@extends('TEMPLATE.administrador')

@section('title', 'PAGOS')

@section('css')

@endsection
 
@section('content')
<!-- Encabezado -->
<div class="header_section">
        <div class="bg-transparent mb-3" style="height: 67px"></div>
        <div class="container-fluid">
            <div class="" data-aos="fade-right">
                <h1 class="titulo h2 text-uppercase fw-bold mb-0">PAGOS</h1>
                <div class="" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="">Tesoreria</a></li>
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="{{ url('admin-pagos') }}">Pagos</a></li>
                        <li class="breadcrumb-item link" aria-current="page">Inicio</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
<!-- Fin encabezado-->

{{-- Contenido --}}
<div class="container-fluid">   
    <div class="card border-4 borde-top-primary shadow-sm h-100" style="border-radius: 20px; min-height: 500px" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
        <div class="card-header bg-transparent">
            <div class="row g-1 justify-content-beetween">
                <div class="col-12 col-md-6 col-xl-2 mb-2 mb-lg-0">
                    @if($registro_caja)
                        <a href="{{ url("admin-pagos/create") }}" class="btn btn-secondary text-white text-uppercase btn-sm w-100">
                            <i class="bi bi-plus-circle me-2"></i>
                            Nuevo Registro
                        </a>
                    @else
                        <button type="button" data-bs-toggle="modal" data-bs-target="#cajacerrada" class="btn text-uppercase btn-secondary text-white btn-sm w-100">
                            <i class="bi bi-plus-circle-fill me-2"></i>
                            Nuevo Registro
                        </button>
                    @endif
                </div>
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
                <div class="col-12 col-md-3 col-xl-3 mb-2 mb-lg-0">
                    <form method="POST" action="{{ route('admin-index-pagos.index_filtro') }}" enctype="multipart/form-data" autocomplete="off" class="needs-validation" novalidate>
                    @csrf
                        <div class="input-group input-group-sm">
                            <input type="date" name="fec_ini" id="fini__id" class="form-control">
                            <input type="date" name="fec_fin" id="ffin__id" class="form-control">
                            <button class="btn btn-primary" type="submit" id="bfiltrar_dtable"><i class="bi bi-search text-white"></i></button>
                        </div>
                    </form>
                </div>
                <div class="col-6 col-md-3 col-xl-3 mb-2 mb-lg-0">
                </div>
                <div class="col-12 col-md-6 col-lg-3 col-xl-1 mb-2 mb-lg-0">
                    <button type="button" class="btn btn-dark btn-sm w-100" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-download"></i></button>
                    <ul class="dropdown-menu">      
                        <li class="dropdown-item">
                            <button class="bg-transparent border-0 px-0 mx-0" id="button_excell" data-bs-toggle="modal" data-bs-target="#reporte_Excel"><i class="bi bi-file-excel me-2"></i><small>EXCEL</small></button>
                        </li>
                        <!-- <li class="dropdown-item">
                            <button class="bg-transparent border-0 px-0 mx-0" id="button_pdfs" data-bs-toggle="modal" data-bs-target="#reporte_PDF"><i class="bi bi-file-pdf me-2"></i><small>PDF</small></button>
                        </li>                                                     -->
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6 mb-2 ">
                    <span class="text-uppercase">Total de registros encontrados: <span class="fw-bold" id="contador_registro">{{$pagos->count()}}</span></span>
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
            <table id="display" class="table table-hover table-sm py-2 text-start text-md-center" cellspacing="0" style="width:100%">
                <thead class="bg-light">
                    <tr>
                        <th class="h6 text-uppercase fw-bold small">N°</th>
                        <th class="h6 text-uppercase fw-bold small">operación</th>
                        <th class="h6 text-uppercase fw-bold small">Nombre o razón social</th>
                        <th class="h6 text-uppercase fw-bold small">Cuenta</th>
                        <th class="h6 text-uppercase fw-bold small">Medio Pago</th>
                        <th class="h6 text-uppercase fw-bold small">Fecha</th>
                        <th class="h6 text-uppercase fw-bold small">Total</th>
                        <th class="h6 text-uppercase fw-bold small text-center">Acciones</th>
                    </tr>
                </thead>
                   
                <tbody id="index_pagos">
                        @php
                            $contador = 1;
                        @endphp  
                        @foreach ($pagos as $admin_pago)
                            <tr class="">
                                <td class="fw-normal align-middle">{{ $contador }}</td>
                                <td class="fw-normal align-middle">{{ $admin_pago->nro_operacion }}</td>
                                <td class="fw-normal align-middle">{{ $admin_pago->proveedor }}</td>
                                <td class="fw-normal align-middle">{{ $admin_pago->egreso }}</td>
                                <td class="fw-normal align-middle">{{ $admin_pago->medio_pago }}</td>
                                <td class="fw-normal align-middle">{{ $admin_pago->fecha }}</td>
                                <td class="fw-normal align-middle">{{ number_format($admin_pago->total_pagado, 2, '.', ',') }}</td>
                                <td class="align-middle">
                                    <div class="text-start text-md-center">
                                        <div class="dropstart">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown-item">
                                                    <!-- route('detalle_pagos.pdf', $admin_pago->slug -->
                                                    <a href="{{route('detalle_pagos.pdf', $admin_pago->slug)}}" target="_blank" class="link-dark text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="top" title="Imprimir"><i class="bi bi-printer-fill me-2"></i>Imprimir</a>
                                                </li>
                            
                                                <li class="dropdown-item">
                                                    <button type="button" class="link-dark bg-transparent mx-0 px-0 border-0" data-bs-toggle="modal" data-bs-target="#movimientos_registro_pagos{{$admin_pago->slug}}">
                                                        <i class="bi bi-eye-fill me-2"></i>
                                                        Detalles
                                                    </button>
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
@foreach ($pagos as $admin_pago)
    @include('ADMINISTRADOR.TESORERIA.pagos.historial_pagos')            
@endforeach
    <!-- pdf : ADMINISTRADOR.TESORERIA.pagos.reporte_modal_pdf || excel: ADMINISTRADOR.TESORERIA.pagos.reporte_modal_excel-->
    @include('ADMINISTRADOR.TESORERIA.pagos.caja_cerrada')
    @include('ADMINISTRADOR.TESORERIA.pagos.reporte_modal_excel')
@endsection

@section('js')
    @if(session('addpago') == 'ok')
        <script>
            Swal.fire({
            icon: 'success',
            confirmButtonColor: '#1C3146',
            title: '¡Éxito!',
            text: 'Pago realizado correctamente',
            })
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('#id_concepto_pdf').on('change', function(){
                valor_apli = $(this).val();
                if(valor_apli == 'Empleado'){
                    $.get('/trans_filtro_pdf', {aplicacion: 'Empleado'}, function(empleado_codigo){
                        $('#id_proveedor_pdf').empty();
                        $('#id_proveedor_pdf').append('<option selected>Selecciona una opcion</option>');
                        $.each(empleado_codigo, function(index, value){
                            $('#id_proveedor_pdf').append('<option value="'+value[0]+'">'+value[0]+' '+value[1]+' '+value[2]+'</option>');
                        });
                    });
                }if(valor_apli == 'Vendedor'){
                    $('#etiqueta_a').html('Vendedores');
                    $.get('/trans_filtro_pdf', {aplicacion: 'Vendedor'}, function(vendedor_codigo){
                        $('#id_proveedor_pdf').empty();
                        $('#id_proveedor_pdf').append('<option selected>Selecciona una opcion</option>');
                        $.each(vendedor_codigo, function(index, value){
                            $('#id_proveedor_pdf').append('<option value="'+value[0]+'">'+value[0]+'</option>');
                        });
                    });
                }if(valor_apli == 'Servicio'){
                   $.get('/trans_filtro_pdf', {aplicacion: 'Servicio'}, function(empleado_codigo){
                        $('#id_proveedor_pdf').empty();
                        $('#id_proveedor_pdf').append('<option selected>Selecciona una opcion</option>');
                        $.each(empleado_codigo, function(index, value){
                            if(value[0] == 'vacio'){
                            }else{
                                $('#id_proveedor_pdf').append('<option value="'+value[0]+'">'+value[0]+'</option>');
                            }
                        });
                    }); 
                }else{
                    $.get('/trans_filtro_pdf', {aplicacion: 'COMPRA'}, function(empleado_codigo){
                        $('#id_proveedor_pdf').empty();
                        $('#id_proveedor_pdf').append('<option selected>Selecciona una opcion</option>');
                        $.each(empleado_codigo, function(index, value){
                            if(value[0] == 'vacio'){
                            }else{
                                $('#id_proveedor_pdf').append('<option value="'+value[0]+'">'+value[0]+'</option>');
                            }
                        });
                    }); 
                }
            });
            
            $('#id_concepto_excel').on('change', function(){
                valor_apli = $(this).val();
                if(valor_apli == 'Empleado'){
                    $.get('/trans_filtro_pdf', {aplicacion: 'Empleado'}, function(empleado_codigo){
                        $('#id_proveedor_excel').empty();
                        $('#id_proveedor_excel').append('<option selected>Selecciona una opcion</option>');
                        $.each(empleado_codigo, function(index, value){
                            $('#id_proveedor_excel').append('<option value="'+value[0]+'">'+value[0]+' '+value[1]+' '+value[2]+'</option>');
                        });
                    });
                }if(valor_apli == 'Vendedor'){
                    $('#etiqueta_a').html('Vendedores');
                    $.get('/trans_filtro_pdf', {aplicacion: 'Vendedor'}, function(vendedor_codigo){
                        $('#id_proveedor_excel').empty();
                        $('#id_proveedor_excel').append('<option selected>Selecciona una opcion</option>');
                        $.each(vendedor_codigo, function(index, value){
                            $('#id_proveedor_excel').append('<option value="'+value[0]+'">'+value[0]+'</option>');
                        });
                    });
                }if(valor_apli == 'Servicio'){
                   $.get('/trans_filtro_pdf', {aplicacion: 'Servicio'}, function(empleado_codigo){
                        $('#id_proveedor_excel').empty();
                        $('#id_proveedor_excel').append('<option selected>Selecciona una opcion</option>');
                        $.each(empleado_codigo, function(index, value){
                            if(value[0] == 'vacio'){
                            }else{
                                $('#id_proveedor_excel').append('<option value="'+value[0]+'">'+value[0]+'</option>');
                            }
                        });
                    }); 
                }else{
                    $.get('/trans_filtro_pdf', {aplicacion: 'COMPRA'}, function(empleado_codigo){
                        $('#id_proveedor_excel').empty();
                        $('#id_proveedor_excel').append('<option selected>Selecciona una opcion</option>');
                        $.each(empleado_codigo, function(index, value){
                            if(value[0] == 'vacio'){
                            }else{
                                $('#id_proveedor_excel').append('<option value="'+value[0]+'">'+value[0]+'</option>');
                            }
                        });
                    }); 
                }
            });
                        
            $('#bfiltrar_dtable').on('click', function(){
                var fecha = $('#fechafiltrar_dtable').val();
                var autenticado = $('#valor_sede').val();
                contador_mp = 1;
                if(fecha){
                    $.get('/pagos/filtrar/fecha', {fecha: fecha,autenticado:autenticado}, function(progra){
                        $('#index_pagos').empty("");
                        $.each(progra, function(index, value){
                            if(value == 'vacio'){
                                $('#index_pagos').empty("");
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
                                '</td><td class="align-middle"><div class="text-start text-md-center"><div class="dropstart"><button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button><ul class="dropdown-menu"><li class="dropdown-item"><a href="admin-pagos/reporte-pagos-pdf/'+value[3]+'" target="_blank" class="link-dark text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="top" title="Imprimir"><i class="bi bi-printer-fill me-2"></i>Imprimir</a></li><li><hr class="dropdown-divider"></li><li class="dropdown-item"><button type="button" class="link-dark bg-transparent mx-0 px-0 border-0" data-bs-toggle="modal" data-bs-target="#movimientos_registro_cobros'+value[3]+'"><i class="bi bi-eye-fill me-2"></i>Detalles</button></li></ul></div></div></td></tr>';
                                $('#contador_registro').html(contador_mp);
                                contador_mp++;
                                $('#index_pagos').append(fila);
                            }
                        });
                    });
                }else{

                }
            });
            
            
            $('button[id=button_pdfs]').on('click', function(){
                $('#id_proveedor_pdf').select2({
                    dropdownParent: $('#reporte_PDF')
                });
                $('#id_concepto_pdf').select2({
                    dropdownParent: $('#reporte_PDF')
                });
            });
            
            $('button[id=button_excell]').on('click', function(){
                $('#id_proveedor_excel').select2({
                    dropdownParent: $('#reporte_Excel')
                });
                $('#id_concepto_excel').select2({
                    dropdownParent: $('#reporte_Excel')
                });
            });
        });
    </script>
@endsection