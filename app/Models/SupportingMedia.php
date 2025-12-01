<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportingMedia extends Model
{
    protected $table = 'supporting_media';

    protected $fillable = [
        'title',
        'description',
        'file_type',
        'file_path',
        'file_name',
        'file_size',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
        'file_size' => 'integer',
    ];

    /**
     * Get human-readable file size
     */
    public function getFormattedSizeAttribute(): string
    {
        $bytes = $this->file_size;

        if ($bytes == 0) {
            return '0 B';
        }

        $units = ['B', 'KB', 'MB', 'GB'];
        $i = floor(log($bytes, 1024));

        return round($bytes / pow(1024, $i), 2) . ' ' . $units[$i];
    }

    /**
     * Get file icon based on type
     */
    public function getIconAttribute(): string
    {
        $iconMap = [
            'pdf' => 'file-pdf',
            'doc' => 'file-word',
            'docx' => 'file-word',
            'ppt' => 'file-powerpoint',
            'pptx' => 'file-powerpoint',
            'xls' => 'file-excel',
            'xlsx' => 'file-excel',
        ];

        return $iconMap[$this->file_type] ?? 'file';
    }
}
