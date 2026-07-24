<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'text',
        'video_path',
        'poster_path',
        'is_active',
    ];

    protected $casts = [
        'title' => 'array',
        'text' => 'array',
        'video_path' => 'array',
        'is_active' => 'boolean',
    ];

    public function getTranslation(string $field, ?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        return $this->{$field}[$locale] ?? $this->{$field}['ka'] ?? '';
    }
}
