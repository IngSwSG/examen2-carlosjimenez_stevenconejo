<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{
    protected $table = 'presupuestos';
    protected $primaryKey = 'codigoPresupuesto';
    public $timestamps = false;
    protected $fillable = [
        'nombrePresupuesto',
    ];

    public function materialUnidades()
    {
        return $this->hasMany(MaterialUnidad::class, 'codigoPresupuesto');
    }
} 