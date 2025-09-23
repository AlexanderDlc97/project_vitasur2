@extends('TEMPLATE.administrador')

@section('title', 'CONFIGURACIONES')

@section('css')
@endsection
 
@section('content')
<!-- Encabezado -->
    <div class="header_section">
        <div class="bg-transparent mb-3" style="height: 67px"></div>
        <div class="container-fluid">
            <div class="" data-aos="fade-right">
                <h1 class="titulo h2 text-uppercase fw-bold mb-0"> CONFIGURACIONES</h1>
                <div class="" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="">Principal</a></li>
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="{{ url('admin-configuraciones') }}">Configuraciones</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
<!-- Fin encabezado-->

{{-- Contenido --}}
    <div class="container-fluid">  
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                <div class="card border-4 borde-top-secondary box-shadow h-100" style="border-radius: 20px" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                    <div class="card-header bg-transparent">
                        <span class="text-uppercase fw-bold" style="color: #515151">General</span>
                    </div>
                    <div class="card-body pb-0">
                        <p class="fw-normal" align="justify">Configura la información general del sistema.</p>
                        <ul class="list-unstyled">
                            @if(Auth::user()->role_id == '1')
                                <li class="text-dark mb-2 menu_item">
                                    <i class="bi bi-people me-2"></i>
                                    <a href="{{ url('admin-usuarios') }}" class="link-dark text-decoration-none">Usuarios</a>
                                </li>
                                <li class="text-dark mb-2 menu_item">
                                    <i class="fa-solid fa-medal me-2"></i>
                                    <a href="{{ url('admin-profesiones') }}" class="link-dark text-decoration-none">Profesiones</a>
                                </li>
                            @endif
                            <li class="text-dark mb-2 menu_item">
                                <i class="bi bi-person-badge me-2"></i>
                                <a href="{{ url('admin-perfil') }}" class="link-dark text-decoration-none">Mi perfil</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                <div class="card border-4 borde-top-secondary box-shadow h-100" style="border-radius: 20px" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                    <div class="card-header bg-transparent">
                        <span class="text-uppercase fw-bold" style="color: #515151">Clínica</span>
                    </div>
                    <div class="card-body pb-0">
                        <p class="fw-normal" align="justify">Gestiona la información principal de la clínica.</p>
                        <ul class="list-unstyled">
                            @if(Auth::user()->role_id == '1')
                                <li class="text-dark mb-2 menu_item">
                                    <i class="fa-solid fa-user-nurse me-2"></i>
                                    <a href="{{ url('admin-especialidades') }}" class="link-dark text-decoration-none">Especialidades</a>
                                </li>
                                <li class="text-dark mb-2 menu_item">
                                    <i class="fa-solid fa-stethoscope me-2"></i>
                                    <a href="{{ url('admin-diagnosticos') }}" class="link-dark text-decoration-none">Diagnósticos</a>
                                </li>
                                <li class="text-dark mb-2 menu_item">
                                    <i class="bi bi-clipboard2-pulse-fill me-2"></i>
                                    <a href="{{ url('admin-procedimientosclinicos') }}" class="link-dark text-decoration-none">Procedimientos</a>
                                </li>
                            @endif
                            @if(Auth::user()->role_id == '1' || Auth::user()->role_id == '4' || Auth::user()->role_id == '5')
                            <li class="text-dark mb-2 menu_item">
                                <i class="fa-solid fa-capsules me-2"></i>
                                <a href="{{ url('admin-medicamentos') }}" class="link-dark text-decoration-none">Bienes</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            @if(Auth::user()->role_id == '1' || Auth::user()->role_id == '4')
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                    <div class="card border-4 borde-top-secondary box-shadow h-100" style="border-radius: 20px" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                        <div class="card-header bg-transparent">
                            <span class="text-uppercase fw-bold" style="color: #515151">Tesoreria</span>
                        </div>
                        <div class="card-body pb-0">
                            <p class="fw-normal" align="justify">Configura la información de cuentas de banco para registrar cobros y pagos.</p>
                            <ul class="list-unstyled">
                                <li class="text-dark mb-2 menu_item">
                                    <i class="bi bi-cash-coin me-2"></i>
                                    <a href="{{ url('admin-medios-pagos') }}" class="link-dark text-decoration-none">Medios de Pago</a>
                                </li>
                                <li class="text-dark mb-2 menu_item">
                                    <i class="bi bi-bank me-2"></i>
                                    <a href="{{ url('admin-cuentas-bancarias') }}" class="link-dark text-decoration-none">Cuentas Bancarias</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
{{-- Fin contenido --}}
@endsection
@section('js')
@endsection