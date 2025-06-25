<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialUnidad extends Model
{
    protected $table = 'material_unidades';
    protected $primaryKey = 'idMaterialUnidad';
    public $timestamps = false;
    protected $fillable = [
        'cantidad',
        'idUnidad',
        'codigoPresupuesto',
        'codigoMaterial',
    ];

    public function unidad()
    {
        return $this->belongsTo(Unidad::class, 'idUnidad', 'idUnidad');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'codigoMaterial', 'codigo');
    }

    public function presupuesto()
    {
        return $this->belongsTo(Presupuesto::class, 'codigoPresupuesto', 'codigoPresupuesto');
    }
} 