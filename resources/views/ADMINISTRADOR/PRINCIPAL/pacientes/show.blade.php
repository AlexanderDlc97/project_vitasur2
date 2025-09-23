@extends('TEMPLATE.administrador')

@section('title', 'PACIENTES')

@section('css')
<style>
    .img_paciente{
        width: 100%; height: 90px;
    }

    @media (max-width: 992px) {
        .img_paciente{
            width: 150px; height: 150px;
        }
    }
</style>
@endsection
 
@section('content')
<!-- Encabezado -->
    <div class="header_section">
        <div class="bg-transparent mb-3" style="height: 67px"></div>
        <div class="container-fluid">
            <div class="" data-aos="fade-right">
                <h1 class="titulo h2 text-uppercase fw-bold mb-0">PACIENTES</h1>
                <div class="" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="">Principal</a></li>
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="{{ url('admin-pacientes') }}">Pacientes</a></li>
                        <li class="breadcrumb-item link" aria-current="page">Detalles</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
<!-- Fin encabezado-->

{{-- Contenido --}}
<div class="container-fluid">  
    <div class="card border-4 borde-top-primary shadow-sm h-100" style="border-radius: 20px; min-height: 450px; overflow: hidden;" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
        <div class="row g-0">
            <div class="col-12 col-md-3 border-end">
                <div class="card content_user">
                    <img src="/images/header_control.jpg" class="header_user" alt="">
                    <div class="card-body text-center">
                        <div class="avatar">
                            <img src="
                            @if($admin_paciente->imagen == "NULL")
                                /images/user.jpg
                            @else
                                /images/personas/{{ $admin_paciente->imagen }}
                            @endif
                            " alt="">
                        </div>
                        <div class="info_user">
                            <p class="fw-bold text-uppercase fs-5 mb-0">{{$admin_paciente->name.' '.$admin_paciente->surnames}}</p>
                            <p class="fw-bold text-primary mb-0 text-uppercase small">HC: {{ $admin_paciente->paciente->historia_clinica }}</p>
                        </div>
                    </div>
                </div>
                <div class="card border-0">
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-2">
                                <div class="clearfix">
                                    <span class="float-start fw-bold text-uppercase small">{{$admin_paciente->identificacion}}</span>
                                    <span class="float-end fw-bold text-uppercase small">:</span>

                                </div>
                            </div>
                            <div class="col-4">
                                {{ $admin_paciente->nro_identificacion }}
                            </div>
                            <div class="col-2">
                                <div class="clearfix">
                                    <span class="float-start fw-bold text-uppercase small">Cel.</span>
                                    <span class="float-end fw-bold text-uppercase small">:</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <a href="tel:{{$admin_paciente->nro_contacto}}">{{$admin_paciente->nro_contacto}}</a>
                            </div>
                            <div class="col-2">
                                <div class="clearfix">
                                    <span class="float-start fw-bold text-uppercase small">F. N.</span>
                                    <span class="float-end fw-bold text-uppercase small">:</span>
                                </div>
                            </div>
                            <div class="col-4">
                                {{ \Carbon\Carbon::parse($admin_paciente->fecha_nacimiento)->format('d-m-Y') }}
                            </div>
                            <div class="col-2">
                                <div class="clearfix">
                                    <span class="float-start fw-bold text-uppercase small">Sexo</span>
                                    <span class="float-end fw-bold text-uppercase small">:</span>
                                </div>
                            </div>
                            <div class="col-4">
                                {{$admin_paciente->sexo}}
                            </div>
                            <div class="col-2">
                                <div class="clearfix">
                                    <span class="float-start fw-bold text-uppercase small">E. C.</span>
                                    <span class="float-end fw-bold text-uppercase small">:</span>
                                </div>
                            </div>
                            <div class="col-10">
                                {{$admin_paciente->estado_civil}}
                            </div>
                            <div class="col-3">
                                <div class="clearfix">
                                    <span class="float-start fw-bold text-uppercase small">Estado</span>
                                    <span class="float-end fw-bold text-uppercase small">:</span>
                                </div>
                            </div>
                            <div class="col-9">
                                @if($admin_paciente->paciente->estado == 'Activo')
                                    <span class="badge text-uppercase small bg-success border-0">{{ $admin_paciente->paciente->estado }}</button>
                                @else
                                    <span class="badge text-uppercase small bg-danger border-0">{{ $admin_paciente->paciente->estado }}</span>
                                @endif
                            </div>
                            <div class="col-3">
                                <div class="clearfix">
                                    <span class="float-start fw-bold text-uppercase small">Dirección</span>
                                    <span class="float-end fw-bold text-uppercase small">:</span>
                                </div>
                            </div>
                            <div class="col-9">
                                {{$admin_paciente->direccion}}
                            </div>
                            
                            <div class="col-3">
                                <div class="clearfix">
                                    <span class="float-start fw-bold text-uppercase small">Ocupación</span>
                                    <span class="float-end fw-bold text-uppercase small">:</span>
                                </div>
                            </div>
                            <div class="col-9">
                                {{$admin_paciente->paciente->ocupacion}}
                            </div>
                            <div class="col-3">
                                <div class="clearfix">
                                    <span class="float-start fw-bold text-uppercase small">Resp</span>
                                    <span class="float-end fw-bold text-uppercase small">:</span>
                                </div>
                            </div>
                            <div class="col-9">
                                {{$admin_paciente->paciente->responsable}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-primary text-end p-2">
                    <div class="row">
                        <div class="col-6 d-flex">
                            <span class="text-white align-self-center" style="font-size: 11px"><b>CLÍNICA VITASUR</b></span>
                        </div>
                        @if(Auth::user()->role_id == '6' || Auth::user()->role_id == '2')
                        @else
                            <div class="col-6">
                                <a href="{{ route('admin-pacientes.edit',$admin_paciente->slug) }}" class="btn btn-sm border-white text-white rounded rounded-pill"><i class="bi bi-pencil-square me-2"></i>Editar</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>  
            <div class="col-12 col-md-9">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-12 col-md-4">
                            <div class="mb-2">
                                <span class="text-uppercase">Total de atenciones encontradas: <span class="fw-bold">{{$atenciones_list->count()}}</span></span>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <button class="btn btn-primary btn-sm text-uppercase text-white w-100" style="border-radius: 20px" data-bs-toggle="modal" data-bs-target="#registro_procedimiento_ambulatorio"><i class="bi bi-clipboard2-pulse-fill me-2"></i></i>Procedimientos Ambulatorios</button>
                        </div>
                    </div>
                    <table id="display" class="table table-hover table-sm" cellspacing="0" style="width:100%">
                        <thead class="bg-dark text-white border-0">
                            <tr>
                                <th class="h6 small text-center text-uppercase fw-bold">N°</th>
                                <th class="h6 small text-center text-uppercase fw-bold">Código</th>
                                <th class="h6 small text-center text-uppercase fw-bold">Fecha</th>
                                <th class="h6 small text-center text-uppercase fw-bold">Especialidad</th>
                                <th class="h6 small text-center text-uppercase fw-bold">Tipo</th>
                                <th classs="h6 small text-center text-uppercase fw-bold">Estado</th>
                                <th class="h6 small text-center text-uppercase fw-bold">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $contadores_valor = 1;
                            @endphp
                            @foreach ($atenciones_list as $admin_atencio)
                                <tr>
                                    <td class="fw-normal text-center align-middle text-md-center">{{$contadores_valor}}</td>
                                    <td class="fw-normal text-center align-middle text-md-center">{{$admin_atencio->codigo}}</td>
                                    <td class="fw-normal text-center align-middle text-md-center">{{$admin_atencio->fecha}}</td>
                                    <td class="fw-normal text-center align-middle text-md-center text-uppercase">{{$admin_atencio->especialidad->name}}</td>
                                    <td class="fw-normal text-center align-middle text-md-center text-uppercase">{{$admin_atencio->tipo}}</td>
                                    <td class="fw-normal text-center align-middle text-md-center">
                                        @if($admin_atencio->estado == 'En atención')
                                            <span class="badge text-uppercase small bg-danger border-0">En atencion</span>
                                        @elseif($admin_atencio->estado == 'Completado')
                                            <span class="badge text-uppercase small bg-dark border-0">Completado</span>
                                        @else
                                            <span class="badge text-uppercase small bg-success border-0">Activo</span>
                                        @endif
                                    </td>
                                    <td class="fw-normal text-center align-middle text-md-center">
                                        <button type="button" class="btn btn-sm btn-grey" @if($admin_atencio->estado == 'En atención') disabled @endif data-bs-toggle="modal" data-bs-target="#showatencion{{ $admin_atencio->slug }}"><i class="bi bi-eye-fill"></i></button>
                                    </td>
                                </tr>
                            @php
                                $contadores_valor++;
                            @endphp      
                            @endforeach
                        </tbody>
                    </table>
                </div>  
            </div> 
        </div>
    </div>
</div>
{{-- Fin contenido --}}
@include('ADMINISTRADOR.PRINCIPAL.pacientes.show_prcedimiento')
@foreach($atenciones_list as $admin_atencio)
    @include('ADMINISTRADOR.PRINCIPAL.pacientes.show_atencion', ['admin_atencio_id' => $admin_atencio->id])
@endforeach
@endsection
@section('js')

@endsection