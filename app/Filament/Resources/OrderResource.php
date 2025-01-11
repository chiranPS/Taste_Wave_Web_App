<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\Filter;
use Filament\Notifications\Notification;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift-top';

    protected static ?string $navigationGroup = 'Service Management';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'success';
    }

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Section::make('Order Details')
            ->description('Put the Order Details in.')
            ->schema([
                Forms\Components\Select::make('customer_id')
                    ->relationship(name: 'customer', titleAttribute: 'Customer_name')
                    ->searchable()
                    ->preload() 
                    ->required(),
                Forms\Components\Select::make('product_id')
                    ->relationship(name: 'product', titleAttribute: 'product_name')
                    ->searchable()
                    ->preload() 
                    ->required(),
                Forms\Components\TextInput::make('total_price')
                       ->maxLength(255)
                       ->default(null)
                       ->required(),
                Forms\Components\TextInput::make('order_type')
                       ->maxLength(255)
                       ->default(null)
                       ->required(),
                Forms\Components\TextInput::make('Quality')
                       ->maxLength(255)
                       ->default(null)
                       ->required(),
                ])->columns(3),               
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('customer.Customer_name')
                           ->sortable()
                           ->searchable(),
            Tables\Columns\TextColumn::make('product.product_name')
                           ->sortable()
                           ->searchable(),
            Tables\Columns\TextColumn::make('total_price')
                           ->sortable()
                           ->searchable(),
            Tables\Columns\TextColumn::make('order_type')
                           ->sortable()
                           ->searchable(),
            Tables\Columns\TextColumn::make('Quality')
                           ->sortable()
                           ->searchable(),
            Tables\Columns\TextColumn::make('created_at')
                           ->sortable()
                           ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\BooleanColumn::make('is_completed')
                           ->label('Completed')
                           ->sortable(),
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
                   ->title('Order Deleted.')
                   ->body('Order has been deleted successfully.')
              ),
            Tables\Actions\Action::make('complete')
                ->label('Complete')
                ->action(function ($record) {
                    $record->update(['is_completed' => true]);
                    Notification::make()
                        ->success()
                        ->title('Order Completed')
                        ->body('The Order has been marked as completed.')
                        ->send();
                })
                ->requiresConfirmation()
                ->color('success')
                ->icon('heroicon-o-check'),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrders::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}


