<?php

use Illuminate\Support\Facades\Route;

// Frontend Controllers
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\MusicController;
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Frontend\MerchandiseController;
use App\Http\Controllers\Frontend\ContactController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MusicController as AdminMusicController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\MerchandiseController as AdminMerchandiseController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingsController;

// ==========================================
// FRONTEND ROUTES (Public)
// ==========================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/music', [MusicController::class, 'index'])->name('music');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/merchandise', [MerchandiseController::class, 'index'])->name('merchandise');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// ==========================================
// AUTH ROUTES (Breeze)
// ==========================================
require __DIR__.'/auth.php';

// ==========================================
// ADMIN ROUTES (Protected)
// ==========================================
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Music
        Route::resource('music', AdminMusicController::class);

        // Album
        Route::resource('albums', AlbumController::class);

        // Gallery
        Route::resource('gallery', AdminGalleryController::class);

        // Merchandise
        Route::resource('merchandise', AdminMerchandiseController::class);

        // Orders
        Route::resource('orders', OrderController::class)->only(['index', 'show', 'update', 'destroy']);

        // Contact Messages
        Route::get('contact', [AdminContactController::class, 'index'])->name('contact.index');
        Route::get('contact/{contactMessage}', [AdminContactController::class, 'show'])->name('contact.show');
        Route::delete('contact/{contactMessage}', [AdminContactController::class, 'destroy'])->name('contact.destroy');

        // Users
        Route::resource('users', UserController::class);

        // Settings
        Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');
    });