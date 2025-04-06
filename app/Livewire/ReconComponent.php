<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Empleador;
use App\Models\Reconsideracion;
use App\Models\Resolutor;
use Illuminate\Support\Facades\DB;

use Livewire\WithPagination;
use Livewire\Redirector;
use Carbon\Carbon;

class ReconComponent extends Component
{
    use WithPagination;

    public $filtrorecon='1';
    
    public $open=false;
    
    public $ruc,$razon_social,
        $nit,$expediente,$doc_inp,
        $f_recepcion,$f_ingreso,$tipo_doc,
        $rc,$monto,
        $observacion;

    public $resolutor,$fecha_asignacion,$fecha_asignacion_view;

    public $data;

    public $pages;
    public $item_i;
    public $item_f;

    public $modalType = '';
    public $idrc = '';

    protected $rules = [
        'ruc' => 'required|string|min:11|max:11',
        'razon_social' => 'nullable|string|max:255',
        'nit' => 'nullable|string|max:50',
        'expediente' => 'nullable|string|max:50',
        'doc_inp' => 'nullable|string|max:50',
        'f_recepcion' => 'nullable|date',
        'f_ingreso' => 'nullable|date',
        'tipo_doc' => 'nullable|string|max:50',
        'rc' => 'nullable|string|max:50',
        'monto' => 'nullable|numeric',
        'observacion' => 'nullable|string|max:500',
    ];
    
    

    protected $col;
    
    public function abrirChatBot($dato)
    {
        return redirect()->route('chat.id', ['dato' => $dato]);
    }

    public function resetForm()
    {
        $this->reset([
            'ruc',
            'razon_social',
            'nit',
            'expediente',
            'doc_inp',
            'f_recepcion',
            'f_ingreso',
            'tipo_doc',
            'rc',
            'monto',
            'observacion',
            'idrc',
            'resolutor',
            'fecha_asignacion',
            'fecha_asignacion_view'
        ]);
    }
    
    public function fresolutor_m($idrc,$est_r){
        $this->idrc = $idrc;
        //$this->fecha_asignacion_view = now()->format('Y-m-d H:i:s');
        if($est_r){
        $this->resolutor = Resolutor::BuscarResolutor($idrc);
        //dd($this->resolutor->fecha_asignado);
        $this->fecha_asignacion =$this->resolutor->fecha_asignado;
        $this->resolutor = $this->resolutor->resolutor;
        //dd($this->resolutor);
        }else{
            $this->resolutor='';
            $this->fecha_asignacion = Carbon::parse($this->fecha_asignacion, 'America/Lima')->format('Y-m-d H:i:s');
        }
     }

     public function reset_fresolutor($idrc)
     {
        //dd($idrc);
        $this->reset([
            'resolutor',
            'fecha_asignacion'
        ]);
        $this->fresolutor_m($idrc,'');
     }  

    public function abriModal($type,$idrc)
    {
        
        if($type=='resolutor'){
            $est_r = Reconsideracion::where('ID_APELACION', $idrc)->value('est_resolutor');
            $this->fresolutor_m($idrc,$est_r);
        }else if($type=='nueva_reconsideracion'){
            $fecha = Carbon::parse($this->fecha_asignacion);
            $codigo = $fecha->format('ym')    // "25" + "04"  → "2504"
            . 'RC'                    // literal       → "2504RC"
            . $fecha->format('dHis');
        //dd($codigo);
        $this->expediente = $codigo;
        }else if($type=='ver_reconsideracion'){
            $this->fRecon($idrc);
        }else if($type=='editar_reconsideracion'){
            $this->fRecon($idrc);
        }
        $this->idrc = $idrc;
        $this->open=true;
        $this->modalType = $type;
    }
     

    public function cerrarModal()
    {
        $this->open=false;
        $this->modalType = '';
        $this->resetForm();
    }

    public $reconEdit;
    public $id;

    public function fRecon($id)
    {
       $reconEdit = Reconsideracion::BuscarReconsideracion($id);
       $this->ruc = $reconEdit->ruc;
       $this->razon_social = $reconEdit->empleador;
       $this->nit = $reconEdit->nit;
       $this->expediente = $reconEdit->expediente;
       $this->doc_inp =  $reconEdit->documento;

       $this->f_recepcion = Carbon::parse($reconEdit->fecha_recepcion)->format('Y-m-d');
       $this->f_ingreso = date('Y-m-d', strtotime($reconEdit->fecha_ingreso));
       $this->rc=$reconEdit->resolucion_cobranza;
       $this->monto = $reconEdit->monto;

    }

    public function updatedRuc($value)
    {
        if (strlen($value) === 11 && is_numeric($value)) {
            $raz = Empleador::BuscarEmpleador($value);

            $this->razon_social = $raz ? $raz->raz_empleador : 'No encontrado';
            
        } else {
            $this->razon_social = '';
        }
    }
    public function saveRecon(){
        $validatedData = $this->validate();
        if ($validatedData) {
        $recon = new Reconsideracion();
        $recon->ruc = $this->ruc;
        $recon->empleador = $this->razon_social;
        $recon->nit = $this->nit;
        $recon->expediente = $this->expediente;
        $recon->documento = $this->doc_inp;
        $recon->fecha_recepcion = $this->f_recepcion;
        $recon->fecha_ingreso = $this->f_ingreso;
        $recon->tipo_documento = '2';
        $recon->est_apelacion = '1';
        $recon->resolucion_cobranza = $this->rc;
        $recon->monto = $this->monto;
        $recon->observacion = $this->observacion;
        $recon->save();

        session()->flash('message', 'Registro guardado exitosamente.');
        }
        $this->resetForm();
        $this->cerrarModal();
    }

    public function asignarResolutor(){
        
        $resolutor = new Resolutor();
        $resolutor->COD_APELACION = $this->idrc;
        $resolutor->RESOLUTOR = $this->resolutor;  
        $fecha_asignacion = Carbon::parse($this->fecha_asignacion)->format('Y-m-d H:i:s');
        $resolutor->FECHA_ASIGNADO = $fecha_asignacion;
        $resolutor->save();

        Reconsideracion::where('ID_APELACION', $this->idrc)->update(['EST_RESOLUTOR' => '1']);

        $this->resetForm();
        $this->cerrarModal();
    }
    
    public function render()
    { 
        if($this->filtrorecon=='1'){
            $recons = Reconsideracion:: ListarReconsideraciones();
        }else{
        $colMap = [
            2 => 'est_apelacion',
            3 => 'est_resolutor',
            4 => 'est_resolver',
            5 => 'est_notificar',
        ];
    
        if (isset($colMap[$this->filtrorecon])) {
            $col = $colMap[$this->filtrorecon]; 
        } else {
            $col = null; 
        }
        
            $recons =Reconsideracion:: ListarReconsideracionesFiltro($col);
        
    }
        return view('livewire.reconComponent', ['recons' => $recons])
        ->extends('layouts.app')
        ->section('content');
    }
}