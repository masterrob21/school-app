<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeType extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'amount',
        'frequency',
        'is_mandatory',
    ];

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}