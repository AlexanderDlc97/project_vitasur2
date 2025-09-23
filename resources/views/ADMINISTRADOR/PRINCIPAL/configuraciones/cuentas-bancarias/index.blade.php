@extends('TEMPLATE.administrador')

@section('title', 'CUENTAS BANCARIAS')

@section('css')
@endsection

@section('content')
<!-- Encabezado -->
<div class="header_section">
    <div class="bg-transparent mb-3" style="height: 67px"></div>
    <div class="container-fluid">
        <div class="" data-aos="fade-right">
            <h1 class="titulo h2 text-uppercase fw-bold mb-0">CUENTAS BANCARIAS</h1>
            <div class="" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-decoration-none link" href="">Principal</a></li>
                    <li class="breadcrumb-item"><a class="text-decoration-none link" href="{{ url('admin-configuraciones') }}">Configuraciones</a></li>
                    <li class="breadcrumb-item"><a class="text-decoration-none link" href="{{ url('admin-cuentas-bancarias') }}">Cuentas bancarias</a></li>
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
                    <div class="row justify-content-between">
                        <div class="col-9 col-md-3 col-xl-2 mb-2 mb-lg-0 order-1 order-md-1 order-lg-1 order-xl-1">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#createcuentabancaria" class="btn btn-primary btn-sm text-uppercase text-white w-100" style="border-radius: 20px">
                                <i class="bi bi-plus-circle me-2"></i>
                                Nuevo registro
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-2 col-12 col-md-6">
                        <span class="text-uppercase">Total de registros encontrados: <span class="fw-bold">{{ number_format($admin_cuentas_bancarias->count(), 0,'.',',') }}</span></span>
                    </div>
                    <table id="display" class="table table-hover table-sm" cellspacing="0" style="width:100%">
                        <thead class="bg-light text-center">
                            <tr>
                                <th class="h6 small text-uppercase fw-bold">N°</th>
                                <th class="h6 small text-uppercase fw-bold">Banco</th>
                                <th class="h6 small text-uppercase fw-bold">Tipo de cuenta</th>
                                <th class="h6 small text-uppercase fw-bold">Nro de Cuenta</th>
                                <th class="h6 small text-uppercase fw-bold">Nro de Cuenta CCI</th>
                                <th class="h6 small text-uppercase fw-bold">Estado</th>
                                <th class="h6 small text-uppercase fw-bold text-center">Acciones</th>
                            </tr>
                        </thead>
                        @php
                            $contador = 1;
                        @endphp
                        @foreach ($admin_cuentas_bancarias as $admin_cuentas_bancaria)
                            <tbody class="text-center">
                                <tr>
                                    <td class="fw-normal align-middle">{{$contador}}</td>
                                    <td class="fw-normal align-middle text-uppercase small">{{$admin_cuentas_bancaria->banco->name}}</td>
                                    <td>{{$admin_cuentas_bancaria->tipocuenta->name}}</td>
                                    <td class="fw-normal align-middle">{{$admin_cuentas_bancaria->nro_cuenta}}</td>
                                    <td class="fw-normal align-middle">{{$admin_cuentas_bancaria->nro_cuenta_cci}}</td>
                                    <td class="fw-normal align-middle small">
                                        <form method="POST" action="/admin-cuentas-bancarias/estado/{{$admin_cuentas_bancaria->slug}}" class="form-update">
                                            @csrf
                                            @method('PUT')
                                                @if($admin_cuentas_bancaria->estado == 'Activo')
                                                    <button type="submit" class="text-uppercase small badge bg-success border-0">Activo</button>
                                                @else
                                                    <button type="submit" class="text-uppercase small badge bg-danger border-0">Inactivo</button>
                                                @endif
                                        </form>
                                    </td>  
                                    <td class="align-middle"> 
                                        <div class="text-start text-md-center">
                                            <div class="dropstart">
                                                 <button type="button" class="btn btn-grey btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu">                                                
                                                    <li class="dropdown-item">
                                                        <button class="bg-transparent border-0 px-0 mx-0" data-bs-toggle="modal" data-bs-target="#editcuentabancaria{{ $admin_cuentas_bancaria->slug }}"><i class="bi bi-pencil-square me-2"></i>Editar</button>
                                                    </li>
                                                    <form method="POST" action="{{ route('admin-cuentas-bancarias.destroy',$admin_cuentas_bancaria->slug) }}" class="form-delete">
                                                    @csrf
                                                    @method('DELETE')
                                                        <li class="dropdown-item">
                                                            <button type="submit" class="bg-transparent mx-0 px-0 border-0"><i class="bi bi-trash-fill me-2"></i>Eliminar</button>        
                                                        </li>
                                                    </form>                                                      
                                                </ul>
                                            </div>
                                        </div>                                            
                                    </td>
                                </tr>
                            </tbody>
                            @php
                                $contador++;
                            @endphp
                        @endforeach
                    </table>
                </div>
            </div>
            @foreach($admin_cuentas_bancarias as $admin_cuentas_bancaria)
                @include('ADMINISTRADOR.PRINCIPAL.configuraciones.cuentas-bancarias.edit')            
            @endforeach
            @include('ADMINISTRADOR.PRINCIPAL.configuraciones.cuentas-bancarias.create')
        </div>
    {{-- Fin contenido --}}

@endsection

@section('js')
<!--sweet alert agregar-->
    @if(session('addcuenta') == 'ok')
    <script>
        Swal.fire({
        icon: 'success',
        confirmButtonColor: '#1C3146',
        title: '¡Éxito!',
        text: 'Cuenta registrada correctamente',
        })
    </script>
    @endif

    <!--sweet alert actualizar-->
    @if(session('error') == 'ok')
    <script>
        Swal.fire({
        icon: 'error',
        confirmButtonColor: '#1C3146',
        title: 'Error!',
        text: 'Las Contraseñas no coinciden',
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
    <!--.sweet alert eliminar-->
    <script>
        $(document).ready(function(){
        @if($message = Session::get('errors'))
            $("#createcuentabancaria").modal('show');
        @endif
        });
    </script>
@endsection