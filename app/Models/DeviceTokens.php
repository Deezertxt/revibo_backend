<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeviceTokens extends Model
{
    use hasFactory;

    protected $table = 'device_tokens';
    protected $primaryKey = 'id_device_token';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'id_device_token',
        'id_usuario',
        'token',
        'platform',
        'is_active',
        'notification_enabled',
        'last_seen_at',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'is_active' => 'boolean',
        'last_seen_at' => 'datetime'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

}
