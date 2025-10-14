<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\Action::make('mark_processing')
                ->label('Mark Processing')
                ->icon('heroicon-o-arrow-path')
                ->color('primary')
                ->action(fn () => $this->record->update(['status' => 'processing']))
                ->visible(fn (): bool => $this->record->status === 'pending'),
            
            Actions\Action::make('mark_shipped')
                ->label('Mark Shipped')
                ->icon('heroicon-o-truck')
                ->color('info')
                ->action(fn () => $this->record->update(['status' => 'shipped']))
                ->visible(fn (): bool => $this->record->status === 'processing'),
            
            Actions\Action::make('mark_delivered')
                ->label('Mark Delivered')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->action(fn () => $this->record->update(['status' => 'delivered']))
                ->visible(fn (): bool => $this->record->status === 'shipped'),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Order Information')
                    ->schema([
                        Infolists\Components\TextEntry::make('order_number')
                            ->label('Order Number')
                            ->copyable(),
                        
                        Infolists\Components\TextEntry::make('user.name')
                            ->label('Customer')
                            ->url(fn (): string => route('filament.admin.resources.users.view', $this->record->user_id))
                            ->openUrlInNewTab(),
                        
                        Infolists\Components\TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'pending' => 'warning',
                                'processing' => 'primary',
                                'shipped' => 'info',
                                'delivered' => 'success',
                                'cancelled' => 'danger',
                                default => 'gray',
                            }),
                        
                        Infolists\Components\TextEntry::make('payment_status')
                            ->label('Payment Status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'pending' => 'warning',
                                'paid' => 'success',
                                'failed' => 'danger',
                                'refunded' => 'secondary',
                                default => 'gray',
                            }),
                        
                        Infolists\Components\TextEntry::make('payment_method')
                            ->label('Payment Method')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'cod' => 'primary',
                                'card' => 'info',
                                'bank_transfer' => 'secondary',
                                default => 'gray',
                            })
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                'cod' => 'Cash on Delivery',
                                'card' => 'Credit/Debit Card',
                                'bank_transfer' => 'Bank Transfer',
                                default => $state,
                            }),
                        
                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Order Date')
                            ->dateTime('M d, Y g:i A'),
                    ])
                    ->columns(3),
                
                Infolists\Components\Section::make('Order Totals')
                    ->schema([
                        Infolists\Components\TextEntry::make('subtotal')
                            ->label('Subtotal')
                            ->money('USD'),
                        
                        Infolists\Components\TextEntry::make('tax')
                            ->label('Tax')
                            ->money('USD'),
                        
                        Infolists\Components\TextEntry::make('shipping')
                            ->label('Shipping')
                            ->money('USD'),
                        
                        Infolists\Components\TextEntry::make('total')
                            ->label('Total')
                            ->money('USD')
                            ->weight('bold')
                            ->color('success'),
                    ])
                    ->columns(4),
                
                Infolists\Components\Section::make('Addresses')
                    ->schema([
                        Infolists\Components\TextEntry::make('shipping_address')
                            ->label('Shipping Address')
                            ->formatStateUsing(function ($state) {
                                if (!$state) return 'Not provided';
                                
                                $address = is_string($state) ? json_decode($state, true) : $state;
                                
                                if (!is_array($address)) return $state;
                                
                                $filtered = array_filter($address, function($value) {
                                    return !empty($value) && $value !== null;
                                });
                                
                                return !empty($filtered) ? implode(', ', $filtered) : 'Not provided';
                            }),
                        
                        Infolists\Components\TextEntry::make('billing_address')
                            ->label('Billing Address')
                            ->formatStateUsing(function ($state) {
                                if (!$state) return 'Not provided';
                                
                                $address = is_string($state) ? json_decode($state, true) : $state;
                                
                                if (!is_array($address)) return $state;
                                
                                $filtered = array_filter($address, function($value) {
                                    return !empty($value) && $value !== null;
                                });
                                
                                return !empty($filtered) ? implode(', ', $filtered) : 'Not provided';
                            }),
                    ])
                    ->columns(2),
                
                Infolists\Components\Section::make('Order Items')
                    ->schema([
                        Infolists\Components\RepeatableEntry::make('items')
                            ->schema([
                                Infolists\Components\TextEntry::make('product.name')
                                    ->label('Product'),
                                
                                Infolists\Components\TextEntry::make('quantity')
                                    ->label('Quantity')
                                    ->badge(),
                                
                                Infolists\Components\TextEntry::make('price')
                                    ->label('Unit Price')
                                    ->money('USD'),
                                
                                Infolists\Components\TextEntry::make('subtotal')
                                    ->label('Subtotal')
                                    ->money('USD')
                                    ->weight('bold'),
                            ])
                            ->columns(4),
                    ]),
                
                Infolists\Components\Section::make('Additional Information')
                    ->schema([
                        Infolists\Components\TextEntry::make('notes')
                            ->label('Order Notes')
                            ->placeholder('No notes provided'),
                    ])
                    ->collapsible(),
            ]);
    }
}
