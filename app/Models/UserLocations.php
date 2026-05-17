<?php

namespace App\Models;

use Clickbar\Magellan\Data\Geometries\Geometry;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLocations extends Model
{
    use HasFactory;
    protected $table = 'UserLocations';
    protected $primaryKey = 'id_user_location';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_user_location',
        'id_usuario',
        'geom' => Geometry::class,
        'recorded_at'
    ];

    protected $casts = [
        'recorded_at' => 'datetime'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}
