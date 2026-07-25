<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image_path',
        'link_url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'title' => 'array',
        'is_active' => 'boolean',
    ];

    public function getTranslation(string $field, string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        $array = $this->{$field} ?? [];

        return $array[$locale] ?? $array[config('app.fallback_locale')] ?? '';
    }
}
