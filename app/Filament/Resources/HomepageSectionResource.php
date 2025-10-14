<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HomepageSectionResource\Pages;
use App\Filament\Resources\HomepageSectionResource\RelationManagers;
use App\Models\HomepageSection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HomepageSectionResource extends Resource
{
    protected static ?string $model = HomepageSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('section_key')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('section_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('title')
                    ->maxLength(255),
                Forms\Components\TextInput::make('subtitle')
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('background_color')
                    ->maxLength(255),
                Forms\Components\FileUpload::make('background_image')
                    ->image(),
                Forms\Components\TextInput::make('text_color')
                    ->maxLength(255),
                Forms\Components\TextInput::make('css_class')
                    ->maxLength(255),
                Forms\Components\TextInput::make('items_to_show')
                    ->numeric(),
                Forms\Components\TextInput::make('settings'),
                Forms\Components\TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('section_key')
                    ->searchable(),
                Tables\Columns\TextColumn::make('section_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subtitle')
                    ->searchable(),
                Tables\Columns\TextColumn::make('background_color')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('background_image'),
                Tables\Columns\TextColumn::make('text_color')
                    ->searchable(),
                Tables\Columns\TextColumn::make('css_class')
                    ->searchable(),
                Tables\Columns\TextColumn::make('items_to_show')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListHomepageSections::route('/'),
            'create' => Pages\CreateHomepageSection::route('/create'),
            'edit' => Pages\EditHomepageSection::route('/{record}/edit'),
        ];
    }
}
