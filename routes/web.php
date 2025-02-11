<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'prevent.back.history'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['auth', 'role:Administrador'])->group(function () {

        // Rutas para gestionar empleados (ahora dentro de `users`)
        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('users.index');
            Route::get('/create', [UserController::class, 'create'])->name('users.create');
            Route::post('/', [UserController::class, 'store'])->name('users.store');
            Route::get('/{user}', [UserController::class, 'show'])->name('users.show');
            Route::get('/{user}/edit',  [UserController::class, 'edit'])->name('users.edit');
            Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        });

        // Rutas para gestionar clientes
        Route::prefix('clients')->group(function () {
            Route::get('/', [ClientController::class, 'index'])->name('clients.index');
            Route::get('/create', [ClientController::class, 'create'])->name('clients.create');
            Route::post('/', [ClientController::class, 'store'])->name('clients.store');
            Route::get('/{client}', [ClientController::class, 'show'])->name('clients.show');
            Route::get('/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');
            Route::put('/{client}', [ClientController::class, 'update'])->name('clients.update');
            Route::delete('/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');
        });
    });
});

require __DIR__ . '/auth.php';

