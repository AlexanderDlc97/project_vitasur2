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
        @php
            $registro = \App\Models\Registrocaja::where('sede_id',Auth::user()->persona->sede_id)->where('id',$registrando)->latest('id')->first();
        @endphp
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
            @if($registro)
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;"> </th>
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;">{{($registro->created_at) }}</th>
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;">{{($registro->registrado_por) }}</th>
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;">SALDO INICIAL</th>
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;"> </th>
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;"> </th>
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;">{{($registro->saldo_inicial) }}</th>
                <th class="h6" style="text-align: center;background-color:#6E7E6B; color:white;"> </th>
            @endif
        </tr>
        </thead>
        <tbody>
            @php 
                $contador = 1;
                $valoringreso = 0;
                $numeroingreso = $registro->saldo_inicial;
            @endphp
            @foreach($dtcajas as $dtcajass)
                <tr>
                    @if($dtcajass->operaciones == 'COBRO')
                        @php
                            if($numeroingreso){
                                $valoringreso = $numeroingreso+$dtcajass->total;
                                $numeroingreso = $valoringreso;
                            }
                        @endphp
                        <td class="font-weight-light" style="text-align: center; border:2px;">{{$contador}}</td>
                        <td class="font-weight-light" style="text-align: center; border:2px;">{{($dtcajass->created_at) }}</td>
                        <td class="font-weight-light" style="text-align: center; border:2px;">{{ $dtcajass->asunto }}</td>
                        <td class="font-weight-light" style="text-align: center; border:2px;">{{ $dtcajass->motivo }}</td>
                        <td class="font-weight-light" style="text-align: center; border:2px;">{{ number_format($dtcajass->total, 2, '.', ',') }}</td>
                        <td class="font-weight-light" style="text-align: center; border:2px;">-</td>
                        <td class="font-weight-light" style="text-align: center; border:2px;">{{ number_format($numeroingreso, 2, '.', ',') }}</td>
                        <td class="font-weight-light" style="text-align: center; border:2px;">{{($dtcajass->metodo) }}</td>
                    @endif
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
        </thead>
        <tbody>
            @php 
                $contadordos = 1;
                $valorpago = 0;
                $numeropago = $registro->saldo_inicial;
            @endphp
            @foreach($dtcajas as $dtcajass)
                <tr>
                    @if($dtcajass->operaciones == 'PAGO')
                        @php
                            if($numeropago){
                                $valorpago = $numeropago-$dtcajass->total;
                                $numeropago = $valorpago;
                            }
                        @endphp
                        <td class="font-weight-light" style="text-align: center; border:2px;">{{$contadordos}}</td>
                        <td class="font-weight-light" style="text-align: center; border:2px;">{{($dtcajass->created_at) }}</td>
                        <td class="font-weight-light" style="text-align: center; border:2px;">{{ $dtcajass->asunto }}</td>
                        <td class="font-weight-light" style="text-align: center; border:2px;">{{ $dtcajass->motivo }}</td>
                        <td class="font-weight-light" style="text-align: center; border:2px;">-</td>
                        <td class="font-weight-light" style="text-align: center; border:2px;">{{ number_format($dtcajass->total, 2, '.', ',') }}</td>
                        <td class="font-weight-light" style="text-align: center; border:2px;">{{ number_format($numeropago, 2, '.', ',') }}</td>
                        <td class="font-weight-light" style="text-align: center; border:2px;">{{($dtcajass->metodo) }}</td>
                    @endif
                </tr>
                @php 
                    $contadordos++;
                @endphp
            @endforeach
        </tbody>
</table>
</html>