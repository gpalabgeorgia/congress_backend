<?php

namespace App\Filament\Resources\EventItemResource\Pages;

use App\Filament\Resources\EventItemResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEventItems extends ListRecords
{
    protected static string $resource = EventItemResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
