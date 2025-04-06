<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestacion extends Model
{
    protected $table = 'prestacion';

    public $timestamps = false;

    protected $primaryKey = 'cod_prestacion';
    protected $keyType = 'string';
    public $incrementing = false;
 
    protected $fillable = [
         'cod_prestacion',
         'resol_prestacion',
         'ruc_prestacion',
         'seg_prestacion',
         'men_prestacion',
         'per_prestacion',
         'red_prestacion'
     ];
}
