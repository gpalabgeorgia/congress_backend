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
                        ->label('სახელი')
                        ->placeholder('მაგალითად: YouTube')
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(function ($state, callable $set) use ($socialIcons) {
                            if (! $state) return;

                            foreach ($socialIcons as $iconClass => $name) {
                                if (mb_strtolower($state) === mb_strtolower($name)) {
                                    $set('icon', $iconClass);
                                    break;
                                }
                            }
                        }),
                    Select::make('icon')
                        ->label('FontAwesome-ის აიქონი')
                        ->options($socialIcons)
                        ->searchable()
                        ->required()
                        ->helperText('აირჩიეთ სოც.ქსელი სიიდან ან შეიყვანეთ ხელით'),

                    TextInput::make('url')
                        ->label('ლინკი')
                        ->url()
                        ->placeholder('https://youtube.com/@channel')
                        ->required(),

                    TextInput::make('sort_order')
                        ->label('სორტირება')
                        ->numeric()
                        ->default(0),

                    Toggle::make('is_active')
                        ->label('აქტიური')
                        ->default(true),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('სახელი')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('icon')
                    ->label('FontAwesome-ის აიქონი'),

                Tables\Columns\TextColumn::make('url')
                    ->label('ბმული')
                    ->limit(30),

                Tables\Columns\BooleanColumn::make('is_active')
                    ->label('სტატუსი'),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('დახარისხება')
                    ->sortable(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
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
