<div class="modal fade @if ($open) show @endif" tabindex="-1" id="staticBackdrop"
    data-bs-backdrop="static"
    @if ($open) style="display: block;" aria-hidden="false" @else style="display: none;" aria-hidden="true" @endif>

    @if ($this->modalType == 'nueva_reconsideracion')
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        REGISTRAR RECONSIDERACION
                    </h5>
                    <button type="button" class="btn-close" aria-label="Close" wire:click="cerrarModal"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3 needs-validation" novalidate>
                        @csrf
                        <div class="col-md-12">
                            <div class="row my-1">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="ruc" class="form-label">RUC:</label>
                                        <input type="text" class="form-control" id="ruc" name="ruc"
                                            minlength="11" maxlength="11" required
                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                            placeholder="20131257750" wire:model.lazy="ruc" />
                                        @error('ruc')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-7 ">
                                    <div class="form-group">
                                        <fieldset disabled>
                                            <label for="razon_social" class="form-label">Empleador:</label>
                                            <input type="text" class="form-control disabledTextInput"
                                                id="razon_social" name="razon_social" wire:model.defer="razon_social" />
                                        </fieldset>
                                    </div>
                                </div>
                            </div>

                            <div class="row my-1">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="nit" class="form-label">NIT:</label>
                                        <input type="text" class="form-control" id="nit" name="nit"
                                            placeholder="" wire:model.defer="nit" />
                                    </div>
                                </div>
                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <fieldset disabled>
                                            <label for="expediente" class="form-label">Expediente:</label>
                                            <input type="text" class="form-control" id="expediente" name="expediente"
                                                readonly placeholder="" wire:model.defer="expediente" />
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="doc_inp" class="form-label">Docummento Inpugnado:</label>
                                        <input type="text" class="form-control" id="doc_inp" name="doc_inp"
                                            placeholder="" wire:model.defer="doc_inp" />
                                    </div>
                                </div>
                            </div>

                            <div class="row my-1">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="f_recepcion" class="form-label">Fecha Recepcion de la nota a
                                            GCCYC:</label>
                                        <input type="Date" class="form-control" id="f_recepcion" name="f_recepcion"
                                            placeholder="" wire:model.defer="f_recepcion" />
                                    </div>
                                </div>
                                <div class="col-md-7 ">
                                    <div class="form-group">
                                        <label for="f_ingreso" class="form-label">Fecha Ingreso Institucion:</label>
                                        <input type="date" class="form-control" id="f_ingreso" name="f_ingreso"
                                            placeholder="" wire:model.defer="f_ingreso" />
                                    </div>
                                </div>
                            </div>

                            <div class="row my-1">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="rc" class="form-label">Resolucion Cobranza:</label>
                                        <input type="text" class="form-control" id="rc" name="rc"
                                            placeholder="" wire:model.defer="rc" />
                                    </div>
                                </div>
                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label for="monto" class="form-label">Monto:</label>
                                        <input type="text" class="form-control" id="monto" name="monto"
                                            placeholder="" wire:model.defer="monto" />
                                    </div>
                                </div>
                                <div class="col-md-4">

                                </div>
                            </div>

                            <div class="row my-1">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="observacion" class="form-label">Observacion:</label>
                                        <input type="text" class="form-control" id="observacion"
                                            name="observacion" placeholder="" wire:model.defer="observacion" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        </from>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        wire:click="cerrarModal">Cerrar</button>
                    <button type="button" class="btn btn-primary" wire:click="saveRecon">Registar</button>
                </div>
            </div>
        </div>
    @endif

    @if ($this->modalType == 'resolutor')
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        ASIGNAR RESOLUTOR A LA RECONSIDERACION
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="cerrarModal"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3 needs-validation" novalidate>
                        @csrf
                        <div class="col-md-12">
                            <div class="row my-1">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="edit_ape_resolutor" class="form-label"
                                            style="color:black;">RESOLUTOR
                                            ASIGNADO:</label>
                                        <select name='edit_ape_resolutor' id="edit_ape_resolutor"
                                            class="form-control" style="color:black;" wire:model="resolutor">
                                            <option value="resolutor_vacio">SELECCIONE:</option>
                                            <option value="70008842">CARLO RODRIGO POSTIGO QUIROZ</option>
                                            <option value="09645683">MARIA ISABEL ARÃ‰STEGUI MONDALGO</option>
                                            <option value="45006608">NINA DEL ROSARIO SILVA CADENAS</option>
                                            <option value="08156112">VERUSCHKA VALLE CUBA</option>
                                            <option value="06269858">YADYRA ARLETTY NARVAJO RAVELLO</option>
                                            <option value="GVIVASQ">GIOVANNI VIVAS QUISPE</option>
                                            <option value="IGOR">IGOR CB</option>
                                            <option value="25708905">CESAR JOSE RICARDO TORRES CARPIO</option>
                                            <option value="06580322">CESAR WENCESLAO ARIAS VENEGAS</option>
                                            <option value="42939554">ELVA LUCY CONDOR CALLUPE</option>
                                            <option value="10062095">PATRICIA ISABEL FIGUEROA VASQUEZ</option>
                                            <option value="10771054">VICTOR MORENO GALLEGOS</option>
                                            <option value="10356127">WILLY MARTIN ARBAIZA TORREALVA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5 ">
                                    <div class="form-group">
                                        <fieldset disabled>
                                            <label for="fecasignacion" style="color:black" class="form-label">FECHA
                                                ASIGNACION:</label>
                                            <input type="text" class="form-control w-100 " readonly
                                                style="color:black" wire:model.defer="fecha_asignacion">
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </from>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        wire:click="cerrarModal">Cerrar</button>
                    <button type="button" class="btn btn-primary"
                        wire:click="reset_fresolutor({{ $this->idrc }})">reset</button>
                    <button type="button" class="btn btn-primary" wire:click="asignarResolutor">Asignar</button>
                </div>
            </div>
        </div>
    @endif

    @if ($this->modalType == 'editar_reconsideracion')
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        EDITAR RECONSIDERACION
                    </h5>
                    <button type="button" class="btn-close" aria-label="Close" wire:click="cerrarModal"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3 needs-validation" novalidate>
                        @csrf
                        <div class="col-md-12">
                            <div class="row my-1">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="ruc" class="form-label">RUC:</label>
                                        <input type="text" class="form-control" id="ruc" name="ruc"
                                            minlength="11" maxlength="11" required
                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                            placeholder="20131257750" wire:model.lazy="ruc" />
                                        @error('ruc')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-7 ">
                                    <div class="form-group">
                                        <fieldset disabled>
                                            <label for="razon_social" class="form-label">Empleador:</label>
                                            <input type="text" class="form-control disabledTextInput"
                                                id="razon_social" name="razon_social"
                                                wire:model.defer="razon_social" />
                                        </fieldset>
                                    </div>
                                </div>
                            </div>

                            <div class="row my-1">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="nit" class="form-label">NIT:</label>
                                        <input type="text" class="form-control" id="nit" name="nit"
                                            placeholder="" wire:model.defer="nit" />
                                    </div>
                                </div>
                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label for="expediente" class="form-label">Expediente:</label>
                                        <input type="text" class="form-control" id="expediente" name="expediente"
                                            placeholder="" wire:model.defer="expediente" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="doc_inp" class="form-label">Docummento Inpugnado:</label>
                                        <input type="text" class="form-control" id="doc_inp" name="doc_inp"
                                            placeholder="" wire:model.defer="doc_inp" />
                                    </div>
                                </div>
                            </div>

                            <div class="row my-1">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="f_recepcion" class="form-label">Fecha Recepcion de la nota a
                                            GCCYC:</label>
                                        <input type="Date" class="form-control" id="f_recepcion"
                                            name="f_recepcion" placeholder="" wire:model.defer="f_recepcion" />
                                    </div>
                                </div>
                                <div class="col-md-7 ">
                                    <div class="form-group">
                                        <label for="f_ingreso" class="form-label">Fecha Ingreso Institucion:</label>
                                        <input type="date" class="form-control" id="f_ingreso" name="f_ingreso"
                                            placeholder="" wire:model.defer="f_ingreso" />
                                    </div>
                                </div>
                            </div>

                            <div class="row my-1">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="rc" class="form-label">Resolucion Cobranza:</label>
                                        <input type="text" class="form-control" id="rc" name="rc"
                                            placeholder="" wire:model.defer="rc" />
                                    </div>
                                </div>
                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label for="monto" class="form-label">Monto:</label>
                                        <input type="text" class="form-control" id="monto" name="monto"
                                            placeholder="" wire:model.defer="monto" />
                                    </div>
                                </div>
                                <div class="col-md-4">

                                </div>
                            </div>

                            <div class="row my-1">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="observacion" class="form-label">Observacion:</label>
                                        <input type="text" class="form-control" id="observacion"
                                            name="observacion" placeholder="" wire:model.defer="observacion" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        </from>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        wire:click="cerrarModal">Cerrar</button>
                    <button type="button" class="btn btn-primary" wire:click="saveRecon">Registar</button>
                </div>
            </div>
        </div>
    @endif

    @if ($this->modalType == 'ver_reconsideracion')
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        REGISTRAR RECONSIDERACION
                    </h5>
                    <button type="button" class="btn-close" aria-label="Close" wire:click="cerrarModal"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3 needs-validation" novalidate>
                        @csrf
                        <fieldset disabled>
                            <div class="col-md-12">
                                <div class="row my-1">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="ruc" class="form-label">RUC:</label>
                                            <input type="text" class="form-control" id="ruc" name="ruc"
                                                minlength="11" maxlength="11" required
                                                onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                placeholder="20131257750" wire:model.lazy="ruc" />
                                            @error('ruc')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-7 ">
                                        <div class="form-group">
                                            <fieldset disabled>
                                                <label for="razon_social" class="form-label">Empleador:</label>
                                                <input type="text" class="form-control disabledTextInput"
                                                    id="razon_social" name="razon_social"
                                                    wire:model.defer="razon_social" />
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>

                                <div class="row my-1">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="nit" class="form-label">NIT:</label>
                                            <input type="text" class="form-control" id="nit" name="nit"
                                                placeholder="" wire:model.defer="nit" />
                                        </div>
                                    </div>
                                    <div class="col-md-3 ">
                                        <div class="form-group">
                                            <label for="expediente" class="form-label">Expediente:</label>
                                            <input type="text" class="form-control" id="expediente"
                                                name="expediente" placeholder="" wire:model.defer="expediente" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="doc_inp" class="form-label">Docummento Inpugnado:</label>
                                            <input type="text" class="form-control" id="doc_inp" name="doc_inp"
                                                placeholder="" wire:model.defer="doc_inp" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row my-1">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="f_recepcion" class="form-label">Fecha Recepcion de la nota a
                                                GCCYC:</label>
                                            <input type="Date" class="form-control" id="f_recepcion"
                                                name="f_recepcion" placeholder="" wire:model.defer="f_recepcion" />
                                        </div>
                                    </div>
                                    <div class="col-md-7 ">
                                        <div class="form-group">
                                            <label for="f_ingreso" class="form-label">Fecha Ingreso
                                                Institucion:</label>
                                            <input type="date" class="form-control" id="f_ingreso"
                                                name="f_ingreso" placeholder="" wire:model.defer="f_ingreso" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row my-1">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="rc" class="form-label">Resolucion Cobranza:</label>
                                            <input type="text" class="form-control" id="rc" name="rc"
                                                placeholder="" wire:model.defer="rc" />
                                        </div>
                                    </div>
                                    <div class="col-md-3 ">
                                        <div class="form-group">
                                            <label for="monto" class="form-label">Monto:</label>
                                            <input type="text" class="form-control" id="monto" name="monto"
                                                placeholder="" wire:model.defer="monto" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                    </div>
                                </div>

                                <div class="row my-1">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="observacion" class="form-label">Observacion:</label>
                                            <input type="text" class="form-control" id="observacion"
                                                name="observacion" placeholder="" wire:model.defer="observacion" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        </from>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        wire:click="cerrarModal">Cerrar</button>
                </div>
            </div>
        </div>
    @endif

    @if ($this->modalType == 'chat')
        dd($modalType);
    @endif

</div>
