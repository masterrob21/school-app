<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'enrollment_date',
        'last_name',
        'other_names',
        'date_of_birth',
        'gender_id',
        'address',
        'phone_number',
        'email',
        'photo_path',
        'branch_id',
        'student_id',
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function discounts()
    {
        return $this->hasMany(DiscountStudent::class);
    }
}
