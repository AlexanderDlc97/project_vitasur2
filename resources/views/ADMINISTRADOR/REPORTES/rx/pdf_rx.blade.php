<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VITASUR | RX - {{ $rx->nro_solicitud }} - PDF</title>
    <link rel="stylesheet" href="{{ public_path('css/bootstrap.css') }}">
    <style>
       
        @font-face {
            font-family: 'Roboto', sans-serif;
            font-style: normal;
            font-weight: normal;
            src: local('Roboto'), url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap') format('truetype');
        }
    
        @page {
            margin: 0cm 0cm;
        }

        .page-break {
            page-break-after: always;
        }
        
        body{
            font-family: 'Roboto', sans-serif;
            margin-top: 1cm;
            margin-left: 1cm;
            margin-right: 1cm;
            margin-bottom: 1cm;
        }

        .contenido{
            background-image: url({{ public_path('images/logo-light.png') }});
            background-repeat: no-repeat;
            background-size: 100% auto;
            background-attachment: fixed;
            background-position: center;
        }

        .bg-primary{
            background-color: #065892;
        }

        .bg-success{
            background-color: #179CBB;
        }

        .bg-danger{
            background-color: #CD0C36;
        }

        .bg-encabezado{
            background-color: #e0e0e0;
        }

        .border-encabezado{
            border-color: #bfbfbf !important;
        }

        .border-primary{
            border-bottom: 2px solid #065892 !important;
        }

        /* .bg-cuerpo{
            background-color: #eeeeee;
        } */

        .texto-11{
            font-size: 11px;
        }
    </style>
</head>
<body>
    <table class="w-100">
            <div class="contenido">
                <div class="header">
                    <table class="w-100">
                        <td style="width: 100%">
                            <p class="text-center mb-0">
                                <img src="{{ public_path('/images/icon.png') }}" style="width: 100px;" alt="">
                            </p>
                            <p class="mb-0 small text-center fw-bold text-uppercase" style="font-size: 10px">DIRECCIÓN: {{Auth::user()->persona->sede->direccion}} </p>
                            <p class="mb-0 small text-center" style="font-size: 10px">(Ref. {{Auth::user()->persona->sede->referencia}})</p>
                            <p class="mb-0 small text-center" style="font-size: 10px">TEL: {{Auth::user()->persona->sede->nro_contacto}}</p>
                        </td>
                    </table>
                </div>
                <table class="w-100" style="border-top: 5px double #065892;"></table>
                <table class="w-100 px-1 pt-1">
                    <tr>
                        <td class="fw-bold text-uppercase" style="width: 17%; font-size: 12.5px">Fecha:</td>
                        <td class="fw-bold text-uppercase" style="width: 58%; font-size: 12.5px">{{ \Carbon\Carbon::parse($rx->fecha)->format('d-m-Y') }}</td>
                        <td class="text-uppercase fw-bold small" style="width: 12%; font-size: 12.5px">Edad:</td>
                        <td class="text-end" style="width: 13%; font-size: 12.5px">{{ $edad }} años</td>
                    </tr>
                </table>
                <table class="w-100 px-1 pb-1">
                    <tr>
                        <td class="fw-bold small" style="width: 17%; font-size: 12.5px">PACIENTE:</td>
                        <td style="width: 58%; font-size: 12.5px">{{ $admin_atencione->paciente->persona->name. ' ' .$admin_atencione->paciente->persona->surnames }}</td>
                        <td class="text-uppercase fw-bold small" style="width: 12%; font-size: 12.5px">{{ $admin_atencione->paciente->persona->identificacion.':' }}</td>
                        <td class="text-end" style="width: 13%; font-size: 12.5px">{{ $admin_atencione->paciente->persona->nro_identificacion }}</td>
                    </tr>
                </table>
                <table class="w-100" style="border-top: 5px double #065892;"></table>
            </div>
            <div class="contenido">
                @php
                    if(\App\Models\Rx::where('atencion_id',$admin_atencione->id)->exists()){
                        $valor_rx = \App\Models\Rx::where('atencion_id',$admin_atencione->id)->first();
                    }else{
                        $valor_rx = '';
                    }
                @endphp
                <p class="text-white mb-2" align="justify">
                    @if($valor_rx != '')
                        {!!$valor_rx->descripcion_rx!!}
                    @else
                    @endif
                </p>
            </div>
    </table>
</body>
</html>