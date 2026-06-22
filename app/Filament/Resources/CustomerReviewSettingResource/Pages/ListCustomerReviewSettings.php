<?php

namespace App\Filament\Resources\CustomerReviewSettingResource\Pages;

use App\Filament\Resources\CustomerReviewSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCustomerReviewSettings extends ListRecords
{
    protected static string $resource = CustomerReviewSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
