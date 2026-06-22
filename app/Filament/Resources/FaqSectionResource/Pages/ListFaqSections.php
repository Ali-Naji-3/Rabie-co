<?php

namespace App\Filament\Resources\FaqSectionResource\Pages;

use App\Filament\Resources\FaqSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFaqSections extends ListRecords
{
    protected static string $resource = FaqSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
