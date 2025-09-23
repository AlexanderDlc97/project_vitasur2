@extends('TEMPLATE.administrador')

@section('title', 'MI PERFIL')

@section('css')
@endsection
 
@section('content')
<!-- Encabezado -->
    <div class="header_section">
        <div class="bg-transparent mb-3" style="height: 67px"></div>
        <div class="container-fluid">
            <div class="" data-aos="fade-right">
                <h1 class="titulo h2 text-uppercase fw-bold mb-0">MI PERFIL</h1>
                <div class="" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="">Principal</a></li>
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="{{ url('admin-configuraciones') }}">Configuraciones</a></li>
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="{{ url('admin-perfil') }}">Mi perfil</a></li>
                        <li class="breadcrumb-item link" aria-current="page">Inicio</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
<!-- Fin encabezado-->

{{-- Contenido --}}
    <div class="container-fluid">  
        <div class="row">
            <div class="col-12 col-md-5 col-xl-4">
                <div class="bg-white shadow-sm" style="border-radius: 20px; overflow: hidden" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                    <div class="card content_user">
                        <img src="/images/header_control.jpg" class="header_user" alt="">
                        <div class="card-body text-center">
                            <div class="avatar">
                                <img src="
                                @if($admin_perfil->imagen == 'NULL' || $admin_perfil->imagen == NULL)
                                    /images/user.jpg
                                @else
                                    /images/personas/{{ $admin_perfil->imagen }}
                                @endif
                                " alt="">
                            </div>
                            <div class="info_user">
                                <p class="fw-bold text-uppercase fs-5 mb-0">{{$admin_perfil->name.' '.$admin_perfil->surnames}}</p>
                                @if($admin_perfil->tipo_persona == 'Médico')
                                    <p class="fw-bold text-primary mb-0 text-uppercase small">{{ $admin_perfil->medico->profesion->name }}</p>
                                @else
                                    <p class="fw-bold text-primary mb-0 text-uppercase small">{{ Auth::user()->role->name }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card border-0">
                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-3">
                                    <div class="clearfix">
                                        <span class="float-start fw-bold text-uppercase small">{{$admin_perfil->identificacion}}</span>
                                        <span class="float-end fw-bold text-uppercase small">:</span>
    
                                    </div>
                                </div>
                                <div class="col-3">
                                    {{ $admin_perfil->nro_identificacion }}
                                </div>
                                <div class="col-3">
                                    <div class="clearfix">
                                        <span class="float-start fw-bold text-uppercase small">Contacto</span>
                                        <span class="float-end fw-bold text-uppercase small">:</span>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <a href="tel:{{$admin_perfil->nro_contacto}}">{{$admin_perfil->nro_contacto}}</a>
                                </div>
                                <div class="col-3">
                                    <div class="clearfix">
                                        <span class="float-start fw-bold text-uppercase small">Fecha de Nac.</span>
                                        <span class="float-end fw-bold text-uppercase small">:</span>
                                    </div>
                                </div>
                                <div class="col-3">
                                    @if($admin_perfil->fecha_nacimiento)
                                        {{ \Carbon\Carbon::parse($admin_perfil->fecha_nacimiento)->format('d-m-Y') }}
                                    @endif
                                </div>
                                <div class="col-3">
                                    <div class="clearfix">
                                        <span class="float-start fw-bold text-uppercase small">Sexo</span>
                                        <span class="float-end fw-bold text-uppercase small">:</span>
                                    </div>
                                </div>
                                <div class="col-3">
                                    {{$admin_perfil->sexo}}
                                </div>
                                <div class="col-3">
                                    <div class="clearfix">
                                        <span class="float-start fw-bold text-uppercase small">Estado civil</span>
                                        <span class="float-end fw-bold text-uppercase small">:</span>
                                    </div>
                                </div>
                                <div class="col-3">
                                    {{$admin_perfil->estado_civil}}
                                </div>
                                <div class="col-3">
                                    <div class="clearfix">
                                        <span class="float-start fw-bold text-uppercase small">Estado</span>
                                        <span class="float-end fw-bold text-uppercase small">:</span>
                                    </div>
                                </div>
                                <div class="col-3">
                                    @if(Auth::user()->estado == 'Activo')
                                        <span class="badge text-uppercase small bg-success border-0">{{Auth::user()->estado}}</button>
                                    @elseif($admin_perfil->estado == 'Inactivo')
                                        <span class="badge text-uppercase small bg-danger border-0">{{Auth::user()->estado}}</button>
                                    @else
                                        <span class="badge text-uppercase small bg-light border-0">{{Auth::user()->estado}}</span>
                                    @endif
                                </div>
                                <div class="col-3">
                                    <div class="clearfix">
                                        <span class="float-start fw-bold text-uppercase small">Dirección</span>
                                        <span class="float-end fw-bold text-uppercase small">:</span>
                                    </div>
                                </div>
                                <div class="col-9">
                                    {{$admin_perfil->direccion}}
                                </div>
                                
                                <div class="col-3">
                                    <div class="clearfix">
                                        <span class="float-start fw-bold text-uppercase small">Email</span>
                                        <span class="float-end fw-bold text-uppercase small">:</span>
                                    </div>
                                </div>
                                <div class="col-9">
                                    @if(empty($admin_perfil->user->email))
                                        <span class="text-muted text-uppercase small">No requerido</span>
                                    @else
                                        <a href="mailto:{{$admin_perfil->user->email}}">{{$admin_perfil->user->email}}</a>
                                    @endif
                                </div>
                                <div class="col-3">
                                    <div class="clearfix">
                                        <span class="float-start fw-bold text-uppercase small">Rol</span>
                                        <span class="float-end fw-bold text-uppercase small">:</span>
                                    </div>
                                </div>
                                <div class="col-9">
                                    @if(empty($admin_perfil->user->role_id))
                                        <span class="text-muted text-uppercase small">No requerido</span>
                                    @else
                                        {{$admin_perfil->user->role->name}}
                                    @endif
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 318"><path fill="#065892" fill-opacity="1" d="M0,288L120,293.3C240,299,480,309,720,298.7C960,288,1200,256,1320,240L1440,224L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path></svg>
                    <div class="bg-primary text-end px-3 pb-3">
                        <div class="row">
                            <div class="col-6 d-flex">
                                <span class="text-white align-self-center" style="font-size: 11px"><b>CLÍNICA VITASUR</b></span>
                            </div>
                            <div class="col-6">
                                <a href="{{ route('admin-perfil.edit',$admin_perfil->slug) }}" class="btn btn-sm border-white text-white rounded rounded-pill"><i class="bi bi-pencil-square me-2"></i>Editar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>  
    </div>
{{-- Fin contenido --}}
@endsection
@section('js')
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
    
@endsection