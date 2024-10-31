<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountChart extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_head',
        'account_type_id',
        'sort_order',
        'gl_code',
        'is_locked',
    ];
}