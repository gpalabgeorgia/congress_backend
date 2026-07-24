<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LanguageResource\Pages;
use App\Models\Language;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class LanguageResource extends Resource
{
    protected static ?string $model = Language::class;

    protected static ?string $navigationIcon = 'heroicon-o-translate';
    protected static ?string $navigationGroup = null;

    protected static ?string $navigationLabel = 'ენები'; // ენები
    protected static ?string $pluralModelLabel = 'ენები';
    protected static ?string $modelLabel = 'ენა';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\TextInput::make('code')
                        ->label('ენის კოდი (მაგალითად: ka, ru, en)')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(10),

                    Forms\Components\TextInput::make('name')
                        ->label('სახელწოდება (მაგალითად: ქართული, English)')
                        ->required(),

                    Forms\Components\TextInput::make('sort_order')
                        ->label('სორტირება')
                        ->numeric()
                        ->default(0),

                    Forms\Components\Toggle::make('is_default')
                        ->label('ნაგულისხმევი')
                        ->default(false),

                    Forms\Components\Toggle::make('is_active')
                        ->label('აქტიური')
                        ->default(true),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('კოდი')
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('სახელი')
                    ->searchable(),

                Tables\Columns\BooleanColumn::make('is_default')
                    ->label('ნაგულისხმევი'),

                Tables\Columns\BooleanColumn::make('is_active')
                    ->label('აქტიური'),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('დახარისხება')
                    ->sortable(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLanguages::route('/'),
            'create' => Pages\CreateLanguage::route('/create'),
            'edit' => Pages\EditLanguage::route('/{record}/edit'),
        ];
    }
}
