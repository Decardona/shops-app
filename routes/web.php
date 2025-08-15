<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\TerceroController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VentaController;

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Route::get('vitrina', [ProductoController::class, 'list'])->name('vitrina');
    Route::resource('productos', ProductoController::class);
    Route::resource('terceros', TerceroController::class);
    Route::resource('user', UserController::class);

    Route::resource('ventas', VentaController::class);
    Route::get('ventas/{id}/imprimir', [VentaController::class, 'imprimir'])->name('ventas.imprimir');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
