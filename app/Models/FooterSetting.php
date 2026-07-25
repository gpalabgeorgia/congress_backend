<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'copyright_text',
        'developer_text',
        'developer_url',
        'logo_path',
    ];

    protected $casts = [
        'title' => 'array',
        'copyright_text' => 'array',
        'developer_text' => 'array',
    ];

    public function getTranslation(string $field, string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        $array = $this->{$field} ?? [];

        return $array[$locale] ?? $array[config('app.fallback_locale')] ?? '';
    }
}
