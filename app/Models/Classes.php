<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    protected $table="classes";
	protected $casts = [
		'created_at' => 'datetime:Y-m-d H:i:s',
	];
}
