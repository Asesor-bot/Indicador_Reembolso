<?php

namespace App\Livewire;

use Livewire\Component;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Models\Periodo;
use App\Models\Resolucion_morosidad;
use App\Models\Empleador;
use App\Models\Dependencias;

class IrComponent extends Component
{
    public $tributo='052100';
    public $ruc;
    public $mes;

    public $rperiodo;
    public $r_morosidad;
    public $r_empleador;
    public $dependencia;

   
    public $show_detalle= false;

    protected $rules = [
        'tributo' => 'required|numeric',
        'ruc' => 'required|numeric|digits:11',
        'mes' => 'required|numeric|digits:6',
    ];
    
    public function buscar()
    {
        $this->validate();
        
        $this->rperiodo = Periodo::on('sico')
        ->where('ruc_periodo', $this->ruc)
        ->where('cod_tributo', $this->tributo)
        ->where('mes_periodo', $this->mes)
        ->first();
  
           
        $this->r_morosidad= Resolucion_morosidad::on('sico')
        ->where('TRIBU_MOROSIDAD', $this->tributo)
        ->where('RUC_MOROSIDAD', $this->ruc)
        ->where('PERCON_MOROSIDAD', $this->mes)
        ->orderBy('NUM_MOROSIDAD', 'asc')
        ->get();

        $this->r_empleador=Empleador::on('sico')
        ->where('COD_EMPLEADOR', $this->ruc)
        ->first();

        $coddepen =  $this->r_empleador->coddepen_empleador;

        $this->dependencia=Dependencias::on('sico')
        ->where('cod_depen', $coddepen)
        ->first();

        $this->show_detalle=true;

      
    }

    public function render()
    {
        return view('livewire.irComponent')
        ->extends('layouts.app')
        ->section('content');
    }

   

    

}