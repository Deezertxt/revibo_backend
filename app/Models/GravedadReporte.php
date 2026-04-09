<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GravedadReporte extends Model
{
    use HasFactory;

    protected $table = 'gravedad_reporte';
    protected $primaryKey = 'id_gravedad_reporte';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_gravedad_reporte',
        'nombre_gravedad_reporte',
        'descripcion_gravedad_reporte',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function reportes()
    {
        return $this->hasMany(Reporte::class, 'id_gravedad_reporte', 'id_gravedad_reporte');
    }
}
