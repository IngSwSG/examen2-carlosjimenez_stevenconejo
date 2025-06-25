<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requisicion extends Model
{
    protected $table = 'requisicions';
    protected $primaryKey = 'idRequisicion';
    public $timestamps = false;
    protected $fillable = [
        'fecha',
        'estado',
        'idUsuario',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'idUsuario');
    }

    public function items()
    {
        return $this->hasMany(ItemRequisicion::class, 'idRequisicion');
    }
} 