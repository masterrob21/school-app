<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    public $incrementing = false;

    # datatype of the primary key id
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'currency',
    ];
}