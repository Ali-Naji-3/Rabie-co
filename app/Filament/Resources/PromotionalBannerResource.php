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
                Forms\Components\Section::make('Media Type')
                    ->description('Choose between image or video banner')
                    ->schema([
                        Forms\Components\Select::make('media_type')
                            ->label('Media Type')
                            ->options([
                                'image' => 'Image Banner',
                                'video' => 'Video Banner',
                            ])
                            ->default('image')
                            ->required()
                            ->live()
                            ->helperText('Select whether to use an image or video for this banner'),
                    ]),
                    
                Forms\Components\Section::make('Banner Images')
                    ->description('Upload promotional banner images')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Banner Image')
                            ->image()
                            ->required(fn (Forms\Get $get) => $get('media_type') === 'image')
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
                    ])
                    ->visible(fn (Forms\Get $get) => $get('media_type') === 'image'),
                    
                Forms\Components\Section::make('Banner Video')
                    ->description('Upload promotional banner video or provide external video URL')
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
                                                <li>Use free online tools like <strong>Clipchamp</strong> or <strong>Kapwing</strong> to trim/edit videos before upload</li>
                                                <li>Recommended: <a href="https://clipchamp.com/en/video-trimmer/" target="_blank" style="color: #0284c7; text-decoration: underline;">Clipchamp Video Trimmer</a></li>
                                                <li>Or use <a href="https://www.kapwing.com/tools/trim-video" target="_blank" style="color: #0284c7; text-decoration: underline;">Kapwing Trim Video</a></li>
                                                <li>Desktop tools: <strong>VLC Media Player</strong> (free), <strong>HandBrake</strong> (compression), or <strong>DaVinci Resolve</strong> (advanced)</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            '))
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('video')
                            ->label('Video File')
                            ->acceptedFileTypes(['video/mp4', 'video/webm', 'video/ogg'])
                            ->directory('promotional-banners/videos')
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
                            ->directory('promotional-banners/thumbnails')
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
                            ->default(false)
                            ->helperText('Start playing automatically'),
                        Forms\Components\Toggle::make('loop')
                            ->label('Loop')
                            ->default(false)
                            ->helperText('Repeat video continuously'),
                        Forms\Components\Toggle::make('muted')
                            ->label('Muted')
                            ->default(true)
                            ->helperText('Start with sound off (recommended for autoplay)'),
                        Forms\Components\Toggle::make('show_controls')
                            ->label('Show Controls')
                            ->default(true)
                            ->helperText('Display play/pause controls'),
                    ])
                    ->columns(2)
                    ->visible(fn (Forms\Get $get) => $get('media_type') === 'video'),
                    
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
