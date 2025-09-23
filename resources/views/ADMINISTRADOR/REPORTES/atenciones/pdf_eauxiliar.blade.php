<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VITASUR | EXAMEN AUXILIAR - {{ $eauxiliar->nro_solicitud }} - PDF</title>
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
                <div class="header pb-3">
                    <table class="w-100">
                        <!-- <td style="width: 20%">
                            <p class="mb-0">
                                <img src="{{ public_path('/images/h1.png') }}" style="width: 120px;" alt="">
                            </p>
                        </td> -->
                        <td style="width: 100%">
                            <p class="text-start mb-0">
                                <img src="{{ public_path('/images/icon.png') }}" style="width: 100px;" alt="">
                            </p>
                            <p class="mb-0 small text-start fw-bold text-uppercase" style="font-size: 10px">DIRECCIÓN: {{Auth::user()->persona->sede->direccion}} </p>
                            <p class="mb-0 small text-start" style="font-size: 10px">(Ref. {{Auth::user()->persona->sede->referencia}})</p>
                            <p class="mb-0 small text-start" style="font-size: 10px">TEL: {{Auth::user()->persona->sede->nro_contacto}}</p>
                        </td>
                    </table>
                </div>
                <table class="w-100" style="border-top: 5px double #065892;"></table>
                <table class="w-100 px-1 pt-1 pb-1">
                    <tr>
                       <td colspan="4" class="fw-bold text-uppercase" style="font-size: 20px">SOLICITUD DE EXAMEN AUXILIAR</td>
                    </tr>
                </table>
                <table class="w-100" style="border-top: 5px double #065892;"></table>
                <table class="w-100 px-1 ">
                    <tr>
                        <td class="fw-bold small" style="width: 40%; font-size: 12.5px">NOMBRE DEL PACIENTE:</td>
                        <td style="width: 60%; font-size: 13px">{{ $admin_atencione->paciente->persona->name.' '.$admin_atencione->paciente->persona->surnames}}</td>
                        <td class="fw-bold small" style="width: 40%; font-size: 12.5px">NRO. HISTORIA CLIN.:</td>
                        <td class="text-uppercase" style="width: 20%; font-size: 13px">{{ $admin_atencione->paciente->persona->nro_identificacion }}</td></td>
                    </tr>
                </table>
                <table class="w-100 px-1 ">
                    <tr>
                        <td class="fw-bold small" style="width: 12%; font-size: 12.5px">DOC. IDENT.:</td>
                        <td class="text-uppercase" style="width: 15%; font-size: 13px">{{ $admin_atencione->paciente->persona->nro_identificacion }}</td>
                        <td class="fw-bold small" style="width: 8%; font-size: 12.5px">SEXO:</td>
                        <td class="text-uppercase small" style="width: 22%; font-size: 13px">{{ $admin_atencione->paciente->persona->sexo == 'Hombre'?'Masculino':'Femenino' }}</td>
                        <td class="fw-bold small" style="width: 8%; font-size: 12.5px">EDAD:</td>
                        <td class="text-uppercase" style="width: 22%; font-size: 13px">{{ $edad }}</td>
                    </tr>
                </table>
                <table class="w-100 border-top border-dark"></table>
                <table class="w-100 px-1 pb-1">
                    <tr>
                        <td class="fw-bold small" style="width: 45%; font-size: 12.5px">ARREA HOSPITALARIA:</td>
                        <td class="text-uppercase" style="width: 80%; font-size: 13px">CONSULTA EXTERNA - {{$admin_atencione->especialidad->name}}</td>
                        <td class="fw-bold small" style="width: 40%; font-size: 12.5px">FECHA DE ATENCION:</td>
                        <td class="text-uppercase small" style="width: 20%; font-size: 13px">{{ \Carbon\Carbon::parse($eauxiliar->fecha)->format('d-m-Y') }}</td>
                    </tr>
                </table>
                <table class="w-100 border-top border-dark"></table>
                <table class="w-100 px-1 pb-1">
                    <tr>
                        <td class="fw-bold small" style="width: 30%; font-size: 12.5px">PROFESIONAL MEDICO:</td>
                        <td class="text-uppercase" style="width: 40%; font-size: 13px">{{ $admin_atencione->medico->persona->name.' '.$admin_atencione->medico->persona->surnames}}</td>
                    </tr>
                </table>
                <table class="w-100 border-top border-dark"></table>
                <table class="w-100 px-1 py-2" style="min-height: 200px; font-size: 13px">
                    <thead>
                        <tr>
                            <td colspan="4" class="text-primary fw-bold text-uppercase" style="font-size: 13px">Detalle de Examen Auxiliar</td>
                        </tr>
                        <tr>
                            <th class="align-middle fw-bold text-uppercase small text-center" style="width: 25%">Analisis</th>
                            <th class="align-middle fw-bold text-uppercase small text-center" style="width: 45%">Tipo de Analisis</th>
                        </tr>
                    </thead>
                    <tbody id="dt_categories" class="text-center">
                        @php
                            $dtlleauxiliares = \App\Models\Detalleeauxiliar::where('eauxiliares_id', $eauxiliar->id)->get();
                        @endphp
                        @foreach($dtlleauxiliares as $item_med)
                            <tr>
                                <td class="align-middle text-center pb-2">{{ $item_med->analisis }}</td>
                                <td class="align-middle text-center pb-2">{{ $item_med->t_analisis }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <table class="w-100 px-1 mt-1" style="min-height: 50px; font-size: 13px">
                    <td style="width: 30%"></td>
                    <td class="text-center border-top" style="width: 40%">
                        <p class="fw-bold mb-0 text-uppercase">Dr. {{$admin_atencione->medico->persona->name .''. $admin_atencione->medico->persona->surnames}}</p>
                        <p class="mb-0 small text-center fw-bold text-uppercase" style="font-size: 10px">C.M.P. {{$admin_atencione->medico->cmp}}</p>
                        <p class="mb-0 text-uppercase">{{$admin_atencione->especialidad->name}}</p>
                    </td>
                    <td style="width: 30%"></td>
                </table>
            </div>
        </td>
    </table>
</body>
</html>