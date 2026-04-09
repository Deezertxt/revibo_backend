<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UrlImagenReporte extends Model
{
    use HasFactory;
    
    protected $table = 'url_imagen_reporte';
    protected $primaryKey = 'id_url_imagen_reporte';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_url_imagen_reporte',
        'id_reporte',
        'url_imagen',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function reporte()
    {
        return $this->belongsTo(Reporte::class, 'id_reporte', 'id_reporte');
    }
}
