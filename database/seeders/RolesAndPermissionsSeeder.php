<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Crear permisos
        $permissions = [
            'crear empleados',
            'editar empleados',
            'eliminar empleados',
            'ver empleados'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Crear roles y asignar permisos
        $adminRole = Role::firstOrCreate(['name' => 'Administrador']);
        $adminRole->syncPermissions(Permission::all());

        $operarioRole = Role::firstOrCreate(['name' => 'Operario']);
        $operarioRole->syncPermissions(['ver empleados']);

        echo "✅ Roles y permisos creados correctamente.\n";
    }
}
