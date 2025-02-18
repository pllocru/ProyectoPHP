<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Muestra una lista de empleados.
     */
    public function index()
    {
        $users = User::paginate(10); // Paginación de 10 empleados por página
        return view('users.index', compact('users'));
    }

    /**
     * Muestra el formulario para crear un nuevo empleado.
     */
    public function create()
    {
        $roles = Role::pluck('name'); // Obtiene los nombres de los roles
        return view('users.create', compact('roles'));
    }

    /**
     * Almacena un nuevo empleado en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'dni' => 'required|unique:users,dni',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'hire_date' => 'required|date',
            'role' => 'required|exists:roles,name',
        ]);

        // Crear usuario
        $user = User::create([
            'dni' => $request->dni,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password'), // Contraseña predeterminada
            'phone' => $request->phone,
            'address' => $request->address,
            'hire_date' => $request->hire_date,
            'role' => $request->role,
        ]);

        // Asignar rol con Spatie
        $user->assignRole($request->role);

        // Mensaje flash de éxito
        session()->flash('success', 'Empleado creado correctamente.');

        return redirect()->route('users.index');
    }

    /**
     * Muestra los detalles de un empleado.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Muestra el formulario para editar un empleado.
     */
    public function edit(User $user)
    {
        $roles = Role::pluck('name');
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Actualiza la información de un empleado.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'dni' => 'required|unique:users,dni,' . $user->id,
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'hire_date' => 'required|date',
            'role' => 'required|exists:roles,name',
        ]);

        // Actualizar usuario
        $user->update($validatedData);

        // Actualizar rol con Spatie
        $user->syncRoles([$request->role]);

        // Mensaje flash de éxito
        session()->flash('success', 'Usuario actualizado correctamente.');

        return redirect()->route('users.index');
    }

    /**
     * Elimina un empleado.
     */
    public function destroy(User $user)
    {
        $user->delete();
        
        // Mensaje flash de éxito
        session()->flash('success', 'Empleado eliminado correctamente.');

        return redirect()->route('users.index');
    }
}
