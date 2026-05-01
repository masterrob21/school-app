<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountStudent extends Model
{
    use HasFactory;

    protected $fillable = ['discount_id', 'student_id'];

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
