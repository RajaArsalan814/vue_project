<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eprep_activity extends Model
{
    use HasFactory;
    protected $table="eprep_activitys";
    protected $fillable = [  
        'title',
        'url',
    ];
}
