<?php

namespace App\Livewire;

use Livewire\Component;
use OpenAI\Laravel\Facades\OpenAI;
use Carbon\Carbon;
use Livewire\Attributes\On; 

use App\Models\Reconsideracion;
use App\Models\Empleador;
use App\Models\Prestacion;
use App\Models\Prestacion_periodo; 
use App\Services\AssistantService;

use PhpOffice\PhpWord\TemplateProcessor;


class ChatComponent extends Component
{
    public $idr;
    public $dato;
    public $datos;
    public $open_chat=false;
    public $modalType='chat';

    public $mensajes = [];
    public $nuevoMensaje;
    public $MensajeUsuario;
    protected  $response;
    public  $mensaje;
    public  $mensajeshow;
    public $doc_name;

    public $ruc,$empleador,$direccion,$correo,$fecha_i, $doc_inpug,$rc,$monto;
    public $r_prestacion,$pres_per;

    protected $listeners = [
        'mensajeEnviado' => 'submit'
    ];

    public function cerrarModal()
    {
        $this->open_chat=false;
        $this->resetForm();
    }
    public function resetForm()
    {
        $this->reset([
            'ruc',
            'empleador',
            'direccion',
            'correo',
            'fecha_i',
            'doc_inpug',
            'rc',
            'monto'
        ]);
    }

    public function iniciarChat()
{
    if (!session()->has('thread_id')) {
        $thread = OpenAI::threads()->create([]);
        session(['thread_id' => $thread->id]); 
    }
}

    public function mount($dato=null)
    {
        if (is_null($dato)) {
        
        }else{
            $this->open_chat=true;

            $recon = Reconsideracion::on('sico')
            ->where('id_apelacion', $dato)
            ->first();

            $this->ruc = $recon ? $recon->ruc : '';
            $this->empleador =$recon ? $recon->empleador : '';

            $emple = Empleador::on('sico')
            ->where('cod_empleador', $this->ruc)
            ->first();

            $this->direccion =$emple ? $emple->dir_empleador : '';
            $this->fecha_i= $recon && $recon->fecha_ingreso
            ? Carbon::parse($recon->fecha_ingreso)->format('Y-m-d')
            : '';

            $this->rc =$recon ? $recon->documento_inpugnado : '';
            $this->monto =$recon ? $recon->monto : '';
            
            $this->r_prestacion = Prestacion::on('sico')
            ->where('resol_prestacion', $this->rc)
            ->get();

            $this->pres_per = Prestacion_periodo::pres_per($this->rc);

        }
    }

    public function CrearMensaje()
    {
        if($this->ruc){
            $periodos = '';
            
            foreach ($this->pres_per as $col) {
                $periodos .= "-tipo de seguro:$col->tipo_seguro, Periodo: $col->per_prestacion, Estado:$col->est_periodo";
            }

            $this->nuevoMensaje = "
Redacta una respuesta de reconsideración formal dirigida basada en los siguientes datos:  
Entidad empleadora: 
- RUC: {$this->ruc}  
- Nombre: {$this->empleador}   
- Dirección fiscal: {$this->direccion} 
- Correo electrónico: {$this->correo}  
Detalles del recurso:  
- Fecha de presentación: {$this->fecha_i}  
- Resolución de Cobranza: {$this->rc}  
- Monto reclamado: S/ {$this->monto}  
- Periodo evaluado: {$periodos} 
El documento debe estar redactado en un tono formal y profesional";

$this->mensajeshow = "Generar respuesta al contribuyente {$this->empleador} con resolucion de cobranza {$this->rc}";
$this->doc_name="{$this->ruc}_{$this->rc}";
$this->ruc=null;
$this->open_chat=false;
        }

        if ($this->MensajeUsuario) {
            $this->mensajeshow=$this->MensajeUsuario;
            $this->nuevoMensaje=$this->MensajeUsuario;
        }
        $this->mensajes[] = [
            "usuario" => "Yo",
            "mensaje" => $this->mensajeshow,
            "fecha" => Carbon::now()->format('Y-m-d H:i:s'),
            "recibido" => false,
        ];
        $this->MensajeUsuario = ''; 
        $this->dispatch('mensajeEnviado');
    }

private function ValidarMensaje($Vmensaje)
{
    $temas_permitidos = [
        'reconsideración', 'apelaciones', 'procesos administrativos','normativa', 'resoluciones', 'derecho administrativo',
        'tributación','pagos','deudas','evaluacion','fallos','fundado','infundado','fundado en parte'
    ];
    return collect($temas_permitidos)->contains(fn($topic) => str_contains($Vmensaje, $topic));
    
}

private function validateMessage($message)
{
    $allowed_topics = [
        'reconsideration', 'appeals', 'administrative processes', 'regulations', 'resolutions', 'administrative law',  
        'taxation', 'payments', 'debts', 'evaluation', 'rulings', 'founded', 'unfounded', 'partially founded'
    ];
    return collect($allowed_topics)->contains(fn($topic) => str_contains($message, $topic));
}


public function submit()
{
    $responseText = "";
    if (!$this->ValidarMensaje($this->nuevoMensaje)) {
        $this->response = "⚠️ Lo sentimos, solo se pueden realizar consultas relacionadas con reconsideraciones y normativas legales.";      
        $this->registerMessage("IA", $this->response, true);
        return;
    }

    $assistantId = 'asst_F4ka8zAXAMDfcmqomE57L7L8';
    if (!session()->has('thread_id')) {
        $thread = OpenAI::threads()->create([]);
        session(['thread_id' => $thread->id]); 
    }
    $threadId = session('thread_id'); 

    $message = OpenAI::threads()->messages()->create($threadId, [
        'role' => 'user','content' => $this->nuevoMensaje,
    ]);

    $run = OpenAI::threads()->runs()->create(
        threadId: $threadId, parameters: ['assistant_id' => $assistantId,]
    );

    $run = $this->waitForCompletion($threadId, $run->id);

    if ($run->status === 'completed') {
        $messages = OpenAI::threads()->messages()->list($threadId, [
            'order' => 'asc','after' => $message->id,'limit' => 10,
        ]);

        foreach ($messages->data as $message) {
            $responseText .= $message->content[0]->text->value . "\n\n";
        }

        $this->response = rtrim($responseText);
    } else {
        $this->response = "Ocurrió un error al procesar la respuesta del asistente.";
    }
    $this->registerMessage("IA", $this->response, true);
    $this->mensaje = '';
    return;
}

private function waitForCompletion($threadId, $runId)
{
    do {
        sleep(1);
        $run = OpenAI::threads()->runs()->retrieve(threadId: $threadId, runId: $runId);
    } while (in_array($run->status, ['queued', 'in_progress']));

    return $run;
}

private function registerMessage($user, $message, $received)
{
    $this->mensajes[] = [
        "usuario" => $user,
        "mensaje" => $message,
        "fecha" => Carbon::now()->format('Y-m-d H:i:s'),
        "recibido" => $received,
    ];
}

    public function render()
    {
        return view('livewire.chatComponent')
        ->extends('layouts.app')
        ->section('content');
    }
    public function enviarMensajetest()
    {
        $this->dispatch("mensajeEnviado");
        $this->dispatch("mensajeRecibido",$this->mensaje);
    }
    public function generateWord($mensaje)
    {

    $visto = '';
    $considerando = '';
    $seResuelve = '';

    if (($pos = strpos($mensaje, 'VISTO:')) !== false) {
        $posVisto = $pos;
        $vistoKey = 'VISTO:';
    } elseif (($pos = strpos($mensaje, 'VISTOS:')) !== false) {
        $posVisto = $pos;
        $vistoKey = 'VISTOS:';
    }
    $posConsiderando = strpos($mensaje, 'CONSIDERANDO:');
    $posSeResuelve = strpos($mensaje, 'SE RESUELVE:');

    if ($posVisto !== false && $posConsiderando !== false && $posSeResuelve !== false) {
        $visto = trim(substr($mensaje, $posVisto + strlen($vistoKey), $posConsiderando - $posVisto - strlen($vistoKey)));
        $considerando = trim(substr($mensaje, $posConsiderando + strlen('CONSIDERANDO:'), $posSeResuelve - $posConsiderando - strlen('CONSIDERANDO:')));
        $seResuelve = trim(substr($mensaje, $posSeResuelve + strlen('SE RESUELVE:')));
    }


        $templatePath = storage_path('app/templates/plantilla.docx');

        if (!file_exists($templatePath)) {
            session()->flash('error', 'Plantilla no encontrada');
            return;
        }

        $templateProcessor = new TemplateProcessor($templatePath);

        $templateProcessor->setValue('docVisto', $visto);
        $templateProcessor->setValue('docConsiderando', $considerando);
        $templateProcessor->setValue('docResuelve', $seResuelve);


        $fileName = "{$this->doc_name}.docx";

        $tempFile = tempnam(sys_get_temp_dir(), 'word');
        $templateProcessor->saveAs($tempFile);

        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }
    
}