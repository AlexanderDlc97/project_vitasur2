<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VITASUR | IMAGENOLOGIA - {{ $admin_imagenologia->nro_solicitud }} - PDF</title>
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
            <div class="contenidos">
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
                        <td class="fw-bold text-uppercase" style="width: 58%; font-size: 12.5px">{{ \Carbon\Carbon::parse($admin_imagenologia->fecha_imagenologia)->format('d-m-Y') }}</td>
                        <td class="text-uppercase fw-bold small" style="width: 12%; font-size: 12.5px">Edad:</td>
                        <td class="text-end" style="width: 13%; font-size: 12.5px">{{ $edad?$edad:'' }} años</td>
                    </tr>
                </table>
                <table class="w-100 px-1 pb-1">
                    @php
                        $pasc = \App\Models\Paciente::where('id', $admin_imagenologia->id_paciente)->first();
                        $paciente_val = \App\Models\Persona::where('id', $pasc->persona_id)->first();
                    @endphp
                    <tr>
                        <td class="fw-bold small" style="width: 17%; font-size: 12.5px">PACIENTE:</td>
                        <td style="width: 58%; font-size: 12.5px">{{ $paciente_val->name. ' ' .$paciente_val->surnames }}</td>
                        <td class="text-uppercase fw-bold small" style="width: 12%; font-size: 12.5px">{{ $paciente_val->identificacion.':' }}</td>
                        <td class="text-end" style="width: 13%; font-size: 12.5px">{{ $paciente_val->nro_identificacion }}</td>
                    </tr>
                </table>
                <table class="w-100 px-1">
                    <tr>
                        <td class="fw-bold text-uppercase" style="width: 13%; font-size: 12.5px">Procedimiento:</td>
                        <td class="fw-bold text-uppercase" style="width: 58%; font-size: 12.5px">{{ $admin_imagenologia->motivo }}</td>
                    </tr>
                </table>
                <table class="w-100" style="border-top: 5px double #065892;"></table>
            </div>
            <div class="contenido mb-5">
                <p class="text-white mb-4" align="justify">
                    @if($admin_imagenologia != '')
                        {!!$admin_imagenologia->descripcion_imagenologia!!}
                    @else
                    @endif
                </p>
            </div>
            <div>
                <table class="w-100 px-1 mt-5" style="min-height: 50px; font-size: 13px">
                    <td style="width: 30%"></td>
                    <td class="text-center border-top" style="width: 40%">
                        @php
                            $val_drimageno = \App\Models\Medico::where('persona_id',$admin_imagenologia->persona_id)->first();
                        @endphp
                        <p class="fw-bold mb-0 text-uppercase">Dr. {{$admin_imagenologia->responsable}}</p>
                        <p class="mb-0 small text-center fw-bold text-uppercase" style="font-size: 10px">C.M.P. {{$val_drimageno->cmp}}</p>
                        <p class="mb-0 text-uppercase">Medico Cirujano</p>
                    </td>
                    <td style="width: 30%"></td>
                </table>
            </div>
</body>
</html>