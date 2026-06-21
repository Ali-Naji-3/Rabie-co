<?php

namespace App\Filament\Resources\EgpRateResource\Pages;

use App\Filament\Resources\EgpRateResource;
use App\Models\EgpRateHistory;
use Filament\Actions;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Support\Facades\Auth;

class ManageEgpRates extends ManageRecords
{
    protected static string $resource = EgpRateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Set New Rate')
                ->icon('heroicon-o-pencil-square')
                ->modalHeading('Set EGP Exchange Rate')
                ->modalDescription('A new rate row will be created. The previous rate is preserved in history. This change takes effect immediately for all customers.')
                ->modalSubmitActionLabel('Save Rate')
                ->mutateFormDataUsing(function (array $data): array {
                    $data['set_by_user_id'] = Auth::id();
                    return $data;
                })
                ->successNotificationTitle('Exchange rate updated — EGP prices will update immediately for all customers.'),
        ];
    }
}
