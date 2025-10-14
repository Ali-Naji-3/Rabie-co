<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeatureIconResource\Pages;
use App\Models\FeatureIcon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FeatureIconResource extends Resource
{
    protected static ?string $model = FeatureIcon::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    
    protected static ?string $navigationLabel = 'Feature Icons';
    
    protected static ?string $navigationGroup = 'Homepage Management';
    
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Icon Configuration')
                    ->description('Choose between icon class or custom image')
                    ->schema([
                        Forms\Components\Radio::make('icon_type')
                            ->label('Icon Type')
                            ->options([
                                'class' => 'Icon Class (Flaticon/FontAwesome)',
                                'image' => 'Custom Image Upload',
                            ])
                            ->default('class')
                            ->required()
                            ->live()
                            ->helperText('Choose how you want to display the icon'),
                            
                        Forms\Components\TextInput::make('icon_class')
                            ->label('Icon Class')
                            ->maxLength(255)
                            ->placeholder('e.g., flaticon-shipping, fas fa-truck')
                            ->helperText('Examples: flaticon-shipping, flaticon-support, fas fa-truck, fas fa-shield-alt')
                            ->visible(fn (Forms\Get $get) => $get('icon_type') === 'class'),
                            
                        Forms\Components\FileUpload::make('icon_image')
                            ->label('Icon Image')
                            ->image()
                            ->directory('feature-icons')
                            ->imageEditor()
                            ->maxSize(512)
                            ->helperText('Upload custom icon image (PNG recommended, max 512KB)')
                            ->visible(fn (Forms\Get $get) => $get('icon_type') === 'image')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                    
                Forms\Components\Section::make('Content')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Title')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., Free Shipping'),
                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->rows(3)
                            ->maxLength(500)
                            ->placeholder('Short description of this feature')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                    
                Forms\Components\Section::make('Link Settings (Optional)')
                    ->description('Add a link if this feature should be clickable')
                    ->schema([
                        Forms\Components\TextInput::make('link_url')
                            ->label('Link URL')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://example.com/shipping-info'),
                        Forms\Components\Toggle::make('open_new_tab')
                            ->label('Open in New Tab')
                            ->default(false),
                    ])
                    ->columns(2)
                    ->collapsed(),
                    
                Forms\Components\Section::make('Styling')
                    ->description('Customize colors and size')
                    ->schema([
                        Forms\Components\ColorPicker::make('icon_color')
                            ->label('Icon Color')
                            ->default('#000000')
                            ->helperText('Color of the icon'),
                        Forms\Components\ColorPicker::make('text_color')
                            ->label('Text Color')
                            ->default('#000000')
                            ->helperText('Color of title and description'),
                        Forms\Components\ColorPicker::make('background_color')
                            ->label('Background Color (Optional)')
                            ->helperText('Leave empty for transparent'),
                        Forms\Components\TextInput::make('icon_size')
                            ->label('Icon Size (px)')
                            ->numeric()
                            ->default(48)
                            ->minValue(16)
                            ->maxValue(128)
                            ->suffix('px'),
                    ])
                    ->columns(2),
                    
                Forms\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\TextInput::make('order')
                            ->label('Display Order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower numbers appear first')
                            ->required(),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->helperText('Toggle to show/hide this feature')
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('icon_image')
                    ->label('Icon')
                    ->square()
                    ->size(40)
                    ->defaultImageUrl(fn (FeatureIcon $record) => $record->icon_type === 'class' ? null : null),
                Tables\Columns\TextColumn::make('icon_class')
                    ->label('Class')
                    ->badge()
                    ->color('info')
                    ->visible(fn ($record) => $record?->icon_type === 'class'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->weight('bold')
                    ->wrap(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->limit(50)
                    ->wrap()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('order')
                    ->label('Order')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color('gray'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('order', 'asc')
            ->reorderable('order')
            ->filters([
                Tables\Filters\SelectFilter::make('icon_type')
                    ->label('Icon Type')
                    ->options([
                        'class' => 'Icon Class',
                        'image' => 'Custom Image',
                    ]),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status')
                    ->placeholder('All features')
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFeatureIcons::route('/'),
            'create' => Pages\CreateFeatureIcon::route('/create'),
            'edit' => Pages\EditFeatureIcon::route('/{record}/edit'),
        ];
    }
}
