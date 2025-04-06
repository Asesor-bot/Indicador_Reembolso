<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IR_Controller;
use App\Http\Livewire\Counter;
use Livewire\Component;
use OpenAI\Laravel\Facades\OpenAI;
use App\Http\Controllers\AssistantController;
use Livewire\Livewire;

use App\Livewire\ChatComponent;

Route::get('/Indicador_Reembolso', function () {
    return view('IR/IR');
});

Route::get('/datos', function () {
    return DB::select('select * from a_agrupar');
});
Route::get('/index', function () {
    return view('welcome');
});


Route::get('/ChatBot', function () {
    return view('IR/chat');
   /* 
    $returnValue = OpenAI::chat()->create([
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            ['role' => 'user', 'content' => 'si o no!'],
        ],
    ]);
    
    echo $returnValue->choices[0]->message->content;+
    */
});

//Route::get('/Reconsideracion', function () {    return view('Recon/Recon');});
Route::get('/Reconsideracion', App\Livewire\ReconComponent::class);

/*
Route::get('/ChatBot/{dato}', function ($dato) {
    return view('IR/chat', compact('dato'));
})->name('chat.bot');
*/
Route::get("ChatBot/{dato}", ChatComponent::class)->name('chatbot');



Route::post('/assistant/generate-response', [AssistantController::class, 'generateAssistantsResponse']);

Route::post('/generar-word-template', [DocumentController::class, 'generateFromTemplate']);

Route::get('/Dashboard', App\Livewire\Dashboard::class);