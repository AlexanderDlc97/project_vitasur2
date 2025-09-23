@extends('TEMPLATE.administrador')

@section('title', 'CAJA')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .nav__btn
{
    height: 40px;
    width: 40px;
    border-radius: 50%;
    /* transform: translateY(10px); */
    background-color: rgba(0, 0, 0, 0.5);
    transition: 0.2s;
}

.nav__btn:hover{
    background-color: rgba(0, 0, 0, 0.8);
}

.nav__btn::after,
.nav__btn::before{
    font-size: 20px;
    color: #FFFFFF;
}
</style>
@endsection
 
@section('content')
<!-- Encabezado -->
<div class="header_section">
    <div class="bg-transparent mb-3" style="height: 67px"></div>
    <div class="container-fluid">
        <div class="" data-aos="fade-right">
            <h1 class="titulo h2 text-uppercase fw-bold mb-0">CAJA</h1>
            <div class="" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-decoration-none link" href="">Tesoreria</a></li>
                    <li class="breadcrumb-item"><a class="text-decoration-none link" href="{{ url('admin-caja') }}">Caja</a></li>
                    <li class="breadcrumb-item" aria-current="page">{{ $admin_caja->name_caja }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- fin encabezado -->

<div class="container-fluid">   
    <div class="card border-4 borde-top-primary shadow-sm h-100" style="border-radius: 20px; min-height: 500px" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
        <div class="card-header bg-transparent">
            <div class="row g-1 justify-content-beetween">
                @if($registcaja)
                    @if($registcaja->estado != 'CERRADA')
                        <div class="col-12 col-md-3 col-xl-3 mb-2 mb-lg-0">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#cajaaperturada" disabled class="btn text-uppercase btn-primary text-white btn-sm w-100">
                                <i class="bi bi-plus-circle-fill me-2"></i>
                                Aperturar Caja
                            </button>
                        </div>
                    @else
                        <div class="col-12 col-md-3 col-xl-3 mb-2 mb-lg-0">
                            <button type="button" class="btn btn-primary btn-sm text-uppercase w-100 text-white" data-bs-toggle="modal" data-bs-target="#create_registro_caja">
                                <i class="bi bi-plus-circle-fill me-2"></i>
                                Aperturar Caja
                            </button>
                        </div>
                    @endif
                @else
                    <div class="col-12 col-md-3 col-xl-3 mb-2 mb-lg-0">
                        <button type="button" class="btn btn-primary btn-sm text-uppercase w-100 text-white" data-bs-toggle="modal" data-bs-target="#create_registro_caja">
                            <i class="bi bi-plus-circle-fill me-2"></i>
                            Aperturar Caja
                        </button>
                    </div>
                @endif
                <div class="col-12 col-md-3 col-xl-3 mb-2 mb-lg-0">
                    <form method="POST" action="{{ route('admin-index-cajas.index_filtro') }}" enctype="multipart/form-data" autocomplete="off" class="needs-validation" novalidate>
                        @csrf
                        <div class="input-group input-group-sm">
                            <input type="date" name="fec_ini" id="fini__id" class="form-control">
                            <input type="date" name="fec_fin" id="ffin__id" class="form-control">
                            <input hidden name="valor_caja" value="{{$admin_caja->id}}">
                            <button class="btn btn-primary" type="submit" id="bfiltrar_dtable"><i class="bi bi-search text-white"></i></button>
                        </div>
                    </form>
                </div>
                <div class="col-12 col-md-3 col-xl-3 mb-2 mb-lg-0">
                </div>
                <div class="col-6 col-md-3 col-xl-2 mb-2 mb-lg-0">
                </div>
                <div class="col-12 col-md-6 col-lg-3 col-xl-1 mb-2 mb-lg-0">
                    <button type="button" class="btn btn-dark btn-sm w-100" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-download"></i></button>
                    <ul class="dropdown-menu">      
                        <li class="dropdown-item">
                            <button class="bg-transparent border-0 px-0 mx-0" data-bs-toggle="modal" data-bs-target="#reporte_Excel"><i class="bi bi-file-excel me-2"></i><small>EXCEL</small></button>
                        </li>                                            
                        <li class="dropdown-item">
                            <button class="bg-transparent border-0 px-0 mx-0" data-bs-toggle="modal" data-bs-target="#reporte_PDF"><i class="bi bi-file-pdf me-2"></i><small>PDF</small></button>
                        </li>                                                    
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="card shadow-sm pb-3 position-relatives @if ($admin_caja->estado == 'APERTURADA') border-success @else border-danger @endif" id="name_caja">
                        <div class="card-body">
                            <div class="row g-0 border-bottom">
                                <div class="col-3">
                                    <img src="/images/cuentas/caja-registradora.png" class="img-fluid rounded-3" alt="">
                                </div>
                                <div class="col-9 ps-2">
                                        <p class="mb-0 text-uppercase small fw-bold text-end">{{$admin_caja->name_caja}} <br>
                                        <small class="text-muted" id="name_sede_caja">{{$admin_caja->sede->name}}</small></p>
                                        <p class="fs-5 mb-0 fw-bold text-end"><span class="text-primary">S/ {{ number_format($admin_caja->total, 2, '.', ',') }}</span></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <img src="/images/cuentas/efectivo.png" class="img-fluid py-2 rounded-3" alt="">
                                </div>
                                <div class="col-9 d-flex">
                                    <div class="align-self-center w-100">
                                        <div class="clearfix text-uppercase">
                                            <span class="float-start">
                                                S/
                                            </span>
                                            <span class="float-end">
                                                {{ number_format($admin_caja->total_efectivo, 2, '.', ',') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="border-top">
                                <div class="row mt-2">
                                    <div class="col-3" id="name_imagen_billetera">
                                        <img src="/images/cuentas/banco.png" class="img-fluid rounded-3" alt="">
                                    </div>
                                    <div class="col-9 d-flex">
                                        <div class="align-self-center w-100">
                                            <div class="clearfix text-uppercase">
                                                <span class="float-start">
                                                    S/
                                                </span>
                                                <span class="float-end" id="name_total_billetera">
                                                    {{ number_format($admin_caja->total_cuenta_banco, 2, '.', ',') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($admin_caja->estado == 'APERTURADA')
                            <span class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-success">
                                {{ $admin_caja->estado }}
                            </span>
                        @else
                            <span class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger">
                                {{ $admin_caja->estado }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-12 col-md-8 col-lg-9 bg-light rounded">
                    <div class="row g-2 px-1 pt-2">
                        @foreach($cuentas as $cuenta)
                            <div class="col-12 col-md-4">
                                <div class="card border-2 borde-left-secondary shadow-sm mb-1" id="name_caja">
                                    <div class="card-body px-2">
                                        <div class="row g-0">
                                            <div class="col-3 border-end pe-2 d-flex">
                                                <img src="/images/cuentas/{{ $cuenta->banco->imagen }}" class="img-fluid align-self-center rounded" alt="">
                                            </div>
                                            <div class="col-9 d-flex">
                                                <div class="align-self-center w-100">
                                                    <div class="text-end">
                                                        <p class="mb-0">{{ $cuenta->nro_cuenta }}</p>
                                                        <small class="text-muted">{{ $cuenta->nro_cuenta_cci }}</small>
                                                    </div>
                                                    <div class="clearfix text-uppercase">
                                                        <span class="float-start ps-2">
                                                            S/
                                                        </span>
                                                        <span class="float-end fw-bold" id="name_total_billetera">
                                                            {{ number_format($cuenta->apertura_cuenta, 2, '.', ',') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 col-md-6 mb-2 ">
                    <span class="text-uppercase">Total de registros encontrados: <span class="fw-bold" id="contador_registro">{{ $registrocaja->count() }}</span></span>
                </div>
            </div>
            <table id="display" class="table table-hover table-sm py-2" cellspacing="0" style="width:100%">
                <thead class="bg-light">
                    <tr>
                        <th class="h6 text-uppercase fw-bold small">N°</th>
                        <th class="h6 text-uppercase fw-bold small">F/H Apertura</th>
                        <th class="h6 text-uppercase fw-bold small">F/H Cierre</th>
                        <th class="h6 text-uppercase fw-bold small">Inicial</th>
                        <th class="h6 text-uppercase fw-bold small">Ingreso</th>
                        <th class="h6 text-uppercase fw-bold small">Egreso</th>
                        <th class="h6 text-uppercase fw-bold small">Total</th>
                        <th class="h6 text-uppercase fw-bold small">Estado</th>
                        <th class="h6 text-uppercase fw-bold small text-center">Acciones</th>
                    </tr>
                </thead>
                    <tbody id="index_caja">
                        @php
                            $contador = 1;
                        @endphp           
                            @foreach ($registrocaja as $registro)   
                                <tr class="">
                                    <td class="fw-normal align-middle">{{ $contador }}</td>
                                    <td class="fw-normal align-middle">{{ $registro->fecha_apertura.' / '.$registro->hora_apertura }}</td>
                                    <td class="fw-normal align-middle">{{ $registro->fecha_cierre.' / '.$registro->hora_cierre }}</td>
                                    <td class="fw-normal align-middle">{{ number_format($registro->saldo_inicial, 2, '.', ',') }}</td>
                                    <td class="fw-normal align-middle text-success">
                                        <i class="bi bi-arrow-up-short me-1"></i>
                                         {{ number_format($registro->saldo_ingreso, 2, '.', ',') }}
                                        </td>
                                    <td class="fw-normal align-middle text-danger">
                                        <i class="bi bi-arrow-down-short me-1"></i>
                                        {{ number_format($registro->saldo_egreso, 2, '.', ',') }}
                                    </td>
                                    <td class="fw-bold align-middle">{{ number_format(($registro->saldo_inicial+$registro->saldo_ingreso)-$registro->saldo_egreso, 2, '.', ',') }}</td>
                                    <td class="fw-normal align-middle">
                                        @if($registro->estado == 'APERTURADA')
                                            <span class="badge bg-success text-uppercase small">Aperturada</span>
                                        @else
                                            <span class="badge bg-danger text-uppercase small">Cerrada</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">   
                                        <div class="text-start text-md-center">
                                            <div class="dropstart">
                                                 <button type="button" class="btn btn-grey btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu"> 
                                                    @if($registro->estado == 'APERTURADA')
                                                        <li class="dropdown-item">
                                                            <button class="bg-transparent text-danger border-0 px-0 mx-0" data-bs-toggle="modal" data-bs-target="#cerrar_registro_caja{{ $registro->slug }}"><i class="fa-solid fa-power-off me-2"></i>Cerrar</button>
                                                        </li>                                                
                                                    @else
                                                    @endif
                                                    <li class="dropdown-item">
                                                        <button class="bg-transparent border-0 px-0 mx-0" data-bs-toggle="modal" data-bs-target="#movimientos_registro_caja{{ $registro->slug }}"><i class="bi bi-eye-fill me-2"></i>Detalles</button>
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
    @foreach($registrocaja as $registro)
        @include('ADMINISTRADOR.TESORERIA.cajas.registro_caja.cerrar_registro_caja')            
        @include('ADMINISTRADOR.TESORERIA.cajas.registro_caja.show')            
    @endforeach
    
    @include('ADMINISTRADOR.TESORERIA.cajas.registro_caja.create_registro_caja')

    <!-- ADMINISTRADOR.TESORERIA.cajas.registro_caja.reporte_modal_pdf || ADMINISTRADOR.TESORERIA.cajas.registro_caja.reporte_modal_excel -->
    @include('ADMINISTRADOR.TESORERIA.cajas.registro_caja.reporte_modal_pdf')
    @include('ADMINISTRADOR.TESORERIA.cajas.registro_caja.reporte_modal_excel')
@endsection
@section('js')
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
  var swiper = new Swiper(".slider-cuentas", {
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
</script>

<!--sweet alert agregar-->
    @if(session('addcaja') == 'ok')
    <script>
        Swal.fire({
        icon: 'success',
        confirmButtonColor: '#1C3146',
        title: '¡Éxito!',
        text: 'Caja aperturada correctamente',
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
                $.get('/cajas/filtrar/fecha', {fecha: fecha,autenticado:autenticado}, function(progra){
                    $('#index_caja').empty("");
                    $.each(progra.Arraylist, function(index, value){
                        if(value == 'vacio'){
                            $('#index_caja').empty("");
                            $('#contador_registro').html(0);
                            $('#tipo_sede').html("");
                        }else{
                            if(value[7] == 'APERTURADA'){
                                estado = '<span class="badge bg-success text-uppercase small">Aperturada</span>';
                            }else{
                                estado = '<span class="badge bg-primary text-uppercase small">Cerrada</span>';
                            }

                            if(value[7] == 'APERTURADA'){
                                cierre_apertura = '<button type="button" class="btn btn-primary btn-sm text-white me-1" data-bs-toggle="modal" data-bs-target="#cerrar_registro_caja'+value[3]+'"><i class="bi bi-x"></i></button>';
                            }else{
                                cierre_apertura = '<button type="button" class="btn btn-danger btn-sm disabled me-1" data-bs-toggle="modal" data-bs-target="#cerrar_registro_caja'+value[3]+'"><i class="bi bi-x"></i></button>';
                            }
                            $('#tipo_sede').html(value[8]);
                            var fila = '<tr id="filamp' + contador_mp +
                            '"><td class="align-middle fw-normal">' + contador_mp + '</td><td class="align-middle fw-normal">' +
                            value[0] + '</td><td class="align-middle fw-normal">' + value[1] +
                            '</td><td class="align-middle fw-normal">' + value[2]+
                            '</td><td class="fw-normal text-success align-middle fw-normal">' + value[4]+
                            '</td><td class="fw-normal text-danger align-middle fw-normal">' + value[5]+
                            '</td><td class="align-middle fw-normal">' + value[6]+
                            '</td><td class="align-middle fw-normal">' + estado+
                            '</td><td class="align-middle"><div class="text-center">'+cierre_apertura+'<button type="button" class="btn btn-primary btn-sm text-white" data-bs-toggle="modal" data-bs-target="#movimientos_registro_caja'+value[3]+'"><i class="bi bi-eye-fill"></i></button></div></td> </tr>';
                            $('#contador_registro').html(contador_mp);
                            contador_mp++;
                            $('#index_caja').append(fila);
                        }
                    });
                });

                $.get('/cajas/filtrar/fecha', {fecha: fecha,autenticado:autenticado}, function(progras){
                    $('#name_caja').empty("");
                    $.each(progras.ArraylistB, function(index, value){
                        if(value == 'vacio'){
                            $('#name_caja').empty("");
                        }else{
                            var todo='<tr><td>'+index+'</td>';
                            var todo='<div class="card border-secondary mb-3">';
                            var todo='<div class="card-body">';
                            todo+='<div class="row g-0 border-bottom"><div class="col-3"><img src="/images/cuentas/caja.png" class="img-fluid rounded-3" alt=""></div><div class="col-9 ps-2"><p class="mb-0 text-uppercase small fw-bold text-end">Caja '+value[2]+' <br><small class="text-muted" id="name_sede_caja">'+value[2]+'</small></p><p class="fs-5 mb-0 fw-bold text-end"><span class="text-primary">S/ '+value[3]+'</span></p></div></div>';

                            todo+='<div class="row"><div class="col-3"><img src="/images/cuentas/efectivo.png" class="img-fluid rounded-3" alt=""></div><div class="col-9 d-flex"><div class="align-self-center w-100"><div class="clearfix text-uppercase"><span class="float-start">S/</span><span class="float-end">'+value[4]+'</span></div></div></div></div>';

                            todo+='<div class="border-top"><div class="row mt-2"><div class="col-3" id="name_imagen_billetera"><img src="/images/cuentas/'+value[0]+'" class="img-fluid rounded-3" alt=""></div><div class="col-9 d-flex"><div class="align-self-center w-100"><div class="clearfix text-uppercase"><span class="float-start">S/</span><span class="float-end" id="name_total_billetera">'+value[1]+'</span></div></div></div></div></div>';
                            todo+='</div>';
                            todo+='</div>';
                            $('#name_caja').append(todo);
                        }
                    });
                });
            }else{

            }
        });
    });
    </script>
@endsection