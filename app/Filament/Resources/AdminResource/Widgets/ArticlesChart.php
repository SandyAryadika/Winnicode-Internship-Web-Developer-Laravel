<?php

namespace App\Filament\Resources\AdminResource\Widgets;

use App\Models\Article;
use Filament\Widgets\LineChartWidget;
use Illuminate\Support\Carbon;

class ArticlesChart extends LineChartWidget
{
    protected static ?string $heading = 'Artikel Harian & Bulanan';
    protected static ?int $sort = 4;
    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $daily = Article::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereDate('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->mapWithKeys(fn($item) => [
                Carbon::parse($item->date)->format('d M') => $item->count,
            ])
            ->toArray();

        $monthly = Article::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->whereDate('created_at', '>=', now()->subMonths(12))
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->mapWithKeys(fn($item) => [
                Carbon::parse($item->month . '-01')->format('M Y') => $item->count,
            ])
            ->toArray();

        $allLabels = array_unique(array_merge(array_keys($daily), array_keys($monthly)));

        sort($allLabels);

        return [
            'datasets' => [
                [
                    'label' => 'Artikel Harian',
                    'data' => array_map(fn($label) => $daily[$label] ?? null, $allLabels),
                    'borderColor' => '#37ABEE',
                    'backgroundColor' => '#37ABEE',
                    'fill' => false,
                ],
                [
                    'label' => 'Artikel Bulanan',
                    'data' => array_map(fn($label) => $monthly[$label] ?? null, $allLabels),
                    'borderColor' => '#FF66C4',
                    'backgroundColor' => '#FF66C4',
                    'fill' => false,
                ],
            ],
            'labels' => $allLabels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
