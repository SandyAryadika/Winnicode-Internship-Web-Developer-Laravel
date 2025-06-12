<?php

namespace App\Filament\Resources\FilamentResource\Widgets;

use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget;
use App\Models\Article;
use App\Models\Category;
use App\Models\Author;
use App\Models\Subscriber;

class ArticleStats extends StatsOverviewWidget
{
    protected function getCards(): array
    {
        $totalArticles = Article::count();
        $totalCategories = Category::count();
        $totalAuthors = Author::count();
        $totalSubscribers = Subscriber::count();

        return [
            Card::make('Total artikel', $totalArticles)
                ->extraAttributes(['class' => 'text-xl'])
                ->icon('heroicon-o-document-text'),

            Card::make('Total kategori', $totalCategories)
                ->icon('heroicon-o-tag'),

            Card::make('Total penulis', $totalAuthors)
                ->icon('heroicon-o-user-group'),

            Card::make('Total subscriber', $totalSubscribers)
                ->icon('heroicon-o-envelope'),
        ];
    }
}
