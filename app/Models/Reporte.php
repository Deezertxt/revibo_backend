<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Clickbar\Magellan\Database\Eloquent\HasPostgisColumns;
use Clickbar\Magellan\Data\Geometries\Geometry;

class Reporte extends Model
{
    use HasFactory;
    //use HasPostgisColumns;
    
    protected $table = 'reporte';
    protected $primaryKey = 'id_reporte';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_reporte',
        'id_usuario',
        'tipo_reporte',
        'gravedad_reporte',
        'titulo',
        'descripcion',
        'geom',
        'activo',
        'fecha_inicio',
        'fecha_fin',
        'fecha_actualizacion',
    ];

    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime',
        'fecha_actualizacion' => 'datetime',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    /* public function tipoReporte()
    {
        return $this->belongsTo(TipoReporte::class, 'id_tipo_reporte', 'id_tipo_reporte');
    }

    public function gravedadReporte()
    {
        return $this->belongsTo(GravedadReporte::class, 'id_gravedad_reporte', 'id_gravedad_reporte');
    } */

    public function fotos()
    {
        return $this->hasMany(UrlImagenReporte::class, 'id_reporte', 'id_reporte');
    }
}
