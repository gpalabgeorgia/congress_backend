<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SocialLinkResource\Pages;
use App\Models\SocialLink;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Card;

class SocialLinkResource extends Resource
{
    protected static ?string $model = SocialLink::class;

    protected static ?string $navigationIcon = 'heroicon-o-share';

    // Помещаем социальные сети в группу "მთავარი"
    protected static ?string $navigationGroup = 'მთავარი';

    protected static ?string $navigationLabel = 'სოციალური ქსელები';
    protected static ?string $pluralModelLabel = 'სოციალური ქსელები';
    protected static ?string $modelLabel = 'სოციალური ქსელი';

    public static function form(Form $form): Form
    {
        // Список популярных соцсетей и их иконок FontAwesome
        $socialIcons = [
            'fa-brands fa-youtube'   => 'YouTube',
            'fa-brands fa-facebook'  => 'Facebook',
            'fa-brands fa-instagram' => 'Instagram',
            'fa-brands fa-telegram'  => 'Telegram',
            'fa-brands fa-whatsapp'  => 'WhatsApp',
            'fa-brands fa-x-twitter' => 'X (Twitter)',
            'fa-brands fa-linkedin'  => 'LinkedIn',
            'fa-brands fa-tiktok'    => 'TikTok',
        ];

        return $form
            ->schema([
                Card::make()->schema([
                    // 1. Поле Название
                    TextInput::make('name')
                        ->label('სახელი / Название')
                        ->placeholder('Например: YouTube')
                        ->required()
                        ->reactive()
                        // Когда админ вводит название, пробуем авто-подставить иконку
                        ->afterStateUpdated(function ($state, callable $set) use ($socialIcons) {
                            if (! $state) return;

                            foreach ($socialIcons as $iconClass => $name) {
                                if (mb_strtolower($state) === mb_strtolower($name)) {
                                    $set('icon', $iconClass);
                                    break;
                                }
                            }
                        }),

                    // 2. Выбор иконки из готового списка (с возможностью ручного ввода)
                    Select::make('icon')
                        ->label('Иконка FontAwesome')
                        ->options($socialIcons)
                        ->searchable()
                        ->required()
                        ->helperText('Выберите соцсеть из списка или введите класс вручную'),

                    TextInput::make('url')
                        ->label('ლინკი / Ссылка')
                        ->url()
                        ->placeholder('https://youtube.com/@channel')
                        ->required(),

                    TextInput::make('sort_order')
                        ->label('სორტირება / Порядок')
                        ->numeric()
                        ->default(0),

                    Toggle::make('is_active')
                        ->label('აქტიური / Активен')
                        ->default(true),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('icon')
                    ->label('Иконка FontAwesome'),

                Tables\Columns\TextColumn::make('url')
                    ->label('Ссылка')
                    ->limit(30),

                Tables\Columns\BooleanColumn::make('is_active')
                    ->label('Активен'),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Сортировка')
                    ->sortable(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->actions([
                EditAction::make(),
                DeleteAction::make(), // Кнопка «Удалить» для каждой строки
            ])
            ->bulkActions([
                DeleteBulkAction::make(), // Групповое удаление галочками
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSocialLinks::route('/'),
            'create' => Pages\CreateSocialLink::route('/create'),
            'edit' => Pages\EditSocialLink::route('/{record}/edit'),
        ];
    }
}
