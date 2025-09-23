@extends('TEMPLATE.administrador')

@section('title', 'COBROS')

@section('css')

@endsection
 
@section('content')
<!-- Encabezado -->
    <div class="header_section">
        <div class="bg-transparent mb-3" style="height: 67px"></div>
        <div class="container-fluid">
            <div class="" data-aos="fade-right">
                <h1 class="titulo h2 text-uppercase fw-bold mb-0">COBROS</h1>
                <div class="" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="">Tesoreria</a></li>
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="{{ url('admin-cobros') }}">Cobros</a></li>
                        <li class="breadcrumb-item link" aria-current="page">Inicio</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
<!-- fin encabezado -->
 
{{-- Contenido --}}
<div class="container-fluid">   
    <div class="card border-4 borde-top-primary shadow-sm h-100" style="border-radius: 20px; min-height: 500px" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
        <div class="card-header bg-transparent">
            <div class="row g-1 justify-content-beetween">
                <div class="col-12 col-md-6 col-xl-2 mb-2 mb-lg-0">
                    @if($registro_caja)
                        <a href="{{ url("admin-cobros/create") }}" class="btn btn-secondary text-white text-uppercase btn-sm w-100">
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
                    <form method="POST" action="{{ route('admin-index-cobros.index_filtro') }}" enctype="multipart/form-data" autocomplete="off" class="needs-validation" novalidate>
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
                            <button class="bg-transparent border-0 px-0 mx-0" data-bs-toggle="modal" data-bs-target="#reporte_Excel"><i class="bi bi-file-excel me-2"></i><small>EXCEL</small></button>
                        </li>
                        <!-- <li class="dropdown-item">
                            <button class="bg-transparent border-0 px-0 mx-0" data-bs-toggle="modal" data-bs-target="#reporte_PDF"><i class="bi bi-file-pdf me-2"></i><small>PDF</small></button>
                        </li>                                                     -->
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6 mb-2 ">
                    <span class="text-uppercase">Total de registros encontrados: <span class="fw-bold" id="contador_registro">{{$cobros->count()}}</span></span>
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
            <table id="display" class="table table-hover table-sm" cellspacing="0" style="width:100%">
                <thead class="bg-dark text-white border-0">
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
                   
                <tbody id="index_cobros">
                        @php
                            $contador = 1;
                        @endphp  
                        @foreach ($cobros as $admin_cobro)
                            <tr class="">
                                <td class="fw-normal align-middle">{{ $contador }}</td>
                                <td class="fw-normal align-middle">{{ $admin_cobro->nro_operacion }}</td>
                                <td class="fw-normal align-middle">{{ $admin_cobro->cliente }}</td>
                                <td class="fw-normal align-middle">{{ $admin_cobro->ingreso }}</td>
                                <td class="fw-normal align-middle">{{ $admin_cobro->medio_pago }}</td>
                                <td class="fw-normal align-middle">{{ $admin_cobro->fecha }}</td>
                                <td class="fw-normal align-middle">{{ number_format($admin_cobro->total_cobrado, 2, '.', ',') }}</td>
                                <td class="align-middle">
                                    <div class="text-start text-md-center">
                                        <div class="dropstart">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown-item">
                                                    <!-- route('detalle_cobros.pdf', $admin_cobro->slug) -->
                                                    <a href="{{route('detalle_cobros.pdf', $admin_cobro->slug)}}" target="_blank" class="link-dark text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="top" title="Imprimir"><i class="bi bi-printer-fill me-2"></i>Imprimir</a>
                                                </li>
                                                
                                                <li class="dropdown-item">
                                                    <button type="button" class="link-dark bg-transparent mx-0 px-0 border-0" data-bs-toggle="modal" data-bs-target="#movimientos_registro_cobros{{$admin_cobro->slug}}">
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
@foreach ($cobros as $admin_cobro)
    @include('ADMINISTRADOR.TESORERIA.cobros.historial_cobros')            
@endforeach
    <!-- ADMINISTRADOR.TESORERIA.cobros.reporte_modal_pdf || ADMINISTRADOR.TESORERIA.cobros.reporte_modal_excel -->
    @include('ADMINISTRADOR.TESORERIA.cobros.reporte_modal_excel')
@endsection

@section('js')
<!--sweet alert agregar-->
    @if(session('addcobro') == 'ok')
    <script>
        Swal.fire({
        icon: 'success',
        confirmButtonColor: '#1C3146',
        title: '¡Éxito!',
        text: 'Cobro realizado correctamente',
        })
    </script>
    @endif

    @if(session('cerrar_caja') == 'ok')
    <script>
        Swal.fire({
        icon: 'success',
        confirmButtonColor: '#1C3146',
        title: '¡Éxito!',
        text: 'Caja cerrada correctamente',
        })
    </script>cerrar_caja
    @endif

    @if(session('addcobro_venta') == 'ok')
    <script>
        Swal.fire({
        icon: 'success',
        confirmButtonColor: '#1C3146',
        title: '¡Éxito!',
        text: 'Venta generada, procede a realizar el cobro',
        })
    </script>
    @endif

    <!--sweet alert actualizar-->
    @if(session('update') == 'ok')
    <script>
        Swal.fire({
        icon: 'success',
        confirmButtonColor: '#1C3146',
        title: '¡Actualizado!',
        text: 'Registro actualizado correctamente',
        })
    </script>
    @endif

    <!--sweet alert eliminar-->
    @if(session('delete') == 'ok')
    <script>
    Swal.fire({
        icon: 'success',
        confirmButtonColor: '#1C3146',
        title: '¡Eliminado!',
        text: 'Registro eliminado correctamente',
        })
    </script>
    @endif
    <script>
    $('.form-delete').submit(function(e){
        e.preventDefault();

        Swal.fire({
        title: '¿Estas seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#1C3146',
        cancelButtonColor: '#FF9C00',
        confirmButtonText: '¡Sí, eliminar!',
        cancelButtonText: 'Cancelar'
        }).then((result) => {
        if (result.isConfirmed) {
            
        this.submit();
        }
        })

    });
    </script>

    <script>
        $(document).ready(function() {
            $('#bfiltrar_dtable').on('click', function(){
                var fecha = $('#fechafiltrar_dtable').val();
                var autenticado = $('#valor_sede').val();
                contador_mp = 1;
                if(fecha){
                    $.get('/cobros/filtrar/fecha', {fecha: fecha,autenticado:autenticado}, function(progra){
                        $('#index_cobros').empty("");
                        $.each(progra, function(index, value){
                            if(value == 'vacio'){
                                $('#index_cobros').empty("");
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
                                '</td><td class="align-middle"><div class="text-start text-md-center"><div class="dropstart"><button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button><ul class="dropdown-menu"><li class="dropdown-item"><a href="admin-cobros/reporte-cobros-pdf/'+value[3]+'" target="_blank" class="link-dark text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="top" title="Imprimir"><i class="bi bi-printer-fill me-2"></i>Imprimir</a></li><li><hr class="dropdown-divider"></li><li class="dropdown-item"><button type="button" class="link-dark bg-transparent mx-0 px-0 border-0" data-bs-toggle="modal" data-bs-target="#movimientos_registro_cobros'+value[3]+'"><i class="bi bi-eye-fill me-2"></i>Detalles</button></li></ul></div></div></td></tr>';
                                $('#contador_registro').html(contador_mp);
                                contador_mp++;
                                $('#index_cobros').append(fila);
                            }
                        });
                    });
                }else{

                }
            });
        });
    </script>
@endsection