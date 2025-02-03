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
        Employee::factory(10)->create();

        echo "✅ Empleados creados correctamente con usuarios y roles asignados.\n";
    }
}
