<?php

namespace App\Filament\Resources\FilamentResource\Widgets;

use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget;
use App\Models\Article;
use App\Models\Category;
use App\Models\Author;

class ArticleStats extends StatsOverviewWidget
{
    protected function getCards(): array
    {
        $totalArticles = Article::count();
        $totalCategories = Category::count();

        return [
            Card::make('Total artikel yang ada', $totalArticles),

            Card::make('Total kategori yang ada', $totalCategories),

            // Card::make('Total Penulis', Author::where('is_active', true)->count())
            Card::make('Total penulis terdaftar', Author::count()),
        ];
    }
}
