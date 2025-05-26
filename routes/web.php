<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Models\Article;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\PublicArticleController;
use App\Http\Controllers\SearchController;

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscribe');
Route::get('/search', [LandingController::class, 'search'])->name('search');
Route::get('/artikel/{slug}', [LandingController::class, 'show'])->name('articles.show');
