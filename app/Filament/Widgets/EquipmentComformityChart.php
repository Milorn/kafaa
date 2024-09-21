<?php

namespace App\Filament\Widgets;

use App\Enums\EquipmentStatus;
use App\Models\Equipment;
use Filament\Widgets\ChartWidget;

class EquipmentComformityChart extends ChartWidget
{
    protected static ?string $pollingInterval = null;

    protected static ?int $sort = 3;

    protected static ?string $heading = 'Répartition des équipements par conformité';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Répartition des équipements',
                    'data' => [
                        Equipment::query()->where('status', EquipmentStatus::Compliant)->count(),
                        Equipment::query()->where('status', EquipmentStatus::NonCompliant)->count(),
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
            'labels' => ['Conforme', 'Non conforme'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
