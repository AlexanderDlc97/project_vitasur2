@extends('TEMPLATE.administrador')

@section('title', 'CAJA')

@section('css')

@endsection
 
@section('content')
<!-- Encabezado -->
<div class="header_section">
    <div class="bg-transparent mb-3" style="height: 67px"></div>
    <div class="container-fluid">
        <div class="" data-aos="fade-right">
            <h1 class="titulo h2 text-uppercase fw-bold mb-0">TESORERIA</h1>
            <div class="" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-decoration-none link" href="">Tesoreria</a></li>
                    <li class="breadcrumb-item"><a class="text-decoration-none link" href="{{ url('admin-caja') }}">Cuentas bancarias</a></li>
                    <li class="breadcrumb-item link" aria-current="page">Inicio</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- fin encabezado -->

<div class="container-fluid">   
    <div class="card border-4 borde-top-primary shadow-sm h-100" style="border-radius: 20px; min-height: 500px" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6 mb-2 ">
                    <span class="text-uppercase">Total de registros encontrados: <span class="fw-bold">{{ $cajas->count() }}</span></span>
                </div>
                <div class="col-12 col-md-6 mb-2 d-flex justify-content-end">
                    <span class="text-uppercase">Sede: <span class="fw-bold">Todos</span></span>  
                </div>
            </div>
            <table id="display" class="table table-hover table-sm py-2 text-center" cellspacing="0" style="width:100%">
                <thead class="bg-light">
                    <tr>
                        <th class="h6 text-uppercase fw-bold small">N°</th>
                        <th class="h6 text-uppercase fw-bold small">Caja</th>
                        <th class="h6 text-uppercase fw-bold small">Sede</th>
                        <th class="h6 text-uppercase fw-bold small">Total E.</th>
                        <th class="h6 text-uppercase fw-bold small">Total C.C.</th>
                        <th class="h6 text-uppercase fw-bold small">Monto Total</th>
                        <th class="h6 text-uppercase fw-bold small">Estado</th>
                        <th class="h6 text-uppercase fw-bold small text-center">Acciones</th>
                    </tr>
                </thead>
                    <tbody id="index_caja">
                        @php
                            $contador = 1;
                        @endphp           
                            @foreach ($cajas as $admin_caja)   
                                <tr class="">
                                    <td class="fw-normal align-middle">{{ $contador }}</td>
                                    <td class="fw-normal align-middle text-start">
                                        <img src="/images/cuentas/caja.png" class="rounded-3 me-3" style="width: 40px; height: 40px;" alt="">
                                        {{ $admin_caja->name_caja }}
                                    </td>
                                    <td class="fw-normal align-middle text-uppercase small">{{ $admin_caja->sede->name }}</td>
                                    <td class="fw-normal align-middle">{{ number_format($admin_caja->total_efectivo, 2, '.', ',') }}</td>
                                    <td class="fw-normal align-middle">{{ number_format($admin_caja->total_cuenta_banco, 2, '.', ',') }}</td>
                                    <td class="fw-bold align-middle">{{ number_format($admin_caja->total, 2, '.', ',') }}</td>
                                    <td class="fw-normal align-middle">
                                        @if($admin_caja->estado == 'APERTURADA')
                                            <span class="badge bg-success text-uppercase small">Aperturada</span>
                                        @else
                                            <span class="badge bg-danger text-uppercase small">Cerrada</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">                                        
                                        <div class="text-center">
                                            <a href="{{url("admin-caja/$admin_caja->slug")}}" class="btn btn-grey btn-sm text-white">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
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

{{-- @include('ADMINISTRADOR.TESORERIA.cajas.reporte_modal_pdf')
@include('ADMINISTRADOR.TESORERIA.cajas.reporte_modal_excel') --}}
@endsection
@section('js')

@endsection