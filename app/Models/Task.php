<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{

    const STAGE_BUFFER = 'buffer';
    const STAGE_WORKING = 'working';
    const STAGE_DONE = 'done';

    protected $fillable = ['user_id', 'name', 'stage', 'estimation_at'];

    /**
     * Relationships
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
