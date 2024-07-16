<?php

namespace App\Filament\Widgets;

use App\Models\Tenant;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Illuminate\Support\Facades\DB;

class UserTypeOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Tenants', Tenant::count()),
            Stat::make('Tenant Admins', User::query()->whereNotNull('tenant_id')->distinct('tenant_id')->count()),
            Stat::make('Marketers', Tenant::query()->whereNotNull('marketer_id')->distinct('marketer_id')->count()),
            // Stat::make('Customers', DB::table('customer_tenant')->whereNotNull('user_id')->distinct('user_id')->count()),
            // Stat::make('Workers', DB::table('worker_tenant')->whereNotNull('user_id')->distinct('user_id')->count()),
        ];
    }
}
