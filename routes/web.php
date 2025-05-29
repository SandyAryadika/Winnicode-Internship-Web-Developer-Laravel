<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/search', [LandingController::class, 'search'])->name('search');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/artikel/{id}', [LandingController::class, 'show'])->name('articles.show');
Route::get('/authors/{id}', [AuthorController::class, 'show'])->name('authors.show');
Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscriber.store');
