<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class MaterialController extends Controller
{
   
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'unidadMedida' => 'required|string|max:50',
            'descripcion' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:100',
            'idCategoria' => 'required|integer|exists:categorias,idCategoria',
        ], [
            'unidadMedida.required' => 'La unidad de medida es obligatoria',
            'descripcion.required' => 'La descripción es obligatoria',
            'ubicacion.required' => 'La ubicación es obligatoria',
            'idCategoria.required' => 'El ID de categoría es obligatorio',
            'idCategoria.exists' => 'La categoría especificada no existe',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $categoria = Categoria::find($request->idCategoria);
            if (!$categoria) {
                return response()->json([
                    'success' => false,
                    'message' => 'La categoría especificada no existe'
                ], 404);
            }

            $material = Material::create([
                'unidadMedida' => $request->unidadMedida,
                'descripcion' => $request->descripcion,
                'ubicacion' => $request->ubicacion,
                'idCategoria' => $request->idCategoria,
            ]);

            $material->load('categoria');

            return response()->json([
                'success' => true,
                'message' => 'Material creado exitosamente',
                'data' => $material
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el material',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function index(): JsonResponse
    {
        try {
            $materiales = Material::with('categoria')->get();

            return response()->json([
                'success' => true,
                'data' => $materiales
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los materiales',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(int $codigo): JsonResponse
    {
        try {
            $material = Material::with('categoria')->find($codigo);

            if (!$material) {
                return response()->json([
                    'success' => false,
                    'message' => 'Material no encontrado'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $material
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener el material',
                'error' => $e->getMessage()
            ], 500);
        }
    }
} 