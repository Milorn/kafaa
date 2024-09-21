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
                        '#06693899',
                        '#FFD60099',
                    ],
                    'borderColor' => [
                        '#066938',
                        '#FFD600',
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
