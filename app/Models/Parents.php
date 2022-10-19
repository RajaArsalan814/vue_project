<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    use HasFactory;
    protected $table = 'parents';
    protected $fillable = [
        'user_id',
        'fullname',
        'gender',
        'date_of_birth',
        'state',
        'city',
        'phone_number',
        'number_of_kids'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the user that owns the Parents
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function agents()
    {
        return $this->belongsTo(Agents::class, 'agent_code', 'agent_code');
    }

    /**
     * Get the user associated with the Parents
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function token()
    {
        return $this->hasOne(Etoken::class, 'id', 'token');
    }
}
