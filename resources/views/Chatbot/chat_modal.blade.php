<div class="p-4 col-sm-12 col-md-6 order-sm-1 order-md-2">

    <div class="modal fade @if ($open_chat) show @endif" id="staticBackdrop" tabindex="-1"
        aria-labelledby="staticBackdropLabel"
        @if ($open_chat) style="display: block;" aria-hidden="false" @else
        style="display: none;" aria-hidden="true" @endif>

        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        CHATBOT - GENERAR RESPUESTA
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="cerrarModal"></button>
                </div>
                <div class="modal-body">

                    <form class="row g-3 needs-validation" novalidate>
                        @csrf
                        <div class="col-md-12">
                            <h5 class="w-auto px-1 text-primary">Entidad Empleadora</h5>
                            <div class="row my-1">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="ruc" class="form-label">RUC:</label>
                                        <input type="text" class="form-control" id="ruc" name="ruc"
                                            minlength="11" maxlength="11" required
                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                            placeholder="Ingrese el RUC" wire:model.defer="ruc" />
                                    </div>
                                </div>
                                <div class="col-md-8 ">
                                    <div class="form-group">
                                        <fieldset disabled>
                                            <label for="empleador" class="form-label">Empleador:</label>
                                            <input type="text" class="form-control" id="empleador disabledTextInput"
                                                name="empleador" wire:model.defer="empleador" />
                                        </fieldset>
                                    </div>
                                </div>
                            </div>

                            <div class="row my-1">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="Direccion" class="form-label">Direccion:</label>
                                        <input type="text" class="form-control" id="Direccion" name="Direccion"
                                            placeholder="" wire:model.defer="direccion" />
                                    </div>
                                </div>

                            </div>
                            <div class="row my-1">
                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label for="correo" class="form-label">Correo:</label>
                                        <input type="text" class="form-control" id="correo" name="correo"
                                            placeholder="" wire:model.defer="correo" />
                                    </div>
                                </div>
                            </div>
                            <h5 class="w-auto px-1 text-primary">Detalle del Recurso</h5>
                            <div class="row my-1">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fecha_i" class="form-label">Fecha de presentacion:</label>
                                        <input type="Date" class="form-control" id="fecha_i" name="fecha_i"
                                            placeholder="" wire:model.defer="fecha_i" />
                                    </div>
                                </div>
                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label for="rc" class="form-label">Resolución de Cobranza</label>
                                        <input type="text" class="form-control" id="rc" name="rc"
                                            placeholder="" wire:model.defer="rc" />
                                    </div>
                                </div>
                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label for="monto" class="form-label">Monto</label>
                                        <input type="text" class="form-control" id="monto" name="rcmonto"
                                            placeholder="" wire:model.defer="monto" />
                                    </div>
                                </div>
                            </div>

                            <div class="row my-1">

                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label for="PeriodosE" class="form-label">Periodos Evaluados:</label>
                                        <div>

                                            @if ($pres_per && count($pres_per) > 0)
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th scope="col">RUC</th>
                                                                <th scope="col">tributo</th>
                                                                <th scope="col">Período</th>
                                                                <th scope="col">Calificacion</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($pres_per as $prestacion)
                                                                <tr>
                                                                    <td>{{ $prestacion->ruc_prestacion }}</td>
                                                                    <td>{{ $prestacion->tipo_seguro }}</td>
                                                                    <td>{{ $prestacion->per_prestacion }}</td>
                                                                    <td
                                                                        class="{{ $prestacion->est_periodo === 'MOROSO' ? 'text-danger' : 'text-success' }}">
                                                                        {{ $prestacion->est_periodo === 'MOROSO' ? 'Con condición de reembolso' : 'Sin condición de reembolso' }}
                                                                    </td>

                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @else
                                                <div class="alert alert-warning" role="alert">
                                                    No se encontraron datos para mostrar.
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                            </from>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                wire:click="cerrarModal">Cerrar</button>
                            <button type="button" class="btn btn-primary" wire:click="CrearMensaje">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
