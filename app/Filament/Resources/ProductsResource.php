<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductsResource\Pages;
use App\Filament\Resources\ProductsResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;
use Filament\Tables\Filters\Filter;


class ProductsResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';
    protected static ?string $navigationGroup = 'Resource Management';
    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::count() < 10 ? 'warning' : 'success';
    }


    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('product_name')
                ->required()
                ->maxLength(255),
            Forms\Components\Select::make('food_category')
            ->required()
            ->label('Select food Category')
            ->options([
                'FriedRice' => 'Fried Rice',
                'Pizza' => 'Pizza',
                'Burger' => 'Burger',
                'Pasta' => 'Pasta',
                'Beverages' => 'Beverages',
                'Kottu' => 'Kottu'
            ]),
            Forms\Components\TextInput::make('description')
                ->required()
                ->maxLength(300),
            Forms\Components\FileUpload::make('image')
                ->image()
                ->directory('products/images')
                ->required(),
                Forms\Components\TextInput::make('product_price')
                ->required(),
                Forms\Components\TextInput::make('rating')
                ->required()
                ->numeric(),
                // ->min(0)
                // ->max(5),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('product_name'),
            Tables\Columns\ImageColumn::make('image')
                  ->disk('public') 
                  ->url(fn($record) => url('storage/'.$record->image)),
            Tables\Columns\TextColumn::make('description'),
            Tables\Columns\TextColumn::make('product_price'),
            Tables\Columns\TextColumn::make('rating'),
        ])
        ->filters([
            Filter::make('is_featured')
                 ->toggle()
        ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                      ->successNotification(
                        Notification::make()
                           ->success()
                           ->title('Product Deleted.')
                           ->body('Product has been deleted successfully.')
                      )
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProducts::route('/create'),
            'edit' => Pages\EditProducts::route('/{record}/edit'),
        ];
    }
}
