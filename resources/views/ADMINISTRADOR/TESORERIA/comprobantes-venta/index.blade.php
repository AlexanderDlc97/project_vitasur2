@extends('PLANTILLA.administrador')

@section('title', 'COMPROBANTES DE VENTA')

@section('css')

@endsection
 
@section('content')
<!-- Encabezado -->
    <div class="header_section">
        <div class="bg-transparent" style="height: 57px"></div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <h1 class="text-white h2 text-uppercase fw-bold mb-0">COMPROBANTES DE VENTA</h1>
                    <div class="" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-decoration-none link-light" href="">Tesoreria</a></li>
                            <li class="breadcrumb-item"><a class="text-decoration-none link-light" href="{{ url('admin-comp-ventas') }}">Comprobantes de venta</a></li>
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
            <div class="row g-1 justify-content-beetween">
                <div class="col-6 col-md-3 col-xl-3 mb-2 mb-lg-0">
                    @if(Gate::allows('gerencia',Auth()->user()))
                    <div class="input-group input-group-sm">
                        <span class="input-group-text" id="basic-addon1">SEDES</span>
                            <select class="form-select form-select-sm select_location text-uppercase" id="floatingSelect" aria-label="Floating label select example">
                                <option selected="selected" hidden="hidden">-- Seleccione --</option>
                                <option value="{{ url('admin-ingresos') }}">TODOS</option>
                                @foreach($sedes as $admin_ingresos_sede)
                                    <option value="{{ route('ingresos.sede', $admin_ingresos_sede) }}">{{ $admin_ingresos_sede->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @else
                    
                    @endif
                </div>
                <div class="col-12 col-md-6 col-xl-3 mb-2 mb-lg-0">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text" id="basic-addon1">TIPO</span>
                        <select class="form-select form-select-sm" id="floatingSelect" aria-label="Floating label select example">
                            <option selected>TODOS</option>
                            <option value="">BOLETA DE VENTA</option>
                            <option value="">FACTURA</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-3 col-xl-3 mb-2 mb-lg-0">
                    <div class="input-group input-group-sm">
                        <input type="date" name="fec_ini" id="fini__id" class="form-control">
                        <input type="date" name="fec_fin" id="ffin__id" class="form-control">
                        <button class="btn btn-primary" type="button" id="bfiltrar_dtable"><i class="bi bi-search text-white"></i></button>
                    </div>
                </div>
                <div class="col-6 col-md-3 col-xl-2 mb-2 mb-lg-0">
                </div>
                <div class="col-12 col-md-6 col-lg-3 col-xl-1 mb-2 mb-lg-0">
                    <button type="button" class="btn btn-dark btn-sm w-100" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-download"></i></button>
                    <ul class="dropdown-menu">      
                        <li class="dropdown-item">
                            <button class="bg-transparent border-0 px-0 mx-0" data-bs-toggle="modal" data-bs-target="#reporte_Excel"><i class="bi bi-file-excel me-2"></i><small>EXCEL</small></button>
                        </li>                                            
                        <li class="dropdown-item">
                            <button class="bg-transparent border-0 px-0 mx-0" data-bs-toggle="modal" data-bs-target="#reporte_PDF"><i class="bi bi-file-pdf me-2"></i><small>PDF</small></button>
                        </li>                                                    
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6 mb-2 ">
                    <span class="text-uppercase">Total de registros encontrados: <span class="fw-bold" id="contador_registro">{{ $ventas->count() }}</span></span>
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
                        <th class="h6 text-uppercase fw-bold small">Comprobante</th>
                        <th class="h6 text-uppercase fw-bold small">Cliente</th>
                        <th class="h6 text-uppercase fw-bold small">F. pago</th>
                        <th class="h6 text-uppercase fw-bold small">F. Vencimiento</th>
                        <th class="h6 text-uppercase fw-bold small">Total</th>
                        <th class="h6 text-uppercase fw-bold small">Estado</th>
                        <th class="h6 text-uppercase fw-bold small text-center">Acciones</th>
                    </tr>
                </thead>
                   
                <tbody id="index_comprob">
                    @php
                        $contador = 1;
                    @endphp
                    @foreach ($ventas as $admin_comp_venta)
                        <tr>
                            <td class="fw-normal align-middle">{{ $contador }}</td>
                            <td class="fw-normal align-middle text-uppercase small"><small>{{ $admin_comp_venta->tipo_comprobante.': '.$admin_comp_venta->serie.'-'.$admin_comp_venta->correlativo }}</small></td>
                            <td class="fw-normal align-middle small">
                                <p class="mb-0 text-uppercase small">{{ $admin_comp_venta->razon_social }}</p>
                                <small>{{ $admin_comp_venta->nombre_cliente }}</small>
                            </td>
                            <td class="fw-normal align-middle text-uppercase small">{{ $admin_comp_venta->forma_pago }}</td>
                            <td class="fw-normal align-middle">{{ $admin_comp_venta->fecha_vencimiento }}</td>
                            <td class="fw-normal align-middle">{{ number_format($admin_comp_venta->total, 2, '.', ',') }}</td>
                            <td class="fw-normal align-middle small">
                                @if($admin_comp_venta->simpleubl_estado_id == 'A')
                                    <span class="badge bg-success small text-uppercase fw-bold">Aceptado</span>
                                @elseif($admin_comp_venta->simpleubl_estado_id == 'B')
                                    <span class="badge bg-warning small text-uppercase fw-bold">POR ANULAR</span>
                                @elseif($admin_comp_venta->simpleubl_estado_id == 'N')
                                    <span class="badge bg-warning small text-uppercase fw-bold">ERROR DE ENVIO</span>
                                @elseif($admin_comp_venta->simpleubl_estado_id == 'O')
                                    <span class="badge bg-success small text-uppercase fw-bold">Aceptado (OBSERVADO)</span>
                                @elseif($admin_comp_venta->simpleubl_estado_id == 'NCDR')
                                    <span class="badge bg-warning small text-uppercase fw-bold">ERROR DE CDR</span>
                                @elseif($admin_comp_venta->simpleubl_estado_id == 'AR')
                                    <span class="badge bg-success small text-uppercase fw-bold">ACEPTADO EN RESUMEN</span>
                                @elseif($admin_comp_venta->simpleubl_estado_id == 'R')
                                    <span class="badge bg-danger small text-uppercase fw-bold">RECHAZADO</span>
                                @elseif($admin_comp_venta->simpleubl_estado_id == 'P')
                                    <span class="badge bg-danger small text-uppercase fw-bold">PENDIENTE</span>
                                @elseif($admin_comp_venta->simpleubl_estado_id == 'C')
                                    <span class="badge bg-danger small text-uppercase fw-bold">ANULADO</span>
                                @elseif($admin_comp_venta->simpleubl_estado_id == 'V')
                                    <span class="badge bg-info small text-uppercase fw-bold">REVERTIDO</span>
                                @else
                                    <span class="badge bg-secondary small text-uppercase fw-bold">POR VERIFICAR</span>
                                @endif
                                {{-- <span class="badge bg-secondary small text-uppercase fw-bold">Enviado</span>   --}}
                                {{-- <span class="badge bg-danger small text-uppercase fw-bold">Rechazado</span>     --}}
                            </td>
                            <td class="fw-normal align-middle">
                                <div class="text-start text-md-center">
                                    <div class="dropstart">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown-item">
                                                <a href="{{ url("admin-comp-ventas/$admin_comp_venta->slug") }}" class="link-dark text-decoration-none"><i class="bi bi-eye-fill me-2"></i>Detalles</a>
                                            </li>
                                            
                                            {{-- <li class="dropdown-item">
                                                <button class="bg-transparent border-0 px-0 mx-0" data-bs-toggle="modal" data-bs-target="#printcomp{{ $admin_comp_venta->slug }}"><i class="bi bi-printer-fill me-2"></i>Imprimir</button>
                                            </li> --}}
                                            @if($admin_comp_venta->credito_debito == '1')
                                            @else
                                                <li class="dropdown-item">
                                                    <button class="bg-transparent border-0 px-0 mx-0" data-bs-toggle="modal" data-bs-target="#anularcomp{{ $admin_comp_venta->slug }}"><i class="bi bi-x-circle-fill me-2"></i>Anular</button>
                                                </li>
                                            @endif
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
    @foreach($ventas as $admin_comp_venta)
        {{-- @include('ADMINISTRADOR.TESORERIA.comprobantes-venta.comprobantes_modal') --}}
        @include('ADMINISTRADOR.TESORERIA.comprobantes-venta.anular_comprobante')
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


@if(session('addanulacionnc') == 'ok')
    <script>
        Swal.fire({
        icon: 'success',
        confirmButtonColor: '#1C3146',
        title: '¡Éxito!',
        text: 'Nota de Crèdito aplicada correctamente',
        })
    </script>
@endif

@if(session('addanulaciond') == 'ok')
    <script>
        Swal.fire({
        icon: 'success',
        confirmButtonColor: '#1C3146',
        title: '¡Éxito!',
        text: 'Anulacion directa aplicada correctamente',
        })
    </script>
    @endif

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