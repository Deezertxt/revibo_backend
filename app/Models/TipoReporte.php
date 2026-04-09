<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoReporte extends Model
{
    use HasFactory;
    
    protected $table = 'tipo_reporte';
    protected $primaryKey = 'id_tipo_reporte';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_tipo_reporte',
        'nombre_tipo_reporte',
        'descripcion_tipo_reporte',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function reportes()
    {
        return $this->hasMany(Reporte::class, 'id_tipo_reporte', 'id_tipo_reporte');
    }
}
