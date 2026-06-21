<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EgpRateResource\Pages;
use App\Models\EgpRateHistory;
use App\Services\CurrencyService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class EgpRateResource extends Resource
{
    protected static ?string $model = EgpRateHistory::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationLabel = 'EGP Exchange Rate';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        $currentRate = app(CurrencyService::class)->getEgpRate();

        return $form
            ->schema([
                Forms\Components\Section::make('Set New Exchange Rate')
                    ->description($currentRate
                        ? 'Current rate: 1 USD = ' . number_format($currentRate, 4) . ' EGP'
                        : 'No rate set yet. EGP option is hidden from customers until a rate is saved.')
                    ->schema([
                        Forms\Components\TextInput::make('rate')
                            ->label('1 USD =')
                            ->suffix('EGP')
                            ->required()
                            ->numeric()
                            ->minValue(0.0001)
                            ->maxValue(100000)
                            ->step(0.0001)
                            ->helperText('Enter how many Egyptian Pounds equal 1 US Dollar. Example: 50.25'),
                        Forms\Components\Textarea::make('notes')
                            ->label('Reason / Notes')
                            ->rows(2)
                            ->maxLength(500)
                            ->helperText('Optional: record why this rate was set (e.g. "CBE rate 2026-06-21")'),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('rate')
                    ->label('1 USD = X EGP')
                    ->formatStateUsing(fn (float $state): string => number_format($state, 4) . ' EGP')
                    ->sortable(),
                Tables\Columns\TextColumn::make('setBy.name')
                    ->label('Set By')
                    ->default('—'),
                Tables\Columns\TextColumn::make('notes')
                    ->label('Notes')
                    ->limit(60)
                    ->default('—'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Set At')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([])
            ->bulkActions([])
            ->emptyStateHeading('No exchange rates set')
            ->emptyStateDescription('Save a rate above to enable EGP display for customers.');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageEgpRates::route('/'),
        ];
    }
}
