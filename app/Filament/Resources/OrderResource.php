<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Support\Enums\FontWeight;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $navigationLabel = 'Orders';

    protected static ?string $modelLabel = 'Order';

    protected static ?string $pluralModelLabel = 'Orders';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Order Information')
                    ->schema([
                        Forms\Components\TextInput::make('order_number')
                            ->label('Order Number')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(1),
                        
                        Forms\Components\Select::make('user_id')
                            ->label('Customer')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->columnSpan(1),
                        
                        Forms\Components\Select::make('status')
                            ->label('Order Status')
                            ->options([
                                'pending' => 'Pending',
                                'processing' => 'Processing',
                                'shipped' => 'Shipped',
                                'delivered' => 'Delivered',
                                'cancelled' => 'Cancelled',
                            ])
                            ->required()
                            ->columnSpan(1),
                        
                        Forms\Components\Select::make('payment_status')
                            ->label('Payment Status')
                            ->options([
                                'pending' => 'Pending',
                                'paid' => 'Paid',
                                'failed' => 'Failed',
                                'refunded' => 'Refunded',
                            ])
                            ->required()
                            ->columnSpan(1),
                        
                        Forms\Components\Select::make('payment_method')
                            ->label('Payment Method')
                            ->options([
                                'cod' => 'Cash on Delivery',
                                'card' => 'Credit/Debit Card',
                                'bank_transfer' => 'Bank Transfer',
                            ])
                            ->required()
                            ->columnSpan(2),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Order Totals')
                    ->schema([
                        Forms\Components\TextInput::make('subtotal')
                            ->label('Subtotal')
                            ->numeric()
                            ->prefix('$')
                            ->required()
                            ->columnSpan(1),
                        
                        Forms\Components\TextInput::make('tax')
                            ->label('Tax')
                            ->numeric()
                            ->prefix('$')
                            ->required()
                            ->columnSpan(1),
                        
                        Forms\Components\TextInput::make('shipping')
                            ->label('Shipping')
                            ->numeric()
                            ->prefix('$')
                            ->required()
                            ->columnSpan(1),
                        
                        Forms\Components\TextInput::make('total')
                            ->label('Total')
                            ->numeric()
                            ->prefix('$')
                            ->required()
                            ->columnSpan(1),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Addresses')
                    ->schema([
                        Forms\Components\Textarea::make('shipping_address')
                            ->label('Shipping Address')
                            ->rows(4)
                            ->columnSpan(1),
                        
                        Forms\Components\Textarea::make('billing_address')
                            ->label('Billing Address')
                            ->rows(4)
                            ->columnSpan(1),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Additional Information')
                    ->schema([
                        Forms\Components\Textarea::make('notes')
                            ->label('Order Notes')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_number')
                    ->label('Order #')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->weight(FontWeight::Bold),
                
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable()
                    ->url(fn (Order $record): string => route('filament.admin.resources.users.view', $record->user_id))
                    ->openUrlInNewTab(),
                
                Tables\Columns\TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'primary' => 'processing',
                        'info' => 'shipped',
                        'success' => 'delivered',
                        'danger' => 'cancelled',
                    ])
                    ->sortable(),
                
                Tables\Columns\BadgeColumn::make('payment_status')
                    ->label('Payment')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'paid',
                        'danger' => 'failed',
                        'secondary' => 'refunded',
                    ])
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Payment Method')
                    ->badge()
                    ->colors([
                        'primary' => 'cod',
                        'info' => 'card',
                        'secondary' => 'bank_transfer',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'cod' => 'Cash on Delivery',
                        'card' => 'Credit/Debit Card',
                        'bank_transfer' => 'Bank Transfer',
                        default => $state,
                    })
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('total')
                    ->label('Total')
                    ->money('USD')
                    ->sortable()
                    ->weight(FontWeight::Bold)
                    ->color('success'),
                
                Tables\Columns\TextColumn::make('items_count')
                    ->label('Items')
                    ->counts('items')
                    ->badge()
                    ->color('info'),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Order Date')
                    ->dateTime('M d, Y g:i A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled',
                    ]),
                
                SelectFilter::make('payment_status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                        'refunded' => 'Refunded',
                    ]),
                
                SelectFilter::make('payment_method')
                    ->options([
                        'cod' => 'Cash on Delivery',
                        'card' => 'Credit/Debit Card',
                        'bank_transfer' => 'Bank Transfer',
                    ]),
                
                TernaryFilter::make('created_at')
                    ->label('Recent Orders')
                    ->queries(
                        true: fn (Builder $query) => $query->where('created_at', '>=', now()->subDays(7)),
                        false: fn (Builder $query) => $query->where('created_at', '<', now()->subDays(7)),
                    ),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                
                // Order Status Actions
                Tables\Actions\Action::make('mark_processing')
                    ->label('Mark Processing')
                    ->icon('heroicon-o-arrow-path')
                    ->color('primary')
                    ->action(fn (Order $record) => $record->update(['status' => 'processing']))
                    ->visible(fn (Order $record): bool => $record->status === 'pending'),
                
                Tables\Actions\Action::make('mark_shipped')
                    ->label('Mark Shipped')
                    ->icon('heroicon-o-truck')
                    ->color('info')
                    ->action(fn (Order $record) => $record->update(['status' => 'shipped']))
                    ->visible(fn (Order $record): bool => $record->status === 'processing'),
                
                Tables\Actions\Action::make('mark_delivered')
                    ->label('Mark Delivered')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->action(fn (Order $record) => $record->update(['status' => 'delivered']))
                    ->visible(fn (Order $record): bool => $record->status === 'shipped'),
                
                // Payment Status Actions
                Tables\Actions\Action::make('mark_paid')
                    ->label('Mark Paid')
                    ->icon('heroicon-o-currency-dollar')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(fn (Order $record) => $record->update(['payment_status' => 'paid']))
                    ->visible(fn (Order $record): bool => $record->payment_status === 'pending'),
                
                Tables\Actions\Action::make('mark_failed')
                    ->label('Mark Failed')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(fn (Order $record) => $record->update(['payment_status' => 'failed']))
                    ->visible(fn (Order $record): bool => $record->payment_status === 'pending'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    
                    Tables\Actions\BulkAction::make('mark_processing')
                        ->label('Mark as Processing')
                        ->icon('heroicon-o-arrow-path')
                        ->action(fn ($records) => $records->each->update(['status' => 'processing']))
                        ->deselectRecordsAfterCompletion(),
                    
                    Tables\Actions\BulkAction::make('mark_shipped')
                        ->label('Mark as Shipped')
                        ->icon('heroicon-o-truck')
                        ->action(fn ($records) => $records->each->update(['status' => 'shipped']))
                        ->deselectRecordsAfterCompletion(),
                    
                    Tables\Actions\BulkAction::make('mark_delivered')
                        ->label('Mark as Delivered')
                        ->icon('heroicon-o-check-circle')
                        ->action(fn ($records) => $records->each->update(['status' => 'delivered']))
                        ->deselectRecordsAfterCompletion(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['user', 'items.product']);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
