<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable implements FilamentUser
{
    use Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'country',
        'city',
        'address',
        'phone',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'rememberToken',
    ];

    // Разрешаем доступ к админке
    public function canAccessFilament(): bool
    {
        return true;
    }

    /**
     * Filament v2 вызывает этот метод для получения имени пользователя в шапке.
     * Возвращаем склеенное имя и фамилию или fallback-значение.
     */
    public function getNameAttribute(): string
    {
        $fullName = trim("{$this->first_name} {$this->last_name}");

        return $fullName !== '' ? $fullName : ($this->email ?? 'Admin');
    }
}
