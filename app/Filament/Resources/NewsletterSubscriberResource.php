<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsletterSubscriberResource\Pages;
use App\Models\NewsletterSubscriber;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class NewsletterSubscriberResource extends Resource
{
    protected static ?string $model = NewsletterSubscriber::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'მთავარი';
    protected static ?string $navigationLabel = 'გამომწერები';

    // Отключаем создание новых записей вручную
    public static function canCreate(): bool
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->label('სახელი')
                    ->searchable(),

                Tables\Columns\TextColumn::make('last_name')
                    ->label('გვარი')
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('გამოწერის თარიღი (Дата)')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_blocked')
                    ->label('ბლოკი')
                    ->boolean()
                    ->trueIcon('heroicon-o-lock-closed')
                    ->falseIcon('heroicon-o-lock-open')
                    ->trueColor('danger')
                    ->falseColor('success'),

                Tables\Columns\TextColumn::make('warned_at')
                    ->label('გაფრთხილება')
                    ->dateTime('d.m.Y H:i')
                    ->placeholder('—'),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                // 1. Кнопка "Предупредить"
                Tables\Actions\Action::make('warn')
                    ->label('გაფრთხილება')
                    ->icon('heroicon-o-exclamation')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->modalHeading('გაფრთხილების გაგზავნა')
                    ->modalSubheading('დარწმუნებული ხართ, რომ გსურთ მომხმარებლის გაფრთხილება?')
                    ->action(function (NewsletterSubscriber $record) {
                        $record->update(['warned_at' => now()]);

                        Notification::make()
                            ->title('მომხმარებელი გაფრთხილებულია')
                            ->warning()
                            ->send();
                    }),

                Tables\Actions\Action::make('toggle_block')
                    ->label(fn (NewsletterSubscriber $record) => $record->is_blocked ? 'განბლოკვა' : 'დაბლოკვა')
                    ->icon(fn (NewsletterSubscriber $record) => $record->is_blocked ? 'heroicon-o-lock-open' : 'heroicon-o-lock-closed')
                    ->color(fn (NewsletterSubscriber $record) => $record->is_blocked ? 'success' : 'danger')
                    ->requiresConfirmation()
                    ->action(function (NewsletterSubscriber $record) {
                        $record->update(['is_blocked' => !$record->is_blocked]);

                        Notification::make()
                            ->title($record->is_blocked ? 'მომხმარებელი დაბლოკილია' : 'მომხმარებელი განბლოკილია')
                            ->send();
                    }),

                // 3. Кнопка "Удалить"
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNewsletterSubscribers::route('/'),
        ];
    }
}
