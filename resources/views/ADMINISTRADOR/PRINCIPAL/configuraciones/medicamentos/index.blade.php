@extends('TEMPLATE.administrador')

@if(Auth::user()->role_id == '1'|| Auth::user()->role_id == '4')
@section('title', 'BIENES')
@elseif(Auth::user()->role_id == '5')
@section('title', 'MEDICAMENTOS')
@endif

@section('css')
@endsection
 
@section('content')
<!-- Encabezado -->
    <div class="header_section">
        <div class="bg-transparent mb-3" style="height: 67px"></div>
        <div class="container-fluid">
            @if(Auth::user()->role_id == '1'|| Auth::user()->role_id == '4')
                <div class="" data-aos="fade-right">
                    <h1 class="titulo h2 text-uppercase fw-bold mb-0">BIENES</h1>
                    <div class="" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-decoration-none link" href="">Principal</a></li>
                            <li class="breadcrumb-item"><a class="text-decoration-none link" href="{{ url('admin-configuraciones') }}">Configuraciones</a></li>
                            <li class="breadcrumb-item"><a class="text-decoration-none link" href="{{ url('admin-medicamentos') }}">Bienes</a></li>
                            <li class="breadcrumb-item link" aria-current="page">Inicio</li>
                        </ol>
                    </div>
                </div>
                @elseif(Auth::user()->role_id == '5')
                <div class="" data-aos="fade-right">
                    <h1 class="titulo h2 text-uppercase fw-bold mb-0">MEDICAMENTOS</h1>
                    <div class="" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-decoration-none link" href="">Principal</a></li>
                            <li class="breadcrumb-item"><a class="text-decoration-none link" href="{{ url('admin-configuraciones') }}">Configuraciones</a></li>
                            <li class="breadcrumb-item"><a class="text-decoration-none link" href="{{ url('admin-medicamentos') }}">Medicamentos</a></li>
                            <li class="breadcrumb-item link" aria-current="page">Inicio</li>
                        </ol>
                    </div>
                </div>
                @endif
        </div>
    </div>
<!-- Fin encabezado-->

{{-- Contenido --}}
    <div class="container-fluid">   
        <div class="card border-4 borde-top-primary shadow-sm h-100" style="border-radius: 20px; min-height: 500px" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
            <div class="card-header bg-transparent">
                <div class="row justify-content-between">
                    <div class="col-9 col-md-3 col-xl-2 mb-2 mb-lg-0 order-1 order-md-1 order-lg-1 order-xl-1">
                        <a href="{{ route('admin-medicamentos.create') }}" class="btn btn-primary btn-sm text-uppercase text-white w-100" style="border-radius: 20px">
                            <i class="bi bi-plus-circle me-2"></i>
                            Nuevo registro
                        </a>
                    </div>
                    <div class="col-3 col-md-2 col-xl-1 mb-2 mb-lg-0 order-2 order-md-3 order-lg-3 order-xl-3">
                    <button type="button" class="btn btn-dark btn-sm w-100" style="border-radius: 20px" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-download"></i></button>
                    <ul class="dropdown-menu">      
                        <li class="dropdown-item">
                            <button class="bg-transparent border-0 px-0 mx-0" data-bs-toggle="modal" data-bs-target="#reporte_Excel"><i class="bi bi-file-excel me-2"></i><small>EXCEL</small></button>
                        </li>                                            
                        <!--<li class="dropdown-item">
                            <button class="bg-transparent border-0 px-0 mx-0" data-bs-toggle="modal" data-bs-target="#reporte_PDF"><i class="bi bi-file-pdf me-2"></i><small>PDF</small></button>
                        </li>-->                                                       
                    </ul>
                </div>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-2 col-12 col-md-6">
                    <span class="text-uppercase">Total de registros encontrados: <span class="fw-bold">{{ number_format($admin_medicamentos->count(), 0,'.',',') }}</span></span>
                </div>
                <table id="display" class="table table-hover table-sm" cellspacing="0" style="width:100%">
                    <thead class="bg-dark text-white border-0">
                        <tr>
                            <th class="h6 small text-center text-uppercase fw-bold">N°</th>
                            <th class="h6 small text-center text-uppercase fw-bold">Nombre</th>
                            <th class="h6 small text-center text-uppercase fw-bold">Clasificacion</th>
                            <th class="h6 small text-center text-uppercase fw-bold">U. M.</th>
                            <th class="h6 small text-center text-uppercase fw-bold">Cantidad</th>
                            <th class="h6 small text-center text-uppercase fw-bold">Precio</th>
                            <th class="h6 small text-center text-uppercase fw-bold">Tipo de Bien</th>
                            <th class="h6 small text-center text-uppercase fw-bold">Estado</th>
                            <th class="h6 small text-center text-uppercase fw-bold">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $contador = 1;
                        @endphp
                        @foreach ($admin_medicamentos as $admin_medicamento)
                            <tr>
                                <td class="fw-normal text-center align-middle">{{ $contador }}</td>
                                <td class="fw-normal text-center align-middle">{{ $admin_medicamento->name }}</td>
                                <td class="fw-normal text-center align-middle">{{ $admin_medicamento->clasificacion?$admin_medicamento->clasificacion->name:'Otros' }}</td>
                                <td class="fw-normal text-center align-middle">{{ $admin_medicamento->unidad_medida }}</td>
                                <td class="fw-normal text-center align-middle">
                                    @if(empty($admin_medicamento->cantidad))
                                        -
                                    @else
                                        {{ $admin_medicamento->cantidad }}
                                    @endif
                                </td>
                                <td class="fw-normal text-center align-middle">{{ number_format($admin_medicamento->precio_venta, 2,'.',',') }}</td>
                                <td class="fw-normal text-center align-middle">{{ $admin_medicamento->tipo_producto}}</td>
                                <td class="fw-normal text-center align-middle small">
                                    <form method="POST" action="/admin-medicamentos/estado/{{ $admin_medicamento->slug }}" class="form-update">
                                        @csrf
                                        @method('PUT')
                                            @if($admin_medicamento->estado == 'Activo')
                                                <button type="submit" class="badge text-uppercase small bg-success border-0">Activo</button>
                                            @else
                                                <button type="submit" class="badge text-uppercase small bg-danger border-0">Inactivo</button>
                                            @endif
                                    </form>
                                </td>  
                                <td class="text-center align-middle">                                        
                                    <div class="text-start text-md-center">
                                        <div class="dropstart">
                                            <button type="button" class="btn btn-grey btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu">                                                
                                                <li class="dropdown-item">
                                                    <button class="bg-transparent border-0 px-0 mx-0" data-bs-toggle="modal" data-bs-target="#show_medicamento{{ $admin_medicamento->slug }}"><i class="bi bi-eye-fill me-2"></i>Ver detalles</button>
                                                </li>      
                                                <li class="dropdown-item">
                                                    <a href="{{ route('admin-medicamentos.edit',$admin_medicamento->slug) }}" class="text-decoration-none" style="color: #000;"><i class="bi bi-pencil-square me-2"></i>Editar</a>
                                                </li>   
                                                <li class="dropdown-item">
                                                    <form method="POST" action="{{ route('admin-medicamentos.destroy',$admin_medicamento->slug) }}" class="form-delete">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="bg-transparent mx-0 px-0 border-0"><i class="bi bi-trash-fill me-2"></i>Eliminar</button>        
                                                    </form>
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
    @foreach ($admin_medicamentos as $admin_medicamento)
        @include('ADMINISTRADOR.PRINCIPAL.configuraciones.medicamentos.show')
    @endforeach
{{-- Fin contenido --}}
@include('ADMINISTRADOR.PRINCIPAL.configuraciones.medicamentos.reporte_modal_excel') 
@endsection
@section('js')
    @if(session('addregister') == 'ok')
        <script>
            Swal.fire({
                icon: 'success',
                confirmButtonColor: '#1C3146',
                title: '¡Éxito!',
                text: 'Nuevo registro guardado correctamente',
            })
        </script>
    @endif

    @if(session('exists') == 'ok')
        <script>
            Swal.fire({
            icon: 'warning',
            confirmButtonColor: '#1C3146',
            title: '¡Lo sentimos!',
            text: 'El registro ingresado ya existe',
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
    
    @if(session('error') == 'ok')
        <script>
            Swal.fire({
            icon: 'warning',
            confirmButtonColor: '#1C3146',
            title: '¡Lo sentimos!',
            text: 'Este registro no se puede eliminar porque está siendo utilizado en otro registro',
            })
        </script>
    @endif
@endsection