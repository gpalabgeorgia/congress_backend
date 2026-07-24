<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeatureResource\Pages;
use App\Models\Feature;
use App\Models\Language;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class FeatureResource extends Resource
{
    protected static ?string $model = Feature::class;

    protected static ?string $navigationIcon = 'heroicon-o-view-grid';
    protected static ?string $navigationGroup = 'მთავარი';
    protected static ?string $navigationLabel = 'ბარათები (Features)';

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

                    Forms\Components\Textarea::make("text.{$code}")
                        ->label('აღწერა (' . strtoupper($code) . ')')
                        ->rows(3)
                        ->required($isRequired),

                    Forms\Components\TextInput::make("action_text.{$code}")
                        ->label('ღილაკის ტექსტი (' . strtoupper($code) . ')')
                        ->default('გაიგე მეტი')
                        ->required($isRequired),
                ]);
        }

        return $form
            ->schema([
                Forms\Components\Section::make('ძირითადი ინფორმაცია')
                    ->schema([
                        Forms\Components\TextInput::make('url')
                            ->label('ბმული')
                            ->default('#')
                            ->required(),

                        Forms\Components\Select::make('card_type')
                            ->label('ბარათის სტილი')
                            ->options([
                                'card--network' => 'Network',
                                'card--culture' => 'Culture',
                                'card--growth' => 'Growth',
                            ])
                            ->default('card--network')
                            ->required(),

                        Forms\Components\TextInput::make('sort_order')
                            ->label('სორტირება')
                            ->numeric()
                            ->default(0),

                        Forms\Components\Toggle::make('is_active')
                            ->label('აქტიურია')
                            ->default(true),
                    ])->columns(2),

                Forms\Components\Section::make('ტექსტების ლოკალიზება')
                    ->schema([
                        Forms\Components\Tabs::make('FeatureLanguages')
                            ->tabs($langTabs),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title.ka')
                    ->label('სათაური (KA)')
                    ->limit(30),

                Tables\Columns\TextColumn::make('card_type')
                    ->label('ბარათის ტიპი'),

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
            'index' => Pages\ListFeatures::route('/'),
            'create' => Pages\CreateFeature::route('/create'),
            'edit' => Pages\EditFeature::route('/{record}/edit'),
        ];
    }
}
