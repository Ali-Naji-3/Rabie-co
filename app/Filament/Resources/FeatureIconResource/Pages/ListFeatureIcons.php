<?php

namespace App\Filament\Resources\FeatureIconResource\Pages;

use App\Filament\Resources\FeatureIconResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFeatureIcons extends ListRecords
{
    protected static string $resource = FeatureIconResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
