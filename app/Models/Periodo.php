<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    protected $table = 'periodo';
    public $timestamps = false;

    protected $primaryKey = null;
    public $incrementing = false;
   

    protected $fillable = [
        'ruc_periodo',
        'mes_periodo',
        'cod_periodo',
        'est_periodo',
        'cod_periodo',
        'fecact_periodo',
    ];


}
