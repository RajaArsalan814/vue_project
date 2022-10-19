<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_assign_modules extends Model
{
    use HasFactory;
    protected $table="student_assign_modules";
	protected $casts = [
		'created_at' => 'datetime:Y-m-d H:i:s',
	];
 
}
