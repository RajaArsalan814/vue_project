<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Public_holiday extends Model
{
    protected $table = 'public_holidays';
    protected $fillable = [
        'title',
        'description',
        'date', 
    ];
 
}
