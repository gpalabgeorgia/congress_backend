<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuItemResource\Pages;
use App\Models\MenuItem;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class MenuItemResource extends Resource
{
    protected static ?string $model = MenuItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-menu-alt-2';
    protected static ?string $navigationGroup = 'მთავარი';
    protected static ?string $navigationLabel = 'მთავარი მენიუ';
    protected static ?string $pluralModelLabel = 'მთავარი მენიუ';
    protected static ?string $modelLabel = 'მენიუს პუნქტი';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    // Выбор родительского пункта (для подкатегорий)
                    Forms\Components\Select::make('parent_id')
                        ->label('მშობელი პუნქტი')
                        ->options(function (?MenuItem $record) {
                            // Получаем только пункты верхнего уровня
                            $query = MenuItem::whereNull('parent_id');

                            // При редактировании исключаем сам этот пункт из списка
                            if ($record) {
                                $query->where('id', '!=', $record->id);
                            }

                            return $query->pluck('title', 'id');
                        })
                        ->placeholder('— მთავარი დონე —')
                        ->searchable()
                        ->nullable(),

                    Forms\Components\TextInput::make('title')
                        ->label('სათაური')
                        ->placeholder('მაგალითად: კონგრესები')
                        ->required(),

                    Forms\Components\TextInput::make('url')
                        ->label('ლინკი')
                        ->placeholder('მაგალითად: /congresses или #')
                        ->nullable(),

                    Forms\Components\TextInput::make('sort_order')
                        ->label('სორტირება')
                        ->numeric()
                        ->default(0),

                    Forms\Components\Toggle::make('is_active')
                        ->label('აქტიური')
                        ->default(true),

                    Forms\Components\Toggle::make('target_blank')
                        ->label('ახალ ფანჯარაში გახსნა')
                        ->default(false),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('სახელი')
                    ->searchable()
                    ->sortable(),

                // Показываем, к какому родителю относится (если это подпункт)
                Tables\Columns\TextColumn::make('parent.title')
                    ->label('მშობელი პუნქტი')
                    ->default('— ზედა დონე —')
                    ->sortable(),

                Tables\Columns\TextColumn::make('url')
                    ->label('ბმული'),

                Tables\Columns\BooleanColumn::make('is_active')
                    ->label('სტატუსი'),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('დახარისხება')
                    ->sortable(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
