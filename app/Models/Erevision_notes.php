<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Erevision_notes extends Model
{
    use HasFactory;
    protected $table="erevision_notes";
  
	protected $casts = [
		'created_at' => 'datetime:Y-m-d H:i:s',
	];
}
