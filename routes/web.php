<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

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

    Route::get('/employees', [EmployeeController::class, 'index'])
    ->middleware(['role:Administrador', 'permission:ver empleados'])
        ->name('employees.index');

    Route::get('/employees/create', [EmployeeController::class, 'create'])
        ->middleware(['role:Administrador', 'permission:crear empleados'])
        ->name('employees.create');

    Route::post('/employees', [EmployeeController::class, 'store'])
        ->middleware(['role:Administrador', 'permission:crear empleados'])
        ->name('employees.store');

    Route::get('/employees/{employee}', [EmployeeController::class, 'show'])
        ->middleware(['role:Administrador', 'permission:ver empleados'])
        ->name('employees.show');

    Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])
        ->middleware(['role:Administrador', 'permission:editar empleados'])
        ->name('employees.edit');

    Route::put('/employees/{employee}', [EmployeeController::class, 'update'])
        ->middleware(['role:Administrador', 'permission:editar empleados'])
        ->name('employees.update');

    Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])
        ->middleware(['role:Administrador', 'permission:eliminar empleados'])
        ->name('employees.destroy');
});


require __DIR__.'/auth.php';
