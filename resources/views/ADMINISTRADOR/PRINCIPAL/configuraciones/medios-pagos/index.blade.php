@extends('TEMPLATE.administrador')

@section('title', 'MEDIOS DE PAGO')

@section('css')
@endsection

@section('content')
<!-- Encabezado -->
<div class="header_section">
    <div class="bg-transparent mb-3" style="height: 67px"></div>
    <div class="container-fluid">
        <div class="" data-aos="fade-right">
            <h1 class="titulo h2 text-uppercase fw-bold mb-0">MEDIOS DE PAGOS</h1>
            <div class="" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-decoration-none link" href="">Principal</a></li>
                    <li class="breadcrumb-item"><a class="text-decoration-none link" href="{{ url('admin-configuraciones') }}">Configuraciones</a></li>
                    <li class="breadcrumb-item"><a class="text-decoration-none link" href="{{ url('admin-medios-pagos') }}">Medios de pagos</a></li>
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
            <div class="card-body">
                <div class="mb-2 col-12 col-md-6">
                    <span class="text-uppercase">Total de registros encontrados: <span class="fw-bold">{{ number_format($admin_medios_pagos->count(), 0,'.',',') }}</span></span>
                </div>
                <table id="display" class="table table-hover table-sm" cellspacing="0" style="width:100%">
                    <thead class="bg-light">
                        <tr>
                            <th class="h6 fw-bold text-uppercase small">N°</th>
                            <th class="h6 fw-bold text-uppercase small">Nombre</th>
                            <th class="h6 fw-bold text-uppercase small">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admin_medios_pagos as $admin_medios_pago)
                            <tr>
                                <td class="fw-normal align-middle">{{ $admin_medios_pago->id }}</td>
                                <td class="fw-normal align-middle text-uppercase small">{{ $admin_medios_pago->name }}</td>
                                <td class="fw-normal align-middle small">
                                    @if($admin_medios_pago->estado == 'Activo')
                                        <span class="badge bg-success small text-uppercase">Activo</span>
                                    @else
                                        <span class="badge bg-danger small text-uppercase">Inactivo</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- Fin contenido --}}

@endsection

@section('js')

@endsection