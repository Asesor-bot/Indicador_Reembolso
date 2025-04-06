<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resolucion_morosidad extends Model
{
    protected $table = 'resolucion_morosidad';
    protected $primaryKey = null;
    public $incrementing = false;

    public $timestamps = false;
    
    
    
    protected $fillable = [
        'TRIBU_MOROSIDAD',
        'NUM_MOROSIDAD',
        'MESEVA_MOROSIDAD',
        'FORMU_MOROSIDAD',
        'FECDEC_MOROSIDAD',
        'FECPAG_MOROSIDAD',
        'FEC_VEN_SUNAT',
        'FEC_ESSA_DEC',
        'ESTADO_MOR',
        'MONDEC_MOROSIDAD',
        'INTERES_GENE',
        'MONPAG_MOROSIDAD',
        'DIFER_MOROSIDAD',
        'INTERES_ACT',
        'PAGO_EXT',
        'FEC_MAX_EXT',
        'MONVAL_MOROSIDAD',
        'NROVAL_MOROSIDAD',
        'FECVAL_MOROSIDAD',
        'TRAB_DEC',
        'FECHA_PROC'
    ];

    
}
