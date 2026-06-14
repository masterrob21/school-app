<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'title',
        'sub_total',
        'discount_total',
        'grand_amount',
        'amount_paid',
        'status',
        'due_date',
        'academic_term_id',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function academicTerm()
    {
        return $this->belongsTo(AcademicTerm::class);
    }

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}