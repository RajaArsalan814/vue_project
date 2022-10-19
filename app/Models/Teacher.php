<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $table="teachers";
    protected $fillable = [
        'user_id',
        'country',
        'designation',
        'first_name',
        'last_name',
        'gender',
        'date_of_birth',
        'phone_number',
        'address',
        'education_level',
        'teacher_type',
        'ic_no',
    ]; 
}
