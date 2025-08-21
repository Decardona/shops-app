<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\TerceroController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ComprasController;

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Route::get('vitrina', [ProductoController::class, 'list'])->name('vitrina');
    Route::resource('productos', ProductoController::class);
    Route::resource('terceros', TerceroController::class);
    Route::resource('user', UserController::class);
    Route::get('ventas/create', [VentaController::class, 'create'])->name('ventas.create');
    Route::get('ventas/{id}/imprimir', [VentaController::class, 'imprimir'])->name('ventas.imprimir');
    Route::post('ventas/store', [VentaController::class, 'store'])->name('ventas.store');
    Route::get('ventas/search', [VentaController::class, 'search'])->name('search_factura');
    Route::post('ventas/start-search', [VentaController::class, 'startSearch'])->name('ventas.start_search');
    Route::delete('ventas/{venta}', [VentaController::class, 'destroy'])->name('ventas.destroy');
    Route::resource('compras', ComprasController::class);

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
