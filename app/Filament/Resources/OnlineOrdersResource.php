<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OnlineOrdersResource\Pages;
use App\Filament\Resources\OnlineOrdersResource\RelationManagers;
use App\Models\OnlineOrder;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
class OnlineOrdersResource extends Resource
{
    protected static ?string $model = OnlineOrder::class;
    protected static ?string $navigationGroup = 'Service Management';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_name')
                    ->label('User Name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('user_email')
                    ->label('User Email')
                    ->email()
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('phone_number')
                    ->label('Phone Number')
                    ->required()
                    ->maxLength(20),

                Forms\Components\TextInput::make('total_price')
                    ->label('Total Price')
                    ->numeric()
                    ->required(),

                Forms\Components\Select::make('delivery_method')
                    ->label('Delivery Method')
                    ->options([
                        'standard' => 'Standard Delivery',
                        'express' => 'Express Delivery',
                    ])
                    ->required(),

                Forms\Components\Textarea::make('delivery_address')
                    ->label('Delivery Address')
                    ->maxLength(500),

                Forms\Components\Textarea::make('order_items')
                    ->label('Order Items (JSON)')
                    ->required()
                    ->json()
                    ->maxLength(1000),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_name')
                    ->label('User Name')
                    ->sortable()
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('user_email')
                    ->label('User Email')
                    ->sortable()
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('phone_number')
                    ->label('Phone Number')
                    ->sortable()
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('order_items')
                    ->label('Order Items')
                    ->sortable()
                    ->formatStateUsing(function ($state) {
                        $orderItems = json_decode($state, true);
                        if (is_array($orderItems)) {
                            $items = collect($orderItems)->map(function ($item) {
                                return '<div style="background-color: #098520; padding: 5px; border-radius: 5px; margin-bottom: 5px; font-size: 14px;">' 
                                    . '<strong>' . $item['product'] . '</strong> - Qty: ' . $item['quantity'] . ' Price: ' . $item['price']
                                    . '</div>';
                            })->implode('');
                            return $items;
                        }
                        return '<div style="padding: 5px; color: #999;">No items</div>';
                    })
                    ->html(),
                
                Tables\Columns\TextColumn::make('total_price')
                    ->label('Total Price')
                    ->sortable()
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('delivery_method')
                    ->label('Delivery Method')
                    ->sortable()
                    ->searchable(),

                    Tables\Columns\BooleanColumn::make('is_completed')
                    ->label('Completed')
                    ->sortable(),
            ])
            ->filters([
                Filter::make('is_completed')
                    ->label('Completed Orders')
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
            'index' => Pages\ListOnlineOrders::route('/'),
            'create' => Pages\CreateOnlineOrders::route('/create'),
            'edit' => Pages\EditOnlineOrders::route('/{record}/edit'),
        ];
    }
}
