<div>
<div id="indicadorR">
    <div class="container-fluid">
        <div class="row" style="margin-top: 10px;"> 
            <div class="col-12">
              <h1 class="h3 mb-2 text-gray-800" style="text-align:center;margin-top:10px;font-weight: bold; color: #5a5c69 !important;font-size: 1.75rem;">CLAIMS SYSTEM - REFUND INDICATOR</h1>
            </div>
        </div>
      
        <div class="card mb-3">
          <div class="card-header" style="color: #858796 !important;">
            INDICADOR DE REEMBOLSO
          </div>
        <div class="card-body">
          
        <form class="row g-3 needs-validation"   wire:submit="buscar">
            @csrf
        <div class="col-md-10">
                <div class="row my-1">
                      <div class="col-md-4">
                        <div class="form-group" >
                            <label for="tributo" class="form-label">Tributo:</label>
                            <select class="form-select" id="tributo" name="tributo" style="" wire:model.change="tributo" >
                              <option value="052100">052100/052402/052405 - SEGURO REGULAR ACTIVO Y PENSIONISTA</option>
                              <option value="052101">052101 - ESSALUD S.C.T.R</option>
                              <option value="052202">052202 - ESSALUD SEGURO AGRARIO/ACUÍCOLA</option>
                              <option value="052308">052308 - ESSALUD CBSSP TRAB. PESQUERO</option>
                              <option value="052110">052110 - ESSALUD TRAB. DEL HOGAR</option>     
                            </select>
                        </div>
                      </div>
                      <div class="col-md-4 ">
                        <div class="form-group">
                            <label for="ruc" class="form-label" >Ingrese el número de RUC:</label>
                            <input type="text" class="form-control" id="ruc" name="ruc" minlength="11" maxlength="11" required 
                            onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="20131257750" wire:model.defer="ruc"/>
                        </div>
                      </div>
                      <div class="col-md-4" >
                        <div class="form-group">
                            <label for="periodo" class="form-label">Ingrese el periodo:</label>
                            <input type="text" class="form-control" id="mes" name="mes" minlength="6" maxlength="6" required
                            onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="201010" wire:model.defer="mes"/>
                        </div>
                      </div>		 
                </div>
              
          <div class="row py-2" wire:key="area-tributo-{{ $tributo }}">
            @if($tributo=='052110')
            <div class="col-md-4 th" >
                    <div class="form-group" >
                            <label for="tdoc" class="form-label">Tipo Documento:</label>
                            <select class="form-select" id="tdoc" name="tdoc" style="">
                              <option value="01">01 - LIBRETA ELECTORAL O DNI</option>
                              <option value="02">02 - CARNET DE FUERZAS POLICIALES</option>
                              <option value="03">03 - CARNET DE FUERZAS ARMADAS</option>
                              <option value="04">04 - CARNET DE EXTRANJERIA</option>
                              <option value="05">05 - LIBRETA TRIBUTARIA</option>   
                              <option value="06">06 - REG. UNICO DE CONTRIBUYENTES</option> 
                              <option value="07">07 - PASAPORTE</option>
                              <option value="08">08 - DOC. PROVISIONAL DE IDENTIDAD</option> 
                              <option value="09">09 - CARNE DE SOLICITANTE DE REFUG</option> 
                              <option value="10">10 - AUTOGENERADO</option> 
                              <option value="11">11 - PART. DE NACIMIENTO-IDENTIDAD</option> 
                              <option value="12">12 - DOC. EDUCACION SUPERIOR</option> 
                              <option value="13">13 - TRAB. MENOR DE EDAD/INTERDICT</option> 
                              <option value="14">14 - TRABAJADOR MENOR DE EDAD</option> 
                              <option value="15">15 - INTERDICTO</option> 
                              <option value="16">16 - CEDULA DIPLOMATICA</option> 
                              <option value="17">17 - COD. INSCRIPCION EMPLEADOR TH</option>
                              <option value="20">20 - LICENCIA DE CONDUCIR</option>   
                              <option value="21">21 - NRO. REGISTRO SUNAT</option>   
                              <option value="22">22 - CARN� DE IDENTIDAD - RR.EE.</option>   
                              <option value="23">23 - CARN� PERMISO TEMP.PERMANENCIA</option>   
                              <option value="24">24 - DOC. DE IDENTIDAD EXTRANJERO</option>   
                              <option value="26">26 - CARN� PERMISO TEMP PERMAN -CPP</option>   
                            </select>
                    </div>
            </div>
            <div class="col-md-4 th">
              <div class="form-group">
                  <label for="periodo" class="form-label">Numero Documento:</label>
                  <input type="text" class="form-control" id="ndoc" name="ndoc" minlength="8" maxlength="8" required
                  onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="12345678"/>
              </div>
            </div>
            @endif
          </div>
        </div> 

        <div class="col-md-2">
          <div class="row">
              <div class="col-md-6">
                      <button  class="btn btn-primary" style="margin-top:36px; font-size:13px;" >Buscar</button> 
              </div>
              <div class="col-md-6">
                      <button  class="btn btn-primary" style="margin-top:36px;font-size:13px;" type="button" wire:click="Calificar"  >Calificar</button> 
              </div>
          </div>
        </div>

       </form>
@if($rperiodo!='')
<div id="detalle">

  <div class="row periodo"  >
                <div class="col-sm-3 d-flex" >
                    <label class="col-sm-4 col-form-label ">RUC:</label>
                    <label class="col-sm-8" style="col-sm-8 color: black;margin-top: 5px;" id="bl_ruc" >{{ $rperiodo->ruc_periodo}}</label>
                </div>  
              
                <div class="col-sm-5 d-flex">
                    <label class="col-sm-3 col-form-label">EMPLEADOR:</label>
                    <label class="col-sm-8" style="color: black;margin-top: 5px;" id="bl_empleador">{{ $r_empleador->raz_empleador }}</label>
                </div>

                <div class="col-sm-4 d-flex">
                    <label class="col-sm-4 col-form-label" >DEPENDENCIA:</label>
                    <label class="col-sm-8" style="color: black;margin-top: 5px;" id="bl_dependenia">{{$dependencia->des_depen}}</label>
                </div>
  </div>
  <div class="row periodo">
                <div class="col-sm-3 d-flex" >
                    <label class="col-sm-4 col-form-label ">PERIODO:</label>
                    <label class="col-sm-8" style="col-sm-8 color: black;margin-top: 5px;" id="bl_ruc">{{ $rperiodo->mes_periodo }}</label>
                </div>  

                <div class="col-sm-5 d-flex">
                    <label class="col-sm-3 col-form-label">CALIFICACION:</label>
                
                  @if($rperiodo->est_periodo == "MOROSO")
                    <label style="margin-top: 5px;" class="col-sm-8 text-danger" id="bl_calificacion">CON CONDICIÓN DE REEMBOLSO</label>            
                  @else
                    <label class="col-sm-8" style="color:black;margin-top: 5px;" id="bl_calificacion">SIN CONDICIÓN DE REEMBOLSO</label>
                  @endif
                </div>

                <div class="col-sm-4 d-flex">
                    <label class="col-sm-4 col-form-label" >ACTUALIZADO AL:</label>
                    <label class="col-sm-8" style="color: black;margin-top: 5px;" id="bl_peridodo"></label>
                </div>
  </div>

  <div id="morosidad">
    <div class="table-responsive">
        <table class="table table-hover" id="example" >
        <?php 
                      $lastTribu = null;
                      $lastPeriodo = null;
                      $count=0;
        ?>

        @foreach ($r_morosidad as $morosidad)
        <?php
                        $count=$count+1;
                        $tributo=$morosidad->tribu_morosidad;
                        if($count==1){
                ?>
                <thead>
                      <tr>
                        <th scope="col" >#</th>
                        <!--<th scope="col" >PERIODO DE CONTINGENCIA</th>-->
                        <th scope="col" >MES DE EVALUACIÓN</th>
                        <th scope="col" >FORMULARIO</th>
                        <th scope="col" >FECHA DECLARADA</th>
                        <th scope="col" >FECHA PAGO</th>
                        <th scope="col" >FECHA SUNAT</th>
                        <th scope="col" >FECHA ESSALUD</th>
                        <th scope="col" >MONTO DECLARADO</th>
                        <th scope="col" >INTERES GENERADO</th>
                        <th scope="col" >MONTO PAGADO</th>
                        <th scope="col" >SALDO DIFERENCIAL</th>
                        <th scope="col" >INTERES {{ \Carbon\Carbon::parse($morosidad->fecha_proc)->format('d/m/Y') }}</th>
                        <th scope="col" >PAGO EXTEMPORANEO</th>
                        <th scope="col" >FECHA PAGO EXT.</th>
                        <th scope="col" >SALDO FINAL {{ \Carbon\Carbon::parse($morosidad->fecha_proc)->format('d/m/Y') }}</th>
                        <th scope="col" >MONTO VALOR</th>
                        <th scope="col" >NUMERO VALOR</th>
			                  <th scope="col" >FECHA VALOR</th>
                        <th scope="col" >CANTIDAD TRABAJADORES</th>
                        <th scope="col" class="">ESTADO MOROSIDAD</th>
                      </tr>
               </thead>
        <?php  } ?>
        <tr>
            <td>{{ $morosidad->num_morosidad }}</td>
            <td>{{ $morosidad->meseva_morosidad }}</td>
            <td>{{ $morosidad->formu_morosidad }}</td>
            <td>{{ $morosidad->fecdec_morosidad }}</td>
            <td>{{ $morosidad->fecpag_morosidad }}</td>
            <td>{{ $morosidad->fec_ven_sunat }}</td>
            <td>{{ $morosidad->fec_essa_dec }}</td>
            <td>{{ $morosidad->mondec_morosidad }}</td>
            <td>{{ $morosidad->interes_gene}}</td>
            <td>{{ $morosidad->monpag_morosidad}}</td>
            <td>{{ $morosidad->difer_morosidad }}</td>
            <td>{{ $morosidad->interes_act }}</td>
            <td>{{ $morosidad->pago_ext }}</td>
            <td>{{ $morosidad->fec_max_ext }}</td>
            <td>{{ $morosidad->saldo_act }}</td>
            <td>{{ $morosidad->mmonval_morosidad }}</td>
            <td>{{ $morosidad->nroval_morosdiad }}</td>
            <td>{{ $morosidad->fecval_morosidad }}</td>
            <td>{{ $morosidad->trab_dec }}</td>
            <td>{{ $morosidad->estado_mor }}</td>
        </tr>
        @endforeach

        </tbody>

        </table>
    </div>
  </div>
{{$this->rperiodo=null}}
{{$this->r_morosidad=null}}

{{$this->r_empleador=null}}

{{$this->dependencia=null}}


    
</div>

@endif

        </div>
    </div>
</div>

