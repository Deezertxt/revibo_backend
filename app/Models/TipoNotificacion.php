<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoNotificacion extends Model
{
    use HasFactory;

    protected $table = 'tipo_notificacion';
    protected $primaryKey = 'id_tipo_notificacion';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_tipo_notificacion',
        'nombre_tipo_notificacion',
        'descripcion_tipo_notificacion',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function notificaciones()
    {
        return $this->hasMany(Notificacion::class, 'id_tipo_notificacion', 'id_tipo_notificacion');
    }
}
