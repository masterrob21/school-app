<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LedgerAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'ledger_code',
        'ledger_name',
        'account_chart_id',
        'sort_order',
        'allow_journal_entry',
    ];
}