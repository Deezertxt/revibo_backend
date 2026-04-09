<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_usuario',
        'nombre_usuario',
        'correo_usuario',
        'contrasena_usuario',
        'id_rol',
        'id_institucion',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function institucion()
    {
        return $this->belongsTo(Institucion::class, 'id_institucion', 'id_institucion');
    }

    public function busqueda()
    {
        return $this->hasMany(Busqueda::class, 'id_usuario', 'id_usuario');
    }

    public function ruta()
    {
        return $this->hasMany(Ruta::class, 'id_usuario', 'id_usuario');
    }

    public function device_tokens()
    {
        return $this->hasMany(DeviceToken::class, 'id_usuario', 'id_usuario');
    }

    public function notificaciones()
    {
        return $this->belongsToMany(Notificacion::class, 'notificacion_usuario', 'id_usuario', 'id_notificacion');
    }

    public function reportes()
    {
        return $this->hasMany(Reporte::class, 'id_usuario', 'id_usuario');
    }


}
