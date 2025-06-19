<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Category;
use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with('categories', Category::all());
        });

        View::composer('*', function ($view) {
            $view->with('authors', User::whereHas('articles')->take(12)->get());
        });

        View::composer('*', function ($view) {
            $view->with('latestArticles', Article::where('status', 'published')
                ->whereNotNull('published_at')
                ->latest('published_at')
                ->take(5)
                ->get());
        });

        View::composer('partials.footer', function ($view) {
            $categories = Category::whereIn('name', [
                'Nasional',
                'Internasional',
                'Hukum & Kriminal',
                'Ekonomi & Bisnis',
                'Teknologi',
            ])->get();

            $view->with('quickCategories', $categories);
        });

        setlocale(LC_TIME, 'id_ID.UTF-8');
        Carbon::setLocale('id');

        Paginator::useTailwind();
    }
    protected $policies = [
        \App\Models\Author::class => \App\Policies\AuthorPolicy::class,
    ];
}
