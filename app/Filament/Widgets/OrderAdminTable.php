<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Order;

class OrderAdminTable extends BaseWidget
{

    protected static ?int $sort = 4;

    public function table(Table $table): Table
    {
        return $table
            ->query(Order::query())
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('customer.Customer_name'),
                Tables\Columns\TextColumn::make('product.product_name'),
                Tables\Columns\TextColumn::make('total_price'),
                Tables\Columns\BooleanColumn::make('is_completed'),
            ]);
    }
}
