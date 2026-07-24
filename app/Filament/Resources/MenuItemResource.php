<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuItemResource\Pages;
use App\Models\Language;
use App\Models\MenuItem;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class MenuItemResource extends Resource
{
    protected static ?string $model = MenuItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-menu';
    protected static ?string $navigationGroup = 'მთავარი';
    protected static ?string $navigationLabel = 'მთავარი მენიუ';

    public static function form(Form $form): Form
    {
        $languages = Language::where('is_active', true)->orderBy('sort_order', 'asc')->get();

        $tabs = [];

        foreach ($languages as $lang) {
            $isDefault = $lang->is_default;
            $code = $lang->code;

            if ($isDefault) {
                $tabs[] = Forms\Components\Tabs\Tab::make(strtoupper($code))
                    ->schema([
                        Forms\Components\Select::make('parent_id')
                            ->label('მშობელი პუნქტი')
                            ->options(fn ($record) => MenuItem::whereNull('parent_id')
                                ->when($record, fn ($q) => $q->where('id', '!=', $record->id))
                                ->get()
                                ->pluck('translated_title', 'id')
                            )
                            ->placeholder('— მთავარი დონე —')
                            ->nullable(),

                        Forms\Components\TextInput::make("title.{$code}")
                            ->label('სათაური (' . strtoupper($code) . ')')
                            ->required(),

                        Forms\Components\TextInput::make('url')
                            ->label('ლინკი')
                            ->nullable(),

                        Forms\Components\TextInput::make('sort_order')
                            ->label('სორტირება')
                            ->numeric()
                            ->default(1),

                        Forms\Components\Toggle::make('is_active')
                            ->label('აქტიური')
                            ->default(true),

                        Forms\Components\Toggle::make('target_blank')
                            ->label('ახალ ფანჯარაში გახსნა')
                            ->default(false),
                    ]);
            } else {
                $tabs[] = Forms\Components\Tabs\Tab::make(strtoupper($code))
                    ->schema([
                        Forms\Components\TextInput::make("title.{$code}")
                            ->label('სათაური (' . strtoupper($code) . ')')
                            ->nullable(),
                    ]);
            }
        }

        return $form
            ->schema([
                Forms\Components\Tabs::make('Languages')
                    ->tabs($tabs)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('translated_title')
                    ->label('სახელი')
                    ->searchable(),

                Tables\Columns\TextColumn::make('parent.translated_title')
                    ->label('მშობელი პუნქტი')
                    ->default('— ზედა დონე —'),

                Tables\Columns\TextColumn::make('url')
                    ->label('ბმული'),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('აქტიური')
                    ->boolean(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('სორტირება')
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
            'index' => Pages\ListMenuItems::route('/'),
            'create' => Pages\CreateMenuItem::route('/create'),
            'edit' => Pages\EditMenuItem::route('/{record}/edit'),
        ];
    }
}
