<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $table = 'announcements';
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'announced_audience',
        'announcement_date',
        'announcement_time',
        'announcement_type',   
    ];
}
