<div>
    <h1 class="h3 mb-2 text-gray-800"
        style="text-align:center;margin-top:10px;font-weight: bold; color: #5a5c69 !important;font-size: 1.75rem;">CLAIMS
        SYSTEM - ChatBot</h1>
    <div class="container-fluid h-100" id="chatbot">
        <div class="row justify-content-center h-100">
            <div class="col-md-8 col-xl-6 chat">
                <div class="card">
                    <div class="card-header msg_head">
                        <div class="d-flex bd-highlight">
                            <div class="img_cont">
                                <i class="bi bi-wechat"></i>
                            </div>
                            <div class="user_info">
                                <span>Chatbot Asesor</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body msg_card_body"
                        style="height: 400px; overflow-y: scroll; border: 1px solid #ccc; padding: 10px; display: flex; flex-direction: column-reverse;">
                        <ul style="list-style: none; margin: 0; padding: 0; width: 100%;">

                            <li>
                                <div class="d-flex justify-content-start mb-4">
                                    <div class="msg_cotainer">
                                        <strong><i class="bi bi-robot"></i></strong><br>
                                        ¡Hola! 👋 Soy tu Asesor Virtual de Reclamos.

                                    </div>
                                </div>
                            </li>


                            @if (!empty($mensajes) && $mensajes !== null)
                                @foreach ($mensajes as $mensaje)
                                    <li>
                                        <div>
                                            @if ($mensaje['recibido'])
                                                <div class="d-flex justify-content-start mb-4">
                                                    <div class="msg_cotainer">
                                                        <strong><i class="bi bi-robot"></i></strong><br>
                                                        {{ $mensaje['mensaje'] }}
                                                        <br>
                                                        <button
                                                            wire:click="generateWord({{ json_encode($mensaje['mensaje']) }})"
                                                            class="btn btn-icon" title="Descargar Word">
                                                            <i class="bi bi-file-earmark-word"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="d-flex justify-content-end mb-4">
                                                    <div class="msg_cotainer_send">
                                                        <div class="d-flex justify-content-end">
                                                            <strong><i class="bi bi-person"></i></strong><br>
                                                        </div>
                                                        {{ $mensaje['mensaje'] }}
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="card-footer">
                        <div class="input-group styled-group">
                            <textarea name="" class="form-control type_msg" placeholder="Type your message..." rows="3"
                                wire:model="MensajeUsuario" wire:keydown.enter="submit"></textarea>
                            <button type="button" class="btn btn-primary" id="send-button" title="Enviar"
                                wire:click="CrearMensaje">
                                <i class="bi bi-send-fill"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('Chatbot.chat_modal')

    @if ($open_chat)
        <div class="modal-backdrop fade show"></div>
    @endif
</div>
