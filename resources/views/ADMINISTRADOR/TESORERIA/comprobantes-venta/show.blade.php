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
                            <li class="breadcrumb-item"><a class="text-decoration-none link-light" href="{{url('admin-comp-ventas')}}">Comprobantes de venta</a></li>
                            <li class="breadcrumb-item text-white" aria-current="page">{{ $admin_comp_venta->tipo_comprobante.': '.$admin_comp_venta->serie.'-'.$admin_comp_venta->correlativo }}</li>
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
    <div class="row justify-content-center">
        <div class="col-12 col-md-9 col-xl-10">
            <div class="card border-4 borde-top-secondary shadow-sm mb-3" style="margin-top: -80px"  data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                <div class="card-body pt-1">
                    <div class="mb-3">
                        <div class="dropdown">
                            <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Acciones
                            </button>
                            <ul class="dropdown-menu small">
                                {{-- <li class="dropdown-item">
                                    <button class="bg-transparent border-0 px-0 mx-0" data-bs-toggle="modal" data-bs-target="#printcomp{{ $admin_comp_venta->slug }}"><i class="bi bi-printer me-2"></i>Imprimir</button>
                                </li> --}}
                                @if(Gate::allows('gerencia',Auth()->user()))
                                @else
                                    @if($admin_comp_venta->credito_debito == '1')
                                        
                                    @else
                                        <li class="dropdown-item">
                                            <button class="bg-transparent border-0 px-0 mx-0" data-bs-toggle="modal" data-bs-target="#anularcomp{{ $admin_comp_venta->slug }}"><i class="bi bi-x-circle me-2"></i>Anular</button>
                                        </li>

                                        <li class="dropdown-item">
                                            <button class="bg-transparent border-0 px-0 mx-0" data-bs-toggle="modal" data-bs-target="#aplicar_nc{{ $admin_comp_venta->slug }}"><i class="bi bi-file-binary me-2"></i>Aplicar nota de crédito</button>
                                        </li>
                                    @endif
                                @endif
                                <li class="dropdown-item">
                                    <button class="bg-transparent border-0 px-0 mx-0" data-bs-toggle="modal" data-bs-target="#enviar_correo{{ $admin_comp_venta->slug }}"><i class="bi bi-envelope-arrow-up me-2"></i>Enviar por correo</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 col-md-3 mb-3 mb-md-0 border-end">
                            <div class="p-1 text-center">
                                <p class="text-uppercase fw-normal mb-0 small text-muted">TOTAL</p>
                                <span class="card-text fw-bold">{{ $control_venta->total }}</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 mb-3 mb-md-0 border-end">
                            <div class="p-1 text-center">
                                <p class="text-uppercase fw-normal mb-0 small text-muted">POR COBRAR</p>
                                @if($control_venta->estado_pago == 'Parcial')
                                    <span class="card-text text-danger fw-bold">{{$control_venta->total_pago}}</span>
                                @elseif($control_venta->estado_pago == 'Anulado nc' || $control_venta->estado_pago == 'Anulado D.')
                                    <span class="card-text text-danger fw-bold">0.00</span>
                                @else
                                    <span class="card-text text-danger fw-bold">{{$control_venta->total}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-6 col-md-3 mb-3 mb-md-0 border-end">
                            <div class="p-1 text-center">
                                <p class="text-uppercase fw-normal mb-0 small text-muted">COBRADO</p>
                                @if($control_venta->estado_pago == 'Pagada')
                                    <span class="card-text text-info fw-bold">0.00</span>
                                @elseif($control_venta->estado_pago == 'Anulado nc' || $control_venta->estado_pago == 'Anulado D.')
                                    <span class="card-text text-info fw-bold">0.00</span>
                                @else
                                    <span class="card-text text-info fw-bold">{{$control_venta->total_pago}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-6 col-md-3 mb-3 mb-md-0">
                            <div class="p-1 text-center">
                                <p class="text-uppercase fw-normal mb-0 small text-muted">NOTA DE CRÉDITO</p>
                                @if($control_venta->estado_pago == 'Anulado nc')
                                    <span class="card-text text-danger fw-bold">{{$control_venta->total}}</span>
                                @else
                                    <span class="card-text text-danger fw-bold">0.00</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card rounded-0 shadow-sm mt-5 mb-3 w-100 position-relative">
                        @if($control_venta->estado_pago == 'Parcial')
                            <span class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-info text-uppercase small">
                                Parcial
                            </span>
                        @elseif($control_venta->estado_pago == 'Pagada')
                            <span class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-success text-uppercase small">
                                Cobrado
                            </span>
                        @elseif($control_venta->estado_pago == 'Anulado nc')
                            <span class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger text-uppercase small">
                                Anulacion Nota de Credito
                            </span>
                        @elseif($control_venta->estado_pago == 'Anulado D.')
                            <span class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger text-uppercase small">
                                Anulacion Directa
                            </span>
                        @else
                            <span class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger text-uppercase small">
                                Por cobrar
                            </span>
                        @endif
                        <div class="card-body p-md-4">
                            <div class="row mb-3">
                                <div class="col-12 col-md-2">
                                    <img src="/images/header_kaita.png" class="card-img" style="width:100%" alt="...">
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-12 col-md-5 text-center">
                                    <span class="text-uppercase text-center fw-bold d-block" style="font-size: 18px">KAITA INTERNATIONAL S.A.C</span>
                                    <p class="fw-light fst-italic mb-0" style="font-size: 11.5px">Mza. 1qa Lote. 16 P.J. San Francisco De La Tablada De Lurin - Sector Segundo Lima - Lima - Villa Maria Del Triunfo</p>
                                    <p class="fw-light fst-italic mb-0" style="font-size: 11.5px">Telf: 665-4576 / 952-314-831</p>
                                    <span class="fw-light fst-italic d-block" style="font-size: 11.5px"><a href="mailto:ventasweb48@gmail.com" class="text-decoration-none link-dark">ventasweb48@gmail.com</a></span>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="card text-center border border-primary">
                                        <p class="text-uppercase mb-0 py-1 fw-bold ">RUC: 20608321773</p>
                                        <div class="bg-primary float-center py-1">
                                            <span class="text-uppercase text-white fw-bold py-1" style="font-size: 15px">{{$admin_comp_venta->tipo_comprobante}}</span>
                                        </div>
                                        <p class="text-uppercase text-dark small mb-0 py-1"><span class="fw-bold text-danger">N°</span> {{$admin_comp_venta->serie}} - <span class="fw-bold text-dark">{{$admin_comp_venta->correlativo}}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-2 mb-3">
                                <div class="col-12 col-lg-9">
                                    <div class="card">
                                        <div class="card-body p-1">
                                            <div class="row g-1">
                                                <div class="col-12 col-md-3 col-lg-2">
                                                    <span class="text-uppercase small fw-bold">Señor(es):</span>
                                                </div>
                                                <div class="col-12 col-md-9 col-lg-10">
                                                    <span class="">{{$admin_comp_venta->nombre_cliente}}</span>
                                                </div>
                                                <div class="col-12 col-md-3 col-lg-2">
                                                    <span class="text-uppercase small fw-bold">Identificación:</span>
                                                </div>
                                                <div class="col-12 col-md-9 col-lg-10">
                                                    <span class="">{{$admin_comp_venta->tipo_documento.' - '.$admin_comp_venta->nro_documento}}</span>
                                                </div>
                                                <div class="col-12 col-md-3 col-lg-2">
                                                    <span class="text-uppercase small fw-bold">Nro. contacto:</span>
                                                </div>
                                                <div class="col-12 col-md-9 col-lg-10">
                                                    <span class="">{{$admin_comp_venta->nro_contacto}}</span>
                                                </div>
                                                <div class="col-12 col-md-3 col-lg-2">
                                                    <span class="text-uppercase small fw-bold">Dirección:</span>
                                                </div>
                                                <div class="col-12 col-md-9 col-lg-10">
                                                    <span class="">{{$admin_comp_venta->direccion}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3">
                                    <div class="card">
                                        <div class="card-body p-1">
                                            <div class="row g-1">
                                                <div class="col-12 col-md-6 col-lg-6">
                                                    <span class="text-uppercase small fw-bold">Fecha:</span>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-6">
                                                    <span class="">{{$admin_comp_venta->fechaemision}}</span>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-6">
                                                    <span class="text-uppercase small fw-bold">Vencimiento:</span>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-6">
                                                    <span class="">{{$admin_comp_venta->fecha_vencimiento}}</span>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-6">
                                                    <span class="text-uppercase small fw-bold">Forma P.:</span>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-6">
                                                    <span class="text-uppercase">{{$admin_comp_venta->forma_pago}}</span>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-6">
                                                    <span class="text-uppercase small fw-bold">Moneda:</span>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-6">
                                                    <span class="text-uppercase">{{$admin_comp_venta->codigo_moneda == 'PEN'?'Soles - PEN':'Dolares - USD'}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table w-100">
                                    <thead>
                                        <tr>
                                            <th class="h6 text-uppercase text-center fw-bold small">N°</th>
                                            <th class="h6 text-uppercase text-center fw-bold small">Código</th>
                                            <th class="h6 text-uppercase text-center fw-bold small">Descripción</th>
                                            <th class="h6 text-uppercase text-center fw-bold small">Unidad</th>
                                            <th class="h6 text-uppercase text-center fw-bold small">Cantidad</th>
                                            <th class="h6 text-uppercase text-center fw-bold small">P. Unit.</th>
                                            <th class="h6 text-uppercase text-center fw-bold small">Desc.</th>
                                            <th class="h6 text-uppercase text-center fw-bold small">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $contador = 1;
                                        @endphp
                                        @foreach ($dt_compro as $dt_compros)
                                            <tr>
                                                <td class="fw-normal align-middle text-center">{{$contador}}</td>
                                                <td class="fw-normal align-middle">{{$dt_compros->codigo_producto}}</td>
                                                <td class="fw-normal align-middle">{{$dt_compros->nombre_producto}}</td>
                                                <td class="fw-normal align-middle">{{$dt_compros->unidad}}</td>
                                                <td class="fw-normal align-middle">{{$dt_compros->cantidad}}</td>
                                                <td class="fw-normal align-middle text-end">{{$dt_compros->valor_unitario}}</td>
                                                <td class="fw-normal align-middle text-end">0.00</td>
                                                <td class="fw-normal align-middle text-end">{{$dt_compros->valor_unitario}}</td>
                                            </tr>
                                        @php
                                            $contador++;
                                        @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-12 col-md-7 col-lg-5">
                                    <table class="w-100">
                                        <tr>
                                            <td class="border-0 ps-2 py-1 bg-light" style="width: 50%">
                                                SUBTOTAL
                                            </td>
                                            <td class="border-0 pe-2 py-1 bg-light" style="width: 50%">
                                                <div class="clearfix">
                                                    <span class="float-start ps-2">S/ </span>
                                                    <span class="float-end">
                                                        {{ number_format(($admin_comp_venta->subtotal), 2, '.', ',') }}
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="border-0 ps-2 py-1" style="width: 50%">
                                                DESCUENTOS
                                            </td>
                                            <td class="border-0 pe-2 py-1" style="width: 50%">
                                                <div class="clearfix">
                                                    <span class="float-start ps-2">S/ </span>
                                                    <span class="float-end">
                                                        {{ number_format(($admin_comp_venta->descuento), 2, '.', ',') }}
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>

                                        
                                        <tr>
                                            <td class="border-0 ps-2 py-1 bg-light" style="width: 50%">
                                                OP. GRAVADA
                                            </td>
                                            <td class="border-0 pe-2 py-1 bg-light" style="width: 50%">
                                                <div class="clearfix">
                                                    <span class="float-start ps-2">S/ </span>
                                                    <span class="float-end">
                                                        {{ number_format(($admin_comp_venta->operacion_gravada), 2, '.', ',') }}
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td class="border-0 ps-2 py-1" style="width: 50%">
                                                IGV (18%)
                                            </td>
                                            <td class="border-0 pe-2 py-1" style="width: 50%">
                                                <div class="clearfix">
                                                    <span class="float-start ps-2">S/ </span>
                                                    <span class="float-end">
                                                        {{ number_format(($admin_comp_venta->igv), 2, '.', ',') }}
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>

                                        <!--<tr>
                                            <td class="border-0 ps-2 py-1 bg-light" style="width: 50%">
                                                SUBTOTAL
                                            </td>
                                            <td class="border-0 pe-2 py-1 bg-light" style="width: 50%">
                                                <div class="clearfix">
                                                    <span class="float-start ps-2">S/ </span>
                                                    <span class="float-end">
                                                        {{ number_format(($admin_comp_venta->subtotal+$admin_comp_venta->igv), 2, '.', ',') }}
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="border-0 ps-2 py-1" style="width: 50%">
                                                DESCUENTO AD.
                                            </td>
                                            <td class="border-0 pe-2 py-1" style="width: 50%">
                                                <div class="clearfix">
                                                    <span class="float-start ps-2">S/ </span>
                                                    <span class="float-end">
                                                        {{ number_format(($admin_comp_venta->descuento_ad), 2, '.', ',') }}
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>-->
                                        
                                        <tr>
                                            <td class="border-0 fw-bold ps-2 py-1 bg-light" style="width: 50%">
                                                IMPORTE TOTAL
                                            </td>
                                            <td class="border-0 fw-bold pe-2 py-1 bg-light" style="width: 50%">
                                                <div class="clearfix">
                                                    <span class="float-start ps-2">S/ </span>
                                                    <span class="float-end">
                                                        {{ number_format(($admin_comp_venta->total), 2, '.', ',') }}
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="pagos_recibidos-tab" data-bs-toggle="tab" data-bs-target="#pagos_recibidos" type="button" role="tab" aria-controls="pagos_recibidos" aria-selected="true">Pagos recibidos</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="notas_credito-tab" data-bs-toggle="tab" data-bs-target="#notas_credito" type="button" role="tab" aria-controls="notas_credito" aria-selected="false">Notas de crédito</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="contabilidad-tab" data-bs-toggle="tab" data-bs-target="#contabilidad" type="button" role="tab" aria-controls="contabilidad" aria-selected="false">Contabilidad</button>
                        </li>
                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="pagos_recibidos" role="tabpanel" aria-labelledby="pagos_recibidos-tab">
                            <div class="card border-0">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-hover">
                                            <thead>
                                                <tr class="bg-light">
                                                    <th class="fw-bold small text-uppercase h6">Fecha</th>
                                                    <th class="fw-bold small text-uppercase h6">Nro. Operación</th>
                                                    <th class="fw-bold small text-uppercase h6">Método de pago</th>
                                                    <th class="fw-bold small text-uppercase text-end h6">Monto</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                @php
                                                    $cobros_historial = \App\Models\Detallecobro::where('codigo_venta',$admin_comp_venta->codigo)->get();
                                                @endphp
                                                @foreach($cobros_historial as $cobros_historiales)
                                                    <tr>
                                                        <td class="align-middle fw-normal">{{$cobros_historiales->fecha}}</td>
                                                        <td class="align-middle fw-normal">{{$cobros_historiales->nro_operacion}}</td>
                                                        <td class="align-middle fw-normal">{{$cobros_historiales->medio_pago}}</td>
                                                        <td class="align-middle fw-normal text-end">{{$cobros_historiales->total_cobrado}}</td>
                                                    </tr>
                                                @endforeach
                                              </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="notas_credito" role="tabpanel" aria-labelledby="notas_credito-tab">
                            <div class="card border-0">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-hover text-center">
                                            <thead>
                                                <tr class="bg-light">
                                                    <th class="fw-bold small text-uppercase h6">Fecha</th>
                                                    <th class="fw-bold small text-uppercase h6">Nota de crédito</th>
                                                    <th class="fw-bold small text-uppercase text-end h6">Monto</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                @php
                                                    $nc_historial = \App\Models\Comprobante::where('credito_debito',1)->where('tipo_comprobante','Nota de crédito')->where('codigo_venta',$admin_comp_venta->codigo_venta)->first();
                                                @endphp
                                                @if($nc_historial)
                                                    <tr>
                                                        <td class="align-middle fw-normal">{{$nc_historial->fechaemision}}</td>
                                                        <td class="align-middle fw-normal">{{$nc_historial->serie.'-'.$nc_historial->correlativo}}</td>
                                                        <td class="align-middle fw-normal">{{$nc_historial->total}}</td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td class="align-middle fw-normal">--</td>
                                                        <td class="align-middle fw-normal">--</td>
                                                        <td class="align-middle fw-normal">--</td>
                                                    </tr>
                                                @endif
                                              </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contabilidad" role="tabpanel" aria-labelledby="contabilidad-tab">
                            <div class="card border-0">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-hover text-center">
                                            <thead>
                                                <tr class="bg-light">
                                                    <th class="fw-bold small text-uppercase h6">Vou Origen</th>
                                                    <th class="fw-bold small text-uppercase h6">Numero</th>
                                                    <th class="fw-bold small text-uppercase text-end h6">Fecha</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $cuenta_v = App\Models\Comprobanteoperacion::where('venta_id',$admin_comp_venta->venta_id)->first();
                                                @endphp
                                                @if($nc_historial)
                                                    <tr>
                                                        <td class="align-middle fw-normal">{{$cuenta_v?$cuenta_v->vou_origen:'--'}}</td>
                                                        <td class="align-middle fw-normal">{{$admin_comp_venta->serie.'-'.$admin_comp_venta->correlativo}}</td>
                                                        <td class="align-middle fw-normal">{{$cuenta_v->created_at->format('Y-m-d')}}</td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td class="align-middle fw-normal">--</td>
                                                        <td class="align-middle fw-normal">--</td>
                                                        <td class="align-middle fw-normal">--</td>
                                                    </tr>
                                                @endif
                                                </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pb-3 text-end" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                <a href="{{url('admin-comp-ventas')}}" class="btn btn-outline-secondary px-5">Volver</a>
            </div>   
        </div>
    </div>
</div>
{{-- Fin contenido --}}
    
    @include('ADMINISTRADOR.TESORERIA.comprobantes-venta.comprobantes_modal')
    @include('ADMINISTRADOR.TESORERIA.comprobantes-venta.anular_comprobante')
    @include('ADMINISTRADOR.TESORERIA.comprobantes-venta.aplicar_notacredito')
    @include('ADMINISTRADOR.TESORERIA.comprobantes-venta.enviar_correo')
   
@endsection

@section('js')
<script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>

    @if(session('Email_enviado') == 'ok')
    <script>
        Swal.fire({
        icon: 'success',
        confirmButtonColor: '#1C3146',
        title: '¡Éxito!',
        text: 'El correo ha sido enviado correctamente',
        })
    </script>
    @endif
    

    @if(session('Email_error') == 'ok')
    <script>
        Swal.fire({
        icon: 'error',
        confirmButtonColor: '#1C3146',
        title: '¡Éxito!',
        text: 'Envio denegado, verifica tu conexion',
        })
    </script>
    @endif
@endsection
