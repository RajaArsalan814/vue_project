<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $table="lessons";
    protected $fillable = [ 
        'module_id',
        'component',
        'title',
        
        
    ];
}
