<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reconsideracion extends Model
{
    protected $table = 'apelacion_g';

    public $timestamps = false;

    protected $primaryKey = 'ID_APELACION';
    protected $keyType = 'int';
 
    protected $fillable = [
        'ID_APELACION',
        'NIT',
        'EXPEDIENTE',
        'EMPLEADOR',
        'RUC',
        'DOCUMENTO',
        'FECHA_INGRESO',
        'FECHA_RECEPCION',
        'TIPO_DOCUMENTO',
        'DOCUMENTO_INPUGNADO',
        'RESOLUCION_COBRANZA',
        'MONTO',
        'USUARIO_CREACION',
        'USUARIO_ACTUALIZACION',
        'FECHA_CREACION',
        'FECHA_ACTUALIZACION',
        'EST_APELACION',
        'EST_RESOLUTOR',
        'EST_RESOLVER',
        'EST_NOTIFICAR',
        'OBSERVACION',
        'TIPO_EXPEDIENTE',
     ];

    public static function ListarReconsideraciones()
    {
        return self::on('sico')
            ->where('TIPO_DOCUMENTO', '2')
            ->orderBy('id_apelacion', 'desc')
            ->paginate(10);
    }

    public static function ListarReconsideracionesFiltro($col)
    {

        if($col=='est_notificar'){
            return self::on('sico')
            ->where('EST_NOTIFICAR', '1')
            ->where('TIPO_DOCUMENTO', '2')
            ->orderBy('id_apelacion', 'desc')
            ->paginate(10);
        }elseif($col=='est_resolver'){
            return self::on('sico')
            ->whereNULL('EST_NOTIFICAR')
            ->where('EST_RESOLVER', '1')
            ->where('TIPO_DOCUMENTO', '2')
            ->orderBy('id_apelacion', 'desc')
            ->paginate(10);
        }elseif($col=='est_resolutor'){
            return self::on('sico')
            ->whereNULL('EST_NOTIFICAR')
            ->whereNULL('EST_RESOLVER')
            ->where('EST_RESOLUTOR', '1')
            ->where('TIPO_DOCUMENTO', '2')
            ->orderBy('id_apelacion', 'desc')
            ->paginate(10);
        }elseif($col=='est_apelacion'){
            return self::on('sico')
            ->whereNULL('est_apelacion')
            ->where('TIPO_DOCUMENTO', '2')
            ->orderBy('id_apelacion', 'desc')
            ->paginate(10);
        }
       
    }

    public static function BuscarReconsideracion($id)
    {
        return self::on('sico')
            ->where('ID_APELACION', $id)
            ->where('TIPO_DOCUMENTO', '2')
            ->first();
    }
    
}