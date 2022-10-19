<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom_activity extends Model
{
    use HasFactory;
    protected $table="classroom_activitys";
    protected $fillable = [ 
        'type',
        'title',
        'url',
    ];
}
