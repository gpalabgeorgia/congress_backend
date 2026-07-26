<?php

namespace App\Filament\Resources\ActivityAndConnectionResource\Pages;

use App\Filament\Resources\ActivityAndConnectionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListActivityAndConnections extends ListRecords
{
    protected static string $resource = ActivityAndConnectionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
