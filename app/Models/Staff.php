<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'hire_date',
        'last_name',
        'first_name',
        'date_of_birth',
        'gender_id',
        'address',
        'phone_number',
        'email',
        'branch_id',
        'staff_id',
        'department_id',
    ];
}