<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gls extends Model
{
    use HasFactory;
    protected $table="gls";
    protected $fillable = [ 
        'name',
    ];
}
