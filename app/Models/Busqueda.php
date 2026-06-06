<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Clickbar\Magellan\Database\Eloquent\HasPostgisColumns;

class Busqueda extends Model
{
    use HasFactory;
    use HasPostgisColumns;
    
    protected $table = 'busqueda';
    protected $primaryKey = 'id_busqueda';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_busqueda',
        'id_usuario',
        'termino',
        'geom' => [
            'type' => 'geometry',
            'srid' => 4326,
        ],
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
