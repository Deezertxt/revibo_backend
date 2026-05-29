<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Clickbar\Magellan\Database\Eloquent\HasPostgisColumns;
use Clickbar\Magellan\Data\Geometries\Geometry;

class Ruta extends Model
{
    use HasFactory;
    //use HasPostgisColumns;
    
    protected $table = 'ruta';
    protected $primaryKey = 'id_ruta';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_ruta',
        'id_usuario',
        'nombre',
        'ruta',
        'distancia',
        'tiempo',
        'origen_nombre',
        'destino_nombre',
        'origen_lat',
        'origen_lng',
        'destino_lat',
        'destino_lng',
        'activa',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}
