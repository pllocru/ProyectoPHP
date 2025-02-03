<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        $employees = [
            [
                'dni' => '12345678A',
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'phone' => '123456789',
                'address' => 'Calle Falsa 123',
                'hire_date' => now(),
                'type' => 'Administrador',
                'role' => 'Administrador',
            ],
            [
                'dni' => '87654321B',
                'name' => 'Operario User',
                'email' => 'operario@example.com',
                'phone' => '987654321',
                'address' => 'Avenida Real 456',
                'hire_date' => now(),
                'type' => 'Operario',
                'role' => 'Operario',
            ]
        ];

        foreach ($employees as $data) {
            // Crear empleado
            $employee = Employee::firstOrCreate([
                'dni' => $data['dni']
            ], [
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'hire_date' => $data['hire_date'],
                'type' => $data['type'],
            ]);

            // Crear usuario asociado
            $user = User::firstOrCreate([
                'email' => $data['email']
            ], [
                'name' => $data['name'],
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ]);

            // Asignar el rol al usuario
            $user->assignRole($data['role']);
        }

        echo "✅ Empleados creados correctamente con usuarios y roles asignados.\n";
    }
}
