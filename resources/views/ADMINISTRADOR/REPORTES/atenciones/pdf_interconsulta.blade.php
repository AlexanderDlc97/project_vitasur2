<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VITASUR | INTERCONSULTA - {{ $interconsulta->nro_solicitud }} - PDF</title>
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
                       <td colspan="4" class="fw-bold text-uppercase" style="font-size: 20px">SOLICITUD DE INTERCONSULTA</td>
                    </tr>
                </table>
                <table class="w-100" style="border-top: 5px double #065892;"></table>
                <table class="w-100 px-1 pb-1">
                    <tr>
                        <td class="fw-bold small" style="width: 25%; font-size: 12.5px">UNIDAD MEDICA:</td>
                        <td style="width: 40%; font-size: 13px">CLINICA VITASUR</td>
                        <td class="fw-bold small" style="width: 50%; font-size: 12.5px">FECHA Y HORA DE LA SOLICITUD:</td>
                        <td class="text-uppercase small" style="width: 40%; font-size: 13px">{{ $admin_atencione->created_at}}</td>
                    </tr>
                </table>
                <table class="w-100 px-1 pb-1">
                    <tr>
                        <td class="fw-bold small" style="width: 30%; font-size: 12.5px">NOMBRE DEL PACIENTE:</td>
                        <td style="width: 40%; font-size: 13px">{{ $admin_atencione->paciente->persona->name.' '.$admin_atencione->paciente->persona->surnames}}</td>
                        <td class="fw-bold small" style="width: 30%; font-size: 12.5px">NOMBRE DEL MEDICO SOLICITANTE:</td>
                        <td class="text-uppercase" style="width: 40%; font-size: 13px">{{ $admin_atencione->medico->persona->name.' '.$admin_atencione->medico->persona->surnames}}</td>
                    </tr>
                </table>
                <table class="w-100 px-1 pb-1">
                    <tr>
                        <td class="fw-bold small" style="width: 50%; font-size: 12.5px">SERVICIO QUE SOLICITA LA INTERCONSULTA:</td>
                        <td class="text-uppercase" style="width: 40%; font-size: 12.5px">{{ $admin_atencione->especialidad->name}}</td>
                        
                    </tr>
                </table>
                @php 
                    $consulta_interconsulta = \App\Models\Consulta::where('atencion_id',$admin_atencione->id)->first();
                @endphp
                <table class="w-100 px-1 pb-1">
                    <tr>
                        <td class="fw-bold small" style="width: 50%; font-size: 12.5px">MOTIVO DE LA INTERCONSULTA:</td>
                        <td class="text-uppercase" style="width: 80%; font-size: 12.5px">{{ $consulta_interconsulta?$consulta_interconsulta->motivo_interconsulta:''}}</td>
                    </tr>
                </table>
                <table class="w-100 px-1 pb-1">
                    <tr>
                        <td class="fw-bold small" style="width: 50%; font-size: 12.5px">SERVICIO AL QUE SOLICITA LA INTERCONSULTA:</td>
                        <td class="text-uppercase" style="width: 58%; font-size: 12.5px">{{ $consulta_interconsulta?$consulta_interconsulta->interconsulta:''}}</td>
                    </tr>
                </table>
                <table class="w-100 border-top border-dark pb-5"></table>
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
    </table>
</body>
</html>