<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    protected $fillable = [
        'material_id',
        'question_text',
        'options',
        'correct_answer',
    ];

    protected $casts = [
        'options' => 'array',
    ];

    /**
     * Get the material that owns this question.
     */
    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }

    /**
     * Get the user answers for this question.
     */
    public function userAnswers(): HasMany
    {
        return $this->hasMany(UserAnswer::class);
    }
}
