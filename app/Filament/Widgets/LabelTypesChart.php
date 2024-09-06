<?php

namespace App\Filament\Widgets;

use App\Enums\LabelType;
use App\Models\Label;
use Filament\Widgets\ChartWidget;

class LabelTypesChart extends ChartWidget
{
    protected static ?string $pollingInterval = null;

    protected static ?int $sort = 2;

    protected static ?string $heading = 'Nombre de labels par type';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Répartitions des Labels',
                    'data' => [
                        Label::query()->where('type', LabelType::PV)->count(),
                        Label::query()->where('type', LabelType::EPE)->count(),
                    ],
                    'backgroundColor' => [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                    ],
                    'borderColor' => [
                        'rgb(255, 99, 132)',
                        'rgb(75, 192, 192)',
                    ],
                ],
            ],
            'labels' => ['PV', 'EPE'],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
