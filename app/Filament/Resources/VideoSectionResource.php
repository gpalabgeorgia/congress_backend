<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VideoSectionResource\Pages;
use App\Models\Language;
use App\Models\VideoSection;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class VideoSectionResource extends Resource
{
    protected static ?string $model = VideoSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-video-camera';
    protected static ?string $navigationGroup = 'მთავარი';
    protected static ?string $navigationLabel = 'ვიდეო პრეზენტაცია (Video)';

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
                        ->rows(4)
                        ->required($isRequired),

                    Forms\Components\FileUpload::make("video_path.{$code}")
                        ->label('ვიდეო ფაილი (' . strtoupper($code) . ')')
                        ->disk('public_uploads') // Выгрузка в public/
                        ->directory('videos')   // Итоговый путь: public/videos
                        ->acceptedFileTypes(['video/mp4', 'video/webm', 'video/ogg'])
                        ->maxSize(102400) // 100 МБ
                        ->required($isRequired),
                ]);
        }

        return $form
            ->schema([
                Forms\Components\Section::make('პარამეტრები')
                    ->schema([
                        Forms\Components\FileUpload::make('poster_path')
                            ->label('ვიდეოს პოსტერი (Обложка)')
                            ->disk('public_uploads')      // Выгрузка в public/
                            ->directory('images/posters') // Итоговый путь: public/images/posters
                            ->image(),

                        Forms\Components\Toggle::make('is_active')
                            ->label('აქტიურია')
                            ->default(true),
                    ])->columns(2),

                Forms\Components\Section::make('ტექსტები და ვიდეო (ენების მიხედვით)')
                    ->schema([
                        Forms\Components\Tabs::make('VideoLanguages')
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

                Tables\Columns\TextColumn::make('created_at')
                    ->label('თარიღი')
                    ->dateTime('d.m.Y H:i'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVideoSections::route('/'),
            'create' => Pages\CreateVideoSection::route('/create'),
            'edit' => Pages\EditVideoSection::route('/{record}/edit'),
        ];
    }
}
