<?php

use App\Models\Categoria;
use App\Models\Material;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('dadoUnMaterialQueNoExiste_insertarMaterial_funcionaCorrectamente', function () {
    $categoria = Categoria::factory()->create([
        'nombre' => 'Construcción'
    ]);

    $materialData = [
        'unidadMedida' => 'kg',
        'descripcion' => 'Cemento Portland',
        'ubicacion' => 'Almacén A',
        'idCategoria' => $categoria->idCategoria
    ];

    $response = $this->postJson('/api/materiales', $materialData);

    $response->assertStatus(201)
        ->assertJson([
            'success' => true,
            'message' => 'Material creado exitosamente'
        ])
        ->assertJsonStructure([
            'success',
            'message',
            'data' => [
                'codigo',
                'unidadMedida',
                'descripcion',
                'ubicacion',
                'idCategoria',
                'categoria' => [
                    'idCategoria',
                    'nombre'
                ]
            ]
        ]);

    $this->assertDatabaseHas('materiales', [
        'unidadMedida' => 'kg',
        'descripcion' => 'Cemento Portland',
        'ubicacion' => 'Almacén A',
        'idCategoria' => $categoria->idCategoria
    ]);

    $material = Material::where('descripcion', 'Cemento Portland')->first();
    expect($material)->not->toBeNull();
    expect($material->categoria->nombre)->toBe('Construcción');
});