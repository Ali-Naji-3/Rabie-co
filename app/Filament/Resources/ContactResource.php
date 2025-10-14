<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationGroup = 'Communication';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Contact Information')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('first_name')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('First Name'),
                                Forms\Components\TextInput::make('last_name')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Last Name'),
                            ]),
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('phone')
                                    ->tel()
                                    ->required()
                                    ->maxLength(20)
                                    ->label('Phone Number'),
                                Forms\Components\Select::make('subject')
                                    ->options([
                                        'order_inquiry' => 'Order Inquiry',
                                        'product_question' => 'Product Question',
                                        'shipping_issue' => 'Shipping Issue',
                                        'return_refund' => 'Return/Refund',
                                        'general_question' => 'General Question',
                                        'complaint' => 'Complaint',
                                        'partnership_business' => 'Partnership/Business',
                                    ])
                                    ->default('order_inquiry')
                                    ->label('Subject'),
                            ]),
                        Forms\Components\Textarea::make('message')
                            ->required()
                            ->rows(5)
                            ->minLength(4)
                            ->maxLength(1000)
                            ->label('Message'),
                        Forms\Components\Select::make('status')
                            ->options([
                                'new' => 'New',
                                'read' => 'Read',
                                'replied' => 'Replied',
                            ])
                            ->default('new')
                            ->required()
                            ->label('Status'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->label('ID'),
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable()
                    ->sortable()
                    ->label('First Name'),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable()
                    ->sortable()
                    ->label('Last Name'),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->copyable()
                    ->icon('heroicon-o-phone')
                    ->label('Phone'),
                Tables\Columns\BadgeColumn::make('subject')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'order_inquiry' => 'Order Inquiry',
                        'product_question' => 'Product Question',
                        'shipping_issue' => 'Shipping Issue',
                        'return_refund' => 'Return/Refund',
                        'general_question' => 'General Question',
                        'complaint' => 'Complaint',
                        'partnership_business' => 'Partnership/Business',
                        default => $state,
                    })
                    ->colors([
                        'primary' => 'order_inquiry',
                        'info' => 'product_question',
                        'warning' => 'shipping_issue',
                        'danger' => ['return_refund', 'complaint'],
                        'success' => 'general_question',
                        'secondary' => 'partnership_business',
                    ])
                    ->label('Subject'),
                Tables\Columns\TextColumn::make('message')
                    ->limit(50)
                    ->wrap()
                    ->label('Message'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'danger' => 'new',
                        'warning' => 'read',
                        'success' => 'replied',
                    ])
                    ->label('Status'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Submitted At'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'new' => 'New',
                        'read' => 'Read',
                        'replied' => 'Replied',
                    ]),
                Tables\Filters\SelectFilter::make('subject')
                    ->options([
                        'order_inquiry' => 'Order Inquiry',
                        'product_question' => 'Product Question',
                        'shipping_issue' => 'Shipping Issue',
                        'return_refund' => 'Return/Refund',
                        'general_question' => 'General Question',
                        'complaint' => 'Complaint',
                        'partnership_business' => 'Partnership/Business',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'view' => Pages\ViewContact::route('/{record}'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
