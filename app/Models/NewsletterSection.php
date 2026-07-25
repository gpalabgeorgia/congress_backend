<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsletterSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'placeholder_text',
        'button_text',
        'is_active',
    ];

    protected $casts = [
        'title' => 'array',
        'subtitle' => 'array',
        'placeholder_text' => 'array',
        'button_text' => 'array',
        'is_active' => 'boolean',
    ];

    public function getTranslation(string $field, string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        $array = $this->{$field} ?? [];

        return $array[$locale] ?? $array[config('app.fallback_locale')] ?? '';
    }
}
