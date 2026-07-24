<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroBannerResource\Pages;
use App\Models\HeroBanner;
use App\Models\Language;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class HeroBannerResource extends Resource
{
    protected static ?string $model = HeroBanner::class;

    protected static ?string $navigationIcon = 'heroicon-o-photograph';
    protected static ?string $navigationGroup = 'მთავარი';
    protected static ?string $navigationLabel = 'მთავარი ბანერი';

    public static function form(Form $form): Form
    {
        $languages = Language::where('is_active', true)->orderBy('sort_order', 'asc')->get();

        // 1. Формируем вкладки с текстами для каждого языка
        $langTabs = [];
        foreach ($languages as $lang) {
            $code = $lang->code;
            $isRequired = $lang->is_default;

            $langTabs[] = Forms\Components\Tabs\Tab::make(strtoupper($code))
                ->schema([
                    Forms\Components\RichEditor::make("title.{$code}")
                        ->label('სათაური (' . strtoupper($code) . ')')
                        ->toolbarButtons([
                            'bold', // Оставлена только кнопка Bold
                        ])
                        ->helperText('გამოყავით საჭირო სიტყვა ან სტროფი და დააწექით "B" (Bold) გასამუქებლად.')
                        ->required($isRequired),

                    Forms\Components\Textarea::make("subtitle.{$code}")
                        ->label('ქვესათაური (' . strtoupper($code) . ')')
                        ->rows(2)
                        ->nullable(),

                    Forms\Components\Textarea::make("desc.{$code}")
                        ->label('აღწერა (' . strtoupper($code) . ')')
                        ->rows(2)
                        ->nullable(),
                ]);
        }

        $featureLangFields = [];
        foreach ($languages as $lang) {
            $code = $lang->code;
            $featureLangFields[] = Forms\Components\TextInput::make("label.{$code}")
                ->label('სახელი (' . strtoupper($code) . ')')
                ->required($lang->is_default);
        }

        return $form
            ->schema([
                Forms\Components\Section::make('ფონური სურათი')
                    ->schema([
                        Forms\Components\FileUpload::make('bg_image')
                            ->label('ბანერის ფონის ატვირთვა')
                            ->image()
                            ->disk('public_uploads')
                            ->directory('hero-banner')
                            ->nullable(),
                    ]),

                Forms\Components\Section::make('ტექსტური ბლოკი')
                    ->schema([
                        Forms\Components\Tabs::make('TextLanguages')
                            ->tabs($langTabs),
                    ]),

                Forms\Components\Section::make(' აიქონები და ბმულები')
                    ->schema([
                        Forms\Components\Repeater::make('features')
                            ->label('ბანერის ელემენტები (ფიჩები)')
                            ->schema([
                                Forms\Components\FileUpload::make('icon')
                                    ->label('აიქონი (PNG)')
                                    ->image()
                                    ->disk('public_uploads')
                                    ->directory('hero-features')
                                    ->required(),

                                Forms\Components\TextInput::make('url')
                                    ->label('ბმული / სექცია (მაგალითად, #cultura или https://...)')
                                    ->required(),

                                Forms\Components\Group::make($featureLangFields)
                                    ->columns(2),
                            ])
                            ->createItemButtonLabel('აიქონის დამატება')
                            ->collapsible()
                            ->defaultItems(0),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('bg_image')
                    ->label('ფონი')
                    ->getStateUsing(function (HeroBanner $record) {
                        return $record->bg_image ? asset('images/' . $record->bg_image) : null;
                    }),

                Tables\Columns\TextColumn::make('title.ka')
                    ->label('სათაური (KA)')
                    ->html()
                    ->limit(50),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('გაახლებულია')
                    ->dateTime('d.m.Y H:i'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHeroBanners::route('/'),
            'create' => Pages\CreateHeroBanner::route('/create'),
            'edit' => Pages\EditHeroBanner::route('/{record}/edit'),
        ];
    }
}
