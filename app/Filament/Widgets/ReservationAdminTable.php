<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Reservation;

class ReservationAdminTable extends BaseWidget
{
    protected static ?int $sort = 3;

    public function table(Table $table): Table
    {
        return $table
        ->query(Reservation::query())
        ->defaultSort('created_at', 'desc')
        ->columns([
            Tables\Columns\TextColumn::make('branch.branch_location'),
            Tables\Columns\TextColumn::make('table_no'),
            Tables\Columns\TextColumn::make('customer_contact_no'),
            Tables\Columns\TextColumn::make('customer_name'),
            Tables\Columns\BooleanColumn::make('is_completed'),
        ]);
    }
}
