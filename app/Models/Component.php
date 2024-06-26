<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;
    protected $table="components";
    protected $fillable = [ 
        'name',
    ];
	protected $casts = [
		'created_at' => 'datetime:Y-m-d H:i:s',
	];
}
