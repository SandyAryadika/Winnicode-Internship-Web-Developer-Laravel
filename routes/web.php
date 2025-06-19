<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\SubscriberExportController;

Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/articles/{id}', [ArticleController::class, 'show'])
    ->whereNumber('id')
    ->name('articles.show');

Route::get('/authors/{id}', [AuthorController::class, 'show'])->name('authors.show');

Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscriber.store');

Route::post('/unsubscribe', [SubscriberController::class, 'unsubscribe'])->name('subscriber.unsubscribe');

Route::post('/articles/{article}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

Route::middleware(['auth'])->group(function () {
    Route::get('/export-subscribers', [SubscriberExportController::class, 'export']);
});

Route::fallback(function () {
    abort(404, 'Halaman tidak ditemukan.');
});
