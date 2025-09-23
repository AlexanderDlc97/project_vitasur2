@extends('PLANTILLA.administrador')

@section('title', 'NOTAS DE CRÉDITO')

@section('css')

@endsection
 
@section('content')
<!-- Encabezado -->
    <div class="header_section">
        <div class="bg-transparent" style="height: 57px"></div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <h1 class="text-white h2 text-uppercase fw-bold mb-0">NOTAS DE CRÉDITO</h1>
                    <div class="" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-decoration-none link-light" href="">Tesoreria</a></li>
                            <li class="breadcrumb-item"><a class="text-decoration-none link-light" href="{{url('admin-notas-credito')}}">Notas de crédito</a></li>
                            <li class="breadcrumb-item text-white" aria-current="page">Inicio</li>
                        </ol>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    
                </div>
            </div>
        </div>
    </div>
<!-- fin encabezado -->

{{-- Contenido --}}
<div class="container-fluid">
    <div class="card border-4 borde-top-secondary shadow-sm mb-3" style="margin-top: -80px"  data-aos="fade-up" data-aos-anchor-placement="top-bottom">
        <div class="card-header bg-transparent">
            <div class="row justify-content-beetween">
                    @if(Gate::allows('gerencia',Auth()->user()))
                    <div class="col-12 col-md-6 col-xl-3 mb-2 mb-lg-0">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" id="basic-addon1">SEDES</span>
                            <select class="form-select form-select-sm text-uppercase" id="valor_sede" aria-label="Floating label select example">
                                <option selected="selected" hidden="hidden">-- Seleccione --</option>
                                <option value="TODOS">TODOS</option>
                                @foreach($sedes as $admin_cotizaciones_sede)
                                    <option value="{{$admin_cotizaciones_sede->id}}">{{ $admin_cotizaciones_sede->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-xl-3 mb-2 mb-lg-0">
                        <div class="input-group input-group-sm">
                            <input type="date" id="fechafiltrar_dtable" class="form-control">
                            <button class="btn btn-primary" type="button" id="bfiltrar_dtable"><i class="bi bi-search text-white"></i></button>
                            <input hidden id="valor_sede" value="{{Auth::user()->persona->sede_id}}">
                        </div>
                    </div>
                    <div class="col-6 col-md-3 col-xl-3 mb-2 mb-lg-0">
                        {{-- <div class="input-group input-group-sm">
                            <input type="date" class="form-control">
                            <input type="date" class="form-control">
                            <button class="btn btn-secondary"><i class="bi bi-search"></i></button>
                        </div> --}}
                    </div>
                    @else
                        <div class="col-12 col-md-3 col-xl-3 mb-2 mb-lg-0">
                            <div class="input-group input-group-sm">
                                <input type="date" id="fechafiltrar_dtable" class="form-control">
                                <button class="btn btn-primary" type="button" id="bfiltrar_dtable"><i class="bi bi-search text-white"></i></button>
                                <input hidden id="valor_sede" value="{{Auth::user()->persona->sede_id}}">
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-xl-6 mb-2 mb-lg-0">
                            {{-- <div class="input-group input-group-sm">
                                <input type="date" class="form-control">
                                <input type="date" class="form-control">
                                <button class="btn btn-secondary"><i class="bi bi-search"></i></button>
                            </div> --}}
                        </div>
                    @endif
                    <div class="col-12 col-md-3 col-xl-3">
                        <div class="btn-group me-2 w-100" role="group" aria-label="Basic example">
                            {{-- <button type="button" data-bs-toggle="modal" data-bs-target="#reporte_Excel" class="btn btn-dark border-light btn-sm px-4"><i class="bi bi-file-earmark-excel me-2"></i>EXCEL</button> --}}
                            <button type="button" data-bs-toggle="modal" data-bs-target="#reporte_PDF" class="btn btn-dark border-light btn-sm px-4"><i class="bi bi-file-earmark-pdf me-2"></i>PDF</button>
                        </div>
                    </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6 mb-2 ">
                    <span class="text-uppercase">Total de registros encontrados: <span class="fw-bold" id="contador_registro">{{$ventas->count()}}</span></span>
                </div>
                <div class="col-12 col-md-6 mb-2 d-flex justify-content-end">
                    @if(Gate::allows('gerencia',Auth()->user()))
                        <span class="text-uppercase">
                            @if(empty($name_sede))
                                <span class="text-uppercase">Sede: <span class="fw-bold" id="tipo_sede">Todos</span></span>
                            @else
                                <span class="text-uppercase">Sede: <span class="fw-bold" id="tipo_sede">{{ $name_sede->name }}</span></span>
                            @endif
                        </span>
                    @else   
                    @endif
                </div>
            </div>
            <table id="" class="display table table-hover table-sm py-2 text-start text-md-center" cellspacing="0" style="width:100%">
                <thead class="bg-light">
                    <tr>
                        <th class="h6 text-uppercase fw-bold small">N°</th>
                        <th class="h6 text-uppercase fw-bold small">Tipo</th>
                        <th class="h6 text-uppercase fw-bold small">Serie</th>
                        <th class="h6 text-uppercase fw-bold small">Correlativo</th>
                        <th class="h6 text-uppercase fw-bold small">Cliente</th>
                        <th class="h6 text-uppercase fw-bold small">Forma de pago</th>
                        <th class="h6 text-uppercase fw-bold small">Cuotas</th>
                        <th class="h6 text-uppercase fw-bold small">F. Vencimiento</th>
                        <th class="h6 text-uppercase fw-bold small">Total</th>
                        <th class="h6 text-uppercase fw-bold small text-center">Acciones</th>
                    </tr>
                </thead>
                   
                <tbody id="index_comprob">
                    @php
                        $contador = 1;
                    @endphp
                    @foreach ($notas_credito as $admin_notas_credito)
                        <tr>
                            <td class="fw-normal align-middle">{{ $contador }}</td>
                            <td class="fw-normal align-middle">{{ $admin_notas_credito->tipo_comprobante }}</td>
                            <td class="fw-normal align-middle">{{ $admin_notas_credito->serie }}</td>
                            <td class="fw-normal align-middle">{{ $admin_notas_credito->correlativo }}</td>
                            <td class="fw-normal align-middle">{{ $admin_notas_credito->nombre_cliente }}</td>
                            <td class="fw-normal align-middle">{{ $admin_notas_credito->forma_pago }}</td>
                            <td class="fw-normal align-middle">{{ $admin_notas_credito->plazo_pago }} CUOTA</td>
                            <td class="fw-normal align-middle">{{ $admin_notas_credito->fecha_vencimiento }}</td>
                            @if($admin_notas_credito->total_pago > 0)
                                <td class="fw-normal align-middle text-danger text-end">
                                    - {{ $admin_notas_credito->total_pago }}
                                </td>
                            @else
                                <td class="fw-normal align-middle text-success text-end">
                                    + {{ $admin_notas_credito->total_pago }}
                                </td>
                            @endif
                            <td class="fw-normal align-middle">
                                <div class="text-start text-md-center">
                                    <div class="dropstart">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown-item">
                                                <a href="" class="link-dark text-decoration-none"><i class="bi bi-eye-fill me-2"></i>Detalles</a>
                                            </li>
                                            @if($admin_notas_credito->tipocompref || $admin_notas_credito->tipo_comprobante == 'Nota de crédito' || $admin_notas_credito->valida_botton == '1' )
                                                <li class="dropdown-item disabled">
                                                    <button type="button" class="btn link-dark text-decoration-none btn-sm mx-0 px-0 border-0" data-bs-toggle="modal" id="id_nc{{$admin_notas_credito->id}}" value="{{$admin_notas_credito->id}}" onclick="miFunc({{$admin_notas_credito->id}})" data-bs-target="#ncredito{{$admin_notas_credito->slug}}"><i class="bi bi-file-text-fill me-2"></i>Nota de credito</button>
                                                </li>
                                            @else
                                                <li class="dropdown-item">
                                                    <button type="button" class="btn link-dark text-decoration-none btn-sm mx-0 px-0 border-0" data-bs-toggle="modal" id="id_nc{{$admin_notas_credito->id}}" value="{{$admin_notas_credito->id}}" onclick="miFunc({{$admin_notas_credito->id}})" data-bs-target="#ncredito{{$admin_notas_credito->slug}}"><i class="bi bi-file-text-fill me-2"></i>Nota de credito</button>
                                                </li>
                                            @endif
                                            @if($admin_notas_credito->tipocompref || $admin_notas_credito->tipo_comprobante == 'Nota de debito' || $admin_notas_credito->valida_botton == '1')
                                                <li class="dropdown-item disabled">
                                                    <a href="{{ url("admin-notadebitos/createnb/$admin_notas_credito->slug")}}" class="link-dark text-decoration-none"><i class="bi bi-file-earmark-plus-fill me-2"></i>Nota de debito</a>
                                                </li>
                                            @else
                                                <li class="dropdown-item">
                                                    <a href="{{ url("admin-notadebitos/createnb/$admin_notas_credito->slug")}}" class="link-dark text-decoration-none"><i class="bi bi-file-earmark-plus-fill me-2"></i>Nota de debito</a>
                                                </li>
                                            @endif
                                            <li class="dropdown-item">
                                                <a href="{{ route('print-comprobante.pdf', $admin_notas_credito->slug) }}" target="_blank" class="link-dark text-decoration-none"><i class="bi bi-filetype-pdf me-2"></i>Descargar PDF</a>
                                            </li>
                                            <li class="dropdown-item">
                                                <a download href="Comprobantes/Facturas/{{ $admin_notas_credito->created_at->isoFormat('Y') }}/{{ $admin_notas_credito->created_at->isoFormat('MMMM') }}/{{ $admin_notas_credito->nombrexml }}/{{ $admin_notas_credito->nombrexml }}.xml" class="link-dark text-decoration-none"><i class="bi bi-filetype-xml me-2"></i>Descagar XML</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div> 
                            </td>
                        </tr>
                        @php
                            $contador++;
                        @endphp
                    @endforeach
                </tbody>
               
            </table>
        </div>
    </div>
</div>
{{-- Fin contenido --}}
    @include('ADMINISTRADOR.TESORERIA.comprobantes-venta.reporte_modal_pdf')
    @include('ADMINISTRADOR.TESORERIA.comprobantes-venta.reporte_modal_excel')
    @foreach ($notas_credito as $admin_notas_credito)
        @include('ADMINISTRADOR.TESORERIA.comprobantes-venta.createnotac')            
    @endforeach
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#bfiltrar_dtable').on('click', function(){
                var fecha = $('#fechafiltrar_dtable').val();
                var autenticado = $('#valor_sede').val();
                contador_mp = 1;
                if(fecha){
                    $.get('/comprobantesV/filtrar/fecha', {fecha: fecha,autenticado:autenticado}, function(progra){
                        $('#index_comprob').empty("");
                        $.each(progra, function(index, value){
                            if(value == 'vacio'){
                                $('#index_comprob').empty("");
                                $('#contador_registro').html(0);
                                $('#tipo_sede').html("");
                            }else{

                                $('#tipo_sede').html(value[4]);
                                var fila = '<tr id="filamp' + contador_mp +
                                '"><td class="align-middle fw-normal">' + contador_mp + '</td><td class="align-middle fw-normal">' +
                                value[0] + '</td><td class="align-middle fw-normal">' + value[1] +
                                '</td><td class="align-middle fw-normal">' + value[2]+
                                '</td><td class="align-middle fw-normal">' + value[5]+
                                '</td><td class="align-middle fw-normal">' + value[6]+
                                '</td><td class="align-middle fw-normal">' + value[7] +
                                '</td><td class="align-middle fw-normal">' + value[8] +
                                '</td><td class="align-middle fw-normal">' + value[9] +
                                '</td><td class="fw-normal align-middle"><div class="text-start text-md-center"><div class="dropstart"><button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button><ul class="dropdown-menu"><li class="dropdown-item"><a href="" class="link-dark text-decoration-none"><i class="bi bi-eye-fill me-2"></i>Detalles</a></li><li class="dropdown-item"><a href="admin-comp-ventas/reporte-comprobante-pdf/'+value[3]+'" target="_blank" class="link-dark text-decoration-none"><i class="bi bi-filetype-pdf me-2"></i>Descargar PDF</a></li><li class="dropdown-item"><a href="" class="link-dark text-decoration-none"><i class="bi bi-filetype-xml me-2"></i>Descagar XML</a></li></ul></div></div></td> </tr>';
                                $('#contador_registro').html(contador_mp);
                                contador_mp++;
                                $('#index_comprob').append(fila);
                            }
                        });
                    });
                }else{

                }
            });
        });
    </script>
@endsection
@section('js')
@if(session('addndebito') == 'ok')
    <script>
        Swal.fire({
        icon: 'success',
        confirmButtonColor: '#1C3146',
        title: '¡Éxito!',
        text: 'Nota de Debito aplicado correctamente',
        })
    </script>
    @endif

@if(session('addncredito') == 'ok')
    <script>
        Swal.fire({
        icon: 'success',
        confirmButtonColor: '#1C3146',
        title: '¡Éxito!',
        text: 'Nota de Credito aplicado correctamente',
        })
    </script>
    @endif
@endsection