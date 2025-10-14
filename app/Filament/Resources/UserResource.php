<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    
    protected static ?string $navigationLabel = 'Users (Customers & Admins)';
    
    protected static ?string $modelLabel = 'User';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('role')
                    ->label('User Role')
                    ->options([
                        'admin' => '🛡️ Admin',
                        'customer' => '👤 Customer',
                    ])
                    ->default('customer')
                    ->required()
                    ->native(false)
                    ->helperText('Select role: Admin for store management, Customer for shopping'),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Forms\Components\DateTimePicker::make('email_verified_at')
                    ->label('Email Verified At')
                    ->default(now()),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required(fn (string $operation): bool => $operation === 'create')
                    ->dehydrated(fn ($state) => filled($state))
                    ->maxLength(255)
                    ->helperText('Leave blank to keep current password (when editing)'),
                    
                // View-only fields - Professional Layout
                Forms\Components\Section::make('User Statistics')
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Member Since')
                            ->content(fn ($record) => $record ? $record->created_at->format('F d, Y \a\t h:i A') : '-'),
                        
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\Placeholder::make('orders_count')
                                    ->label('Total Orders')
                                    ->content(fn ($record) => $record ? $record->orders()->count() : 0),
                                    
                                Forms\Components\Placeholder::make('reviews_count')
                                    ->label('Total Reviews')
                                    ->content(fn ($record) => $record ? $record->reviews()->count() : 0),
                                    
                                Forms\Components\Placeholder::make('tokens_count')
                                    ->label('API Tokens')
                                    ->content(fn ($record) => $record ? $record->tokens()->count() : 0),
                            ]),
                        
                        Forms\Components\Placeholder::make('last_login')
                            ->label('Last Activity')
                            ->content(fn ($record) => $record ? $record->updated_at->diffForHumans() : '-'),
                    ])
                    ->visible(fn (string $operation) => $operation === 'view')
                    ->collapsed(false),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->copyable(),
                Tables\Columns\BadgeColumn::make('role')
                    ->formatStateUsing(fn (string $state): string => ucfirst($state))
                    ->colors([
                        'danger' => 'admin',
                        'success' => 'customer',
                    ])
                    ->icons([
                        'heroicon-o-shield-check' => 'admin',
                        'heroicon-o-user' => 'customer',
                    ])
                    ->sortable(),
                Tables\Columns\TextColumn::make('orders_count')
                    ->counts('orders')
                    ->label('Orders')
                    ->sortable()
                    ->badge()
                    ->color('info'),
                Tables\Columns\TextColumn::make('reviews_count')
                    ->counts('reviews')
                    ->label('Reviews')
                    ->sortable()
                    ->badge()
                    ->color('warning'),
                Tables\Columns\TextColumn::make('tokens_count')
                    ->counts('tokens')
                    ->label('API Tokens')
                    ->sortable()
                    ->badge()
                    ->color('primary'),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Joined')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->options([
                        'admin' => 'Admins',
                        'customer' => 'Customers',
                    ])
                    ->query(function (Builder $query, array $data) {
                        if ($data['value'] === 'admin') {
                            return $query->where('role', 'admin');
                        }
                        if ($data['value'] === 'customer') {
                            return $query->where('role', 'customer');
                        }
                    }),
                Tables\Filters\Filter::make('has_orders')
                    ->label('Has Orders')
                    ->query(fn (Builder $query): Builder => $query->has('orders')),
                Tables\Filters\Filter::make('has_reviews')
                    ->label('Has Reviews')
                    ->query(fn (Builder $query): Builder => $query->has('reviews')),
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
            ->defaultSort('created_at', 'desc')
            ->modifyQueryUsing(fn (Builder $query) => 
                $query->orderByRaw("CASE WHEN role = 'admin' THEN 0 ELSE 1 END")
                      ->orderBy('created_at', 'desc')
            );
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
    
    public static function canDelete($record): bool
    {
        // Prevent deleting admin accounts
        return $record->role !== 'admin';
    }
}
