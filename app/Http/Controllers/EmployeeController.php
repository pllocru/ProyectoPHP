<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{ 
    /**
     * Muestra una lista de empleados.
     */
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    /**
     * Muestra el formulario para crear un nuevo empleado.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Almacena un nuevo empleado en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'dni' => 'required|unique:employees,dni',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email|unique:users,email',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'hire_date' => 'required|date',
            'type' => 'required|in:Operario,Administrador',
        ]);

        // Crear el empleado
        $employee = Employee::create($request->all());

        // Crear usuario asociado
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password'), // Contraseña predeterminada
        ]);

        // Asignar rol al usuario
        $role = Role::where('name', $request->type)->first();
        if ($role) {
            $user->assignRole($role);
        }

        return redirect()->route('employees.index')->with('success', 'Empleado creado correctamente.');
    }

    /**
     * Muestra los detalles de un empleado.
     */
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    /**
     * Muestra el formulario de edición de un empleado.
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    /**
     * Actualiza la información de un empleado.
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'dni' => 'required|unique:employees,dni,' . $employee->id,
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id . '|unique:users,email,' . $employee->id,
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'hire_date' => 'required|date',
            'type' => 'required|in:Operario,Administrador',
        ]);

        $employee->update($request->all());

        // Actualizar el usuario asociado
        $user = User::where('email', $employee->email)->first();
        if ($user) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            // Actualizar el rol
            $user->syncRoles([$request->type]);
        }

        return redirect()->route('employees.index')->with('success', 'Empleado actualizado correctamente.');
    }

    /**
     * Elimina un empleado y su usuario asociado.
     */
    public function destroy(Employee $employee)
    {
        // Eliminar el usuario asociado
        $user = User::where('email', $employee->email)->first();
        if ($user) {
            $user->delete();
        }

        // Eliminar el empleado
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Empleado eliminado correctamente.');
    }
}
