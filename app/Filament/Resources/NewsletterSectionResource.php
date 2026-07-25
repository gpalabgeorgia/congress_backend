<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsletterSectionResource\Pages;
use App\Models\Language;
use App\Models\NewsletterSection;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class NewsletterSectionResource extends Resource
{
    protected static ?string $model = NewsletterSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-mail';
    protected static ?string $navigationGroup = 'მთავარი';
    protected static ?string $navigationLabel = 'სიახლეების გამოწერა';

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

                    Forms\Components\Textarea::make("subtitle.{$code}")
                        ->label('ქვესათაური (' . strtoupper($code) . ')')
                        ->rows(2),

                    Forms\Components\TextInput::make("placeholder_text.{$code}")
                        ->label('ინპუტის ტექსტი (Placeholder)')
                        ->required($isRequired),

                    Forms\Components\TextInput::make("button_text.{$code}")
                        ->label('ღილაკის ტექსტი')
                        ->required($isRequired),
                ]);
        }

        return $form
            ->schema([
                Forms\Components\Section::make('სტატუსი')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('აქტიურია')
                            ->default(true),
                    ]),

                Forms\Components\Section::make('ტექსტები (ენების მიხედვით)')
                    ->schema([
                        Forms\Components\Tabs::make('NewsletterLanguages')
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
                    ->limit(40),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('აქტიური')
                    ->boolean(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNewsletterSections::route('/'),
            'create' => Pages\CreateNewsletterSection::route('/create'),
            'edit' => Pages\EditNewsletterSection::route('/{record}/edit'),
        ];
    }
}
