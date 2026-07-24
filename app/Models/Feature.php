<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = [
        'title',
        'text',
        'action_text',
        'url',
        'card_type',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'title' => 'array',
        'text' => 'array',
        'action_text' => 'array',
        'is_active' => 'boolean',
    ];

    public function getTranslation(string $field, ?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        return $this->{$field}[$locale] ?? $this->{$field}['ka'] ?? '';
    }
}
