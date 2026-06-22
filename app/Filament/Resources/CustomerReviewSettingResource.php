<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerReviewSettingResource\Pages;
use App\Models\CustomerReview;
use App\Models\CustomerReviewSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CustomerReviewSettingResource extends Resource
{
    protected static ?string $model = CustomerReviewSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?string $navigationLabel = 'Review Statistics';

    protected static ?string $modelLabel = 'Review Statistics';

    protected static ?string $pluralModelLabel = 'Review Statistics';

    protected static ?string $navigationGroup = 'Homepage Management';

    protected static ?int $navigationSort = 12;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Section')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Show Customer Reviews section on homepage')
                            ->default(true),

                        Forms\Components\TextInput::make('section_title')
                            ->label('Section Title')
                            ->required()
                            ->maxLength(255)
                            ->default('Customer Reviews'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Statistics Mode')
                    ->schema([
                        Forms\Components\Toggle::make('use_marketing_stats')
                            ->label('Use Marketing Statistics')
                            ->live()
                            ->helperText('Off = Real statistics (calculated from approved reviews). On = Marketing statistics (you control the numbers below).'),

                        Forms\Components\Placeholder::make('real_stats_reference')
                            ->label('Live Real Statistics (reference)')
                            ->content(function (): string {
                                $stats = CustomerReview::cachedRealStats();
                                $counts = $stats['star_counts'];

                                return "Average {$stats['average']} / 5 · {$stats['total']} reviews · "
                                    ."5★ {$counts[5]}, 4★ {$counts[4]}, 3★ {$counts[3]}, 2★ {$counts[2]}, 1★ {$counts[1]}";
                            }),
                    ]),

                Forms\Components\Section::make('Marketing Statistics')
                    ->description('Manually controlled numbers shown when Marketing mode is on.')
                    ->visible(fn (Forms\Get $get): bool => (bool) $get('use_marketing_stats'))
                    ->schema([
                        Forms\Components\TextInput::make('marketing_average_rating')
                            ->label('Average Rating')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(5)
                            ->step(0.01)
                            ->placeholder('4.91'),

                        Forms\Components\TextInput::make('marketing_total_reviews')
                            ->label('Total Reviews')
                            ->numeric()
                            ->minValue(0)
                            ->placeholder('1251'),

                        Forms\Components\TextInput::make('marketing_five_star')
                            ->label('5 Star Count')
                            ->numeric()
                            ->minValue(0)
                            ->default(0)
                            ->required(),

                        Forms\Components\TextInput::make('marketing_four_star')
                            ->label('4 Star Count')
                            ->numeric()
                            ->minValue(0)
                            ->default(0)
                            ->required(),

                        Forms\Components\TextInput::make('marketing_three_star')
                            ->label('3 Star Count')
                            ->numeric()
                            ->minValue(0)
                            ->default(0)
                            ->required(),

                        Forms\Components\TextInput::make('marketing_two_star')
                            ->label('2 Star Count')
                            ->numeric()
                            ->minValue(0)
                            ->default(0)
                            ->required(),

                        Forms\Components\TextInput::make('marketing_one_star')
                            ->label('1 Star Count')
                            ->numeric()
                            ->minValue(0)
                            ->default(0)
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('section_title')
                    ->label('Section Title')
                    ->weight('bold'),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),

                Tables\Columns\IconColumn::make('use_marketing_stats')
                    ->label('Marketing Mode')
                    ->boolean(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->paginated(false);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomerReviewSettings::route('/'),
            'create' => Pages\CreateCustomerReviewSetting::route('/create'),
            'edit' => Pages\EditCustomerReviewSetting::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        // Singleton — only allow creating if the row does not exist yet.
        return CustomerReviewSetting::count() === 0;
    }
}
