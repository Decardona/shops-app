<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tercero>
 */
class TerceroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tipo_documento' => $this->faker->randomElement(['CC', 'CE', 'NIT', 'TI']),
            'documento' => $this->faker->unique()->numerify('#########'),
            'escliente' => $this->faker->boolean(),
            'esproveedor' => $this->faker->boolean(),
            'nombre' => $this->faker->firstName(),
            'apellido' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'direccion' => $this->faker->address(),
        ];
    }
}
