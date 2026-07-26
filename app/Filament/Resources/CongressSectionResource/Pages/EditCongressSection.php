<?php

namespace App\Filament\Resources\CongressSectionResource\Pages;

use App\Filament\Resources\CongressSectionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCongressSection extends EditRecord
{
    protected static string $resource = CongressSectionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
