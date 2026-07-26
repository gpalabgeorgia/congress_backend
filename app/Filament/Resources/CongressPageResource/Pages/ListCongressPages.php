<?php

namespace App\Filament\Resources\CongressPageResource\Pages;

use App\Filament\Resources\CongressPageResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCongressPages extends ListRecords
{
    protected static string $resource = CongressPageResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
