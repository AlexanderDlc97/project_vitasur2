<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VITASUR | RECETA - {{ $receta->nro_solicitud }} - PDF</title>
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
            margin-top: 0.2cm;
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
        <td style="width: 48%">
            <div class="contenido">
                <div class="header">
                    <table class="w-100">
                        <!-- <td style="width: 20%">
                            <p class="mb-0">
                                <img src="{{ public_path('/images/h1.png') }}" style="width: 120px;" alt="">
                            </p>
                        </td> -->
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
                        <td class="fw-bold small" style="width: 17%; font-size: 12.5px">PACIENTE:</td>
                        <td style="width: 58%; font-size: 12.5px">{{ $admin_atencione->paciente->persona->name. ' ' .$admin_atencione->paciente->persona->surnames }}</td>
                    </tr>
                </table>
                <table class="w-100 px-1 pb-1">
                    <tr>
                        <td class="fw-bold text-uppercase" style="width: 10%; font-size: 12.5px">Fecha:</td>
                        <td class="text-uppercase" style="width: 23%; font-size: 12.5px">{{ \Carbon\Carbon::parse($receta->fecha)->format('d-m-Y') }}</td>
                        <td class="text-uppercase fw-bold small" style="width: 10%; font-size: 12.5px">Edad:</td>
                        <td class="text-start" style="width: 18%; font-size: 12.5px">{{ $edad }} años</td>
                        <td class="text-uppercase fw-bold small" style="width: 10%; font-size: 12.5px">{{ $admin_atencione->paciente->persona->identificacion.':' }}</td>
                        <td class="text-start" style="width: 15%; font-size: 12.5px">{{ $admin_atencione->paciente->persona->nro_identificacion }}</td>
                    </tr>
                </table>
                <table class="w-100 border-top border-dark"></table>
                <table class="w-100 px-1 py-2" style="min-height: 100px; font-size: 13px">
                    <thead>
                        <tr>
                            <td colspan="4" class="text-primary fw-bold text-uppercase" style="font-size: 13px">Detalle de receta</td>
                        </tr>
                        <tr>
                            <th class="align-middle fw-bold text-uppercase small text-center" style="width: 10%">Cant.</th>
                            <th class="align-middle fw-bold text-uppercase small text-center" style="width: 65%">Descripción</th>
                            <!--<th class="align-middle fw-bold text-uppercase small text-center" style="width: 5%">Via</th>
                            <th class="align-middle fw-bold text-uppercase small text-center" style="width: 45%">Indicaciones</th>-->
                        </tr>
                    </thead>
                    <tbody id="dt_categories" class="text-center">
                        @php
                            $medicamentos = \App\Models\Medicamentoreceta::where('receta_id', $receta->id)->get();
                        @endphp
                        @foreach($medicamentos as $item_med)
                            <tr>
                                <td class="align-middle text-center pb-2">{{ $item_med->cantidad }}</td>
                                <td class="align-middle text-center pb-2">{{ $item_med->producto->name.' '.$item_med->producto->unidad_medida }}</td>
                                <!--<td class="align-middle text-center pb-2">{{ $item_med->via }}</td>
                                <td class="align-middle text-center pb-2">{{ $item_med->indicaciones }}</td>-->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <table class="w-100 border-top border-dark"></table>
                <table class="w-100 px-1" style="min-height: 50px; font-size: 13px">
                    <tr>
                        <td class="text-uppercase fw-bold small">Información adicional</td>
                    </tr>
                    <tr>
                        <td>{{ $receta->informacion_adicionales }}</td>
                    </tr>
                </table>
                <table class="w-100 px-1 mt-5" style="min-height: 50px; font-size: 13px">
                    <td style="width: 30%"></td>
                    <td class="text-center border-top" style="width: 40%">
                        <p class="fw-bold mb-0 text-uppercase">Dr. {{$admin_atencione->medico->persona->name .' '. $admin_atencione->medico->persona->surnames}}</p>
                        <p class="mb-0 small text-center fw-bold text-uppercase" style="font-size: 10px">C.M.P. {{$admin_atencione->medico->cmp}}</p>
                        <p class="mb-0 text-uppercase">{{$admin_atencione->especialidad->name}}</p>
                    </td>
                    <td style="width: 30%"></td>
                </table>
            </div>
        </td>
        <td style="width: 4%"></td>
        <td style="width: 48%">
            <div class="contenido">
                <div class="header">
                    <table class="w-100">
                        <!-- <td style="width: 20%">
                            <p class="mb-0">
                                <img src="{{ public_path('/images/h1.png') }}" style="width: 120px;" alt="">
                            </p>
                        </td> -->
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
                        <td class="fw-bold small" style="width: 17%; font-size: 12.5px">PACIENTE:</td>
                        <td style="width: 58%; font-size: 12.5px">{{ $admin_atencione->paciente->persona->name. ' ' .$admin_atencione->paciente->persona->surnames }}</td>
                    </tr>
                </table>
                <table class="w-100 px-1 pb-1">
                    <tr>
                        <td class="fw-bold text-uppercase" style="width: 10%; font-size: 12.5px">Fecha:</td>
                        <td class="text-uppercase" style="width: 23%; font-size: 12.5px">{{ \Carbon\Carbon::parse($receta->fecha)->format('d-m-Y') }}</td>
                        <td class="text-uppercase fw-bold small" style="width: 10%; font-size: 12.5px">Edad:</td>
                        <td class="text-start" style="width: 18%; font-size: 12.5px">{{ $edad }} años</td>
                        <td class="text-uppercase fw-bold small" style="width: 10%; font-size: 12.5px">{{ $admin_atencione->paciente->persona->identificacion.':' }}</td>
                        <td class="text-start" style="width: 15%; font-size: 12.5px">{{ $admin_atencione->paciente->persona->nro_identificacion }}</td>
                    </tr>
                </table>
                <table class="w-100 border-top border-dark"></table>
                <table class="w-100 px-1 py-2" style="min-height: 100px; font-size: 13px">
                    <thead>
                        <tr>
                            <td colspan="4" class="text-primary fw-bold text-uppercase" style="font-size: 13px">Detalle de receta</td>
                        </tr>
                        <tr>
                            <!--<th class="align-middle fw-bold text-uppercase small text-center" style="width: 5%">Cant.</th>-->
                            <th class="align-middle fw-bold text-uppercase small text-start" style="width: 35%">Descripción</th>
                            <th class="align-middle fw-bold text-uppercase small text-center" style="width: 3%">Via</th>
                            <th class="align-middle fw-bold text-uppercase small text-center" style="width: 62%">Indicaciones</th>
                        </tr>
                    </thead>
                    <tbody id="dt_categories" class="text-center">
                        @php
                            $medicamentos = \App\Models\Medicamentoreceta::where('receta_id', $receta->id)->get();
                        @endphp
                        @foreach($medicamentos as $item_med)
                            <tr>
                                <!--<td class="align-middle text-center pb-2">{{ $item_med->cantidad }}</td>-->
                                <td class="align-middle pb-2 small text-start">{{ $item_med->producto->name.' '.$item_med->producto->unidad_medida }}</td>
                                <td class="align-middle pb-2 small text-center">{{ $item_med->via }}</td>
                                <td class="align-middle pb-2 small">{{ $item_med->indicaciones }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <table class="w-100 border-top border-dark"></table>
                <table class="w-100 px-1" style="min-height: 50px; font-size: 13px">
                    <tr>
                        <td class="text-uppercase fw-bold small">Información adicional</td>
                    </tr>
                    <tr>
                        <td>{{ $receta->informacion_adicionales }}</td>
                    </tr>
                </table>
                <!--<table class="w-100 px-1 mt-5" style="min-height: 50px; font-size: 13px">
                    <td style="width: 30%"></td>
                    <td class="text-center border-top" style="width: 40%">
                        <p class="fw-bold mb-0 text-uppercase">Dr. {{$admin_atencione->medico->persona->name .' '. $admin_atencione->medico->persona->surnames}}</p>
                        <p class="mb-0 small text-center fw-bold text-uppercase" style="font-size: 10px">C.M.P. {{$admin_atencione->medico->cmp}}</p>
                        <p class="mb-0 text-uppercase">{{$admin_atencione->especialidad->name}}</p>
                    </td>
                    <td style="width: 30%"></td>
                </table>-->
            </div>
        </td>
    </table>
</body>
</html>