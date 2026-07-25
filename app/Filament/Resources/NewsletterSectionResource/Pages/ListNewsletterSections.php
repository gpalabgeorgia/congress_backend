<?php

namespace App\Filament\Resources\NewsletterSectionResource\Pages;

use App\Filament\Resources\NewsletterSectionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNewsletterSections extends ListRecords
{
    protected static string $resource = NewsletterSectionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
