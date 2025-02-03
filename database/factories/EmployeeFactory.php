<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    /**
     * Define el estado por defecto del modelo Employee.
     */
    public function definition(): array
    {
        return [
            'dni' => $this->faker->unique()->randomNumber(8, true) . strtoupper(Str::random(1)), // DNI con una letra al final
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'hire_date' => $this->faker->date(),
            'type' => $this->faker->randomElement(['Operario', 'Administrador']),
        ];
    }
}

