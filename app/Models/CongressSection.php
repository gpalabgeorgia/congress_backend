<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CongressSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'image',
        'image_position',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'title' => 'array',
        'content' => 'array',
        'is_active' => 'boolean',
    ];

    public function getTranslation(string $field, ?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        $array = $this->{$field} ?? [];

        if (is_array($array)) {
            return $array[$locale] ?? $array[config('app.fallback_locale')] ?? reset($array) ?? '';
        }

        return (string) $array;
    }
}
