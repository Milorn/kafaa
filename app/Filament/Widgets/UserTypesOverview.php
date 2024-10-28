<?php

namespace App\Filament\Widgets;

use App\Models\Company;
use App\Models\Expert;
use App\Models\Provider;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserTypesOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Nombre d\'experts', Expert::query()->count()),
            Stat::make('Nombre d\'entreprises', Company::query()->count()),
            Stat::make('Nombre de fournisseurs', Provider::query()->count()),
        ];
    }
}
