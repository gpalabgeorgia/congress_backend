<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventItemResource\Pages;
use App\Models\EventItem;
use App\Models\Language;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class EventItemResource extends Resource
{
    protected static ?string $model = EventItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationGroup = 'მთავარი';
    protected static ?string $navigationLabel = 'ღონისძიებები';

    public static function form(Form $form): Form
    {
        $languages = Language::where('is_active', true)->orderBy('sort_order', 'asc')->get();

        $langTabs = [];
        foreach ($languages as $lang) {
            $code = $lang->code;
            $isRequired = $lang->is_default;

            $langTabs[] = Forms\Components\Tabs\Tab::make(strtoupper($code))
                ->schema([
                    Forms\Components\TextInput::make("title.{$code}")
                        ->label('სათაური (' . strtoupper($code) . ')')
                        ->required($isRequired),
                ]);
        }

        return $form
            ->schema([
                Forms\Components\Section::make('ინფორმაცია')
                    ->schema([
                        Forms\Components\FileUpload::make('image_path')
                            ->label('ფოტო')
                            ->disk('public_uploads')
                            ->directory('images/events')
                            ->image()
                            ->required(),

                        Forms\Components\TextInput::make('link_url')
                            ->label('ბმული "დეტალურად"')
                            ->nullable(),

                        Forms\Components\TextInput::make('sort_order')
                            ->label('სორტირება')
                            ->numeric()
                            ->default(0),

                        Forms\Components\Toggle::make('is_active')
                            ->label('აქტიურია')
                            ->default(true),
                    ])->columns(2),

                Forms\Components\Section::make('ტექსტი')
                    ->schema([
                        Forms\Components\Tabs::make('EventLanguages')
                            ->tabs($langTabs),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('სურათი')
                    ->disk('public_uploads')
                    ->getStateUsing(function ($record) {
                        return asset($record->image_path);
                    })
                    ->square()
                    ->size(40),

                Tables\Columns\TextColumn::make('title.ka')
                    ->label('სათაური (KA)')
                    ->limit(40),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('რიგი')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('აქტიური')
                    ->boolean(),
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
            'index' => Pages\ListEventItems::route('/'),
            'create' => Pages\CreateEventItem::route('/create'),
            'edit' => Pages\EditEventItem::route('/{record}/edit'),
        ];
    }
}
