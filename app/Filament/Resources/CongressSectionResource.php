<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CongressSectionResource\Pages;
use App\Models\CongressSection;
use App\Models\Language;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class CongressSectionResource extends Resource
{
    protected static ?string $model = CongressSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-view-list';
    protected static ?string $navigationGroup = 'ჩვენს შესახებ';
    protected static ?string $navigationLabel = 'კონგრესის 1 სექცია';
    protected static ?int $navigationSort = 2;

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

                    Forms\Components\Textarea::make("content.{$code}")
                        ->label('ტექსტი (' . strtoupper($code) . ')')
                        ->rows(5)
                        ->required($isRequired),
                ]);
        }

        return $form
            ->schema([
                Forms\Components\Section::make('პარამეტრები')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('ფოტო')
                            ->disk('public_uploads')
                            ->directory('about')
                            ->image()
                            ->required(),

                        Forms\Components\Select::make('image_position')
                            ->label('ფოტოს პოზიცია')
                            ->options([
                                'left' => 'მარცხნივ (Left)',
                                'right' => 'მარჯვნივ (Right / Reverse)',
                            ])
                            ->default('left')
                            ->required(),

                        Forms\Components\TextInput::make('sort_order')
                            ->label('თანმიმდევრობა')
                            ->numeric()
                            ->default(0),

                        Forms\Components\Toggle::make('is_active')
                            ->label('აქტიური')
                            ->default(true),
                    ])->columns(2),

                Forms\Components\Section::make('ტექსტები (ენების მიხედვით)')
                    ->schema([
                        Forms\Components\Tabs::make('SectionLanguages')
                            ->tabs($langTabs),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('ფოტო')
                    ->getStateUsing(fn ($record) => $record->image ? asset($record->image) : null),

                Tables\Columns\TextColumn::make('title.ka')
                    ->label('სათაური (KA)'),

                Tables\Columns\TextColumn::make('image_position')
                    ->label('პოზიცია'),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('რიგი')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('სტატუსი')
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
            'index' => Pages\ListCongressSections::route('/'),
            'create' => Pages\CreateCongressSection::route('/create'),
            'edit' => Pages\EditCongressSection::route('/{record}/edit'),
        ];
    }
}
