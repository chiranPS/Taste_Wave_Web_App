<?php

namespace App\Filament\Resources\OnlineOrdersResource\Pages;

use App\Filament\Resources\OnlineOrdersResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOnlineOrders extends ListRecords
{
    protected static string $resource = OnlineOrdersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
