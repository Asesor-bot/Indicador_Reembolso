@extends('IR.IR')
@section('detalles')

<div class="row periodo">
                <div class="col-sm-3 d-flex" >
                    <label class="col-sm-4 col-form-label ">RUC:</label>
                    <label class="col-sm-8" style="col-sm-8 color: black;margin-top: 5px;" id="lbl_ruc">{{ $periodo->ruc_periodo }}</label>
                </div>  

                <div class="col-sm-5 d-flex">
                    <label class="col-sm-3 col-form-label">EMPLEADOR:</label>
                    <label class="col-sm-8" style="color: black;margin-top: 5px;" id="lbl_empleador">{{ $empleador->raz_empleador }}</label>
                </div>

                <div class="col-sm-4 d-flex">
                    <label class="col-sm-4 col-form-label" >DEPENDENCIA:</label>
                    <label class="col-sm-8" style="color: black;margin-top: 5px;" id="lbl_dependenia">{{$dependencia->des_depen}}</label>
                </div>
</div>

<div class="row periodo">
                <div class="col-sm-3 d-flex" >
                    <label class="col-sm-4 col-form-label ">PERIODO:</label>
                    <label class="col-sm-8" style="col-sm-8 color: black;margin-top: 5px;" id="lbl_ruc">{{ $periodo->mes_periodo }}</label>
                </div>  

                <div class="col-sm-5 d-flex">
                    <label class="col-sm-3 col-form-label">CALIFICACION:</label>
                
                @if($periodo->EST_PERIODO == "MOROSO")
                    <label style="margin-top: 5px;" class="col-sm-8 text-danger" id="lbl_calificacion">CON CONDICIÓN DE REEMBOLSO</label>            
                @else
                    <label class="col-sm-8" style="color:black;margin-top: 5px;" id="lbl_calificacion">SIN CONDICIÓN DE REEMBOLSO</label>
                @endif
                </div>

                <div class="col-sm-4 d-flex">
                    <label class="col-sm-4 col-form-label" >ACTUALIZADO AL:</label>
                     <label class="col-sm-8" style="color: black;margin-top: 5px;" id="lbl_peridodo"></label>
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
@endsection
