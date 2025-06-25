<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialUnidad extends Model
{
    protected $table = 'material_unidads';
    protected $primaryKey = 'idMaterialUnidad';
    public $timestamps = false;
    protected $fillable = [
        'cantidad',
        'idUnidad',
    ];

    public function unidad()
    {
        return $this->belongsTo(Unidad::class, 'idUnidad');
    }

    public function materiales()
    {
        return $this->belongsToMany(Material::class, 'material_unidads', 'idMaterialUnidad', 'codigo');
    }

    public function presupuesto()
    {
        return $this->belongsTo(Presupuesto::class, 'codigoPresupuesto');
    }
} 