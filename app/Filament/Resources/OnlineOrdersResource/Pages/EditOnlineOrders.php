<?php

namespace App\Filament\Resources\OnlineOrdersResource\Pages;

use App\Filament\Resources\OnlineOrdersResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOnlineOrders extends EditRecord
{
    protected static string $resource = OnlineOrdersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
