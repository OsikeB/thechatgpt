<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/articles', [PostController::class, 'index'])->name('posts.index');
Route::get('/articles/{post:slug}', [PostController::class, 'show'])->name('posts.show');

Route::prefix('admin')->name('admin.')->middleware(['web', 'auth'])->group(function (): void {
    Route::view('/', 'admin.dashboard')->name('dashboard');
});