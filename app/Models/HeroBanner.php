<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroBanner extends Model
{
    protected $fillable = [
        'bg_image',
        'title',
        'subtitle',
        'desc',
        'features',
    ];

    protected $casts = [
        'title' => 'array',
        'subtitle' => 'array',
        'desc' => 'array',
        'features' => 'array',
    ];

    // Хелпер для получения перевода с фолбэком на 'ka'
    public function getTranslation(string $field, ?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        return $this->{$field}[$locale] ?? $this->{$field}['ka'] ?? '';
    }

    // Полный путь к фоновой картинке
    public function getBgImageUrlAttribute(): string
    {
        return $this->bg_image
            ? asset('images/' . $this->bg_image)
            : asset('images/hero-bg.jpg');
    }

    // Подготовленный массив фич для текущей локали
    public function getFormattedFeaturesAttribute(): array
    {
        if (empty($this->features) || !is_array($this->features)) {
            return [];
        }

        $locale = app()->getLocale();

        return array_map(function ($item) use ($locale) {
            return [
                'icon' => !empty($item['icon']) ? asset('images/' . $item['icon']) : '',
                'url' => $item['url'] ?? '#',
                'label' => $item['label'][$locale] ?? $item['label']['ka'] ?? '',
            ];
        }, $this->features);
    }
}
