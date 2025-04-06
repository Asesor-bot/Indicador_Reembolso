<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleador extends Model
{
    protected $table = 'empleador';

    public $timestamps = false;

    protected $primaryKey = 'cod_empleador';
    protected $keyType = 'string';
    public $incrementing = false;
 
    protected $fillable = [
         'cod_empleador',
         'raz_empleador',
         'dir_empleador',
         'coddepen_empleador'
     ];

     
    public static function BuscarEmpleador($value)
    {
        return self::on('sico')
            ->where('COD_EMPLEADOR', $value)
            ->first();
    }
}