<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_code',
        'ledger_id',
        'debit',
        'credit',
        'valued_date',
        'entry_date',
        'description',
        'balance',
        'branch_id',
        'user_id',
    ];
}