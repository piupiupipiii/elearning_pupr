<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Material extends Model
{
    protected $fillable = [
        'section_number',
        'title',
        'description',
        'youtube_url',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    /**
     * Get the questions for this material.
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    /**
     * Get the user progress records for this material.
     */
    public function userProgress(): HasMany
    {
        return $this->hasMany(UserProgress::class);
    }

    /**
     * Extract YouTube video ID from URL.
     */
    public function getYoutubeIdAttribute(): string
    {
        $url = $this->youtube_url;

        // If it's already just an ID (11 characters)
        if (preg_match('/^[a-zA-Z0-9_-]{11}$/', $url)) {
            return $url;
        }

        // Extract from various YouTube URL formats
        if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $matches)) {
            return $matches[1];
        }

        return $url;
    }
}
