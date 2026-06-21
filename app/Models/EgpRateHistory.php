<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EgpRateHistory extends Model
{
    public $timestamps = false;

    protected $table = 'egp_rate_history';

    protected $fillable = ['rate', 'set_by_user_id', 'notes'];

    protected $casts = [
        'rate' => 'float',
        'created_at' => 'datetime',
    ];

    public function setBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'set_by_user_id');
    }
}
