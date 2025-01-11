<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Branch;
use App\Models\Inventory;
use App\Models\Product;


class StatsAdminOverview extends BaseWidget
{

    protected function getStats(): array
    {
        return [
            Stat::make('Customers', Customer::query()->count())
                ->description('All Customers from the WebSite')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
            Stat::make('Branches', Branch::query()->count())
                ->description('All Registered Branches from the WebSite')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
            Stat::make('Orders',Order::query()->count())
                ->description('All Appointments from the WebSite')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
            Stat::make('Products',Product::query()->count())
                ->description('All Products from the WebSite')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17])
        ];
    }
}
