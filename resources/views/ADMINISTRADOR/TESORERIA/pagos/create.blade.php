@extends('TEMPLATE.administrador')

@section('title', 'PAGOS')

@section('css')

@endsection
 
@section('content')
<!-- Encabezado -->
<div class="header_section">
        <div class="bg-transparent mb-3" style="height: 67px"></div>
        <div class="container-fluid">
            <div class="" data-aos="fade-right">
                <h1 class="titulo h2 text-uppercase fw-bold mb-0">PAGOS</h1>
                <div class="" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="">Tesoreria</a></li>
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="{{ url('admin-pagos') }}">Pagos</a></li>
                        <li class="breadcrumb-item" aria-current="page">Nuevo registro</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
<!-- Fin encabezado-->

{{-- Contenido --}}
<form class="form-group" method="POST" action="/admin-pagos" enctype="multipart/form-data" autocomplete="off">      
    @csrf
    <div class="container-fluid">   
    <div class="card border-4 borde-top-primary shadow-sm h-100" style="border-radius: 20px; min-height: 500px" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                <div class="card-body">
                    <span class="text-danger">* <small class="text-muted py-0 my-0 text-start"> - Campos obligatorios</small></span>
                    <div class="row">
                        <div class="col-12 col-md-5 col-lg-4 col-xl-2">
                            <div class="mb-3">
                                <label for="tipo_trans" class="">Tipo de Transacción</label>
                                <select id="tipo_trans" class="form-select form-select-sm @error('tipo_transaccion') is-invalid @enderror">
                                    <option disabled selected="selected" hidden="hidden">-- Seleccione --</option>
                                    <option value="AMORTIZACION">AMORTIZACION</option>
                                </select>
                                @error('tipo_transaccion')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <input hidden id="tipo_trans_id" name="tipo_transaccion">
                        </div>
                        <div class="col-12 col-md-5 col-lg-2 col-xl-2" id="show_tipo_aplic">
                            <div class="mb-3">
                                <label for="aplicacion_a" class="">Tipo de aplicacion</label>
                                <select id="aplicacion_a" class="form-select form-select-sm" required>
                                    <option disabled selected="selected" hidden="hidden">-- Seleccione --</option>
                                    <option value="Profesional">PROFESIONAL</option>
                                    <option value="Servicio">SERVICIO</option>
                                </select>
                            </div>
                            <input hidden id="aplicado_a" name="aplicado_a">
                        </div>
                        <div class="col-12 col-md-3 col-lg-2" id="mostrar_profes">
                            <label for="medico__id">Profesional<span class="text-danger">*</span></label>
                            <select name="medico_id" id="medico__id" class="form-select form-select-sm select2_bootstrap_2" data-placeholder="Seleccione">
                            </select>
                            <input hidden name="medico__id_value" id="medico__id_value">
                            <div class="invalid-feedback">
                                El campo no puede estar vacío
                            </div>
                        </div>
                    </div>
                    <div class="row border-bottom mb-2">
                        <div class="col-12 col-md-6 col-lg-2">
                            <div class="mb-3">
                                <label for="nro_operacion_id" class="">Nro. Operación<span class="text-danger">*</span></label>
                                <input type="text" value="{{$codigP}}" id="nro_operacion_id" class="form-control fw-light form-control-sm bg-white" disabled maxLength="100">  
                                <input hidden name="nro_operacion" value="{{$codigP}}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-2">
                            <div class="mb-3">
                                <label for="fecha_id" class="">Fecha<span class="text-danger">*</span></label>
                                <input type="date" value="{{$fecha_actual}}" id="fecha_id" class="form-control form-control-sm bg-white" disabled>
                                <input hidden name="fecha" value="{{$fecha_actual}}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-2">
                            <div class="mb-3">
                                <label for="moneda_id" class="">Moneda</label>
                                <select name="tipo_moneda" class="form-select form-select-sm" id="moneda_id" >
                                    <option value="Soles" selected="selected">Soles - PEN</option>
                                    <option value="Dólares">Dólares - USD</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="egreso_id" class="">Egreso a</label>
                                <select name="egreso" id="egreso_id" class="form-select form-select-sm select2 @error('egreso') is-invalid @enderror">
                                    <option selected="selected" hidden="hidden"></option>
                                    <option disabled>Efectivo</option>
                                    <option value="Efectivo">Caja Uno</option>
                                    <option disabled>Bancos</option>
                                    @foreach ($bancos as $banco)
                                        <option value="{{$banco->nro_cuenta}}">{{$banco->banco->name.': '.$banco->nro_cuenta}}</option>                                   
                                    @endforeach
                                </select>
                                @error('egreso')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-2">
                            <div class="mb-3">
                                <label for="medio_pago_id" class="">Medio de pago</label>
                                <select name="medio_pago" id="medio_pago" class="form-select form-select-sm @error('medio_pago') is-invalid @enderror">
                                </select>
                                @error('medio_pago')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <table class="w-100 table table-sm" id="cobros" >
                        <thead class="bg-light">
                            <tr>
                                <th class="h6 text-uppercase fw-bold small" style="width: 5%">N°</th>
                                <th class="h6 text-uppercase fw-bold small" style="width: 45%">Concepto</th>
                                <th class="h6 text-uppercase fw-bold small" style="width: 10%">Total</th>
                                <th class="h6 text-uppercase fw-bold small" style="width: 10%">Pagado</th>
                                <th class="h6 text-uppercase fw-bold small" style="width: 10%">Por pagar</th>
                                <th class="h6 text-uppercase fw-bold small" style="width: 10%">Pagado</th>
                                <th class="h6 text-uppercase fw-bold small" style="width: 10%">Comp. Pago</th>
                            </tr>
                        </thead>
                        <tbody id="cobros_tble">
                        </tbody>
                    </table>
                    <div id="contenedor_otros">
                        <div class="row g-2">
                            <div class="col-12 col-md-6 col-lg-3 col-xl-4">
                                <div class="mb-3">
                                    <label for="moneda_id" class="">Concepto</label>
                                    <div class="input-group input-group-sm" id="new_concept">
                                        <input type="text" id="concepto_id" placeholder="" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3 col-xl-1">
                                <div class="mb-3">
                                    <label for="moneda_id" class="">Valor</label>
                                    <input type="decimal" name="valor" id="valor_id" placeholder="S/" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3 col-xl-1">
                                <div class="mb-3">
                                    <label for="cantidad_id" class="">Cantidad</label>
                                    <input type="number" name="cantidad" id="cantidad_id" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-5 col-xl-5">
                                <div class="mb-3">
                                    <label for="observacion_id" class="">Observaciones</label>
                                    <textarea name="observaciones" id="observacion_id" class="form-control form-control-sm" rows="2"></textarea>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3 col-xl-1 d-flex">
                                <div class="mb-3 align-self-top w-100">
                                    <label for="" class=" text-white">Agregar</label>
                                    <button type="button" class="btn btn-sm btn-secondary text-white w-100" id="btnasignar"><i class="bi bi-plus-circle"></i></button>
                                </div>
                            </div>
                        </div>
                        <table class="w-100 table table-sm" >
                            <thead class="bg-light">
                                <tr>
                                    <th class="h6 text-uppercase fw-bold small" style="width: 5%">N°</th>
                                    <th class="h6 text-uppercase fw-bold small" style="width: 30%">Concepto</th>
                                    <th class="h6 text-uppercase fw-bold small" style="width: 10%">Valor</th>
                                    {{-- <th class="h6 text-uppercase fw-bold small" style="width: 10%">Impuesto</th> --}}
                                    <th class="h6 text-uppercase fw-bold small" style="width: 10%">Cantidad</th>
                                    <th class="h6 text-uppercase fw-bold small" style="width: 50%">Observaciones</th>
                                    <th class="h6 text-uppercase fw-bold small" style="width: 5%"></th>
                                </tr>
                            </thead>
                            <tbody id="dt_otros">
                                
                            </tbody>
                        </table>
                    </div>

                    <div class="row justify-content-beetween">
                        <div class="col-12 col-md-7">
                            <p class="fw-bold mb-1">Observaciones:</p>
                            <textarea name="descripcion" class="form-control fw-light form-control-sm bg-white"></textarea>
                        </div>
                        <div class="col-12 col-md-5">
                            <table class="w-100">
                                <tr>
                                    <td class="border-0 ps-2 py-1 bg-light" style="width: 50%">
                                        Subtotal
                                    </td>
                                    <td class="border-0 pe-2 py-1 bg-light" style="width: 50%">
                                        <div class="clearfix">
                                            <span class="float-start ps-2">S/ </span>
                                            <span class="float-end" id="subtotal">
                                                0.00
                                            </span>
                                            <input id="subtotal_id" hidden name="subtotal">
                                        </div>
                                    </td>
                                </tr>
                                
                                
                                <!-- <tr id="igv_total">
                                    <td class="border-0 ps-2 py-1" style="width: 50%">
                                        IGV (18%)
                                    </td>
                                    <td class="border-0 pe-2 py-1" style="width: 50%">
                                        <div class="clearfix">
                                            <span class="float-start ps-2">S/ </span>
                                            <span class="float-end" id="igv">
                                                0.00
                                            </span>
                                            <input id="igv_id" hidden name="igv">
                                        </div>
                                    </td>
                                </tr> -->

                                <tr>
                                    <td class="border-0 fw-bold ps-2 py-1 bg-light" style="width: 50%">
                                        TOTAL COBRADO
                                    </td>
                                    <td class="border-0 fw-bold pe-2 py-1 bg-light" style="width: 50%">
                                        <div class="clearfix">
                                            <span class="float-start ps-2">S/ </span>
                                            <span class="float-end" id="total_pagado">
                                                0.00
                                            </span>
                                            <input id="total_cobrado_id" hidden name="total_pagado" >
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            @error('total_pagado')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="pb-3 text-end" {{--data-aos="fade-up" data-aos-anchor-placement="top-bottom"--}}>
                <a href="{{ url('admin-pagos') }}" class="btn btn-outline-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary px-5 my-2 my-md-0 text-white">Registrar</button>
            </div>
        </div>
    </form>
{{-- Fin contenido --}}

@endsection

@section('js')
 <script>
        $('#contenedor_otros').hide();
        $('#show_tipo_aplic').hide();
        $('#mostrar_profes').hide();
        $(document).ready(function() {
            $('#tipo_trans').on('change', function(){
                $('#tipo_trans').attr('disabled', true);
                transaccion = $(this).val();
                $('#tipo_trans_id').val(transaccion);
                if(transaccion == 'AMORTIZACION'){
                    $('#show_tipo_aplic').show();
                    $('#aplicacion_a').on('change', function(){
                        valor_apli = $(this).val();
                        $('#aplicacion_a').attr("disabled", true);
                        $('#aplicado_a').val(valor_apli);

                        $('#cobros').hide();
                        $('#contenedor_otros').show();
                        $('#igv_total').hide();

                        if(valor_apli == 'Profesional'){
                            $('#mostrar_profes').show();

                            $.get('/trans_pagos_medic', {valor_apli: valor_apli}, function(cliente_codigo){
                                $('#medico__id').empty();
                                $('#medico__id').append('<option selected>Selecciona una opcion</option>');
                                $.each(cliente_codigo, function(index, value){
                                    $('#medico__id').append('<option value="'+index+'_'+value[0]+'">'+value[0]+'</option>');
                                });
                            });

                            $('#medico__id').on('change', function(){
                                dr_operacion = document.getElementById('medico__id').value.split('_');
                                $('#medico__id_value').val(dr_operacion[1]);
                            });
                        }
                    });

                    var contador_mp = 1;
                    var subtotal=[];
                    var neto = 0;
                    var igv=0;

                    $('#btnasignar').click(function() {
                        var concepto = $('#concepto_id').val();
                        var valor = $('#valor_id').val();
                        /*var impuesto = $('#impuesto_id').val(0);*/
                        var impuesto = 1;
                        var cantidad = $('#cantidad_id').val();
                        var observaciones = $('#observacion_id').val();
                        if (concepto != '' && valor != '' && impuesto != '' && cantidad != ''){
                                var impuesto = 0;
                                let subtotales = 0;
                                [ ...document.getElementsByName( "subtotal" ) ].forEach( function ( element ) {
                                    if(element.value !== '') {
                                        subtotales += parseFloat(element.value);
                                    }
                                });

                                if(subtotales == 0){
                                    neto = 0;
                                    subtotal=(cantidad*valor);
                                    subtotal = subtotal.toFixed(1);
                                    neto =(parseFloat(neto)+parseFloat(subtotal)).toFixed(2);
                                    igv= 0;
                                    total=(parseFloat(neto)+parseFloat(igv)).toFixed(2);
                                }else{
                                    subtotal=(cantidad*valor);
                                    subtotal = subtotal.toFixed(1);
                                    neto =(parseFloat(neto)+parseFloat(subtotal)).toFixed(2);
                                    igv= 0;
                                    total=(parseFloat(neto)+parseFloat(igv)).toFixed(2);
                                }

                                var fila = '<tr class="selected igv_carta" id="filamp'+contador_mp+'"><td class="align-middle fw-normal">'+contador_mp+'</td><td class="align-middle fw-normal">'+concepto+'</td><td class="align-middle fw-normal">'+valor+'</td><td class="align-middle fw-normal text-danger fw-bold">'+cantidad+'</td><td class="align-middle fw-normal text-danger fw-bold">'+observaciones+'</td><<td class="align-middle"><button type="button" class="btn btn-sm btn-danger" onclick="eliminarmp('+contador_mp+','+subtotal+');"><i class="bi bi-trash"></i></button></td><input type="hidden" name="contador[]" value="'+contador_mp+'"><input type="hidden" name="concepto[]" value="'+concepto+'"><input type="hidden" name="valor[]" value="'+valor+'"><input type="hidden" name="impuesto" value="'+impuesto+'"><input type="hidden" name="cantidad[]" value="'+cantidad+'"><input type="hidden" name="observaciones[]" value="'+observaciones+'"></tr>';
                                contador_mp++;
                                limpiarmp();
                                
                                if(total == 0){
                                    $("#igv").html("0");
                                    $("#igv_id").val(0);
                                }else{
                                    $("#igv").html(0.00);
                                    $("#igv_id").val(0.00);
                                }
                                $("#subtotal").html(neto);
                                $("#subtotal_id").val(neto);
                                $("#total_pagado").html(total);
                                $("#total_cobrado_id").val(total);
                                $('#dt_otros').append(fila);

                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Error al ingresar el detalle del ingreso, revise los datos del producto',
                            })
                        }
                    });
                }
            });

            function limpiarmp() {
                $('#concepto_id').prop('selectedIndex', 0).change();
                $("#valor_id").val("");
                $("#cantidad_id").val("");
                $("#observacion_id").val("");
            }

            $('#egreso_id').on('change', function(){
                egresoss = $(this).val();
                if(egresoss === 'Efectivo'){
                    $('#medio_pago').empty();
                    $('#medio_pago').append('<option selected>Selecciona una opcion</option>');
                    $('#medio_pago').append('<option value="Efectivo">Efectivo</option>');
                }else{
                    $('#medio_pago').empty();
                    $('#medio_pago').append('<option selected>Selecciona una opcion</option>');
                    $('#medio_pago').append('<option value="Consignación">Consignación</option>');
                    $('#medio_pago').append('<option value="Transferencia">Transferencia</option>');
                    $('#medio_pago').append('<option value="Yape">Yape</option>');
                    $('#medio_pago').append('<option value="Plin">Plin</option>');
                    $('#medio_pago').append('<option value="Cheque">Cheque</option>');
                    $('#medio_pago').append('<option value="Tarjeta de crédito">Tarjeta de crédito</option>');
                    $('#medio_pago').append('<option value="Tarjeta de débito">Tarjeta de débito</option>');
                }
            });
        });

        function eliminarmp(indexmp ,subtotal)
        {
            $("#filamp" + indexmp).remove();
            let subtotales = 0;
            [ ...document.getElementsByName( "subtotal" ) ].forEach( function ( element ) {
                if(element.value !== '') {
                    subtotales += parseFloat(element.value);
                }
            });
            neto =(parseFloat(subtotales)-parseFloat(subtotal)).toFixed(2);
            console.log(neto);
            if(neto == 0 || neto<0){
                neto =(parseFloat(neto)*0).toFixed(2);
                igv= 0;
                total=(parseFloat(neto)+parseFloat(igv)).toFixed(2);
                $("#igv").html("0");
                $("#igv_id").val(0);
                $("#subtotal").html(0);
                $("#subtotal_id").val(0);
                $("#total_pagado").html(0);
                $("#total_cobrado_id").val(0);
            }else{
                igv= 0;
                total=(parseFloat(neto)+parseFloat(igv)).toFixed(2);
                $("#subtotal").html(neto);
                $("#subtotal_id").val(neto);
                $("#igv").html(0.00);
                $("#igv_id").val(0.00);
                $("#total_pagado").html(total);
                $("#total_cobrado_id").val(total);
            }


        }

        function sumar() {
            let subtotal = 0;

            if($('#tipo_trans').val() == 'COMPRA'){
                $(".recib").each(function() {
                    if(isNaN(parseFloat($(this).val()))){
                        subtotal += 0;
                    }else{
                        subtotal += parseFloat($(this).val());
                    }
                    if(subtotal == 0){
                        $("#igv").html("0");
                        $("#igv_id").val(0);
                    }else{
                        $("#igv").html(0);
                        $("#igv_id").val(0);
                    }
                    total_c = parseFloat(subtotal);
                    $("#subtotal").html(subtotal);
                    $("#subtotal_id").val(subtotal);
                    $("#total_pagado").html(total_c);
                    $("#total_cobrado_id").val(total_c);
                });
            }else{
                if($('#aplicacion_a').val() == 'Vendedor'){
                    $(".recib").each(function() {
                        if(isNaN(parseFloat($(this).val()))){
                            subtotal += 0;
                        }else{
                            subtotal += parseFloat($(this).val());
                        }
                        if(subtotal == 0){
                            $("#igv").html("0");
                            $("#igv_id").val(0);
                        }else{
                            $("#igv").html(0);
                            $("#igv_id").val(0);
                        }
                        total_c = parseFloat(subtotal);
                        $("#subtotal").html(subtotal);
                        $("#subtotal_id").val(subtotal);
                        $("#total_pagado").html(total_c);
                        $("#total_cobrado_id").val(total_c);
                    });
                }if($('#aplicacion_a').val() == 'Proveedor'){
                    $(".recib").each(function() {
                        if(isNaN(parseFloat($(this).val()))){
                            subtotal += 0;
                        }else{
                            subtotal += parseFloat($(this).val());
                        }
                        if(subtotal == 0){
                            $("#igv").html("0");
                            $("#igv_id").val(0);
                        }else{
                            $("#igv").html(0);
                            $("#igv_id").val(0);
                        }
                        impu = (subtotal).toFixed(2);
                        total_c = parseFloat(subtotal)+parseFloat(impu);
                        $("#subtotal").html(subtotal);
                        $("#subtotal_id").val(subtotal);
                        $("#total_pagado").html(total_c);
                        $("#total_cobrado_id").val(total_c);
                    });
                }if($('#aplicacion_a').val() == 'Empleado'){
                    $(".recib").each(function() {
                        if(isNaN(parseFloat($(this).val()))){
                            subtotal += 0;
                        }else{
                            subtotal += parseFloat($(this).val());
                        }
                        if(subtotal == 0){
                            $("#igv").html("0");
                            $("#igv_id").val(0);
                        }else{
                            $("#igv").html(0);
                            $("#igv_id").val(0);
                        }
                        impu = (subtotal).toFixed(2);
                        total_c = parseFloat(subtotal)+parseFloat(impu);
                        $("#subtotal").html(subtotal);
                        $("#subtotal_id").val(subtotal);
                        $("#total_pagado").html(total_c);
                        $("#total_cobrado_id").val(total_c);
                    });
                }
            }
        };
        
        function pintar_nombre() {
            valor_pulsado = $('#proveedor_id').val();
            if(valor_pulsado){
                $('#proveedor_ids').val(valor_pulsado);
            }else{
                $('#proveedor_ids').val("");
            }
        };
        </script>

        @if(session('montoElevado') == 'ok')
        <script>
            Swal.fire({
            icon: 'error',
            confirmButtonColor: '#1C3146',
            title: '¡Éxito!',
            text: 'El Monto Recibido excede del monto a cobrar',
            })
        </script>
        @endif
@endsection