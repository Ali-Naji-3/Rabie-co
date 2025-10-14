<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroSliderResource\Pages;
use App\Filament\Resources\HeroSliderResource\RelationManagers;
use App\Models\HeroSlider;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HeroSliderResource extends Resource
{
    protected static ?string $model = HeroSlider::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    
    protected static ?string $navigationLabel = 'Hero Sliders';
    
    protected static ?string $navigationGroup = 'Homepage Management';
    
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Slider Images')
                    ->description('Upload slider images. Desktop image is required.')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Desktop Image')
                            ->image()
                            ->required()
                            ->directory('hero-sliders')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '21:9',
                                '16:9',
                            ])
                            ->maxSize(2048)
                            ->helperText('Recommended size: 1920x823px (21:9 aspect ratio)')
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('mobile_image')
                            ->label('Mobile Image (Optional)')
                            ->image()
                            ->directory('hero-sliders/mobile')
                            ->imageEditor()
                            ->maxSize(1024)
                            ->helperText('Recommended size: 800x600px. If not provided, desktop image will be used.')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                    
                Forms\Components\Section::make('Content')
                    ->schema([
                        Forms\Components\TextInput::make('small_title')
                            ->label('Small Title (Optional)')
                            ->maxLength(255)
                            ->placeholder('e.g., BRAND NEW'),
                        Forms\Components\TextInput::make('main_title')
                            ->label('Main Title')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., COMERCIO SHOP'),
                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->rows(3)
                            ->maxLength(500)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                    
                Forms\Components\Section::make('Button Settings')
                    ->schema([
                        Forms\Components\TextInput::make('button_text')
                            ->label('Button Text')
                            ->required()
                            ->maxLength(255)
                            ->default('SHOP NOW'),
                        Forms\Components\TextInput::make('button_link')
                            ->label('Button Link')
                            ->required()
                            ->maxLength(255)
                            ->default('/collection')
                            ->helperText('URL where button should redirect'),
                    ])
                    ->columns(2),
                    
                Forms\Components\Section::make('Styling & Animation')
                    ->schema([
                        Forms\Components\Select::make('text_alignment')
                            ->label('Text Alignment')
                            ->options([
                                'left' => 'Left',
                                'center' => 'Center',
                                'right' => 'Right',
                            ])
                            ->default('left')
                            ->required(),
                        Forms\Components\ColorPicker::make('text_color')
                            ->label('Text Color')
                            ->default('#000000'),
                        Forms\Components\ColorPicker::make('background_overlay')
                            ->label('Background Overlay Color')
                            ->helperText('Optional color overlay on image'),
                        Forms\Components\TextInput::make('overlay_opacity')
                            ->label('Overlay Opacity (%)')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->maxValue(100)
                            ->suffix('%'),
                        Forms\Components\Select::make('animation')
                            ->label('Animation Style')
                            ->options([
                                'fadeInUp' => 'Fade In Up',
                                'fadeIn' => 'Fade In',
                                'slideInLeft' => 'Slide In Left',
                                'slideInRight' => 'Slide In Right',
                                'zoomIn' => 'Zoom In',
                            ])
                            ->default('fadeInUp')
                            ->required(),
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
                            ->helperText('Toggle to show/hide this slider')
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Preview')
                    ->square()
                    ->size(80),
                Tables\Columns\TextColumn::make('main_title')
                    ->label('Title')
                    ->searchable()
                    ->weight('bold')
                    ->wrap(),
                Tables\Columns\TextColumn::make('small_title')
                    ->label('Subtitle')
                    ->searchable()
                    ->toggleable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('button_text')
                    ->label('Button')
                    ->badge()
                    ->color('success'),
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
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status')
                    ->placeholder('All sliders')
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
            'index' => Pages\ListHeroSliders::route('/'),
            'create' => Pages\CreateHeroSlider::route('/create'),
            'edit' => Pages\EditHeroSlider::route('/{record}/edit'),
        ];
    }
}
