<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class ProjectsChart extends ChartWidget
{
    protected static ?string $pollingInterval = null;

    protected static ?int $sort = 5;

    protected static ?string $heading = 'Nombre de projets';

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $started = Trend::model(Project::class)
            ->dateColumn('started_on')
            ->between(
                start: now()->subYear(),
                end: now()->addYear(),
            )
            ->perMonth()
            ->count();

        $finished = Trend::model(Project::class)
            ->dateColumn('finished_on')
            ->between(
                start: now()->subYear(),
                end: now()->addYear(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Lancement',
                    'data' => $started->map(fn (TrendValue $value) => $value->aggregate),
                    'tension' => 0.2,
                    'borderColor' => 'rgb(75, 192, 192)',
                ],
                [
                    'label' => 'Fin',
                    'data' => $finished->map(fn (TrendValue $value) => $value->aggregate),
                    'tension' => 0.2,
                ],
            ],
            'labels' => $started->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
