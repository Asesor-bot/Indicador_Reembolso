<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Prestacion;
use App\Models\Periodo;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prestacion_periodo extends Model
{
    use HasFactory;

    public static function pres_per($resolPrestacion)
    {
        return DB::table('prestacion')
            ->select('pr.*', 'p.est_periodo', 'p.fecact_periodo')
            ->distinct()
            ->fromSub(function ($query) use ($resolPrestacion) {
                $query->select('ruc_prestacion',
                               DB::raw("
                                    CASE 
                                        WHEN seg_prestacion = 'SEGURO REGULAR' THEN '052100' 
                                        WHEN seg_prestacion = 'SEGURO AGRARIO' THEN '052202' 
                                        WHEN seg_prestacion = 'SEGURO PENSIONISTA' THEN '052402' 
                                        ELSE 'OTRO SEGURO'
                                    END AS tipo_seguro"), 
                               'per_prestacion')
                      ->from('prestacion')
                      ->where('resol_prestacion', $resolPrestacion);
            }, 'pr')
            ->leftJoin('periodo as p', function ($join) {
                $join->on('p.ruc_periodo', '=', 'pr.ruc_prestacion')
                     ->on('p.mes_periodo', '=', 'pr.per_prestacion')
                     ->on('p.cod_tributo', '=', 'pr.tipo_seguro');
            })
            ->get();
    }
}
