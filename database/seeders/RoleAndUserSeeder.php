<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1️⃣ Crear los roles si no existen
        $adminRole = Role::firstOrCreate(['name' => 'Administrador']);
        $operarioRole = Role::firstOrCreate(['name' => 'Operario']);

        // 2️⃣ Crear permisos de ejemplo (opcional)
        $permissions = [
            'ver-dashboard',
            'gestionar-usuarios',
            'gestionar-tareas'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 3️⃣ Asignar permisos al rol Administrador
        $adminRole->syncPermissions($permissions);

        // 4️⃣ Crear usuario Administrador y asignarle el rol
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('admin123')
            ]
        );
        $admin->assignRole($adminRole);

        // 5️⃣ Crear usuario Operario y asignarle el rol
        $operario = User::firstOrCreate(
            ['email' => 'operario@example.com'],
            [
                'name' => 'Operario User',
                'password' => Hash::make('operario123')
            ]
        );
        $operario->assignRole($operarioRole);
    }
}
