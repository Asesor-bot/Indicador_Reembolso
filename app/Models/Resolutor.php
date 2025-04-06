<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resolutor extends Model
{
    use HasFactory;

    protected $table = 'resolutor_g';

    protected $primaryKey = 'COD_RESOLUTOR';

    public $timestamps = false;

    protected $fillable = [
        'COD_APELACION',
        'RESOLUTOR',
        'FECHA_ASIGNADO',
        'FECHA_EMISION',
        'FECHA_NOTIFICACION',
        'RESOLUCION_APELACION',
        'FALLO',
        'MONTO_RESUELTO',
        'ESTADO',
        'USUARIO_CREACION',
        'USUARIO_ACTUALIZACION',
        'FECHA_CREACION',
        'FECHA_ACTUALIZACION'
    ];

    public static function BuscarResolutor($id)
    {
        return self::on('sico')
            ->where('COD_APELACION', $id)
            ->orderByDesc('COD_RESOLUTOR')
            ->first();
    }

    
    
}