<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CuotaController;
use App\Http\Controllers\TareaController;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Mail\MiCorreo;
use Illuminate\Support\Facades\Mail;
use App\Models\Role;

Route::get('/tareas/reset', function () {
    session()->forget('cliente_verificado');
    session()->forget('cliente_id');
    return redirect()->route('tareas.verificar');
})->name('tareas.reset');



Route::get('/tareas/verificar', function () {
    return view('verificar_cliente');
})->name('tareas.verificar');



Route::post('/tareas/verificar', [TareaController::class, 'verificarCliente'])->name('tareas.verificar.post');

Route::post('/tareas/storenueva', [TareaController::class, 'storenueva'])->name('tareas.storenueva');

Route::get('/tareas/nueva', [TareaController::class, 'nueva'])->name('tareas.nueva');



Route::get('/test-correo', function () {
    $data = [
        'nombre' => 'Yeray',
        'concepto' => 'NO ES UNA ESTAFA',
        'importe' => '100.00 EUR',
        'fecha_emision' => now()->format('d/m/Y'),
        'mensaje' => 'Realize un bizum al numero 671 21 98 22 para que esta noche santiago no se le acerque a su casa 
        NO ES UNA ESTAFA',
    ];

    Mail::to('mgrandesanchez@gmail.com')->send(new MiCorreo($data));

    return "Correo de prueba enviado correctamente a tu dirección.";
});




Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('google.redirect');


Route::get('/google-auth/callback', function () {
    $user_google = Socialite::driver('google')->stateless()->user();

    // Buscar si el usuario ya existe
    $user = User::where('email', $user_google->email)->first();

    if ($user) {
        // Si el usuario existe, actualizar Google ID si es necesario
        if (!$user->google_id) {
            $user->update([
                'google_id' => $user_google->id,
            ]);
        }
    } else {
        // Si el usuario no existe, crearlo
        $user = User::create([
            'name' => $user_google->name,
            'email' => $user_google->email,
            'google_id' => $user_google->id,
            'password' => bcrypt('password123'),
            'role' => 'Operario',
        ]);

        // ✅ Asignar el rol "operario" solo si es nuevo
        $user->assignRole('Operario');
    }

    // Iniciar sesión con el usuario
    Auth::login($user);

    return redirect()->route('dashboard');
})->name('google.callback');


Route::get('/', function () {
    return Inertia::render('Dashboard'); // Debe coincidir con el nombre del archivo Vue
});

Route::post('/tareas/verificar', [TareaController::class, 'verificarCliente'])->name('tareas.verificar.post');

Route::get('/tareas/{tarea}/descargar-resumen', [TareaController::class, 'descargarResumen'])->name('tareas.descargarResumen');

Route::middleware(['auth', 'prevent.back.history'])->group(function () {




    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::put('/tareas/{tarea}/realizar', [TareaController::class, 'realizar'])->name('tareas.realizar');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['auth'])->get('/tareas/{tarea}', [TareaController::class, 'show'])->name('tareas.show');

    Route::middleware(['auth', 'role:Administrador'])->group(function () {
        // 📌 Rutas para gestionar usuarios
        Route::resource('users', UserController::class);

        // 📌 Rutas para gestionar clientes
        Route::resource('clientes', ClientController::class);

        Route::get('clientes/{cliente}/delete', [ClientController::class, 'delete'])->name('clientes.delete');

        // 📌 Rutas para gestionar cuotas
        Route::resource('cuotas', CuotaController::class);

        Route::get('/cuotas/{cuota}/delete', [CuotaController::class, 'delete'])->name('cuotas.delete');

        Route::get('/cuotas/{cuota}/pdf', [CuotaController::class, 'descargarPDF'])->name('cuotas.pdf');

        Route::get('/tareas/{tarea}/asignar-operario', [TareaController::class, 'asignarOperario'])->name('tareas.asignarOperario');
        Route::put('/tareas/{tarea}/guardar-operario', [TareaController::class, 'guardarOperario'])->name('tareas.guardarOperario');

        Route::get('tareas/{tarea}/delete', [TareaController::class, 'delete'])->name('tareas.delete');


       


    });

    // 🔹 Rutas para Administradores
    Route::middleware(['auth', 'role:Administrador'])->prefix('tareas')->group(function () {
        Route::get('/', [TareaController::class, 'index'])->name('tareas.index'); // Todas las tareas
        Route::get('/create', [TareaController::class, 'create'])->name('tareas.create');
        Route::post('/store', [TareaController::class, 'store'])->name('tareas.store');
        Route::get('/{tarea}/edit', [TareaController::class, 'edit'])->name('tareas.edit');
        Route::put('/{tarea}/update', [TareaController::class, 'update'])->name('tareas.update');
        Route::delete('/{tarea}/destroy', [TareaController::class, 'destroy'])->name('tareas.destroy');
    });

    // 🔹 Rutas para Operarios
    Route::middleware(['auth', 'role:Operario'])->prefix('mis-tareas')->group(function () {
        Route::get('/', [TareaController::class, 'misTareas'])->name('tareas.misTareas'); // Solo sus tareas
        Route::put('/{tarea}/realizar', [TareaController::class, 'realizar'])->name('tareas.realizar');

        // Mostrar el formulario para realizar la tarea
        Route::get('/tareas/{tarea}/realizar', [TareaController::class, 'realizar'])->name('tareas.realizar');

        // Guardar los datos de la tarea realizada
        Route::put('/tareas/{tarea}/realizar', [TareaController::class, 'guardarRealizada'])->name('tareas.guardarRealizada');

    });

});




require __DIR__ . '/auth.php';

