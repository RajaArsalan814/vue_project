<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etoken extends Model
{
    use HasFactory;
    protected $table="e_tokens";
    protected $fillable = [
        'added_by',
        'user_id',
        'token_amount',
    ];
	protected $casts = [
		'created_at' => 'datetime:Y-m-d H:i:s',
	];

    /**
     * Get the user that owns the Etoken
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
