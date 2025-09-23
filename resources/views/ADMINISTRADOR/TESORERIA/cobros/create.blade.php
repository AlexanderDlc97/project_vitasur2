@extends('TEMPLATE.administrador')

@section('title', 'COBROS')

@section('css')

@endsection
 
@section('content')
<!-- Encabezado -->
<div class="header_section">
        <div class="bg-transparent mb-3" style="height: 67px"></div>
        <div class="container-fluid">
            <div class="" data-aos="fade-right">
                <h1 class="titulo h2 text-uppercase fw-bold mb-0">COBROS</h1>
                <div class="" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="">Tesoreria</a></li>
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="{{ url('admin-cobros') }}">Cobros</a></li>
                        <li class="breadcrumb-item" aria-current="page">Nuevo registro</li>

                    </ol>
                </div>
            </div>
        </div>
    </div>
<!-- fin encabezado -->

{{-- Contenido --}}
    <form class="form-group" method="POST" action="/admin-cobros" enctype="multipart/form-data" autocomplete="off">      
        @csrf
        <div class="container-fluid">   
            <div class="card border-4 borde-top-primary shadow-sm h-100" style="border-radius: 20px; min-height: 500px" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                <div class="card-body">
                    <span class="text-danger">* <small class="text-muted py-0 my-0 text-start"> - Campos obligatorios</small></span>
                    <div class="row">
                        <div class="col-12 col-md-5 col-lg-4 col-xl-2">
                            <div class="mb-3">
                                <label for="tipo_trans" class="">Tipo de Transacción</label>
                                <select required id="tipo_trans" class="form-select form-select-sm @error('tipo_transaccion') is-invalid @enderror" >
                                    <option selected="selected" hidden="hidden">-- Seleccione --</option>
                                    <option value="ATENCION">ATENCION</option>
                                    <option value="EAUXILIAR">EAUXILIAR</option>
                                    <option value="MEDICAMENTOS">MEDICAMENTOS</option>
                                    <option value="PROCEDIMIENTOS">PROCEDIMIENTOS</option>
                                    <option value="OTROS">OTROS</option>
                                </select>
                                @error('tipo_transaccion')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <input hidden id="tipo_trans_id" name="tipo_transaccion">
                        </div>
                        <div class="col-12 col-md-3 col-lg-2" id="mostrar_tipo">
                            <label for="tipo__id">Tipo de Atencion<span class="text-danger">*</span></label>
                            <select name="tipo" id="tipo__id" class="form-select form-select-sm select2_bootstrap_2" data-placeholder="Seleccione">
                                <option value="{{ old('tipo') }}" selected="selected" hidden="hidden">{{ old('tipo') }}</option>
                                <option value="Cita programada">CITA PROGRAMADA</option>
                                <option value="Atencion directa">ATENCIÓN DIRECTA</option>
                            </select>
                            <div class="invalid-feedback">
                                El campo no puede estar vacío
                            </div>
                        </div>
                        <div class="col-12 col-md-3 col-lg-2" id="mostrar_medicam">
                            <label for="tipo__receta">Tipo de dispensación<span class="text-danger">*</span></label>
                            <select name="tipo_receta" id="tipo__receta" class="form-select form-select-sm select2_bootstrap_2" data-placeholder="Seleccione">
                                <option value="{{ old('tipo_receta') }}" selected="selected" hidden="hidden">{{ old('tipo') }}</option>
                                <option value="Receta">RECETA</option>
                                <option value="Libre">LIBRE</option>
                            </select>
                            <div class="invalid-feedback">
                                El campo no puede estar vacío
                            </div>
                        </div>
                        <div class="col-12 col-md-5 col-lg-4 col-xl-3">
                            <div class="mb-3">
                                <label for="t_cliente" class="">Paciente</label>
                                <div class="input-group input-group-sm" id="t_cliente">
                                    <select required id="cliente_id" class="form-select form-select-sm select2_bootstrap_2 @error('cliente') is-invalid @enderror" >
                                    </select>
                                    <input hidden name="person_ids" id="person_ids">
                                    <input hidden name="cliente" id="name_cli_ids">
                                    <input hidden name="asunto" id="name_cli_id">
                                </div>
                                @error('cliente')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-3 col-lg-2" id="mostrar_espec">
                            <div class="clearfix">
                                <span class="float-start">
                                    <label for="especialidad__id">Especialidad<span class="text-danger">*</span></label>
                                </span>
                                <span class="float-end small" id="mostrar_sesiones">
                                    <button type="button" class="btn badge btn-secondary btn-sm small w-100 align-bottom text-white" data-bs-toggle="modal" data-bs-target="#nueva_sesion">
                                        +
                                    </button>
                                </span>
                            </div>
                            <select id="especialidad__id" class=" form-select-sm select2_bootstrap_2" data-placeholder="Seleccione">
                                <option value="{{ old('especialidad_id') }}" selected="selected" hidden="hidden">{{ old('especialidad_id') }}</option>
                                @foreach($especialidades as $especialidad)
                                    <option value="{{ $especialidad->id }}_{{ $especialidad->profesione_id }}">{{ $especialidad->name }}</option>
                                @endforeach
                            </select>
                            <input hidden name="sesiones_value" id="sesiones_value_ids">
                            <div class="invalid-feedback">
                                El campo no puede estar vacío
                            </div>
                        </div>

                        <div class="col-12 col-md-3 col-lg-2" id="mostrar_profes">
                            <label for="medico__id">Profesional<span class="text-danger">*</span></label>
                            <select name="medico_id" id="medico__id" class="form-select form-select-sm select2_bootstrap_2" data-placeholder="Seleccione">
                            </select>
                            <div class="invalid-feedback">
                                El campo no puede estar vacío
                            </div>
                        </div>
                        <div class="col-6 col-md-2 col-lg-1">
                            <label for="agre" class=" d-block text-white">..</label>
                            <button type="button" id="btnasignar_servicio" class="btn btn-secondary btn-sm w-100 align-bottom text-white mt-2 mt-md-0">
                                Agregar
                            </button>
                        </div>
                    </div>
                    <div class="row border-bottom mb-2">
                        <div class="col-12 col-md-6 col-lg-2">
                            <div class="mb-3">
                                <label for="nro_operacion_id" class="">Nro. Operación<span class="text-danger">*</span></label>
                                <input type="text" value="{{ $codigC }}" id="nro_operacion_id" class="form-control fw-light form-control-sm bg-white" disabled maxLength="100">  
                                <input hidden name="nro_operacion" value="{{ $codigC }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-2">
                            <div class="mb-3">
                                <label for="fecha_id" class="">Fecha<span class="text-danger">*</span></label>
                                <input type="date" value="{{ $fecha_actual }}" id="fecha_id" class="form-control form-control-sm bg-white" disabled>
                                <input hidden name="fecha" value="{{ $fecha_actual }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-2">
                            <div class="mb-3">
                                <label for="moneda_id" class="">Moneda</label>
                                <select required name="tipo_moneda" class="form-select form-select-sm" id="moneda_id" >
                                    <option value="Soles" selected="selected">Soles - PEN</option>
                                    <option value="Dólares">Dólares - USD</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="ingreso_id" class="">Ingreso a</label>
                                <select required name="ingreso" id="ingreso_id" class="form-select form-select-sm select2 @error('ingreso') is-invalid @enderror" >
                                    <option selected="selected" hidden="hidden" disabled="disabled"></option>
                                    <option disabled>Efectivo</option>
                                    <option value="Efectivo">Caja Uno</option>
                                    <option disabled>Bancos</option>
                                    @foreach ($bancos as $banco)
                                        <option value="{{ $banco->nro_cuenta }}">{{ $banco->banco->name.': '.$banco->nro_cuenta }}</option>                                   
                                    @endforeach
                                </select>
                                @error('ingreso')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-2">
                            <div class="mb-3">
                                <label for="medio_pago_id" class="">Medio de pago</label>
                                <select required name="medio_pago" id="medio_pago" class="form-select form-select-sm @error('medio_pago') is-invalid @enderror" >
                                </select>
                                @error('medio_pago')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <table class="w-100 table table-sm" id="venta">
                        <thead class="bg-light">
                            <tr>
                                <th class="h6 text-uppercase fw-bold small" style="width: 5%">N°</th>
                                <th class="h6 text-uppercase fw-bold small" style="width: 45%">Concepto</th>
                                <th class="h6 text-uppercase fw-bold small" style="width: 10%">Total</th>
                                <th class="h6 text-uppercase fw-bold small" style="width: 10%">Por Cobrar</th>
                                <th class="h6 text-uppercase fw-bold small" style="width: 10%">Recibido</th>
                            </tr>
                        </thead>
                        <tbody id="cobros_tble">
                        </tbody>
                    </table>
                    <div id="contenedor_otros">
                        <div class="row g-2">
                            <div class="col-12 col-md-6 col-lg-3 col-xl-4">
                                <div class="mb-3">
                                    <label for="concepto_id" class="">Concepto</label>
                                    <select id="concepto_id" class="form-select select2_bootstrap_2" style="width: 100%">
                                        <option selected="selected" hidden="hidden">-- Seleccione --</option>
                                        @foreach ($producto as $productos)
                                            <option value="{{$productos->id}}_{{$productos->name}}">{{$productos->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3 col-xl-1">
                                <div class="mb-3">
                                    <label for="valor_id" class="">Valor</label>
                                    <input type="decimal" name="valor" id="valor_id" placeholder="S/" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3 col-xl-2">
                                <div class="mb-3">
                                    <label for="impuesto_id" class="">Impuesto</label>
                                    <select name="impuesto" id="impuesto_id" class="form-select form-select-sm select2_bootstrap_2" >
                                        <option hidden="hidden">-- Seleccione --</option>
                                        <option selected="selected" value="0">0 %</option>
                                        <option value="0.18">18 %</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3 col-xl-1">
                                <div class="mb-3">
                                    <label for="cantidad_id" class="">Cantidad</label>
                                    <input type="number" name="cantidad" id="cantidad_id" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3 col-xl-3">
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
                                    <th class="h6 text-uppercase fw-bold small" style="width: 10%">Impuesto</th>
                                    <th class="h6 text-uppercase fw-bold small" style="width: 10%">Cantidad</th>
                                    <th class="h6 text-uppercase fw-bold small" style="width: 30%">Observaciones</th>
                                    <th class="h6 text-uppercase fw-bold small" style="width: 5%"></th>
                                </tr>
                            </thead>
                            <tbody id="dt_otros">
                                <tr>
                                </tr>
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
                                            <span class="float-end" id="total_cobrado">
                                                0.00
                                            </span>
                                            <input required id="total_cobrado_id" hidden name="total_cobrado" >
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            @error('total_cobrado')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="pb-3 text-end">
                <a href="{{ url('admin-cobros') }}" class="btn btn-outline-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary px-5 my-2 my-md-0 text-white">Registrar</button>
            </div>
        </div>
    </form>
{{-- Fin contenido --}}
@include('ADMINISTRADOR.TESORERIA.cobros.sesiones')
@endsection

@section('js')
    <script>
    $('#contenedor_otros').hide();
    $('#aplicando').hide();
    $('#mostrar_tipo').hide();
    $('#mostrar_medicam').hide();
    $('#mostrar_espec').hide();
    $('#mostrar_profes').hide();
    $('#btnasignar_servicio').hide();
    $('#mostrar_sesiones').hide();
    $(document).ready(function () {
        
        $('#tipo_trans').on('change', function(){
            $('#tipo_trans').attr('disabled', true);
            transaccion = $(this).val();
            $('#tipo_trans_id').val(transaccion);
            if(transaccion == 'ATENCION'){
                $('#mostrar_tipo').show();
                $('#tipo__id').on('change', function(){
                    tipo_atencion_val = $(this).val();
                    if(tipo_atencion_val == 'Cita programada'){
                        $('#btnasignar_servicio').hide();
                        $('#mostrar_espec').hide();
                        $('#mostrar_profes').hide();

                        $('#especialidad__id').prop('disabled',true);
                        $('#especialidad__id').val("").trigger("change");
                        $('#medico__id').prop('disabled',true);
                        $('#medico__id').val("").trigger("change");
                        $.get('/trans_cobros', {tipo_atencion_val: tipo_atencion_val}, function(cliente_codigo){
                            $('#cliente_id').empty();
                            $('#cliente_id').append('<option selected>Selecciona una opcion</option>');
                            $.each(cliente_codigo, function(index, value){
                                $('#cliente_id').append('<option value="'+index+'_'+value[0]+'">'+value[0]+' // '+value[1]+'</option>');
                            });
                        });
                        $('#venta').show();
                        $('#contenedor_otros').hide();
                        $('#igv_total').hide();
        
                        $('#cliente_id').on('change', function(){
                            clientes_operacion = document.getElementById('cliente_id').value.split('_');
                            $('#name_cli_id').val(clientes_operacion[1]);
                            $('#name_cli_ids').val(clientes_operacion[1]);
                            $('#person_ids').val(clientes_operacion[0]);
                            $('#cobros_tble').empty("");  
        
                            var contador_mp = 1;
                            var valor_sum_total = 0;
        
                            $.get('/dt_ventas', {operac_cliente: clientes_operacion[0], tipo_atencion_val: tipo_atencion_val}, function(cliente_codigo){
                                // $('#cobros_tble').empty("");
                                $.each(cliente_codigo, function(index, value){
                                    por_cobrar = value[1];
                                    const random = Math.random().toString(36).substring(2, 5);
                                    if(contador_mp > 1){
                                        aumentar_codigo = Number(value[4])+1;
                                    }else{
                                        aumentar_codigo = Number(value[4]);
                                    }
                                    if(value[3] == 'atencion_programada'){
                                        var fila = '<tr class="selected igv_carta" id="filamp'+contador_mp+'"><td class="align-middle fw-normal">'+contador_mp+'</td><td class="align-middle fw-normal">AT: '+aumentar_codigo+' ('+value[2]+')'+' - '+value[5]+'</td><td class="align-middle fw-normal" id="totalidad_val_html'+random+'">'+value[1]+'</td><td class="align-middle fw-normal text-danger fw-bold"><input class="form-control form-control-sm" id="cobranza'+random+'" name="por_cobrar[]" value="'+por_cobrar+'"></td><td class="align-middle fw-normal text-danger fw-bold"><input type="decimal" ste="0.05" name="recibido[]" onkeyup="sumar();" placeholder="S/" class="form-control form-control-sm recib"></td><input type="hidden" name="contador[]" value="'+contador_mp+'"><input type="hidden" name="cita_codigo_value[]" value="'+value[0]+'"><input type="hidden" name="value_especial[]" value="'+value[6]+'"><input type="hidden" name="profesional_id[]" value="'+value[7]+'"><input type="hidden" name="concepto[]" value="'+aumentar_codigo+'"><input type="hidden" name="total[]" value="'+value[1]+'"><input type="hidden" name="codigo_venta[]" value="'+aumentar_codigo+'"></tr>';
                                    }
                                    contador_mp++;
        
                                    $('#cobros_tble').append(fila);
                                    
                                    $( "#cobranza"+random ).on( "keyup", function() {
                                        valor_cobranza = $(this).val();
                                        console.log(random);
                                        $('#totalidad_val_html'+random).html(valor_cobranza);
                                        $('#totalidad_val'+random).val(valor_cobranza);
                                    } );
                                });
                            });
                        });
                    }else{
                        $('#btnasignar_servicio').show();
                        $.get('/trans_cobros', {tipo_atencion_val: tipo_atencion_val}, function(cliente_codigo){
                            $('#cliente_id').empty();
                            $('#cliente_id').append('<option selected>Selecciona una opcion</option>');
                            $.each(cliente_codigo, function(index, value){
                                $('#cliente_id').append('<option value="'+index+'_'+value[0]+'">'+value[0]+' // '+value[1]+'</option>');
                            });
                        });

                        $('#venta').show();
                        $('#contenedor_otros').hide();
                        $('#igv_total').hide();
        
                        $('#cliente_id').on('change', function(){
                            clientes_operacion = document.getElementById('cliente_id').value.split('_');
                            $('#name_cli_id').val(clientes_operacion[1]);
                            $('#name_cli_ids').val(clientes_operacion[1]);
                            $('#person_ids').val(clientes_operacion[0]);
                            $('#cobros_tble').empty("");  
                        });

                        $('#mostrar_espec').show();
                        $('#mostrar_profes').show();

                        $('#especialidad__id').prop('disabled',false);
                        $('#especialidad__id').val("").trigger("change");
                        $('#medico__id').prop('disabled',false);
                        $('#medico__id').val("").trigger("change");

                        $('#especialidad__id').on('change', function(){
                            value_especial = document.getElementById('especialidad__id').value.split('_');

                            if(value_especial[0] == '6'){
                                $('#mostrar_sesiones').show();
                                $( "#sesiones_value_id" ).on( "keyup", function() {
                                    $('#sesiones_value_ids').val($(this).val());
                                } );
                            }else{
                                $('#mostrar_sesiones').hide();
                                $('#sesiones_value_id').val('');
                            }
                            $.get('/busqueda_profesion_cobro',{value_especial: value_especial[1]}, function(busqueda){
                                $('#medico__id').empty("");
                                $('#medico__id').append("<option value='' selected='selected' hidden='hidden'></option>");
                                $.each(busqueda, function(index, value){
                                    $('#medico__id').append("<option value='" + index +"'>" + value[0] +' '+value[1]+"</option>");
                                });
                            });
                        });
                        var contador_mp = 1;
                        $('#btnasignar_servicio').on('click', function(){
                            clientes_operacion = document.getElementById('cliente_id').value.split('_');

                            value_especial = document.getElementById('especialidad__id').value.split('_');
                            value_medic = $('#medico__id').val();

                            
                            var valor_sum_total = 0;
                            console.log('entro');
                            $.get('/dt_ventas', {operac_cliente: clientes_operacion[0], tipo_atencion_val: tipo_atencion_val, value_especial:value_especial[0],value_medic:value_medic}, function(cliente_codigo){
                                // $('#cobros_tble').empty("");
                                $.each(cliente_codigo, function(index, value){
                                    por_cobrar = value[1];
                                    const random = Math.random().toString(36).substring(2, 5);
                                    if(value[3] == 'atencion_directa'){
                                        if(contador_mp > 1){
                                            aumentar_codigo = Number(value[4])+1;
                                        }else{
                                            aumentar_codigo = Number(value[4]);
                                        }
                                        var fila = '<tr class="selected igv_carta" id="filamp'+contador_mp+'"><td class="align-middle fw-normal">'+contador_mp+'</td><td class="align-middle fw-normal">AT: '+aumentar_codigo+' ('+value[2]+')'+' - '+value[5]+'</td><td class="align-middle fw-normal" id="totalidad_val_html'+random+'">'+value[1]+'</td><td class="align-middle fw-normal text-danger fw-bold"><input class="form-control form-control-sm" id="cobranza'+random+'" name="por_cobrar[]" value="'+por_cobrar+'"></td><td class="align-middle fw-normal text-danger fw-bold"><input type="decimal" ste="0.05" name="recibido[]" onkeyup="sumar();" placeholder="S/" class="form-control form-control-sm recib"></td><input type="hidden" name="value_especial[]" value="'+value_especial[0]+'"><input type="hidden" name="profesional_id[]" value="'+value_medic+'"><input type="hidden" name="contador[]" value="'+contador_mp+'"><input type="hidden" name="concepto[]" value="'+aumentar_codigo+'"><input type="hidden" name="total[]" value="'+value[1]+'"><input type="hidden" name="codigo_venta[]" value="'+aumentar_codigo+'"></tr>';
                                        if(value_especial[0] == '6'){
                                            
                                        }else{
                                            $('#sesiones_value_ids').val('');
                                        }
                                    }
                                    contador_mp++;
        
                                    $('#cobros_tble').append(fila);
                                    
                                    $( "#cobranza"+random ).on( "keyup", function() {
                                        valor_cobranza = $(this).val();
                                        console.log(random);
                                        $('#totalidad_val_html'+random).html(valor_cobranza);
                                        $('#totalidad_val'+random).val(valor_cobranza);
                                    } );

                                    $('#especialidad__id').val("").trigger("change");
                                    $('#medico__id').val("").trigger("change");
                                });
                            });
                        });
                        
                    }
                });
            }if(transaccion == 'EAUXILIAR'){
                $('#mostrar_tipo').hide();
                $('#mostrar_medicam').hide();

                $('#btnasignar_servicio').show();
                $.get('/trans_cobros', {tipo_atencion_val: 'EAUXILIAR'}, function(cliente_codigo){
                    $('#cliente_id').empty();
                    $('#cliente_id').append('<option selected>Selecciona una opcion</option>');
                    $.each(cliente_codigo, function(index, value){
                        $('#cliente_id').append('<option value="'+index+'_'+value[0]+'">'+value[0]+' // '+value[1]+'</option>');
                    });
                });

                $('#venta').show();
                $('#contenedor_otros').hide();
                $('#igv_total').hide();

                $('#cliente_id').on('change', function(){
                    clientes_operacion = document.getElementById('cliente_id').value.split('_');
                    $('#name_cli_id').val(clientes_operacion[1]);
                    $('#name_cli_ids').val(clientes_operacion[1]);
                    $('#person_ids').val(clientes_operacion[0]);
                    $('#cobros_tble').empty("");  
                });

                var contador_mp = 1;
                $('#btnasignar_servicio').on('click', function(){
                    clientes_operacion = document.getElementById('cliente_id').value.split('_');

                    value_especial = document.getElementById('especialidad__id').value.split('_');
                    value_medic = $('#medico__id').val();

                    
                    var valor_sum_total = 0;
                    $.get('/dt_eauxiliar', {operac_cliente: clientes_operacion[0], tipo_atencion_val: 'EAUXILIAR'}, function(cliente_codigo){
                        // $('#cobros_tble').empty("");
                        $.each(cliente_codigo, function(index, value){
                            console.log('entro');
                            por_cobrar = value[1];
                            const random = Math.random().toString(36).substring(2, 5);
                            //if(value[3] == 'examen_auxiliar'){
                            //    var fila = '<tr class="selected igv_carta" id="filamp'+contador_mp+'"><td class="align-middle fw-normal">'+contador_mp+'</td><td class="align-middle fw-normal">EA: '+(value[0])+' ('+value[2]+')'+' - '+value[5]+'</td><td class="align-middle fw-normal">'+value[1]+'</td><td class="align-middle fw-normal text-danger fw-bold">S/ -'+por_cobrar+'</td><td class="align-middle fw-normal text-danger fw-bold"><input type="decimal" ste="0.05" name="recibido[]" onkeyup="sumar();" placeholder="S/" class="form-control form-control-sm recib"></td><input type="hidden" name="value_especial[]" value="'+value_especial[0]+'"><input type="hidden" name="contador[]" value="'+contador_mp+'"><input type="hidden" name="concepto[]" value="'+(value[0])+'"><input type="hidden" name="total[]" value="'+value[1]+'"><input type="hidden" name="por_cobrar[]" value="'+por_cobrar+'"><input type="hidden" name="por_atencion_id[]" value="'+value[6]+'"><input type="hidden" name="codigo_venta[]" value="'+(value[0])+'"></tr>';
                            //}
                            
                            if(value[3] == 'examen_auxiliar'){
                                var fila = '<tr class="selected igv_carta" id="filamp'+contador_mp+'"><td class="align-middle fw-normal">'+contador_mp+'</td><td class="align-middle fw-normal">EA: '+(value[0])+' ('+value[2]+')'+' - '+value[5]+'</td><td class="align-middle fw-normal" id="totalidad_val_html'+random+'">'+value[1]+'</td><td class="align-middle fw-normal text-danger fw-bold"><input class="form-control form-control-sm" id="cobranza'+random+'" name="por_cobrar[]" value="'+por_cobrar+'"></td><td class="align-middle fw-normal text-danger fw-bold"><input type="decimal" ste="0.05" name="recibido[]" onkeyup="sumar();" placeholder="S/" class="form-control form-control-sm recib"></td><input type="hidden" name="value_especial[]" value="'+value_especial[0]+'"><input type="hidden" name="contador[]" value="'+contador_mp+'"><input type="hidden" name="concepto[]" value="'+(value[0])+'"><input type="hidden" id="totalidad_val'+random+'" name="total[]" value="'+value[1]+'"><input type="hidden" name="por_atencion_id[]" value="'+value[6]+'"><input type="hidden" name="codigo_venta[]" value="'+(value[0])+'"></tr>';
                            }
                            
                            contador_mp++;

                            $('#cobros_tble').append(fila);
                            
                            $( "#cobranza"+random ).on( "keyup", function() {
                                valor_cobranza = $(this).val();
                                console.log(random);
                                $('#totalidad_val_html'+random).html(valor_cobranza);
                                $('#totalidad_val'+random).val(valor_cobranza);
                            } );
                        });
                    });
                });
            }if(transaccion == 'MEDICAMENTOS'){
                $('#mostrar_medicam').show();
                $('#tipo__receta').on('change', function(){
                    tipo_receta_val = $(this).val();
                    
                    $.get('/trans_cobros_medic', {tipo_receta_val: tipo_receta_val}, function(cliente_codigo){
                        $('#cliente_id').empty();
                        $('#cliente_id').append('<option selected>Selecciona una opcion</option>');
                        $.each(cliente_codigo, function(index, value){
                            if(value[0] == 'no_existe'){
                                $('#cliente_id').empty();
                            }else{
                                $('#cliente_id').append('<option value="'+index+'_'+value[0]+'">'+value[0]+' // '+value[1]+'</option>');
                            }
                        });
                    });

                    if(tipo_receta_val == 'Receta'){
                        $('#venta').show();
                        $('#contenedor_otros').hide();
                        $('#igv_total').hide();
                        
                        $('#cliente_id').on('change', function(){
                            clientes_operacion = document.getElementById('cliente_id').value.split('_');
                            $('#name_cli_id').val(clientes_operacion[1]);
                            $('#name_cli_ids').val(clientes_operacion[1]);
                            $('#person_ids').val(clientes_operacion[0]);
                            $('#cobros_tble').empty("");  
        
                            var contador_mp = 1;
                            var valor_sum_total = 0;
                            console.log('entro',tipo_receta_val, clientes_operacion[0]);
                            $.get('/dt_ventas_medicamen', {operac_cliente: clientes_operacion[0], tipo_receta_val: tipo_receta_val}, function(cliente_codigo){
                                // $('#cobros_tble').empty("");
                                $.each(cliente_codigo, function(index, value){
                                    console.log(value);
                                    por_cobrar = value[1];
                                    const random = Math.random().toString(36).substring(2, 5);
                                    if(value[3] == 'receta_programada'){
                                        var fila = '<tr class="selected igv_carta" id="filamp'+contador_mp+'"><td class="align-middle fw-normal">'+contador_mp+'</td><td class="align-middle fw-normal">R: '+value[4]+' ('+value[2]+')'+' - '+value[5]+'</td><td class="align-middle fw-normal" id="totalidad_val_html'+random+'">'+value[1]+'</td><td class="align-middle fw-normal text-danger fw-bold"><input class="form-control form-control-sm" id="cobranza'+random+'" name="por_cobrar[]" value="'+por_cobrar+'"></td><td class="align-middle fw-normal text-danger fw-bold"><input type="decimal" ste="0.05" name="recibido[]" onkeyup="sumar();" placeholder="S/" class="form-control form-control-sm recib"></td><input type="hidden" name="contador[]" value="'+contador_mp+'"><input type="hidden" name="cita_codigo_value[]" value="'+value[0]+'"><input type="hidden" name="value_especial[]" value="'+value[6]+'"><input type="hidden" name="profesional_id[]" value="'+value[7]+'"><input type="hidden" name="concepto[]" value="'+value[4]+'"><input type="hidden" name="total[]" value="'+value[1]+'"><input type="hidden" name="por_cobrar[]" value="'+por_cobrar+'"><input type="hidden" name="codigo_venta[]" value="'+value[4]+'"><input type="hidden" name="atencion_id_val[]" value="'+value[8]+'"></tr>';
                                    }
                                    contador_mp++;
        
                                    $('#cobros_tble').append(fila);
                                    
                                    $( "#cobranza"+random ).on( "keyup", function() {
                                        valor_cobranza = $(this).val();
                                        console.log(random);
                                        $('#totalidad_val_html'+random).html(valor_cobranza);
                                        $('#totalidad_val'+random).val(valor_cobranza);
                                    } );
                                });
                            });
                        });
                    }else{
                        $('#venta').hide();
                        $('#contenedor_otros').show();
                        $('#igv_total').show();
                        
                        $('#cliente_id').on('change', function(){
                            clientes_operacion = document.getElementById('cliente_id').value.split('_');
                            $('#name_cli_id').val(clientes_operacion[1]);
                            $('#name_cli_ids').val(clientes_operacion[1]);
                            $('#person_ids').val(clientes_operacion[0]);
                            $('#cobros_tble').empty("");  
                        });

                        $.get('/trans_cobros_medic_productos', {tipo_receta_val: tipo_receta_val}, function(cliente_codigo){
                            $('#concepto_id').empty();
                            $('#concepto_id').append('<option selected>Selecciona una opcion</option>');
                            $.each(cliente_codigo, function(index, value){
                                $('#concepto_id').append('<option value="'+index+'_'+value[0]+'">'+value[0]+' // '+value[1]+'</option>');
                            });
                        });

                        $('#concepto_id').on('change', function(){
                            var concepto = document.getElementById('concepto_id').value.split('_');
                            $.get('/trans_cobros_precio', {concepto: concepto[0]}, function(cliente_codigo){
                                $('#valor_id').val();
                                $.each(cliente_codigo, function(index, value){
                                    $('#valor_id').val(value[0]);
                                });
                            });
                        });

                        var contador_mp = 1;
                        var subtotal=[];
                        var neto = 0;
                        var igv=0;


                        $('#btnasignar').click(function() {
                            var concepto = document.getElementById('concepto_id').value.split('_');
                            var impuesto = $('#impuesto_id').val();
                            var cantidad = $('#cantidad_id').val();
                            var observaciones = $('#observacion_id').val();
                            var valor = $('#valor_id').val();

                            if (concepto != '' && valor != '' && cantidad != ''){

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
                                        igv= (parseFloat(neto)*(0)).toFixed(2);
                                        total=(parseFloat(neto)+parseFloat(igv)).toFixed(2);
                                    }else{
                                        subtotal=(cantidad*valor);
                                        subtotal = subtotal.toFixed(1);
                                        neto =(parseFloat(neto)+parseFloat(subtotal)).toFixed(2);
                                        igv= (parseFloat(neto)*(0)).toFixed(2);
                                        total=(parseFloat(neto)+parseFloat(igv)).toFixed(2);
                                    }

                                    var fila = '<tr class="selected igv_carta" id="filamp'+contador_mp+'"><td class="align-middle fw-normal">'+contador_mp+'</td><td class="align-middle fw-normal">'+concepto[1]+'</td><td class="align-middle fw-normal">'+valor+'</td><td class="align-middle fw-normal text-success">'+impuesto+' % </td><td class="align-middle fw-normal text-danger fw-bold">'+cantidad+'</td><td class="align-middle fw-normal text-danger fw-bold">'+observaciones+'</td><<td class="align-middle"><button type="button" class="btn btn-sm btn-danger" onclick="eliminaran('+contador_mp+','+subtotal+');"><i class="bi bi-trash"></i></button></td><input type="hidden" name="contador[]" value="'+contador_mp+'"><input type="hidden" name="producto_id[]" value="'+concepto[0]+'"><input type="hidden" name="concepto[]" value="'+concepto[1]+'"><input type="hidden" name="valor[]" value="'+valor+'"><input type="hidden" name="impuesto" value="'+impuesto+'"><input type="hidden" name="cantidad[]" value="'+cantidad+'"><input type="hidden" name="observaciones[]" value="'+observaciones+'"><input type="hidden" name="codigo_venta[]" value="'+concepto[1]+'"></tr>';
                                    contador_mp++;
                                    $('#concepto_id').prop('selectedIndex', 0).change();
                                    $('#impuesto_id').prop('selectedIndex', 1).change();
                                    $("#valor_id").val("");
                                    $("#cantidad_id").val(1);
                                    $("#observacion_id").val("");
                                    
                                    if(total == 0){
                                        $("#igv").html("0");
                                        $("#igv_id").val(0);
                                    }else{
                                        $("#igv").html(0);
                                        $("#igv_id").val(0);
                                    }
                                    $("#subtotal").html(neto);
                                    $("#subtotal_id").val(neto);
                                    $("#total_cobrado").html(total);
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
            }if(transaccion == 'PROCEDIMIENTOS'){
                $.get('/trans_cobros', {transacciones: transaccion}, function(cliente_codigo){
                    $('#cliente_id').empty();
                    $('#cliente_id').append('<option selected>Selecciona una opcion</option>');
                    $.each(cliente_codigo, function(index, value){
                        $('#cliente_id').append('<option value="'+index+'_'+value[0]+'">'+value[0]+' // '+value[1]+'</option>');
                    });
                });
                $('#cliente_id').on('change', function(){
                    clientes_operacion = document.getElementById('cliente_id').value.split('_');
                    $('#name_cli_id').val(clientes_operacion[1]);
                    $('#name_cli_ids').val(clientes_operacion[1]);
                    $('#person_ids').val(clientes_operacion[0]);
                    $('#cobros_tble').empty("");
                });

                $.get('/trans_procedimientos', {tipoprocedimiento: transaccion}, function(cliente_codigo){
                    $('#concepto_id').empty();
                    $('#concepto_id').append('<option selected>Selecciona una opcion</option>');
                    $.each(cliente_codigo, function(index, value){
                        $('#concepto_id').append('<option value="'+index+'_'+value[0]+'">'+value[0]+'</option>');
                    });
                });

                $('#concepto_id').on('change', function(){
                    var concepto = document.getElementById('concepto_id').value.split('_');
                    $.get('/trans_procedimientos_precio', {concepto: concepto[0]}, function(cliente_codigo){
                        $('#valor_id').val();
                        $.each(cliente_codigo, function(index, value){
                            $('#valor_id').val(value[0]);
                        });
                    });
                });

                $('#venta').hide();
                $('#contenedor_otros').show();
                $('#igv_total').show();

                var contador_mp = 1;
                var subtotal=[];
                var neto = 0;
                var igv=0;


                $('#btnasignar').click(function() {
                    var concepto = document.getElementById('concepto_id').value.split('_');
                    var impuesto = $('#impuesto_id').val();
                    var cantidad = $('#cantidad_id').val();
                    var observaciones = $('#observacion_id').val();
                    var valor = $('#valor_id').val();

                    if (concepto != '' && valor != '' && cantidad != ''){

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
                                igv= (parseFloat(neto)*(0)).toFixed(2);
                                total=(parseFloat(neto)+parseFloat(igv)).toFixed(2);
                            }else{
                                subtotal=(cantidad*valor);
                                subtotal = subtotal.toFixed(1);
                                neto =(parseFloat(neto)+parseFloat(subtotal)).toFixed(2);
                                igv= (parseFloat(neto)*(0)).toFixed(2);
                                total=(parseFloat(neto)+parseFloat(igv)).toFixed(2);
                            }

                            var fila = '<tr class="selected igv_carta" id="filamp'+contador_mp+'"><td class="align-middle fw-normal">'+contador_mp+'</td><td class="align-middle fw-normal">'+concepto[1]+'</td><td class="align-middle fw-normal">'+valor+'</td><td class="align-middle fw-normal text-success">'+impuesto+' % </td><td class="align-middle fw-normal text-danger fw-bold">'+cantidad+'</td><td class="align-middle fw-normal text-danger fw-bold">'+observaciones+'</td><<td class="align-middle"><button type="button" class="btn btn-sm btn-danger" onclick="eliminaran('+contador_mp+','+subtotal+');"><i class="bi bi-trash"></i></button></td><input type="hidden" name="contador[]" value="'+contador_mp+'"><input type="hidden" name="producto_id[]" value="'+concepto[0]+'"><input type="hidden" name="concepto[]" value="'+concepto[1]+'"><input type="hidden" name="valor[]" value="'+valor+'"><input type="hidden" name="impuesto" value="'+impuesto+'"><input type="hidden" name="cantidad[]" value="'+cantidad+'"><input type="hidden" name="observaciones[]" value="'+observaciones+'"></tr>';
                            contador_mp++;
                            $('#concepto_id').prop('selectedIndex', 0).change();
                            $('#impuesto_id').prop('selectedIndex', 1).change();
                            $("#valor_id").val("");
                            $("#cantidad_id").val(1);
                            $("#observacion_id").val("");
                            
                            if(total == 0){
                                $("#igv").html("0");
                                $("#igv_id").val(0);
                            }else{
                                $("#igv").html(0);
                                $("#igv_id").val(0);
                            }
                            $("#subtotal").html(neto);
                            $("#subtotal_id").val(neto);
                            $("#total_cobrado").html(total);
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

            }if(transaccion == 'OTROS'){
                $.get('/trans_cobros', {transacciones: transaccion}, function(cliente_codigo){
                    $('#cliente_id').empty();
                    $('#cliente_id').append('<option selected>Selecciona una opcion</option>');
                    $.each(cliente_codigo, function(index, value){
                        $('#cliente_id').append('<option value="'+index+'_'+value[0]+'">'+value[0]+' // '+value[1]+'</option>');
                    });
                });
                $('#cliente_id').on('change', function(){
                    clientes_operacion = document.getElementById('cliente_id').value.split('_');
                    $('#name_cli_id').val(clientes_operacion[1]);
                    $('#name_cli_ids').val(clientes_operacion[1]);
                    $('#person_ids').val(clientes_operacion[0]);
                    $('#cobros_tble').empty("");
                });

                $('#concepto_id').on('change', function(){
                    var concepto = document.getElementById('concepto_id').value.split('_');
                    $.get('/trans_cobros_precio', {concepto: concepto[0]}, function(cliente_codigo){
                        $('#valor_id').val();
                        $.each(cliente_codigo, function(index, value){
                            $('#valor_id').val(value[0]);
                        });
                    });
                });

                $('#venta').hide();
                $('#contenedor_otros').show();
                $('#igv_total').show();

                var contador_mp = 1;
                var subtotal=[];
                var neto = 0;
                var igv=0;


                $('#btnasignar').click(function() {
                    var concepto = document.getElementById('concepto_id').value.split('_');
                    var impuesto = $('#impuesto_id').val();
                    var cantidad = $('#cantidad_id').val();
                    var observaciones = $('#observacion_id').val();
                    var valor = $('#valor_id').val();

                    if (concepto != '' && valor != '' && cantidad != ''){

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
                                igv= (parseFloat(neto)*(0)).toFixed(2);
                                total=(parseFloat(neto)+parseFloat(igv)).toFixed(2);
                            }else{
                                subtotal=(cantidad*valor);
                                subtotal = subtotal.toFixed(1);
                                neto =(parseFloat(neto)+parseFloat(subtotal)).toFixed(2);
                                igv= (parseFloat(neto)*(0)).toFixed(2);
                                total=(parseFloat(neto)+parseFloat(igv)).toFixed(2);
                            }

                            var fila = '<tr class="selected igv_carta" id="filamp'+contador_mp+'"><td class="align-middle fw-normal">'+contador_mp+'</td><td class="align-middle fw-normal">'+concepto[1]+'</td><td class="align-middle fw-normal">'+valor+'</td><td class="align-middle fw-normal text-success">'+impuesto+' % </td><td class="align-middle fw-normal text-danger fw-bold">'+cantidad+'</td><td class="align-middle fw-normal text-danger fw-bold">'+observaciones+'</td><<td class="align-middle"><button type="button" class="btn btn-sm btn-danger" onclick="eliminaran('+contador_mp+','+subtotal+');"><i class="bi bi-trash"></i></button></td><input type="hidden" name="contador[]" value="'+contador_mp+'"><input type="hidden" name="producto_id[]" value="'+concepto[0]+'"><input type="hidden" name="concepto[]" value="'+concepto[1]+'"><input type="hidden" name="valor[]" value="'+valor+'"><input type="hidden" name="impuesto" value="'+impuesto+'"><input type="hidden" name="cantidad[]" value="'+cantidad+'"><input type="hidden" name="observaciones[]" value="'+observaciones+'"></tr>';
                            contador_mp++;
                            $('#concepto_id').prop('selectedIndex', 0).change();
                            $('#impuesto_id').prop('selectedIndex', 1).change();
                            $("#valor_id").val("");
                            $("#cantidad_id").val(1);
                            $("#observacion_id").val("");
                            
                            if(total == 0){
                                $("#igv").html("0");
                                $("#igv_id").val(0);
                            }else{
                                $("#igv").html(0);
                                $("#igv_id").val(0);
                            }
                            $("#subtotal").html(neto);
                            $("#subtotal_id").val(neto);
                            $("#total_cobrado").html(total);
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
        $('#ingreso_id').on('change', function(){
            ingresoss = $(this).val();
            if(ingresoss === 'Efectivo'){
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
                igv= (parseFloat(neto)*(0)).toFixed(2);
                total=(parseFloat(neto)+parseFloat(igv)).toFixed(2);
                $("#igv").html("0");
                $("#igv_id").val(0);
                $("#subtotal").html(0);
                $("#subtotal_id").val(0);
                $("#total_cobrado").html(0);
                $("#total_cobrado_id").val(0);
            }else{
                igv= (parseFloat(neto)*(0)).toFixed(2);
                total=(parseFloat(neto)+parseFloat(igv)).toFixed(2);
                $("#subtotal").html(neto);
                $("#subtotal_id").val(neto);
                $("#igv").html(0);
                $("#igv_id").val(0);
                $("#total_cobrado").html(total);
                $("#total_cobrado_id").val(total);
            }


        }
    
    function sumar() {
        let subtotal = 0;

        if($('#tipo_trans').val() == 'VENTA'){
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
                $("#total_cobrado").html(total_c);
                $("#total_cobrado_id").val(total_c);
            });
        }else{
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
                impu = (subtotal*0).toFixed(2);
                total_c = parseFloat(subtotal)+parseFloat(impu);
                $("#subtotal").html(subtotal);
                $("#subtotal_id").val(subtotal);
                $("#total_cobrado").html(total_c);
                $("#total_cobrado_id").val(total_c);
            });
        }
    };

    function eliminaran(indexmp ,subtotal)
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
                igv= (parseFloat(neto)*(0)).toFixed(2);
                total=(parseFloat(neto)+parseFloat(igv)).toFixed(2);
                $("#igv").html("0");
                $("#igv_id").val(0);
                $("#subtotal").html(0);
                $("#subtotal_id").val(0);
                $("#total_cobrado").html(0);
                $("#total_cobrado_id").val(0);
            }else{
                igv= (parseFloat(neto)*(0)).toFixed(2);
                total=(parseFloat(neto)+parseFloat(igv)).toFixed(2);
                $("#subtotal").html(neto);
                $("#subtotal_id").val(neto);
                $("#igv").html(0);
                $("#igv_id").val(0);
                $("#total_cobrado").html(total);
                $("#total_cobrado_id").val(total);
            }


        }
    
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