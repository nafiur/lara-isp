<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Network\RouterController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('network/routers', RouterController::class)
        ->except('show')
        ->middleware([
            'index' => 'can:network.view',
            'create' => 'can:network.manage',
            'store' => 'can:network.manage',
            'edit' => 'can:network.manage',
            'update' => 'can:network.manage',
            'destroy' => 'can:network.manage',
        ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
