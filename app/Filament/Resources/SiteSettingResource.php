<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteSettingResource\Pages;
use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    
    protected static ?string $navigationLabel = 'Site Settings';
    
    protected static ?string $navigationGroup = 'Homepage Management';
    
    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Settings')
                    ->tabs([
                        // General Tab
                        Forms\Components\Tabs\Tab::make('General')
                            ->icon('heroicon-o-home')
                            ->schema([
                                Forms\Components\Section::make('Site Information')
                                    ->description('Basic site information')
                                    ->schema([
                                        Forms\Components\TextInput::make('site_name')
                                            ->label('Site Name')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('Rabie-Co'),
                                        Forms\Components\TextInput::make('site_tagline')
                                            ->label('Tagline')
                                            ->maxLength(255)
                                            ->placeholder('Your tagline here'),
                                        Forms\Components\Textarea::make('site_description')
                                            ->label('Description')
                                            ->rows(3)
                                            ->maxLength(500)
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(2),
                            ]),
                            
                        // Logos & Images Tab
                        Forms\Components\Tabs\Tab::make('Logos & Images')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Forms\Components\Section::make('Site Logos')
                                    ->description('Upload your logos and favicon')
                                    ->schema([
                                        Forms\Components\FileUpload::make('logo')
                                            ->label('Main Logo')
                                            ->image()
                                            ->directory('site-settings/logos')
                                            ->imageEditor()
                                            ->maxSize(1024)
                                            ->helperText('Recommended: PNG with transparent background')
                                            ->columnSpanFull(),
                                        Forms\Components\FileUpload::make('footer_logo')
                                            ->label('Footer Logo (Optional)')
                                            ->image()
                                            ->directory('site-settings/logos')
                                            ->imageEditor()
                                            ->maxSize(1024)
                                            ->helperText('If not provided, main logo will be used')
                                            ->columnSpanFull(),
                                        Forms\Components\FileUpload::make('favicon')
                                            ->label('Favicon')
                                            ->image()
                                            ->directory('site-settings/logos')
                                            ->acceptedFileTypes(['image/x-icon', 'image/png'])
                                            ->maxSize(100)
                                            ->helperText('Recommended: 32x32px or 64x64px PNG/ICO')
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                            
                        // Header Settings Tab
                        Forms\Components\Tabs\Tab::make('Header')
                            ->icon('heroicon-o-rectangle-group')
                            ->schema([
                                Forms\Components\Section::make('Header Styling')
                                    ->schema([
                                        Forms\Components\ColorPicker::make('header_background_color')
                                            ->label('Background Color')
                                            ->default('#ffffff'),
                                        Forms\Components\ColorPicker::make('header_text_color')
                                            ->label('Text Color')
                                            ->default('#000000'),
                                        Forms\Components\Toggle::make('sticky_header')
                                            ->label('Sticky Header')
                                            ->default(true)
                                            ->helperText('Header stays at top when scrolling')
                                            ->inline(false),
                                    ])
                                    ->columns(2),
                            ]),
                            
                        // Contact Information Tab
                        Forms\Components\Tabs\Tab::make('Contact')
                            ->icon('heroicon-o-phone')
                            ->schema([
                                Forms\Components\Section::make('Contact Information')
                                    ->description('Your business contact details')
                                    ->schema([
                                        Forms\Components\TextInput::make('phone')
                                            ->label('Phone Number')
                                            ->tel()
                                            ->maxLength(255)
                                            ->placeholder('+1 (555) 123-4567'),
                                        Forms\Components\TextInput::make('email')
                                            ->label('Email Address')
                                            ->email()
                                            ->maxLength(255)
                                            ->placeholder('info@rabie-co.com'),
                                        Forms\Components\TextInput::make('whatsapp')
                                            ->label('WhatsApp Number')
                                            ->tel()
                                            ->maxLength(255)
                                            ->placeholder('+1 (555) 123-4567')
                                            ->helperText('Include country code'),
                                        Forms\Components\TextInput::make('working_hours')
                                            ->label('Working Hours')
                                            ->maxLength(255)
                                            ->placeholder('Mon-Fri: 9AM-6PM'),
                                        Forms\Components\Textarea::make('address')
                                            ->label('Business Address')
                                            ->rows(3)
                                            ->maxLength(500)
                                            ->columnSpanFull()
                                            ->placeholder('123 Main Street, City, Country'),
                                    ])
                                    ->columns(2),
                            ]),
                            
                        // Social Media Tab
                        Forms\Components\Tabs\Tab::make('Social Media')
                            ->icon('heroicon-o-share')
                            ->schema([
                                Forms\Components\Section::make('Social Media Links')
                                    ->description('Add your social media profile URLs')
                                    ->schema([
                                        Forms\Components\TextInput::make('facebook_url')
                                            ->label('Facebook')
                                            ->url()
                                            ->maxLength(255)
                                            ->prefixIcon('heroicon-o-globe-alt')
                                            ->placeholder('https://facebook.com/yourpage'),
                                        Forms\Components\TextInput::make('instagram_url')
                                            ->label('Instagram')
                                            ->url()
                                            ->maxLength(255)
                                            ->prefixIcon('heroicon-o-globe-alt')
                                            ->placeholder('https://instagram.com/yourprofile'),
                                        Forms\Components\TextInput::make('twitter_url')
                                            ->label('Twitter / X')
                                            ->url()
                                            ->maxLength(255)
                                            ->prefixIcon('heroicon-o-globe-alt')
                                            ->placeholder('https://twitter.com/yourhandle'),
                                        Forms\Components\TextInput::make('linkedin_url')
                                            ->label('LinkedIn')
                                            ->url()
                                            ->maxLength(255)
                                            ->prefixIcon('heroicon-o-globe-alt')
                                            ->placeholder('https://linkedin.com/company/yourcompany'),
                                        Forms\Components\TextInput::make('youtube_url')
                                            ->label('YouTube')
                                            ->url()
                                            ->maxLength(255)
                                            ->prefixIcon('heroicon-o-globe-alt')
                                            ->placeholder('https://youtube.com/yourchannel'),
                                        Forms\Components\TextInput::make('tiktok_url')
                                            ->label('TikTok')
                                            ->url()
                                            ->maxLength(255)
                                            ->prefixIcon('heroicon-o-globe-alt')
                                            ->placeholder('https://tiktok.com/@yourusername'),
                                    ])
                                    ->columns(2),
                            ]),
                            
                        // SEO Tab
                        Forms\Components\Tabs\Tab::make('SEO')
                            ->icon('heroicon-o-magnifying-glass')
                            ->schema([
                                Forms\Components\Section::make('SEO Settings')
                                    ->description('Search engine optimization settings')
                                    ->schema([
                                        Forms\Components\TextInput::make('meta_title')
                                            ->label('Meta Title')
                                            ->maxLength(60)
                                            ->helperText('Max 60 characters for best SEO')
                                            ->columnSpanFull(),
                                        Forms\Components\Textarea::make('meta_description')
                                            ->label('Meta Description')
                                            ->rows(3)
                                            ->maxLength(160)
                                            ->helperText('Max 160 characters for best SEO')
                                            ->columnSpanFull(),
                                        Forms\Components\Textarea::make('meta_keywords')
                                            ->label('Meta Keywords')
                                            ->rows(2)
                                            ->helperText('Comma-separated keywords')
                                            ->columnSpanFull(),
                                        Forms\Components\FileUpload::make('og_image')
                                            ->label('Social Share Image (OG Image)')
                                            ->image()
                                            ->directory('site-settings/seo')
                                            ->maxSize(2048)
                                            ->helperText('Recommended: 1200x630px for Facebook/Twitter')
                                            ->columnSpanFull(),
                                    ]),
                                    
                                Forms\Components\Section::make('Analytics')
                                    ->description('Tracking and analytics codes')
                                    ->schema([
                                        Forms\Components\TextInput::make('google_analytics_id')
                                            ->label('Google Analytics ID')
                                            ->placeholder('G-XXXXXXXXXX or UA-XXXXXXXXX-X')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('google_tag_manager_id')
                                            ->label('Google Tag Manager ID')
                                            ->placeholder('GTM-XXXXXXX')
                                            ->maxLength(255),
                                    ])
                                    ->columns(2),
                            ]),
                            
                        // Footer Tab
                        Forms\Components\Tabs\Tab::make('Footer')
                            ->icon('heroicon-o-bars-3-bottom-left')
                            ->schema([
                                Forms\Components\Section::make('Footer Settings')
                                    ->schema([
                                        Forms\Components\Textarea::make('footer_description')
                                            ->label('Footer Description')
                                            ->rows(3)
                                            ->maxLength(500)
                                            ->placeholder('About your company...')
                                            ->columnSpanFull(),
                                        Forms\Components\TextInput::make('copyright_text')
                                            ->label('Copyright Text')
                                            ->maxLength(255)
                                            ->default('© 2025 Rabie-Co. All rights reserved.')
                                            ->columnSpanFull(),
                                    ]),
                                    
                                Forms\Components\Section::make('Footer Styling')
                                    ->schema([
                                        Forms\Components\ColorPicker::make('footer_background_color')
                                            ->label('Background Color')
                                            ->default('#222222'),
                                        Forms\Components\ColorPicker::make('footer_text_color')
                                            ->label('Text Color')
                                            ->default('#ffffff'),
                                    ])
                                    ->columns(2),
                            ]),
                            
                        // Advanced Tab
                        Forms\Components\Tabs\Tab::make('Advanced')
                            ->icon('heroicon-o-code-bracket')
                            ->schema([
                                Forms\Components\Section::make('Custom Code')
                                    ->description('Add custom CSS and JavaScript')
                                    ->schema([
                                        Forms\Components\Textarea::make('custom_css')
                                            ->label('Custom CSS')
                                            ->rows(5)
                                            ->helperText('Custom CSS code (without <style> tags)')
                                            ->columnSpanFull(),
                                        Forms\Components\Textarea::make('custom_js')
                                            ->label('Custom JavaScript')
                                            ->rows(5)
                                            ->helperText('Custom JS code (without <script> tags)')
                                            ->columnSpanFull(),
                                    ]),
                                    
                                Forms\Components\Section::make('Header & Footer Scripts')
                                    ->description('Add tracking codes or custom scripts')
                                    ->schema([
                                        Forms\Components\Textarea::make('header_scripts')
                                            ->label('Header Scripts')
                                            ->rows(4)
                                            ->helperText('Scripts to add in <head> section')
                                            ->columnSpanFull(),
                                        Forms\Components\Textarea::make('footer_scripts')
                                            ->label('Footer Scripts')
                                            ->rows(4)
                                            ->helperText('Scripts to add before </body> tag')
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('site_name')
                    ->label('Site Name')
                    ->searchable()
                    ->weight('bold'),
                Tables\Columns\ImageColumn::make('logo')
                    ->label('Logo')
                    ->square()
                    ->size(40),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable(),
                Tables\Columns\IconColumn::make('sticky_header')
                    ->label('Sticky Header')
                    ->boolean(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // No bulk actions needed for settings
            ])
            ->paginated(false); // Settings should be a single record
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSiteSettings::route('/'),
            'create' => Pages\CreateSiteSetting::route('/create'),
            'edit' => Pages\EditSiteSetting::route('/{record}/edit'),
        ];
    }
    
    public static function canCreate(): bool
    {
        // Only allow creating if no settings exist yet
        return SiteSetting::count() === 0;
    }
}
