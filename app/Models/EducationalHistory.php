<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'previous_school',
        'attended_date',
        'end_date',
        'level',
    ];
}