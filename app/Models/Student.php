<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'student_id',
        'name',
        'course',
        'gpa',
    ];

    protected $casts = [
        'gpa' => 'float',
    ];
}