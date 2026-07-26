<?php

namespace App\Filament\Resources\CongressPageResource\Pages;

use App\Filament\Resources\CongressPageResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCongressPage extends EditRecord
{
    protected static string $resource = CongressPageResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
