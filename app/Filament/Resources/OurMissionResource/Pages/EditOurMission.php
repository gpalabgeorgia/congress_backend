<?php

namespace App\Filament\Resources\OurMissionResource\Pages;

use App\Filament\Resources\OurMissionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOurMission extends EditRecord
{
    protected static string $resource = OurMissionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
