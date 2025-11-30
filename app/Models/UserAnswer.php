<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAnswer extends Model
{
    protected $fillable = [
        'user_id',
        'question_id',
        'selected_answer',
    ];

    /**
     * Get the user that owns this answer.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the question for this answer.
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
