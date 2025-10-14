<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PromotionalBannerResource\Pages;
use App\Models\PromotionalBanner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PromotionalBannerResource extends Resource
{
    protected static ?string $model = PromotionalBanner::class;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';
    
    protected static ?string $navigationLabel = 'Promotional Banners';
    
    protected static ?string $navigationGroup = 'Homepage Management';
    
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Banner Images')
                    ->description('Upload promotional banner images')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Banner Image')
                            ->image()
                            ->required()
                            ->directory('promotional-banners')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '21:9',
                                '16:9',
                                '3:1',
                            ])
                            ->maxSize(2048)
                            ->helperText('Recommended size: 1920x823px (21:9 aspect ratio)')
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('mobile_image')
                            ->label('Mobile Image (Optional)')
                            ->image()
                            ->directory('promotional-banners/mobile')
                            ->imageEditor()
                            ->maxSize(1024)
                            ->helperText('Optional mobile version')
                            ->columnSpanFull(),
                    ]),
                    
                Forms\Components\Section::make('Banner Information')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Banner Title (For Admin Reference)')
                            ->maxLength(255)
                            ->placeholder('e.g., Summer Sale Banner')
                            ->helperText('This is just for admin reference, not shown on website'),
                        Forms\Components\TextInput::make('alt_text')
                            ->label('Alt Text (SEO)')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., Summer Sale 2025')
                            ->helperText('Important for SEO and accessibility'),
                    ])
                    ->columns(2),
                    
                Forms\Components\Section::make('Content Overlay (Optional)')
                    ->description('Add text overlay on banner (similar to hero sliders)')
                    ->schema([
                        Forms\Components\TextInput::make('small_title')
                            ->label('Small Title (Optional)')
                            ->maxLength(255)
                            ->placeholder('e.g., SPECIAL OFFER'),
                        Forms\Components\TextInput::make('main_title')
                            ->label('Main Title')
                            ->maxLength(255)
                            ->placeholder('e.g., 50% OFF SALE'),
                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->rows(3)
                            ->maxLength(500)
                            ->placeholder('Limited time offer...')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('button_text')
                            ->label('Button Text (Optional)')
                            ->maxLength(255)
                            ->placeholder('e.g., SHOP NOW')
                            ->helperText('If empty, entire banner will be clickable without button'),
                    ])
                    ->columns(2)
                    ->collapsed(),
                    
                Forms\Components\Section::make('Text Styling')
                    ->description('Customize text appearance')
                    ->schema([
                        Forms\Components\Select::make('text_alignment')
                            ->label('Text Alignment')
                            ->options([
                                'left' => 'Left',
                                'center' => 'Center',
                                'right' => 'Right',
                            ])
                            ->default('left'),
                        Forms\Components\ColorPicker::make('text_color')
                            ->label('Text Color')
                            ->default('#000000')
                            ->helperText('Choose text color for good contrast'),
                    ])
                    ->columns(2)
                    ->collapsed(),
                    
                Forms\Components\Section::make('Link Settings')
                    ->schema([
                        Forms\Components\TextInput::make('link_url')
                            ->label('Link URL')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://example.com/sale')
                            ->helperText('Where should this banner link to? Leave empty for no link.'),
                        Forms\Components\Toggle::make('open_new_tab')
                            ->label('Open in New Tab')
                            ->default(false),
                    ])
                    ->columns(2),
                    
                Forms\Components\Section::make('Display Settings')
                    ->schema([
                        Forms\Components\Select::make('position')
                            ->label('Banner Position')
                            ->options([
                                'after_products' => 'After Featured Products',
                                'after_reviews' => 'After Customer Reviews',
                                'before_footer' => 'Before Footer',
                                'custom' => 'Custom Position',
                            ])
                            ->default('after_products')
                            ->required()
                            ->helperText('Choose where to display this banner on homepage'),
                        Forms\Components\TextInput::make('order')
                            ->label('Display Order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower numbers appear first')
                            ->required(),
                    ])
                    ->columns(2),
                    
                Forms\Components\Section::make('Scheduling (Optional)')
                    ->description('Set start and end dates for this banner campaign')
                    ->schema([
                        Forms\Components\DateTimePicker::make('start_date')
                            ->label('Start Date')
                            ->helperText('Leave empty to show immediately'),
                        Forms\Components\DateTimePicker::make('end_date')
                            ->label('End Date')
                            ->helperText('Leave empty for no expiration'),
                    ])
                    ->columns(2)
                    ->collapsed(),
                    
                Forms\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->helperText('Toggle to show/hide this banner')
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Preview')
                    ->height(60),
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->weight('bold')
                    ->wrap()
                    ->placeholder('(No title)'),
                Tables\Columns\TextColumn::make('position')
                    ->label('Position')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'after_products' => 'info',
                        'after_reviews' => 'success',
                        'before_footer' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => ucwords(str_replace('_', ' ', $state))),
                Tables\Columns\TextColumn::make('order')
                    ->label('Order')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color('gray'),
                Tables\Columns\TextColumn::make('clicks_count')
                    ->label('Clicks')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color('success'),
                Tables\Columns\TextColumn::make('click_through_rate')
                    ->label('CTR')
                    ->suffix('%')
                    ->badge()
                    ->color('primary'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                Tables\Columns\TextColumn::make('start_date')
                    ->label('Start')
                    ->date()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('end_date')
                    ->label('End')
                    ->date()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('order', 'asc')
            ->reorderable('order')
            ->filters([
                Tables\Filters\SelectFilter::make('position')
                    ->label('Position')
                    ->options([
                        'after_products' => 'After Featured Products',
                        'after_reviews' => 'After Customer Reviews',
                        'before_footer' => 'Before Footer',
                        'custom' => 'Custom Position',
                    ]),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status')
                    ->placeholder('All banners')
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
                    Tables\Actions\BulkAction::make('activate')
                        ->label('Activate Selected')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function ($records) {
                            $records->each->update(['is_active' => true]);
                        }),
                    Tables\Actions\BulkAction::make('deactivate')
                        ->label('Deactivate Selected')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->action(function ($records) {
                            $records->each->update(['is_active' => false]);
                        }),
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
            'index' => Pages\ListPromotionalBanners::route('/'),
            'create' => Pages\CreatePromotionalBanner::route('/create'),
            'edit' => Pages\EditPromotionalBanner::route('/{record}/edit'),
        ];
    }
}
