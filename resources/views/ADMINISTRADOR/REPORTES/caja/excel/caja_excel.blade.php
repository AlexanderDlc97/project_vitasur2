<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VITASUR</title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/administrador.css">
    <link rel="stylesheet" href="/css/datatables/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="/css/datatables/select.bootstrap5.min.css">
    <link rel="stylesheet" href="/css/datatables/responsive.bootstrap.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/select2.min.css">
    <link rel="icon" href="/images/ICON-1.png">
</head>
<table id="tcompany" class="table table-hover table-sm" cellspacing="0" style="width:100%">
        <thead>
            <tr>
                <th colspan="8" style="background-color:#76B82A; color:white; "></th>
            </tr>
            <tr>
                <th style="background-color:#76B82A;"></th>
                <th style="background-color:#76B82A;"></th>
                <th style="background-color:#76B82A;"></th>
                <th style="background-color:#76B82A;"></th>
                <th style="background-color:#76B82A;"></th>
                <th style="background-color:#76B82A;"></th>
                <th style="background-color:#76B82A;"></th>
                <th style="background-color:#76B82A;"></th>
            </tr>
            <tr>
                <th style="background-color:#76B82A;"></th>
                <th style="background-color:#76B82A;"></th>
                <th style="background-color:#76B82A;"></th>
                <th style="background-color:#76B82A;"></th>
                <th style="background-color:#76B82A;"></th>
                <th style="background-color:#76B82A;"></th>
                <th style="background-color:#76B82A;"></th>
                <th style="background-color:#76B82A;"></th>
            </tr>
            <tr>
                <th style="background-color:#76B82A;"></th>
                <th style="background-color:#76B82A;"></th>
                <th style="background-color:#76B82A;"></th>
                <th style="background-color:#76B82A;"></th>
                <th style="background-color:#76B82A;"></th>
                <th style="background-color:#76B82A;"></th>
                <th style="background-color:#76B82A;"></th>
                <th style="background-color:#76B82A;"></th>
            </tr>
            <tr>
                <th colspan="8" style="background-color:#76B82A; color:white; "></th>
            </tr>
            <tr>
                <th style="background-color:#76B82A;"></th>
                <th colspan="7" style="background-color:#76B82A; color:white; font-size:20px;font-weight: bold;"><u>REGISTRO DE MOVIMIENTO DE CAJA</u></th>
            </tr>
            <tr>
                <th style="background-color:#76B82A;"></th>
                <th style="background-color:#76B82A;"></th>
                <th style="background-color:#76B82A;"></th>
                <th style="background-color:#76B82A;"></th>
                <th style="background-color:#76B82A;"></th>
                <th style="background-color:#76B82A;"></th>
                <th style="background-color:#76B82A;"></th>
                <th style="background-color:#76B82A;"></th>
            </tr>
            <tr>
                <th colspan="8" style="background-color:#76B82A; color:white; "></th>
            </tr>
        </thead>
        @foreach($banco as $bancos)
        @php
            $cobro_v = DB::table('registrocajas as rca')->join('movimiento_cajas as movc','movc.registrocaja_id','=','rca.id')->select('movc.*','rca.saldo_inicial')->where('rca.sede_id',Auth::user()->persona->sede_id)->where('movc.cuenta',$bancos->nro_cuenta)->whereBetween('rca.created_at', [$fechac_ini,$fechac_fn])->where('movc.operaciones','COBRO')->get();

            $saldo_inicial_v = DB::table('registrocajas as rca')->join('movimiento_cajas as movc','movc.registrocaja_id','=','rca.id')->select('rca.saldo_inicial')->where('rca.sede_id',Auth::user()->persona->sede_id)->where('movc.cuenta',$bancos->nro_cuenta)->whereBetween('rca.created_at', [$fechac_ini,$fechac_fn])->where('movc.operaciones','COBRO')->first();
            
            $pago_c = DB::table('registrocajas as rca')->join('movimiento_cajas as movc','movc.registrocaja_id','=','rca.id')->select('movc.*','rca.saldo_inicial')->where('rca.sede_id',Auth::user()->persona->sede_id)->where('movc.cuenta',$bancos->nro_cuenta)->whereBetween('rca.created_at', [$fechac_ini,$fechac_fn])->where('movc.operaciones','PAGO')->get();

            $saldo_inicial_c = DB::table('registrocajas as rca')->join('movimiento_cajas as movc','movc.registrocaja_id','=','rca.id')->select('rca.saldo_inicial')->where('rca.sede_id',Auth::user()->persona->sede_id)->where('movc.cuenta',$bancos->nro_cuenta)->whereBetween('rca.created_at', [$fechac_ini,$fechac_fn])->where('movc.operaciones','PAGO')->first();
        @endphp
        <thead>
            <tr>
                <th colspan="8" style="background-color: #fefdfd ; color:black; font-size:20px;font-weight: bold; text-align: center;"><u>{{$bancos->name}}</u></th>
            </tr>
            <tr>
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;">N°</th>
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;">Fecha</th>
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;">Asunto</th>
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;">Motivo</th>
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;">Ingreso</th>
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;">Salida</th>
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;">Total</th>
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;">Medio de Pago</th>
            </tr>
            <tr>
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;"> </th>
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;">{{$fechac_ini.' / '.$fechac_fn }}</th>
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;">{{(Auth::user()->persona->name.' '.Auth::user()->persona->lastname_padre.' '.Auth::user()->persona->lastname_madre) }}</th>
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;"></th>
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;"> </th>
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;"> </th>
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;"></th>
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;"> </th>
            </tr>
            <tr>
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;"> </th>
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;"></th>
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;"></th>
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;"></th>
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;"> </th>
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;"> </th>
                @if($saldo_inicial_v)
                    <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;">{{$saldo_inicial_v->saldo_inicial}}</th>
                @else
                    <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;">0.00</th>
                @endif
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;"> </th>
            </tr>
        </thead>
        <tbody>
            @php 
                $contador = 1;
                $valoringreso = 0;
                $numeroingreso = $saldo_inicial_v?$saldo_inicial_v->saldo_inicial:0.00;
            @endphp
            @foreach($cobro_v as $cobro_vs)
                @php 
                    if($numeroingreso){
                        $numeroingreso = $numeroingreso+$cobro_vs->total;
                    }
                @endphp
                <tr>
                    <td class="font-weight-light" style="text-align: center; border:2px;">{{$contador}}</td>
                    <td class="font-weight-light" style="text-align: center; border:2px;">{{($cobro_vs->created_at) }}</td>
                    <td class="font-weight-light" style="text-align: center; border:2px;">{{ $cobro_vs->asunto }}</td>
                    <td class="font-weight-light" style="text-align: center; border:2px;">{{ $cobro_vs->motivo }}</td>
                    <td class="font-weight-light" style="text-align: center; border:2px;">{{ number_format($cobro_vs->total, 2, '.', ',') }}</td>
                    <td class="font-weight-light" style="text-align: center; border:2px;">-</td>
                    <td class="font-weight-light" style="text-align: center; border:2px;">{{ number_format($numeroingreso, 2, '.', ',') }}</td>
                    <td class="font-weight-light" style="text-align: center; border:2px;">{{($cobro_vs->metodo) }}</td> 
                </tr>
                @php 
                    $contador++;
                @endphp
            @endforeach
        </tbody> 

        <thead>
            <tr>
                <th class="h6" style="text-align: center; color:white;"> </th>
                <th class="h6" style="text-align: center; color:white;"></th>
                <th class="h6" style="text-align: center; color:white;"></th>
                <th class="h6" style="text-align: center; color:white;"></th>
                <th class="h6" style="text-align: center; color:white;"> </th>
                <th class="h6" style="text-align: center; color:white;"> </th>
                <th class="h6" style="text-align: center; color:white;"> </th>
                <th class="h6" style="text-align: center; color:white;"></th>
            </tr>
            <tr>
                <th class="h6" style="text-align: center; color:white;"> </th>
                <th class="h6" style="text-align: center; color:white;"></th>
                <th class="h6" style="text-align: center; color:white;"></th>
                <th class="h6" style="text-align: center; color:white;"></th>
                <th class="h6" style="text-align: center; color:white;"> </th>
                <th class="h6" style="text-align: center; color:white;"> </th>
                <th class="h6" style="text-align: center; color:white;"> </th>
                <th class="h6" style="text-align: center; color:white;"></th>
            </tr>
            <tr>
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;"> </th>
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;"></th>
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;"></th>
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;"></th>
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;"> </th>
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;"> </th>
                @if($saldo_inicial_c)
                    <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;">{{$saldo_inicial_c->saldo_inicial}}</th>
                @else
                    <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;">0.00</th>
                @endif
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;"> </th>
            </tr>
        </thead>
        <tbody>
            @php 
                $contadordos = 1;
                $valorpago = 0;
                $numeropago = $saldo_inicial_c?$saldo_inicial_c->saldo_inicial:0.00;
            @endphp
            @foreach($pago_c as $pago_cs)
                @php 
                    if($numeropago){
                        $valorpago = $numeropago-$pago_cs->total;
                        $numeropago = $valorpago;
                    }
                @endphp
                <tr>
                    <td class="font-weight-light" style="text-align: center; border:2px;">{{$contadordos}}</td>
                    <td class="font-weight-light" style="text-align: center; border:2px;">{{($pago_cs->created_at) }}</td>
                    <td class="font-weight-light" style="text-align: center; border:2px;">{{ $pago_cs->asunto }}</td>
                    <td class="font-weight-light" style="text-align: center; border:2px;">{{ $pago_cs->motivo }}</td>
                    <td class="font-weight-light" style="text-align: center; border:2px;">-</td>
                    <td class="font-weight-light" style="text-align: center; border:2px;">{{ number_format($pago_cs->total, 2, '.', ',') }}</td>
                    <td class="font-weight-light" style="text-align: center; border:2px;">{{ number_format($numeropago, 2, '.', ',') }}</td>
                    <td class="font-weight-light" style="text-align: center; border:2px;">{{($pago_cs->metodo) }}</td>
                </tr>
                @php 
                    $contadordos++;
                @endphp
            @endforeach
        </tbody>
        
        <thead>
            <tr>
                <th class="h6" style="text-align: center; color:white;"> </th>
                <th class="h6" style="text-align: center; color:white;"></th>
                <th class="h6" style="text-align: center; color:white;"></th>
                <th class="h6" style="text-align: center; color:white;"></th>
                <th class="h6" style="text-align: center; color:white;"> </th>
                <th class="h6" style="text-align: center; color:white;"> </th>
                <th class="h6" style="text-align: center; color:white;"> </th>
                <th class="h6" style="text-align: center; color:white;"></th>
            </tr>
        </thead>
        <thead>
            <tr>
                <th class="h6" style="text-align: center; color:white;"> </th>
                <th class="h6" style="text-align: center; color:white;"></th>
                <th class="h6" style="text-align: center; color:white;"></th>
                <th class="h6" style="text-align: center; color:white;"></th>
                <th class="h6" style="text-align: center; color:white;"> </th>
                <th class="h6" style="text-align: center; color:white;"> </th>
                <th class="h6" style="text-align: center; color:white;"> </th>
                <th class="h6" style="text-align: center; color:white;"></th>
            </tr>
        </thead>
        @endforeach
</table>
</html>