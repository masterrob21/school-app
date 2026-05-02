<?php

namespace App\Http\Controllers;

use App\Models\FeeType;
use App\Models\DiscountStudent;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class InvoiceController extends Controller
{
    private const STATUS_UNPAID = 'unpaid';

    private const STATUS_PARTIALLY_PAID = 'partially_paid';

    private const STATUS_PAID = 'paid';

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $invoices = Invoice::with('student')->latest()->get();

        return view('invoices.index')->with('invoices', $invoices);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $students = Student::orderBy('last_name')->orderBy('other_names')->get();

        return view('invoices.create')
            ->with('students', $students)
            ->with('feeTypes', FeeType::orderBy('name')->get())
            ->with('studentDiscounts', $this->studentDiscountMap());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'title' => ['required', 'string', 'max:255'],
            'due_date' => ['nullable', 'date'],
            'invoice_items' => ['required', 'array', 'min:1'],
            'invoice_items.*.name' => ['required', 'string', 'max:255'],
            'invoice_items.*.amount' => ['required', 'numeric', 'min:0.01'],
            'invoice_items.*.fee_type_id' => ['nullable', 'exists:fee_types,id'],
        ]);

        $subTotal = collect($validated['invoice_items'])->sum(function (array $item): float {
            return (float) $item['amount'];
        });
        $discountTotal = $this->calculateDiscountTotal((int) $validated['student_id'], $subTotal);
        $amountPaid = 0.0;

        $grandAmount = $subTotal - $discountTotal;

        if ($amountPaid > $grandAmount) {
            return back()->withErrors(['amount_paid' => 'Amount paid cannot exceed grand amount.'])->withInput();
        }

        DB::transaction(function () use ($validated, $subTotal, $discountTotal, $grandAmount, $amountPaid): void {
            $invoice = Invoice::create([
                'student_id' => $validated['student_id'],
                'title' => $validated['title'],
                'sub_total' => $subTotal,
                'discount_total' => $discountTotal,
                'grand_amount' => $grandAmount,
                'amount_paid' => $amountPaid,
                'status' => $this->resolveStatus($amountPaid, $grandAmount),
                'due_date' => $validated['due_date'] ?? null,
            ]);

            $items = collect($validated['invoice_items'])->map(function (array $item) use ($invoice): array {
                return [
                    'invoice_id' => $invoice->id,
                    'fee_type_id' => $item['fee_type_id'] ?? null,
                    'name' => $item['name'],
                    'amount' => (float) $item['amount'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            })->all();

            InvoiceItem::insert($items);
        });

        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice): View
    {
        $invoice->load(['student', 'invoiceItems.feeType', 'payments.paymentMode']);

        return view('invoices.show')->with('invoice', $invoice);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice): View
    {
        $invoice->load('invoiceItems');

        $students = Student::orderBy('last_name')->orderBy('other_names')->get();

        return view('invoices.edit')
            ->with('invoice', $invoice)
            ->with('students', $students)
            ->with('feeTypes', FeeType::orderBy('name')->get())
            ->with('studentDiscounts', $this->studentDiscountMap());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice): RedirectResponse
    {
        $validated = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'title' => ['required', 'string', 'max:255'],
            'due_date' => ['nullable', 'date'],
            'invoice_items' => ['required', 'array', 'min:1'],
            'invoice_items.*.name' => ['required', 'string', 'max:255'],
            'invoice_items.*.amount' => ['required', 'numeric', 'min:0.01'],
            'invoice_items.*.fee_type_id' => ['nullable', 'exists:fee_types,id'],
        ]);

        $subTotal = collect($validated['invoice_items'])->sum(function (array $item): float {
            return (float) $item['amount'];
        });
        $discountTotal = $this->calculateDiscountTotal((int) $validated['student_id'], $subTotal);
        $amountPaid = (float) $invoice->amount_paid;

        $grandAmount = $subTotal - $discountTotal;

        if ($amountPaid > $grandAmount) {
            return back()->withErrors(['amount_paid' => 'Amount paid cannot exceed grand amount.'])->withInput();
        }

        DB::transaction(function () use ($validated, $invoice, $subTotal, $discountTotal, $grandAmount, $amountPaid): void {
            $invoice->update([
                'student_id' => $validated['student_id'],
                'title' => $validated['title'],
                'sub_total' => $subTotal,
                'discount_total' => $discountTotal,
                'grand_amount' => $grandAmount,
                'amount_paid' => $amountPaid,
                'status' => $this->resolveStatus($amountPaid, $grandAmount),
                'due_date' => $validated['due_date'] ?? null,
            ]);

            $invoice->invoiceItems()->delete();

            $items = collect($validated['invoice_items'])->map(function (array $item) use ($invoice): array {
                return [
                    'invoice_id' => $invoice->id,
                    'fee_type_id' => $item['fee_type_id'] ?? null,
                    'name' => $item['name'],
                    'amount' => (float) $item['amount'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            })->all();

            InvoiceItem::insert($items);
        });

        return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice): RedirectResponse
    {
        if ((float) $invoice->amount_paid > 0) {
            return redirect()->route('invoices.index')->with('error', 'Cannot delete an invoice that has payment records.');
        }

        $invoice->delete();

        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully.');
    }

    private function resolveStatus(float $amountPaid, float $grandAmount): string
    {
        if ($grandAmount <= 0 || $amountPaid >= $grandAmount) {
            return self::STATUS_PAID;
        }

        if ($amountPaid > 0) {
            return self::STATUS_PARTIALLY_PAID;
        }

        return self::STATUS_UNPAID;
    }

    private function calculateDiscountTotal(int $studentId, float $subTotal): float
    {
        $discounts = DiscountStudent::with('discount:id,type,value')
            ->where('student_id', $studentId)
            ->get();

        $discountTotal = 0.0;

        foreach ($discounts as $discountStudent) {
            if (!$discountStudent->discount) {
                continue;
            }

            if ($discountStudent->discount->type === 'percentage') {
                $discountTotal += $subTotal * ((float) $discountStudent->discount->value / 100);
                continue;
            }

            $discountTotal += (float) $discountStudent->discount->value;
        }

        return min($subTotal, round($discountTotal, 2));
    }

    private function studentDiscountMap(): array
    {
        return DiscountStudent::with('discount:id,type,value,name')
            ->get()
            ->groupBy('student_id')
            ->map(function ($items) {
                return $items->map(function ($discountStudent) {
                    return [
                        'type' => $discountStudent->discount?->type,
                        'value' => (float) ($discountStudent->discount?->value ?? 0),
                        'name' => $discountStudent->discount?->name,
                    ];
                })->values();
            })
            ->toArray();
    }
}