<?php

namespace App\Filament\Widgets;

use App\Models\ActivityArea;
use App\Models\Company;
use App\Models\Provider;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;

class CompaniesAndProvidersPerActivityAreaChart extends ChartWidget
{
    protected static ?string $pollingInterval = null;

    protected static ?int $sort = 4;

    protected static ?string $heading = 'Répartition des entreprises et fournisseurs par secteur d\'activité';

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $activityAreas = ActivityArea::query()
            ->get();

        $companiesPerActivityArea = $activityAreas->map(fn ($area) => [
            'id' => $area->id,
            'count' => 0,
        ])->toArray();

        $areas = collect(Company::query()
            ->whereNotNull('activity_area_id')
            ->pluck('activity_area_id'));

        foreach ($areas as $area) {
            foreach ($companiesPerActivityArea as $key => $companyPerActivityArea) {
                if ($area == $companyPerActivityArea['id']) {
                    $companiesPerActivityArea[$key]['count']++;
                    break;
                }
            }
        }
        $companiesData = collect($companiesPerActivityArea)->pluck('count')->toArray();

        $providersPerActivityArea = $activityAreas->map(fn ($area) => [
            'id' => $area->id,
            'count' => 0,
        ])->toArray();

        $areas = collect(Provider::query()
            ->whereNotNull('activity_area_id')
            ->pluck('activity_area_id'));

        foreach ($areas as $area) {
            foreach ($providersPerActivityArea as $key => $providerPerActivityArea) {
                if ($area == $providerPerActivityArea['id']) {
                    $providersPerActivityArea[$key]['count']++;
                    break;
                }
            }
        }
        $providersData = collect($providersPerActivityArea)->pluck('count')->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Entreprises',
                    'data' => $companiesData,
                    'backgroundColor' => '#06693899',
                    'borderColor' => '#066938',
                ],
                [
                    'label' => 'Fournisseurs',
                    'data' => $providersData,
                    'backgroundColor' => '#FFD60099',
                    'borderColor' => '#FFD600',
                ],
            ],
            'labels' => $activityAreas->pluck('name')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): RawJs
    {
        return RawJs::make(<<<'JS'
        {
            scales: {
                x: {
                    ticks: {
                    maxRotation: 70,
                    minRotation: 70
                    }
                }
            },
        }
    JS);
    }
}
