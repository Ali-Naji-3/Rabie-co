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

class HomepageSectionResource extends Resource
{
    protected static ?string $model = HomepageSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationLabel = 'Homepage Sections';

    protected static ?string $navigationGroup = 'Homepage Management';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Section Identity')
                    ->schema([
                        Forms\Components\TextInput::make('section_key')
                            ->label('Section Key')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('Unique machine-readable key, e.g. real_results'),
                        Forms\Components\TextInput::make('section_name')
                            ->label('Section Name (Admin)')
                            ->required()
                            ->maxLength(255)
                            ->helperText('For admin reference only'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Display Settings')
                    ->schema([
                        Forms\Components\Select::make('position')
                            ->label('Page Position')
                            ->options([
                                'after_products' => 'After Featured Products',
                                'after_reviews'  => 'After Customer Reviews',
                                'before_footer'  => 'Before Footer',
                            ])
                            ->default('after_products')
                            ->required()
                            ->helperText('Where on the homepage this section renders'),
                        Forms\Components\Select::make('card_layout')
                            ->label('Card Layout')
                            ->options([
                                'promotional' => 'Promotional (image + overlay + shop link)',
                                'steps'       => 'Steps (label + image + title + description)',
                            ])
                            ->default('promotional')
                            ->required()
                            ->helperText('Layout template for every card in this section'),
                        Forms\Components\TextInput::make('order')
                            ->label('Display Order')
                            ->numeric()
                            ->default(0)
                            ->required()
                            ->helperText('Lower numbers appear first within the same position'),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->required(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Heading')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Section Title')
                            ->maxLength(255)
                            ->placeholder('e.g., Real Results'),
                        Forms\Components\TextInput::make('subtitle')
                            ->label('Section Subtitle')
                            ->maxLength(255)
                            ->placeholder('e.g., See what to expect at every stage'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Advanced')
                    ->schema([
                        Forms\Components\TextInput::make('css_class')
                            ->label('Extra CSS Class')
                            ->maxLength(255)
                            ->placeholder('e.g., dark-bg'),
                        Forms\Components\KeyValue::make('settings')
                            ->label('Extra Settings (JSON)'),
                    ])
                    ->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order')
                    ->label('#')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color('gray'),
                Tables\Columns\TextColumn::make('section_name')
                    ->label('Name')
                    ->searchable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Heading')
                    ->searchable()
                    ->placeholder('(none)'),
                Tables\Columns\TextColumn::make('position')
                    ->label('Position')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'after_products' => 'info',
                        'after_reviews'  => 'success',
                        'before_footer'  => 'warning',
                        default          => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => ucwords(str_replace('_', ' ', $state))),
                Tables\Columns\TextColumn::make('card_layout')
                    ->label('Layout')
                    ->badge()
                    ->color('primary')
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger'),
                Tables\Columns\TextColumn::make('cards_count')
                    ->label('Cards')
                    ->counts('cards')
                    ->badge()
                    ->color('gray'),
            ])
            ->defaultSort('order', 'asc')
            ->reorderable('order')
            ->filters([
                Tables\Filters\SelectFilter::make('position')
                    ->options([
                        'after_products' => 'After Featured Products',
                        'after_reviews'  => 'After Customer Reviews',
                        'before_footer'  => 'Before Footer',
                    ]),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status')
                    ->placeholder('All sections')
                    ->trueLabel('Active only')
                    ->falseLabel('Inactive only'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            RelationManagers\PromotionalBannersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListHomepageSections::route('/'),
            'create' => Pages\CreateHomepageSection::route('/create'),
            'edit'   => Pages\EditHomepageSection::route('/{record}/edit'),
        ];
    }
}
