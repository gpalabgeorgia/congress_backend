<?php

namespace App\Filament\Resources\CongressSectionResource\Pages;

use App\Filament\Resources\CongressSectionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCongressSections extends ListRecords
{
    protected static string $resource = CongressSectionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
