<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FooterSettingResource\Pages;
use App\Models\FooterSetting;
use App\Models\Language;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class FooterSettingResource extends Resource
{
    protected static ?string $model = FooterSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-template';
    protected static ?string $navigationGroup = 'მთავარი';
    protected static ?string $navigationLabel = 'ფუტერი (Footer)';

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
                        ->label('სათაური / ბრენდი (' . strtoupper($code) . ')')
                        ->required($isRequired),

                    Forms\Components\TextInput::make("copyright_text.{$code}")
                        ->label('Copyright ტექსტი (' . strtoupper($code) . ')')
                        ->required($isRequired),

                    Forms\Components\TextInput::make("developer_text.{$code}")
                        ->label('Developer ტექსტი (' . strtoupper($code) . ')')
                        ->required($isRequired),
                ]);
        }

        return $form
            ->schema([
                Forms\Components\Section::make('ძირითადი პარამეტრები')
                    ->schema([
                        Forms\Components\FileUpload::make('logo_path')
                            ->label('ფუტერის ლოგო')
                            ->disk('public_uploads')
                            ->directory('images')
                            ->image()
                            ->nullable(),
                    ]),

                Forms\Components\Section::make('ტექსტები (ენების მიხედვით)')
                    ->schema([
                        Forms\Components\Tabs::make('FooterLanguages')
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

                Tables\Columns\TextColumn::make('copyright_text.ka')
                    ->label('Copyright (KA)'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFooterSettings::route('/'),
            'create' => Pages\CreateFooterSetting::route('/create'),
            'edit' => Pages\EditFooterSetting::route('/{record}/edit'),
        ];
    }
}
