<?php

namespace Database\Factories;

use App\Models\Material;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaterialFactory extends Factory
{

    public function definition(): array
    {
        return [
            'unidadMedida' => $this->faker->randomElement(['kg', 'litros', 'unidades', 'metros', 'cm']),
            'descripcion' => $this->faker->sentence(3),
            'ubicacion' => $this->faker->randomElement(['Almacén A', 'Almacén B', 'Almacén C', 'Depósito Central']),
            'idCategoria' => Categoria::factory(),
        ];
    }
} 