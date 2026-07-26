<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CongressPageResource\Pages;
use App\Models\CongressPage;
use App\Models\Language;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class CongressPageResource extends Resource
{
    protected static ?string $model = CongressPage::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'ჩვენს შესახებ';
    protected static ?string $navigationLabel = 'კონგრესი (ბანერი)';

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
                        ->label('ბანერის სათაური (' . strtoupper($code) . ')')
                        ->required($isRequired),

                    Forms\Components\TextInput::make("subtitle.{$code}")
                        ->label('ბანერის ქვესათაური (' . strtoupper($code) . ')')
                        ->required($isRequired),

                    Forms\Components\Textarea::make("intro_text.{$code}")
                        ->label('შესავალი ტექსტი (' . strtoupper($code) . ')')
                        ->rows(4)
                        ->required($isRequired),
                ]);
        }

        return $form
            ->schema([
                Forms\Components\Section::make('ტექსტები (ენების მიხედვით)')
                    ->schema([
                        Forms\Components\Tabs::make('CongressLanguages')
                            ->tabs($langTabs),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title.ka')
                    ->label('სათაური (KA)'),

                Tables\Columns\TextColumn::make('subtitle.ka')
                    ->label('ქვესათაური (KA)'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCongressPages::route('/'),
            'create' => Pages\CreateCongressPage::route('/create'),
            'edit' => Pages\EditCongressPage::route('/{record}/edit'),
        ];
    }
}
