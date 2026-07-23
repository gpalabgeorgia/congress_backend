<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdminResource\Pages;
use App\Models\Admin;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Facades\Hash;

class AdminResource extends Resource
{
    protected static ?string $model = Admin::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'ადმინისტრატორები';
    protected static ?string $pluralModelLabel = 'ადმინისტრატორები';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')
                    ->label('სახელი')
                    ->required(),
                Forms\Components\TextInput::make('last_name')
                    ->label('გვარი')
                    ->required(),
                Forms\Components\TextInput::make('country')
                    ->label('ქვეყანა')
                    ->required(),
                Forms\Components\TextInput::make('city')
                    ->label('ქალაქი')
                    ->required(),
                Forms\Components\TextInput::make('address')
                    ->label('მისამართი')
                    ->required(),
                Forms\Components\TextInput::make('phone')
                    ->label('ტელეფონი')
                    ->tel()
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required(),
                Forms\Components\TextInput::make('password')
                    ->label('პაროლი')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('first_name')->label('სახელი')->searchable(),
                Tables\Columns\TextColumn::make('last_name')->label('გვარი')->searchable(),
                Tables\Columns\TextColumn::make('email')->label('Email')->searchable(),
                Tables\Columns\TextColumn::make('phone')->label('ტელეფონი'),
                Tables\Columns\TextColumn::make('country')->label('ქვეყანა'),
                Tables\Columns\TextColumn::make('city')->label('ქალაქი'),
                Tables\Columns\TextColumn::make('created_at')->label('შექმნილია')->dateTime('d.m.Y H:i'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAdmins::route('/'),
            'create' => Pages\CreateAdmin::route('/create'),
            'edit' => Pages\EditAdmin::route('/{record}/edit'),
        ];
    }
}
