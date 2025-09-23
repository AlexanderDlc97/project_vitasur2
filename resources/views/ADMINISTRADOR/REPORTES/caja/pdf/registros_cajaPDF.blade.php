<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VITASUR | REPORTE DE CAJA - {{ $admin_caja->name_caja }}</title>
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
            margin-top: 2.9cm;
            margin-left: 1cm;
            margin-right: 1cm;
            margin-bottom: 1.5cm;
        }
    
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2.7cm;
            background-color: transparent;
        }

        header .contenedor{
            display: flex;
            justify-content: center;
            align-items: center;
        }
    
        footer {
            position: fixed; 
            bottom: 0.2cm; 
            left: 0cm; 
            right: 0cm;
            height: 2cm;
        }   



        .bg-primary{
            background-color: #76B82A;
        }

        .bg-success{
            background-color: #009929;
        }

        .bg-danger{
            background-color: #CD0C36;
        }

        .bg-warning{
            background-color: #ffc107;
        }

        .text-success{
            color: #009929;
        }

        .text-danger{
            color: #CD0C36;
        }

        .contenido
        {
            margin-top: 0cm;
            margin-left: 0cm;
            margin-right: 0cm;
            margin-bottom: 0.5cm;
        }

        .bg-plomo{
            background-color: #545454;
            color: #FFFFFF;
        }

        .texto-11{
            font-size: 11px;
        }
    </style>
</head>
<body>
    <header class="">
        <div class="container contenedor">
            <table class="w-100 mt-3">
                <td style="width: 15%">
                    <img src="{{ public_path('images/icon.png') }}" style="width: 85px; border-radius: 10px 0 10px 0" alt="">
                </td>
                <td style="width: 85%">
                    <table class="w-100 mt-3">
                        <td style="width: 45%" class="border-0 border-bottom border-1 border-dark">
                            <p class="text-uppercase mb-2 text-start fw-bold">Lista A/C {{ $admin_caja->name_caja.' | '.$admin_caja->sede->name }}</p>
                        </td>
                        <td style="width: 35%" class="border-0 border-bottom border-1 border-dark">
                            <span class="float-end text-uppercase fecha" style="font-size: 10px">
                                {{$now->isoFormat('dddd D \d\e MMMM \d\e\l Y'.' | '.$now->format('H:i:s'))}}
                            </span>
                        </td>
                    </table>
                    <table class="w-100 mt-1">
                        <td style="width: 100%" class="">
                            <p class="text-start text-uppercase mt-3 small texto-11">Total de registros Apertura/Cierre encontrados: <span class="badge bg-primary mt-1">{{$registrocaja->count()}}</span></p>
                        </td>
                    </table>
                </td>
            </table>
        </div>
    </header>
    <div class="contenido">
        @if(empty($fi && $ff))
        @else
            <div class="alert alert-light">
                <small class="fst-italic">*Se muestra los registros encontrados desde {{$fi}}, hasta {{$ff}} </small>
            </div> 
        @endif
        <table class="w-100 mt-2" style="font-size: 10px;">
            <thead class="">
                <tr>
                    <th class="border-0 border-bottom border-dark py-1 text-uppercase text-center">N°</th>
                    <th class="border-0 border-bottom border-dark py-1 text-uppercase text-center">F/H Apertura</th>
                    <th class="border-0 border-bottom border-dark py-1 text-uppercase text-center">F/H Cierre</th>
                    <th class="border-0 border-bottom border-dark py-1 text-uppercase text-center">Inicial</th>
                    <th class="border-0 border-bottom border-dark py-1 text-uppercase text-center">Ingreso</th>
                    <th class="border-0 border-bottom border-dark py-1 text-uppercase text-center">Egreso</th>
                    <th class="border-0 border-bottom border-dark py-1 text-uppercase text-center">Total</th>
                    <th class="border-0 border-bottom border-dark py-1 text-uppercase text-center">Estado</th>
                </tr>
            </thead>
                <tbody>
                    @php
                        $contador = 1;
                    @endphp
                    @foreach($registrocaja as $item)
                        <tr>
                            <td class="border-bottom py-1 border-dark text-center">{{ $contador }}</td>
                            <td class="border-bottom py-1 border-dark text-center">{{ $item->fecha_apertura.' / '.$item->hora_apertura }}</td>
                            <td class="border-bottom py-1 border-dark text-center">{{ $item->fecha_cierre.' / '.$item->hora_cierre }}</td>
                            <td class="border-bottom py-1 border-dark text-center">{{ number_format($item->saldo_inicial, 2, '.', ',') }}</td>
                            <td class="border-bottom py-1 border-dark text-center ">
                                 
                                <label class="text-success">+ {{ number_format($item->saldo_ingreso, 2, '.', ',') }}</label>
                            </td>
                            <td class="border-bottom py-1 border-dark text-center">
                                
                                <label class="text-danger">- {{ number_format($item->saldo_egreso, 2, '.', ',') }}</label>
                            </td>
                            <td class="border-bottom py-1 border-dark text-center">{{ number_format(($item->saldo_inicial+$item->saldo_ingreso)-$item->saldo_egreso, 2, '.', ',') }}</td>
                            <td class="border-bottom py-1 border-dark text-center">
                                @if($item->estado == 'APERTURADA')
                                    <span class="badge bg-success text-uppercase small">Aperturada</span>
                                @else
                                    <span class="badge bg-danger text-uppercase small">Cerrada</span>
                                @endif
                            </td>
                        </tr> 
                        @php
                            $contador++;
                        @endphp
                    @endforeach
                </tbody>
        </table>         
    </div>

    <footer>
        <script type="text/php">
            if ( isset($pdf) ) {
                $pdf->page_script('
                    $font = $fontMetrics->get_font("Roboto, sans-serif", "normal");
                    $pdf->text(270, 820, "PÁGINA $PAGE_NUM DE $PAGE_COUNT", $font, 8);
                ');
            }
        </script>
    </footer>
</body>
</html>