@extends('PLANTILLA.administrador')

@section('title', 'NOTA DE DEBITO')

@section('css')
@endsection
 

@section('content')
<div class="bg-primary" style="height: 57px"></div>
 <!-- Encabezado -->
    <div class="bg-primary" style="height: 160px; border-radius: 0 0 30px 30px;">
        <div class="container-fluid">
            <div class="row">
            <div class="col-md-9">
                <h1 class="text-white h2 text-uppercase fw-bold mb-0">COMPROBANTES DE VENTA</h1>
                <div class="" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-decoration-none link-light" href="">Tesoreria</a></li>
                        <li class="breadcrumb-item"><a class="text-decoration-none link-light" href="{{url('admin-comp-ventas')}}">Comprobantes de venta</a></li>
                        <li class="breadcrumb-item text-white" aria-current="page">Inicio</li>
                    </ol>
                </div>
            </div>
            <div class="col-md-3">
                
            </div>
        </div>
        </div>
    </div>
<!-- fin encabezado -->

    {{-- Contenido --}}
        <div class="container-fluid">
            <div class="card border-4 borde-top-secondary shadow-sm mb-3" style="margin-top: -80px"  data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                <form class="form-group" method="POST" action="/admin-notadebitos" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="card-body text-center">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-2 mb-3 mb-lg-0 border-end">
                            <div class="form-group my-md-0">
                                <label class="fw-bold text-primary d-block h5 small text-uppercase">Tipo de comprobante</label>
                                <p class="fw-normal mb-0">{{$admin_venta->tipo_comprobante}}</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 mb-3 mb-lg-0 border-end">
                            <div class="form-group my-md-0">
                                <label class="fw-bold text-primary d-block h5 small text-uppercase">Serie</label>
                                <p class="fw-normal mb-0">{{$admin_venta->serie}}</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 mb-3 mb-lg-0 border-end">
                            <div class="form-group my-md-0">
                                <label class="fw-bold text-primary d-block h5 small text-uppercase">correlativo</label>
                                <p class="fw-normal mb-0">{{$admin_venta->correlativo}}</p>
                            </div> 
                        </div>
                        <div class="col-12 col-md-6 col-lg-2 mb-3 mb-lg-0 border-end">
                            <div class="form-group my-md-0">
                                <label class="fw-bold text-primary d-block h5 small text-uppercase">Fecha de Emision</label>
                                <p class="fw-normal mb-0">{{$admin_venta->fecha}}</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-2 mb-3 mb-lg-0">
                            <div class="form-group my-md-0">
                                <label class="fw-bold d-block text-primary h5 small text-uppercase">Total</label>
                                <span class="badge bg-dark fs-6">{{$admin_venta->total}}</span>
                            </div>
                        </div>  
                    </div>
                </div>
                    <input hidden id="venta_ids" value="{{$admin_venta->id}}">   
                    <input type="text" hidden name="codigo_venta" class="form-control form-control-sm bg-white" value="{{$admin_venta->codigo}}">
                    <input hidden name="serieref" value="{{$admin_venta->serie}}">   
                    <input hidden name="correlativoref" value="{{$admin_venta->correlativo}}">
                    <input hidden name="codigomotivo" value="{{$admin_venta->codigo_comprobante}}">
                    @if($correlativo_reiniciar == 'Inicio')
                        <input type="text" hidden name="seriecorrelativo_nc" class="form-control form-control-sm bg-white" value="{{$serial.' - '.$correlativo_pro}}">
                        <input hidden name="serie" value="{{$admin_venta->tipo_comprobante == 'Factura'?'F'.$serial:'B'.$serial}}">   
                        <input hidden name="correlativo" value="{{$correlativo_pro}}">
                    @elseif($correlativo_reiniciar == 'avanzando')
                        <input type="text" hidden name="seriecorrelativo_nc" class="form-control form-control-sm bg-white" value="{{$serial.' - '.$correlativo_pro}}">
                        <input hidden name="serie" value="{{$admin_venta->tipo_comprobante == 'Factura'?'F'.$serial:'B'.$serial}}">   
                        <input hidden name="correlativo" value="{{$correlativo_pro}}">
                    @else
                        <input type="text" hidden name="seriecorrelativo_nc" class="form-control form-control-sm bg-white" value="{{$serial.' - '.$correlativo_pro}}">
                        <input hidden name="serie" value="{{$admin_venta->tipo_comprobante == 'Factura'?'F'.$serial:'B'.$serial}}">   
                        <input hidden name="correlativo" value="{{$correlativo_pro}}">
                    @endif
                    <div class="card-body">
                        <p class="text-primary mb-2 small text-uppercase fw-bold">Detalles</p>
                        <div class="row">
                            {{-- <div class="col-12 col-md-2 mb-3">
                                <label for="identificacion_id" class="form-label">Cargo por Recojo</label>
                                <input type="decimal" id="cargo_re" onkeyup="precioR()" class="form-control form-control-sm bg-white Reco" value="0.00"> 
                            </div>
                            <div class="col-12 col-md-2 mb-3">
                                <label for="identificacion_id" class="form-label">Cargo por Entrega</label>
                                <input type="decimal" id="cargo_en"  onkeyup="precioE();"class="form-control form-control-sm bg-white Entre"  value="0.00"> 
                            </div> --}}
                            <div class="col-12 col-md-2 mb-3">
                                <label for="name_id" class="form-label">Tipo de nota de debito<span class="text-danger">*</span></label>
                                <select class="form-select form-select-sm" id="tipo_concepto">
                                    <option disabled selected>Seleccione una opción</option>
                                    @foreach ($tipo_nbs as $tipo_nb)
                                        @if($tipo_nb->id == '2')
                                            <option value="{{ $tipo_nb->name}}_{{$tipo_nb->codigo}}">{{ $tipo_nb->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <input hidden name="codigo_comprobante" id="codigo_comprobante">
                                <input hidden name="descripmotivo" id="descripmotivo">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-2 col-lg-7 mb-3">
                                <label for="descripcion_encomienda" class="form-label d-block">Producto</label>
                                <select id="descripcion_encomienda" class="form-select form-select-sm select2">
                                </select>
                            </div>
                            <div class="col-12 col-md-2 col-lg-1 mb-3">
                                <label for="cantidad_encomienda" class="form-label d-block">Und.</label>
                                <input type="text" id="umedida" min="0" class="float-end form-control form-control-sm">
                            </div>
                            <div class="col-12 col-md-2 col-lg-1 mb-3">
                                <label for="cantidad_encomienda" class="form-label d-block">Cantidad</label>
                                <input type="number" id="cantidad_encomienda" class="float-end form-control form-control-sm">
                            </div>
                            <div class="col-12 col-md-2 col-lg-1 mb-3">
                                <label for="precio_encomienda" class="form-label d-block">Precio</label>
                                <input type="number" id="precio_encomienda" class="float-end form-control form-control-sm" step="0.01">
                            </div>
                            <div class="col-12 col-md-2 col-lg-2 mb-3">
                                <label for="agre" class="form-label d-block text-white">..</label>
                                <button type="button" id="btnasignar" class="btn btn-secondary btn-sm w-100 align-bottom text-white mt-2 mt-md-0">
                                    Agregar
                                </button>
                                @error('fecha')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <table class="table table-sm table-hover">
                            <thead class="bg-light">
                            <tr>
                                <th class="fw-bold small text-uppercase">N°</th>
                                <th class="fw-bold small text-uppercase">Tipo</th>
                                <th class="fw-bold small text-uppercase">Descripción</th>
                                <th class="fw-bold small text-uppercase">Cantidad</th>
                                <th class="fw-bold small text-uppercase">Peso (kg)</th>
                                <th class="fw-bold small text-uppercase">Precio Unit.</th>
                                <th class="fw-bold small text-uppercase">Total</th>
                                <th class="fw-bold small text-uppercase"></th>
                            </tr>
                            </thead>
                            <tbody id="dtlle_ncomienda">
                            </tbody>
                        </table>
                        <div class="row justify-content-beetween">
                            <div class="col-12 col-md-7">
                                {{-- <div class="card border-dark align-self-end" id="coorporativo">
                                    <div class="card-body p-1 m-1">
                                        <p class="small">Por indicaciones de la sunat la detraccion se envia en soles</p>
                                        <div class="row g-1">
                                            <div class="col-12 col-md-6 col-lg-3 mb-3 mb-lg-0">
                                                <label for="producto_id" class="form-label d-block small">Tipo de detraccion</label>
                                                <select id="select_detraccio_vista" disabled class="form-select form-select-sm select2 bg-white">
                                                </select>
                                                <select id="select_detraccio" hidden name="tipo_detraccion" class="form-select form-select-sm bg-white">
                                                </select>  
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-3 mb-3 mb-lg-0">
                                                <label for="cantidad_encomienda" class="form-label d-block small">% de detraccion</label>
                                                <input type="number" id="porcentaje_detraccion_id_vista" value="4" disabled class="float-end form-control bg-white form-control-sm" step="0.01">
                                                <input type="number" id="porcentaje_detraccion_id" hidden value="4" name="porcentaje_detraccion" class="float-end form-control bg-white form-control-sm" step="0.01">
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-3 mb-3 mb-lg-0">
                                                <label for="producto_id" class="form-label d-block small">Medio de pago</label>
                                                <select id="metodo_detraccio_vista" disabled class="form-select form-select-sm select2 bg-white">
                                                    <option hidden="hidden">-- Seleccione --</option>
                                                    <option selected="selected" value="Deposito en cuenta">Deposito en cuenta</option>
                                                </select>
                                                <select id="metodo_detraccio" hidden name="metodo_detraccion" class="form-select form-select-sm bg-white">
                                                    <option hidden="hidden">-- Seleccione --</option>
                                                    <option selected="selected" value="Deposito en cuenta">Deposito en cuenta</option>
                                                </select>  
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-3 mb-3 mb-lg-0" id="inputT_detraccio">
                                                <label for="cantidad_encomienda" class="form-label d-block small">Total de detraccion (S/.)</label>
                                                <input type="decimal" id="total_detraccion_id_vista" disabled class="float-end form-control bg-white form-control-sm">
                                                <input type="decimal" id="total_detraccion_id" hidden name="total_detraccion" class="float-end form-control bg-white form-control-sm">
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="col-12 col-md-5">
                                <div class="row">
                                    <div class="">
                                        <br>
                                        <div class="clearfix">
                                            <small class="">Opera. Gravada</small>
                                            <small class="float-end fw-bold" id="subto">0.00</small>
                                            <input type="decimal" id="subt" name="subtotal" hidden>
                                        </div>
                                        {{-- <div class="clearfix">
                                            <small class="">Descuento</small>
                                            <small class="float-end fw-bold" id="desc">0.00</small>
                                            <input type="text" id="c_descuento" value="0" hidden name="descuento" >
                                        </div> --}}
                                        <div class="clearfix">
                                            <small class="">Valor de venta</small>
                                            <small class="float-end fw-bold" id="vventa">0.00</small>
                                            <input type="text" id="valor_v" hidden name="valor_venta">
                                        </div>
                                        <div class="clearfix">
                                            <small class="">I.G.V.</small>
                                            <small class="float-end fw-bold" id="igv">0.00</small>
                                            <input type="decimal" id="i_igv" hidden name="igv">
                                        </div>
                                        <hr>
                                        <div class="clearfix">
                                            <small class="">Subtotal</small>
                                            <small class="float-end fw-bold" id="new_subtotal">0.00</small>
                                            <input type="text" id="new_subtotal_id" value="0" hidden name="new_subtotal" >
                                        </div>
                                        <div class="clearfix">
                                            {{-- <small class="">Cargo por recojo</small>
                                            <small class="float-end fw-bold" id="cargo_recojo">0.00</small> --}}
                                            <input type="text" id="c_recojo" value="0" hidden name="cargo_recojo" >
                                        </div>
                                        <div class="clearfix">
                                            {{-- <small class="">Cargo por entrega</small>
                                            <small class="float-end fw-bold" id="cargo_entrega">0.00</small> --}}
                                            <input type="text" id="c_entrega" value="0" hidden name="cargo_entrega" >
                                        </div>
                                        <div class="clearfix">
                                            <small class="">TOTAL</small>
                                            <small class="float-end fw-bold" id="total">0.00</small>
                                            <input type="decimal" id="i_total" name="total" hidden>
                                            @error('total')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-3 mt-4 text-end" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                    @if($correlativo_reiniciar == 'vacio')
                        <button type="submit" class="btn btn-primary px-5 my-2 my-md-0 text-white disabled">Registrar</button>
                    @else
                        <button type="submit" class="btn btn-primary px-5 my-2 my-md-0 text-white">Registrar</button>
                    @endif
                    <a href="{{ url('admin-orden-servicios') }}" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    {{-- Fin contenido --}}

@endsection

@section('js')
@if(session('addndebito') == 'ok')
<script>
    Swal.fire({
    icon: 'success',
    confirmButtonColor: '#1C3146',
    title: '¡Éxito!',
    text: 'Nota de Debito generada correctamente',
    })
</script>
@endif
<script>

    $(document).ready(function() {

        $('#tipo_concepto').on('change', function(){
            $('#tipo_concepto').attr('disabled',true);
            valor_genera = document.getElementById('tipo_concepto').value.split('_');
            $('#codigo_comprobante').val(valor_genera[1]);
            $('#descripmotivo').val(valor_genera[0]);
            if(valor_genera[0] == 'Aumento en el valor'){
                $('#cantidad_encomienda').attr('disabled',true);
            }
        });
    });
        var id_venta = $('#venta_ids').val();
        $.get('/busqueda_ndebito',{id_venta: id_venta}, function(busqueda){
            $('#descripcion_encomienda').empty("");
            $('#descripcion_encomienda').append("<option selected disabled>Selecciona una opcion</option>");
            $.each(busqueda, function(index, value){
                $('#descripcion_encomienda').append("<option value='" +value[0] +'_'+value[1] +'_'+value[2] +'_'+value[3] +'_'+value[4] +'_'+value[5] +'_'+value[6] +'_'+value[7] +'_'+value[8] +'_'+value[9] + "'>" +value[0] + "</option>");
            })
        });

        $('#descripcion_encomienda').on('change', function(){
            varumedida = document.getElementById('descripcion_encomienda').value.split('_');
            $('#umedida').val(varumedida[1]);
            $('#precio_encomienda').val(varumedida[2]);
            $('#cantidad_encomienda').val(varumedida[9]);
        });

        $('#btnasignar').click(function() {
            agregar();
        });


        var contador_mp = 1;
        var subtotal = [];
        var neto = 0;
        function agregar() {
            var des_enco = document.getElementById('descripcion_encomienda').value.split('_');
            var cant_enco = $('#cantidad_encomienda').val();
            var umedida = $('#umedida').val();
            var prec_enco = $('#precio_encomienda').val();

            if (des_enco != "" && cant_enco != "" && cant_enco > 0 &&
                    umedida != "" && prec_enco != "") {
                    subtotal = cant_enco*prec_enco;
                    subtotal = subtotal.toFixed(1);
                    neto =(parseFloat(neto)+parseFloat(subtotal)).toFixed(2);
                var fila = '<tr class="selected igv_carta" id="filamp' + contador_mp +
                        '"><td class="align-middle fw-normal">' + contador_mp + '</td><td class="align-middle fw-normal">' + des_enco[0] +
                        '</td><td class="align-middle fw-normal">' + cant_enco +
                        '</td><td class="align-middle fw-normal">' + umedida +
                        '</td><td class="align-middle fw-normal">' + prec_enco +
                        '</td><td class="align-middle fw-normal">' + subtotal +
                        '</td><input type="hidden" name="item[]" value="' + contador_mp +
                        '"><input type="hidden" name="codigo_producto[]" value="' + des_enco[3] +
                        '"><input type="hidden" name="id_producto[]" value="' + des_enco[4] +
                        '"><input type="hidden" name="producto[]" value="' + des_enco[0] +
                        '"><input type="hidden" name="lote[]" value="' + des_enco[5] +
                        '"><input type="hidden" name="cantidad[]" value="' + cant_enco +
                        '"><input type="hidden" name="descripcion[]" value="' + des_enco[8] +
                        '"><input type="hidden" name="umedida[]" value="' + umedida +
                        '"><input type="hidden" name="precio_descuento[]" value="' + prec_enco +
                        '"><td class="align-middle"><button class="btn btn-sm btn-danger" onclick="eliminarmp(' +
                        contador_mp + ','+subtotal+');"><i class="bi bi-trash"></i></button></td></tr>';
                    contador_mp++;
                    limpiarmp();
                    
                    $("#subto").html("S/."+neto);
                    $("#subt").val(neto);
                    $('#dtlle_ncomienda').append(fila);

                if(neto > 0){
                    var suma_general = 0;
                    var c_recojos = $('#c_recojo').val();
                    var c_entregas = $('#c_entrega').val();
                    var c_descuentos = $('#c_descuento').val();
                    var subsuma = Number(neto);
                    suma_general = suma_general+subsuma;
                    suma_general = suma_general.toFixed(2);
                    $('#vventa').html(suma_general);
                    $('#valor_v').val(suma_general);
                    $('#igv').html(0.18);
                    $('#i_igv').val(0.18);
                    var totales_enc = Number(suma_general)+(Number(suma_general)*0.18);
                    $('#new_subtotal').html(totales_enc.toFixed(2));
                    $('#new_subtotal_id').val(totales_enc.toFixed(2));
                    var total_final = Number(totales_enc)+Number(c_recojos)+Number(c_entregas);
                    total_final = total_final.toFixed(2);
                    $('#total').html(total_final);
                    $('#i_total').val(total_final);

                    if(total_final > 401){
                        $('#select_detraccio').prop('disabled', false);
                        $('#porcentaje_detraccion_id').prop('disabled', false);
                        $('#metodo_detraccio').prop('disabled', false);
                        $('#total_detraccion_id').prop('disabled', false);
                        new_total_id_final = total_final*0.04;
                        $('#total_detraccion_id').val(new_total_id_final.toFixed(2));
                        $('#total_detraccion_id_vista').val(new_total_id_final.toFixed(2));
                    }else{
                        new_total_id_final = total_final*0.04;
                        $('#select_detraccio').prop('disabled', false);
                        $('#porcentaje_detraccion_id').prop('disabled', false);
                        $('#metodo_detraccio').prop('disabled', false);
                        $('#total_detraccion_id').prop('disabled', false);
                        $('#total_detraccion_id').val("");
                        $('#total_detraccion_id').val(new_total_id_final.toFixed(2));
                    }
                }

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Error al ingresar el detalle de la orden, revise los datos ingresados',
                    })
                }
        }

        function limpiarmp() {
            $("#descripcion_encomienda").prop('selectedIndex', 0).change();
            $("#descripcion_encomienda").val("");
            $('#cantidad_encomienda').val("");
            $('#umedida').val("");
            $('#precio_encomienda').val("");
        }

        function eliminarmp(indexmp, subtota) {
            neto = neto-subtota;
            neto = neto.toFixed(2);
            $("#subto").html("S/."+neto);
            $("#subt").val(neto);

            if(neto > 0){
                var suma_general = 0;
                var c_recojos = $('#c_recojo').val();
                var c_entregas = $('#c_entrega').val();
                var c_descuentos = $('#c_descuento').val();
                var subsuma = Number(neto);
                suma_general = suma_general+subsuma;
                suma_general = suma_general.toFixed(2);
                $('#vventa').html(suma_general);
                $('#valor_v').val(suma_general);
                $('#igv').html(0.18);
                $('#i_igv').val(0.18);
                var totales_enc = Number(suma_general)+(Number(suma_general)*0.18);
                $('#new_subtotal').html(totales_enc.toFixed(2));
                $('#new_subtotal_id').val(totales_enc.toFixed(2));
                var total_final = Number(totales_enc)+Number(c_recojos)+Number(c_entregas);
                total_final = total_final.toFixed(2);
                $('#total').html(total_final);
                $('#i_total').val(total_final);
            }else{
                $('#cargo_recojo').html("0.00");
                $('#c_recojo').val("0.00");
                $('#cargo_entrega').html("0.00");
                $('#c_entrega').val("0.00");
                $('#desc').html("0.00");
                $('#c_descuento').val("0.00");
                $('#new_subtotal').html("0.00");
                $('#new_subtotal_id').val("0.00");
                $('#vventa').html("0.00");
                $('#valor_v').val("0.00");
                $('#igv').html("0.00");
                $('#i_igv').val("0.00");
                $('#total').html("0.00");
                $('#i_total').val("0.00");
                $('#total_detraccion_id').val("");
                $('#total_detraccion_id_vista').val("");
            }
            
            if(neto > 401){
                $('#select_detraccio').prop('disabled', false);
                $('#porcentaje_detraccion_id').prop('disabled', false);
                $('#metodo_detraccio').prop('disabled', false);
                $('#total_detraccion_id').prop('disabled', false);
                new_total_id_final = neto*0.04;
                $('#total_detraccion_id').val(new_total_id_final.toFixed(2));
                $('#total_detraccion_id_vista').val(new_total_id_final.toFixed(2));
            }else{
                new_total_id_final = neto*0.04;
                $('#select_detraccio').prop('disabled', false);
                $('#porcentaje_detraccion_id').prop('disabled', false);
                $('#metodo_detraccio').prop('disabled', false);
                $('#total_detraccion_id').prop('disabled', false);
                $('#total_detraccion_id').val(new_total_id_final.toFixed(2));
                $('#total_detraccion_id_vista').val(new_total_id_final.toFixed(2));
            }

            $("#filamp" + indexmp).remove();
            
        }
</script>
@endsection