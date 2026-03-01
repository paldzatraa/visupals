<?php

namespace App\Filament\Widgets;

use App\Models\Portfolio;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProjectStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Projects', Portfolio::count())
                ->description('Karya yang terpublikasi')
                ->descriptionIcon('heroicon-m-presentation-chart-line')
                ->color('primary')
                ->chart([7, 2, 10, 3, 15, 4, 17]), // Grafik estetik

            Stat::make('Role', 'Content Creator')
                ->description('UPMD FILKOM UB') // Identitas Anda
                ->color('info'),
        ];
    }
}
