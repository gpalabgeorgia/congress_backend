<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [
        'parent_id',
        'title',
        'url',
        'sort_order',
        'is_active',
        'target_blank',
    ];

    protected $casts = [
        'title' => 'array',
        'is_active' => 'boolean',
        'target_blank' => 'boolean',
    ];

    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id');
    }

    public function getTranslatedTitleAttribute(): string
    {
        $titles = $this->title;

        if (is_array($titles)) {
            $locale = app()->getLocale();
            return $titles[$locale] ?? $titles['ka'] ?? reset($titles) ?: '';
        }

        return is_string($titles) ? $titles : '';
    }
}
