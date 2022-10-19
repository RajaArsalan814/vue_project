<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agents extends Model
{
    use HasFactory;
    protected $table = 'agents';
    protected $fillable = [
        'user_id',
        'full_name',
        'ic_number',
        'date_of_birth',
        'phone_number',
        'bank_name',
        'ac_no',
        'center_listed',
        'consultant_code'
    ];


    /**
     * Get the user that owns the Agents
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function agent_user_name()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get all of the comments for the Agents
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clients()
    {
        return $this->hasMany(Parents::class, 'agent_code', 'agent_code');
    }

}
