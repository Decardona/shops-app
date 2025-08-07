<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->words(2, true), // Ej: "Camiseta Azul"
            'descripcion' => $this->faker->sentence(8),
            'sku' => $this->faker->unique()->ean8(),
            'categoria_id' => \App\Models\Categoria::inRandomOrder()->first()?->id ?? 1,
            'marca_id' => \App\Models\Marca::inRandomOrder()->first()?->id ?? 1,
        ];
    }
}
