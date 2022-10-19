<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table="students";
    protected $fillable = [
        'user_id',
        'parent_id',
        'student_name',
        'last_name',
        'gender',
        'gender',
        'date_of_birth',
        'current_school',
        'student_phone_number',
    ];



}
