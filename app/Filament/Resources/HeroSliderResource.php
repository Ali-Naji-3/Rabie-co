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
                Forms\Components\Section::make('Media Type')
                    ->description('Choose between image or video slider')
                    ->schema([
                        Forms\Components\Select::make('media_type')
                            ->label('Media Type')
                            ->options([
                                'image' => 'Image Slider',
                                'video' => 'Video Slider',
                            ])
                            ->default('image')
                            ->required()
                            ->live()
                            ->helperText('Select whether to use an image or video for this hero slider'),
                    ]),
                    
                Forms\Components\Section::make('Slider Images')
                    ->description('Upload slider images. Desktop image is required.')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Desktop Image')
                            ->image()
                            ->required(fn (Forms\Get $get) => $get('media_type') === 'image')
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
                    ->visible(fn (Forms\Get $get) => $get('media_type') === 'image')
                    ->columns(2),
                    
                Forms\Components\Section::make('Slider Video')
                    ->description('Upload slider video or provide external video URL')
                    ->schema([
                        Forms\Components\Placeholder::make('video_editor_info')
                            ->label('')
                            ->content(new \Illuminate\Support\HtmlString('
                                <div style="background: #f0f9ff; border: 1px solid #0ea5e9; border-radius: 8px; padding: 12px; margin-bottom: 12px;">
                                    <div style="display: flex; align-items: start; gap: 10px;">
                                        <svg style="width: 20px; height: 20px; flex-shrink: 0; color: #0ea5e9; margin-top: 2px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <div style="flex: 1;">
                                            <strong style="color: #0369a1; display: block; margin-bottom: 4px;">💡 Video Editing Tips:</strong>
                                            <ul style="margin: 0; padding-left: 20px; color: #0c4a6e; font-size: 13px; line-height: 1.6;">
                                                <li>Use <a href="https://clipchamp.com/en/video-trimmer/" target="_blank" style="color: #0284c7; text-decoration: underline;">Clipchamp</a> or <a href="https://www.kapwing.com/tools/trim-video" target="_blank" style="color: #0284c7; text-decoration: underline;">Kapwing</a> to trim videos before upload</li>
                                                <li>Desktop tools: VLC Media Player, HandBrake, or DaVinci Resolve</li>
                                                <li>Hero videos work best with autoplay, loop, and muted enabled</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            '))
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('video')
                            ->label('Video File')
                            ->acceptedFileTypes(['video/mp4', 'video/webm', 'video/ogg'])
                            ->directory('hero-sliders/videos')
                            ->maxSize(51200) // 50MB
                            ->helperText('Upload video file (MP4, WebM, or OGG). Max size: 50MB. 💡 Tip: Videos can be manually compressed after upload for faster loading (see documentation).')
                            ->downloadable()
                            ->previewable()
                            ->openable()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('video_url')
                            ->label('Or External Video URL')
                            ->url()
                            ->placeholder('https://www.youtube.com/watch?v=...')
                            ->helperText('Alternatively, provide YouTube or Vimeo URL')
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('video_thumbnail')
                            ->label('Video Thumbnail (Optional)')
                            ->image()
                            ->directory('hero-sliders/thumbnails')
                            ->imageEditor()
                            ->maxSize(1024)
                            ->helperText('Thumbnail shown before video loads')
                            ->columnSpanFull(),
                    ])
                    ->visible(fn (Forms\Get $get) => $get('media_type') === 'video'),
                    
                Forms\Components\Section::make('Video Settings')
                    ->description('Configure video playback options')
                    ->schema([
                        Forms\Components\Toggle::make('autoplay')
                            ->label('Autoplay')
                            ->default(true)
                            ->helperText('Start playing automatically (recommended for hero videos)'),
                        Forms\Components\Toggle::make('loop')
                            ->label('Loop')
                            ->default(true)
                            ->helperText('Repeat video continuously (recommended for hero videos)'),
                        Forms\Components\Toggle::make('muted')
                            ->label('Muted')
                            ->default(true)
                            ->helperText('Start with sound off (required for autoplay)'),
                        Forms\Components\Toggle::make('show_controls')
                            ->label('Show Controls')
                            ->default(false)
                            ->helperText('Display play/pause controls (usually hidden for hero videos)'),
                    ])
                    ->columns(2)
                    ->visible(fn (Forms\Get $get) => $get('media_type') === 'video'),
                    
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
