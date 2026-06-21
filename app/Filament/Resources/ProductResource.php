<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\AuditLog;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    
    protected static ?string $navigationLabel = 'Products';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => 
                                $set('slug', \Illuminate\Support\Str::slug($state))
                            ),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('Auto-generated from product name'),
                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\TextInput::make('sku')
                            ->label('SKU')
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('Stock Keeping Unit (optional)'),
                    ])
                    ->columns(2),
                    
                Forms\Components\Section::make('Product Images')
                    ->schema([
                        Forms\Components\FileUpload::make('primary_image')
                            ->label('Primary Image')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '1:1',
                                '4:3',
                                '16:9',
                            ])
                            ->directory('products/primary')
                            ->maxSize(2048)
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('1:1')
                            ->imageResizeTargetWidth('800')
                            ->imageResizeTargetHeight('800')
                            ->helperText('📸 Main product image (drag & drop, auto-resized to 800x800px)')
                            ->columnSpanFull(),
                            
                        Forms\Components\FileUpload::make('images')
                            ->label('Gallery Images')
                            ->image()
                            ->multiple()
                            ->reorderable()
                            ->imageEditor()
                            ->directory('products/gallery')
                            ->maxFiles(10)
                            ->maxSize(2048)
                            ->imageResizeMode('cover')
                            ->imageResizeTargetWidth('1200')
                            ->imageResizeTargetHeight('1200')
                            ->helperText('🖼️ Drag & drop up to 10 images (auto-resized to 1200x1200px). Drag to reorder.')
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),
                    
                Forms\Components\Section::make('Pricing & Inventory')
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('$')
                            ->minValue(0)
                            ->step(0.01)
                            ->live()
                            ->label('Original Price'),
                        Forms\Components\TextInput::make('discount_percentage')
                            ->numeric()
                            ->suffix('%')
                            ->minValue(0)
                            ->maxValue(100)
                            ->default(0)
                            ->live()
                            ->helperText('Enter discount percentage (0-100%). Final price will be auto-calculated.'),
                        Forms\Components\Placeholder::make('calculated_sale_price')
                            ->label('Final Price (After Discount)')
                            ->content(function (Forms\Get $get, ?Product $record) {
                                $price = floatval($get('price') ?? 0);
                                $discount = intval($get('discount_percentage') ?? 0);

                                if ($price <= 0) {
                                    return 'Enter price first';
                                }

                                if ($discount > 0) {
                                    // Live preview: mirrors getSalePriceAttribute branch-1
                                    $finalPrice = round($price - ($price * ($discount / 100)), 2);
                                } elseif ($record !== null) {
                                    // Edit mode with no percentage: read the stored final_price
                                    $finalPrice = (float) $record->final_price;
                                } else {
                                    $finalPrice = $price;
                                }

                                if ($finalPrice < $price) {
                                    return '$' . number_format($finalPrice, 2) . ' (Save $' . number_format($price - $finalPrice, 2) . ')';
                                }
                                return '$' . number_format($finalPrice, 2);
                            })
                            ->helperText('💡 This is the actual selling price charged at checkout'),
                        Forms\Components\TextInput::make('stock')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->helperText('Available quantity'),
                    ])
                    ->columns(2),
                    
                Forms\Components\Section::make('Product Details')
                    ->schema([
                        Forms\Components\RichEditor::make('description')
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'bulletList',
                                'orderedList',
                                'link',
                            ])
                            ->columnSpanFull(),
                    ]),
                    
                Forms\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Featured Product')
                            ->helperText('Show on homepage'),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->helperText('Visible to customers'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Marketing / Social Proof')
                    ->schema([
                        Forms\Components\Textarea::make('short_description')
                            ->label('Short Description')
                            ->rows(2)
                            ->maxLength(500)
                            ->helperText('Brief marketing tagline shown on product cards')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('rating')
                            ->label('Display Rating')
                            ->numeric()
                            ->step(0.1)
                            ->minValue(0)
                            ->maxValue(5)
                            ->suffix('/ 5')
                            ->helperText('Overrides calculated avg. Leave blank to use real review average.'),
                        Forms\Components\Toggle::make('auto_review_count')
                            ->label('Auto Review Count')
                            ->helperText('ON: use real approved review count. OFF: use manual count below.')
                            ->live()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('rating_count')
                            ->label('Manual Review Count')
                            ->numeric()
                            ->step(1)
                            ->minValue(0)
                            ->helperText('Ignored when Auto Review Count is ON.')
                            ->hidden(fn (Forms\Get $get): bool => (bool) $get('auto_review_count')),
                    ])
                    ->columns(2)
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('primary_image')
                    ->label('Image')
                    ->circular()
                    ->defaultImageUrl(url('/media/images/product/1.jpg')),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Product $record): string => $record->sku ?? 'No SKU'),
                Tables\Columns\TextColumn::make('category.name')
                    ->badge()
                    ->color('info')
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('usd')
                    ->sortable()
                    ->label('Price')
                    ->description(fn (Product $record): ?string =>
                        $record->final_price < $record->price
                            ? ($record->discount_percentage > 0 ? $record->discount_percentage . '% OFF → ' : 'Sale → ')
                              . '$' . number_format($record->final_price, 2)
                            : null
                    ),
                Tables\Columns\TextColumn::make('stock')
                    ->badge()
                    ->sortable()
                    ->color(fn (int $state): string => match (true) {
                        $state === 0 => 'danger',
                        $state < 10 => 'warning',
                        default => 'success',
                    }),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean()
                    ->label('Featured'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Added')
                    ->dateTime()
                    ->sortable()
                    ->since()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name')
                    ->preload(),
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Featured'),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active'),
                Tables\Filters\Filter::make('low_stock')
                    ->label('Low Stock')
                    ->query(fn (Builder $query): Builder => $query->where('stock', '<', 10)),
                Tables\Filters\Filter::make('out_of_stock')
                    ->label('Out of Stock')
                    ->query(fn (Builder $query): Builder => $query->where('stock', 0)),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->before(function (Product $record, Tables\Actions\DeleteAction $action) {
                        if ($record->orderItems()->exists()) {
                            Notification::make()
                                ->title('Product cannot be deleted')
                                ->body('This product has order history. Set "Active = Off" to hide it from the store instead.')
                                ->danger()
                                ->persistent()
                                ->send();
                            $action->cancel();
                            return;
                        }
                        AuditLog::record('product_deleted', $record, [
                            'id'    => $record->id,
                            'name'  => $record->name,
                            'price' => $record->price,
                            'sku'   => $record->sku,
                        ], []);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function (Collection $records, Tables\Actions\DeleteBulkAction $action) {
                            $blocked = $records->filter(fn (Product $p) => $p->orderItems()->exists());
                            if ($blocked->isNotEmpty()) {
                                Notification::make()
                                    ->title('Cannot delete ' . $blocked->count() . ' product(s)')
                                    ->body('Products with order history cannot be deleted. Deactivate them instead.')
                                    ->danger()
                                    ->persistent()
                                    ->send();
                                $action->cancel();
                                return;
                            }
                            foreach ($records as $record) {
                                AuditLog::record('product_deleted', $record, [
                                    'id'    => $record->id,
                                    'name'  => $record->name,
                                    'price' => $record->price,
                                    'sku'   => $record->sku,
                                ], []);
                            }
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
