<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VITASUR | REPORTE MOVIMIENTOS DE CAJA - {{ $registro->codigo }}</title>
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
            background-image: url({{ asset('images/wallpaper_document.png') }});
            background-repeat: no-repeat;
            background-size: 100% auto;
            background-attachment: fixed;
            background-position: center;
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

        .bg-encabezado{
            background-color: #e0e0e0;
        }

        .border-encabezado{
            border-color: #bfbfbf !important;
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
                            <p class="text-uppercase mb-2 text-start fw-bold">Movimiento de caja</p>
                        </td>
                        <td style="width: 35%" class="border-0 border-bottom border-1 border-dark">
                            <span class="float-end text-uppercase fecha" style="font-size: 10px">
                                {{$now->isoFormat('dddd D \d\e MMMM \d\e\l Y'.' | '.$now->format('H:i:s'))}}
                            </span>
                        </td>
                    </table>
                    <table class="w-100 mt-1">
                        <td style="width: 100%" class="">
                            <p class="text-start text-uppercase mt-1 small">{{ $registro->codigo }}</p>
                        </td>
                    </table>
                </td>
            </table>
        </div>
    </header>
    <div class="contenido">
        <table class="mt-2 mb-2" style="width: 100%; font-size: 10px">
            <thead class="bg-encabezado">
                <th class="text-uppercase border border-encabezado text-center py-1 fw-bold small" style=" width: 14.5%">F/H Apertura</th>
                <th class="text-uppercase border border-encabezado text-center py-1 fw-bold small" style=" width: 14.5%">F/H Cierre</th>
                <th class="text-uppercase border border-encabezado text-center py-1 fw-bold small" style=" width: 14.5%">Inicial</th>
                <th class="text-uppercase border border-encabezado text-center py-1 fw-bold small" style=" width: 14.5%">Ingreso</th>
                <th class="text-uppercase border border-encabezado text-center py-1 fw-bold small" style=" width: 14.5%">Egreso</th>
                <th class="text-uppercase border border-encabezado text-center py-1 fw-bold small" style=" width: 14.5%">Total</th>
                <th class="text-uppercase border border-encabezado text-center py-1 fw-bold small" style=" width: 13%">Estado</th>
            </thead>
            <tbody class="bg-cuerpo">
                <tr>
                    <td class="text-uppercase border border-encabezado text-center py-2 fw-normal small">{{ $registro->fecha_apertura.' / '.$registro->hora_apertura }}</td>
                    <td class="text-uppercase border border-encabezado text-center py-2 fw-normal small">{{ $registro->fecha_cierre.' / '.$registro->hora_cierre }}</td>
                    <td class="text-uppercase border border-encabezado text-center py-2 fw-normal small">{{ number_format($registro->saldo_inicial, 2, '.', ',') }}</td>
                    <td class="text-uppercase border border-encabezado text-center py-2 fw-normal small text-success">+ {{ number_format($registro->saldo_ingreso, 2, '.', ',') }}</td>
                    <td class="text-uppercase border border-encabezado text-center py-2 fw-normal small text-danger">- {{ number_format($registro->saldo_egreso, 2, '.', ',') }}</td>
                    <td class="text-uppercase border border-encabezado text-center py-2 fw-normal small">{{ number_format(($registro->saldo_inicial+$registro->saldo_ingreso)-$registro->saldo_egreso, 2, '.', ',') }}</td>
                    <td class="text-uppercase border border-encabezado text-center py-2 fw-normal small">
                        @if($registro->estado == 'APERTURADA')
                            <span class="badge bg-success text-uppercase small">Aperturada</span>
                        @else
                            <span class="badge bg-danger text-uppercase small">Cerrada</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="w-100 mt-2" style="font-size: 10px;">
            <thead class="">
                <tr>
                    <th class="border-0 border-bottom border-dark py-1 text-uppercase text-center">N°</th>
                    <th class="border-0 border-bottom border-dark py-1 text-uppercase text-center">MOTIVO</th>
                    <th class="border-0 border-bottom border-dark py-1 text-uppercase text-center">ASUNTO</th>
                    <th class="border-0 border-bottom border-dark py-1 text-uppercase text-center">TOTAL</th>
                    <th class="border-0 border-bottom border-dark py-1 text-uppercase text-center">MEDIO PAGO</th>
                </tr>
            </thead>
                <tbody>
                    @php
                        $contador = 1;
                    @endphp
                    @foreach($mov_registro_caja as $item)
                        <tr>
                            <td class="border-bottom py-1 border-dark text-center">{{ $contador }}</td>
                            <td class="border-bottom py-1 border-dark text-center">{{ $item->motivo }}</td>
                            <td class="border-bottom py-1 border-dark text-center">{{ $item->asunto }}</td>
                            @if($item->operaciones == 'PAGO')
                                <td class="border-bottom py-1 border-dark text-center">
                                    <label class="text-danger">S/ {{ $item->total }}</label>
                                </td>
                            @else
                                <td class="border-bottom py-1 border-dark text-center">
                                    <label class="text-success">S/ {{ $item->total }}</label>
                                </td>
                            @endif
                            
                            <td class="border-bottom py-1 border-dark text-center">{{ $item->metodo }}</td>
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