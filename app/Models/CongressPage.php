<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CongressPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'intro_text',
    ];

    protected $casts = [
        'title' => 'array',
        'subtitle' => 'array',
        'intro_text' => 'array',
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
