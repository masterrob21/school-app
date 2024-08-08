<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_name',
        'first_name',
        'occupation_id',
        'primary_number',
        'secondary_number',
        'email',
        'address',
    ];
}