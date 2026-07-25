<?php

namespace App\Filament\Resources\EventItemResource\Pages;

use App\Filament\Resources\EventItemResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEventItem extends EditRecord
{
    protected static string $resource = EventItemResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
