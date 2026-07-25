<?php

namespace App\Filament\Resources\NewsletterSectionResource\Pages;

use App\Filament\Resources\NewsletterSectionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNewsletterSection extends EditRecord
{
    protected static string $resource = NewsletterSectionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
