<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerReviewResource\Pages;
use App\Models\CustomerReview;
use App\Services\ImageOptimizationService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CustomerReviewResource extends Resource
{
    protected static ?string $model = CustomerReview::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationLabel = 'Customer Reviews';

    protected static ?string $modelLabel = 'Customer Review';

    protected static ?string $pluralModelLabel = 'Customer Reviews';

    protected static ?string $navigationGroup = 'Homepage Management';

    protected static ?int $navigationSort = 11;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Review')
                    ->schema([
                        Forms\Components\TextInput::make('customer_name')
                            ->label('Customer Name')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('title')
                            ->label('Review Title')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Textarea::make('description')
                            ->label('Review Description')
                            ->required()
                            ->rows(4)
                            ->maxLength(2000)
                            ->columnSpanFull(),

                        Forms\Components\Select::make('rating')
                            ->label('Rating')
                            ->options([
                                1 => '1 Star',
                                2 => '2 Stars',
                                3 => '3 Stars',
                                4 => '4 Stars',
                                5 => '5 Stars',
                            ])
                            ->required()
                            ->default(5),

                        Forms\Components\FileUpload::make('image')
                            ->label('Review Image')
                            ->image()
                            ->directory('customer-reviews')
                            ->maxSize(2048)
                            ->helperText('Optimized to WebP (max 800px) on save.')
                            // SSOT: route admin uploads through the same optimizer the public path uses.
                            ->saveUploadedFileUsing(function (TemporaryUploadedFile $file) {
                                return app(ImageOptimizationService::class)->optimizeAndStore($file, 'customer-reviews');
                            })
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Moderation')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                CustomerReview::STATUS_PENDING => 'Pending',
                                CustomerReview::STATUS_APPROVED => 'Approved',
                                CustomerReview::STATUS_REJECTED => 'Rejected',
                            ])
                            ->default(CustomerReview::STATUS_PENDING)
                            ->required(),

                        Forms\Components\Toggle::make('is_pinned')
                            ->label('Pin to Homepage')
                            ->default(false)
                            ->helperText('Pinned reviews appear first.')
                            ->inline(false),

                        Forms\Components\TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower numbers appear first.')
                            ->required(),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Customer')
                    ->searchable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->limit(40),

                Tables\Columns\TextColumn::make('rating')
                    ->label('Rating')
                    ->badge()
                    ->color(fn (int $state): string => match (true) {
                        $state >= 4 => 'success',
                        $state === 3 => 'info',
                        $state === 2 => 'warning',
                        default => 'danger',
                    })
                    ->formatStateUsing(fn (int $state): string => str_repeat('⭐', $state)." ({$state}/5)")
                    ->sortable(),

                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->height(40),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        CustomerReview::STATUS_APPROVED => 'success',
                        CustomerReview::STATUS_REJECTED => 'danger',
                        default => 'warning',
                    })
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_pinned')
                    ->label('📌 Pinned')
                    ->boolean()
                    ->sortable()
                    ->action(
                        Tables\Actions\Action::make('togglePinned')
                            ->label(fn (CustomerReview $record) => $record->is_pinned ? 'Unpin' : 'Pin to Home')
                            ->icon(fn (CustomerReview $record) => $record->is_pinned ? 'heroicon-o-bookmark-slash' : 'heroicon-o-bookmark')
                            ->color(fn (CustomerReview $record) => $record->is_pinned ? 'warning' : 'success')
                            ->requiresConfirmation()
                            ->action(fn (CustomerReview $record) => $record->update(['is_pinned' => ! $record->is_pinned]))
                    ),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Order')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Submitted')
                    ->dateTime()
                    ->sortable()
                    ->since(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->reorderable('sort_order')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        CustomerReview::STATUS_PENDING => 'Pending',
                        CustomerReview::STATUS_APPROVED => 'Approved',
                        CustomerReview::STATUS_REJECTED => 'Rejected',
                    ]),

                Tables\Filters\SelectFilter::make('rating')
                    ->label('Rating')
                    ->options([
                        1 => '1 Star',
                        2 => '2 Stars',
                        3 => '3 Stars',
                        4 => '4 Stars',
                        5 => '5 Stars',
                    ]),

                Tables\Filters\TernaryFilter::make('is_pinned')
                    ->label('Pinned')
                    ->boolean()
                    ->trueLabel('Pinned only')
                    ->falseLabel('Unpinned only')
                    ->native(false),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

                Tables\Actions\Action::make('approve')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(fn (CustomerReview $record) => $record->update(['status' => CustomerReview::STATUS_APPROVED]))
                    ->visible(fn (CustomerReview $record) => $record->status !== CustomerReview::STATUS_APPROVED),

                Tables\Actions\Action::make('reject')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(fn (CustomerReview $record) => $record->update(['status' => CustomerReview::STATUS_REJECTED]))
                    ->visible(fn (CustomerReview $record) => $record->status !== CustomerReview::STATUS_REJECTED),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('approve_selected')
                        ->label('Approve Selected')
                        ->icon('heroicon-o-check')
                        ->color('success')
                        ->action(fn ($records) => $records->each->update(['status' => CustomerReview::STATUS_APPROVED])),

                    Tables\Actions\BulkAction::make('reject_selected')
                        ->label('Reject Selected')
                        ->icon('heroicon-o-x-mark')
                        ->color('danger')
                        ->action(fn ($records) => $records->each->update(['status' => CustomerReview::STATUS_REJECTED])),

                    Tables\Actions\BulkAction::make('pin_selected')
                        ->label('📌 Pin to Homepage')
                        ->icon('heroicon-o-bookmark')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(fn ($records) => $records->each->update(['is_pinned' => true])),

                    Tables\Actions\BulkAction::make('unpin_selected')
                        ->label('Unpin from Homepage')
                        ->icon('heroicon-o-bookmark-slash')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->action(fn ($records) => $records->each->update(['is_pinned' => false])),

                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomerReviews::route('/'),
            'create' => Pages\CreateCustomerReview::route('/create'),
            'edit' => Pages\EditCustomerReview::route('/{record}/edit'),
        ];
    }
}
