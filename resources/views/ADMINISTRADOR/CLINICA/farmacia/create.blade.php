@extends('TEMPLATE.administrador')

@section('title', 'FARMACIA')

@section('css')
@endsection
 
@section('content')
<!-- Encabezado -->
    <div class="header_section">
        <div class="bg-transparent mb-3" style="height: 67px"></div>
        <div class="container-fluid">
            <div class="" data-aos="fade-right">
                <h1 class="titulo h2 text-uppercase fw-bold mb-0">FARMACIA</h1>
                <div class="" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="">Clinica</a></li>
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="{{ url('admin-farmacia') }}">Farmacia</a></li>
                        <li class="breadcrumb-item link" aria-current="page">Nuevo registro</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
<!-- Fin encabezado-->

{{-- Contenido --}}
<form method="POST" action="{{ route('admin-farmacia.store') }}" enctype="multipart/form-data" autocomplete="off" class="needs-validation" novalidate>
    @csrf
    <div class="container-fluid">   
        <div class="card border-4 borde-top-primary shadow-sm h-100" style="border-radius: 20px; min-height: 450px" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
            <div class="card-body">
                <div class="card border-0 rounded-0 border-start border-3 border-info mb-4" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 1px 0px; background-color: #fcfcfc">
                    <div class="card-body py-2">
                        <i class="bi bi-info-circle text-info me-2"></i>Importante:
                        <ul class="list-unstyled mb-0 pb-0">
                            <li class="mb-0 pb-0">
                                <small class="text-muted py-0 my-0 text-start"> Se consideran campos obligatorios los campos que tengan este simbolo: <span class="text-danger">*</small></span>
                            </li>
                        </ul>
                    </div>
                </div>
    
                <div class="row g-3 mb-4">
                    <div class="col-12 col-md-6 col-lg-2">
                        <label for="codigo__id">Código<span class="text-danger">*</span></label>
                        <input id="codigo__id" type="text" class="form-control bg-white" value="F{{$codigo_farmac_slug}}" disabled required>
                        <input type="text" name="codigo" hidden value="{{$codigo_farmac_slug}}">
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-2">
                        <label for="fecha__id">Fecha<span class="text-danger">*</span></label>
                        <input name="fecha" id="fecha__id" type="date" class="form-control" value="{{ $now->format('Y-m-d') }}" required>
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-12 col-lg-2">
                        <label for="duracion__id">Tipo de Atencion<span class="text-danger">*</span></label>
                        <select name="tipo_atencion" id="tipo_atencion_id" class="form-select select2_bootstrap_2" data-placeholder="Seleccione" required>
                            <option value="{{ old('tipotipo_atencion_atencion_id') }}" selected="selected" disabled="disabled">Selecciona una opcion</option>
                            <option value="atencion_programada">Atencion Programada</option>
                            <!-- <option value="atencion_directa">Atencion Directa</option> -->
                        </select>
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>

                    <div class="col-12 col-md-12 col-lg-6" id="show_atencion">
                        <label for="duracion__id">Atención<span class="text-danger">*</span></label>
                        <select name="atencion" id="atencion__id" class="form-select select2_bootstrap_2" data-placeholder="Seleccione" required>
                            <option value="{{ old('atencion') }}" selected="selected" hidden="hidden">{{ old('atencion') }}</option>
                            <!-- <option value="1">AT25020001 | Alexander De La Cruz Saravia | 11-02-2025</option> -->
                        </select>
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>
                </div>

                <div class="row g-2">
                    <div class="col-6 col-md-4">
                        <label for="medicamento__id">Medicamento</label>
                        <select id="medicamento__id" class="form-select select2_bootstrap" data-placeholder="Seleccione">
                        </select>
                    </div>
                   
                    <div class="col-6 col-md-1">
                        <label for="cantidad__id">Cantidad</label>
                        <input type="decimal" class="form-control" id="cantidad_venta_id">
                    </div>
                    
                    <div class="col-6 col-md-1">
                        <label for="precio__id">Precio</label>
                        <input type="decimal" class="form-control" id="precio_venta_id">
                    </div>

                    <div class="col-12 col-md-1">
                        <label for="agre" class="d-block text-white">..</label>
                        <button type="button" id="btnasignar" class="btn btn-grey w-100 align-bottom mt-2 mt-md-0">
                            <i class="bi bi-plus-circle"></i>
                        </button>
                    </div>
                </div>
                    
                <div class="table-responsive mt-3" style="min-height: 150px">
                    <table class="table table-sm table-hover w-100">
                        <thead>
                            <tr>
                                <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 5%">N°</th>
                                <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 10%">Código</th>
                                <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 40%">Descripción</th>
                                <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 10%">Unidad</th>
                                <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 10%">Cantidad</th>
                                <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 10%">Precio</th>
                                <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 10%">Subtotal</th>
                                <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 5%"></th>
                            </tr>
                        </thead>
                        <tbody id="dtll_farmacia" class="text-center">
                        </tbody>
                    </table>
                </div>
                    
                <div class="mt-2">
                    <label for="descripcion__id">Descripción</label>
                    <textarea name="descripcion" class="form-control" id="descripcion__id" rows="3"></textarea>
                    <div class="invalid-feedback">
                        El campo no puede estar vacío
                    </div>
                </div>

                <div class="row mt-3 d-flex justify-content-end">
                    <div class="col-12 col-md-5">
                        <table class="w-100">
                            <input hidden id="acomulador_card">
                            <tr>
                                <td class="border-0 ps-2 py-1 bg-light" style="width: 50%">
                                    Subtotal
                                </td>
                                <td class="border-0 pe-2 py-1 bg-light" style="width: 50%">
                                    <div class="clearfix">
                                        <span class="float-start ps-2">S/ </span>
                                        <span class="float-end" id="subtotal_html">
                                            0.00
                                        </span>
                                        <input name="subtotal" hidden id="subtotal_id">
                                    </div>
                                </td>
                            </tr>
                            
                            
                            <tr>
                                <td class="border-0 ps-2 py-1" style="width: 50%">
                                    I.G.V.
                                </td>
                                <td class="border-0 pe-2 py-1" style="width: 50%">
                                    <div class="clearfix">
                                        <span class="float-start ps-2">S/ </span>
                                        <span class="float-end" id="igv_html">
                                            0.00
                                        </span>
                                        <input name="igv" hidden id="igv_id">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="border-0 fw-bold ps-2 py-1 bg-light" style="width: 50%">
                                    TOTAL
                                </td>
                                <td class="border-0 fw-bold pe-2 py-1 bg-light" style="width: 50%">
                                    <div class="clearfix">
                                        <span class="float-start ps-2">S/ </span>
                                        <span class="float-end" id="total_html">
                                            0.00
                                        </span>
                                        <input name="total" hidden id="total_id">
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>             
        </div>
        <div class="pt-3 text-end" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
            <a href="{{ route('admin-farmacia.index') }}" class="btn btn-grey">Cancelar</a>
            <button type="submit" class="btn btn-primary px-5 my-2 my-md-0 text-white">Guardar</button>
        </div>
    </div>
</form>
{{-- Fin contenido --}}
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
<script>
    function previewImage(nb) {        
    var reader = new FileReader();         
    reader.readAsDataURL(document.getElementById('uploadImage'+nb).files[0]);         
    reader.onload = function (e) {             
        document.getElementById('uploadPreview'+nb).src = e.target.result;         
    };     
    }
</script>
<script>
    (function () {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
            }
            form.classList.add('was-validated')
        }, false)
        })
    })()
</script>

<script>
    $(document).ready(function() {
        $('#tipo_atencion_id').on('change', function(){
            value_tipo = $(this).val();
            if(value_tipo == 'atencion_directa'){
                $.get('/busqueda_tipo_atencion',{value_tipo: value_tipo}, function(busqueda){
                    $('#medicamento__id').empty("");
                    $('#medicamento__id').append("<option selected>Selecciona una opcion</option>");
                    $.each(busqueda, function(index, value){
                        $('#medicamento__id').append("<option value='"+value[0]+'_'+value[1]+'_'+value[2]+'_'+value[3]+'_'+value[4]+'_'+index+"'>" + value[0]+"</option>");
                    });
                });
                $('#show_atencion').hide();
                $('#atencion__id').attr('disabled',true);

                $('#medicamento__id').on('change', function(){
                     valor_medic_select = $('#medicamento__id').val().split('_');
                    $('#precio_venta_id').val(valor_medic_select[1]);
                });
                
                var contador_mps = 1;
                $('#btnasignar').click(function() {
                    valor_medic_select = $('#medicamento__id').val().split('_');
                    cantidad = $('#cantidad_venta_id').val();
                    precio = $('#precio_venta_id').val();
                    valor_total = parseInt(cantidad)*parseFloat(precio);

                    if (valor_medic_select != "" && cantidad > 0 && precio > 0) {

                        var $divs = $(".contador_divs").toArray().length;
                        $('#acomulador_card').val($divs+1);
                        var fila = '<tr class="selected contador_divs" id="filamp' + contador_mps +
                                    '"><td class="align-middle fw-normal">' + contador_mps + '</td><td class="align-middle fw-normal">' + valor_medic_select[4] +
                                    '</td><td class="align-middle fw-normal">' + valor_medic_select[0] +
                                    '</td><td class="align-middle fw-normal">' + valor_medic_select[2] +
                                    '</td><td class="align-middle fw-normal">' + cantidad +
                                    '<input type="hidden" name="cantidad[]" value="' + cantidad +
                                    '"></td><td class="align-middle fw-normal">' + precio +
                                    '</td><td class="align-middle fw-normal">' + valor_total +
                                    '</td><input type="hidden" name="medicamento_id[]" value="' + valor_medic_select[5] +
                                    '"><input type="hidden" name="precio[]" value="' + precio +
                                    '"><input type="hidden" name="subtotal_[]" value="' + valor_total +
                                    '"><td class="align-middle"><button type="button" class="bg-transparent border-0 text-danger" onclick="eliminardtc(' +
                            contador_mps +');"><i class="bi bi-trash"></i></button></td></tr>';

                            contador_mps++;

                            $('#medicamento__id').prop('selectedIndex', 0).change();
                            $('#cantidad_venta_id').val("");
                            $('#precio_venta_id').val("");
                            $('#dtll_farmacia').append(fila);

                            let subtotal_fijo = 0;
                            let subtotal_cal;
                            [...document.getElementsByName("subtotal_[]")].forEach(function(element) {
                                if (element.value !== '') {
                                    subtotal_fijo += parseFloat((element.value));
                                    console.log(subtotal_fijo); 

                                    subtotal_cal = parseFloat(subtotal_fijo/1.18);
                                    $('#subtotal_html').html(subtotal_cal.toFixed(2));
                                    $('#subtotal_id').val(subtotal_cal.toFixed(2));

                                    igv_total = subtotal_cal*0.18;
                                    igv_total = igv_total.toFixed(2);

                                    $('#igv_html').html(igv_total);
                                    $('#igv_id').val(igv_total);

                                    $('#total_html').html(subtotal_fijo);
                                    $('#total_id').val(subtotal_fijo);

                                }else{
                                    $('#subtotal_html').html(0.00);
                                    $('#subtotal_id').val(0.00);

                                    $('#igv_html').html(0.00);
                                    $('#igv_id').val(0.00);

                                    $('#total_html').html(0.00);
                                    $('#total_id').val(0.00);
                                }
                            });

                    }
                });
            }else{
                $('#show_atencion').show();
                $('#atencion__id').attr('disabled',false);

                $.get('/busqueda_tipo_atencion',{value_tipo: value_tipo}, function(busqueda){
                    $('#atencion__id').empty("");
                    $('#atencion__id').append("<option selected>Selecciona una opcion</option>");
                    $.each(busqueda, function(index, value){
                        $('#atencion__id').append("<option value='"+value[0]+"'>" + value[0]+' | '+value[1]+' | '+value[2]+"</option>");
                    });
                });
                
                $('#atencion__id').on('change', function(){
                    valor_codigo_atencion = $(this).val();

                    $.get('/busqueda_tipo_atencion_medicamento',{valor_codigo_atencion: valor_codigo_atencion}, function(busqueda){
                        $('#medicamento__id').empty("");
                        $('#medicamento__id').append("<option selected>Selecciona una opcion</option>");
                        $.each(busqueda, function(index, value){
                            $('#medicamento__id').append("<option value='"+value[0]+'_'+value[1]+'_'+value[2]+'_'+value[3]+'_'+value[4]+'_'+index+"'>" + value[0]+"</option>");
                        });
                    });
                });

                $('#medicamento__id').on('change', function(){
                     valor_medic_select = $('#medicamento__id').val().split('_');
                    $('#cantidad_venta_id').val(valor_medic_select[3]);
                    $('#precio_venta_id').val(valor_medic_select[1]);
                });
                
                var contador_mps = 1;
                $('#btnasignar').click(function() {
                    valor_medic_select = $('#medicamento__id').val().split('_');
                    cantidad = parseFloat($('#cantidad_venta_id').val());
                    precio = $('#precio_venta_id').val();
                    valor_total = parseInt(cantidad)*parseFloat(precio);
                    valor_total = valor_total.toFixed(2);

                    if (valor_medic_select != "" && cantidad > 0 && precio > 0) {
                        console.log(cantidad, precio);
                        var $divs = $(".contador_divs").toArray().length;
                        $('#acomulador_card').val($divs+1);
                        var fila = '<tr class="selected contador_divs" id="filamp' + contador_mps +
                                    '"><td class="align-middle fw-normal">' + contador_mps + '</td><td class="align-middle fw-normal">' + valor_medic_select[4] +
                                    '</td><td class="align-middle fw-normal">' + valor_medic_select[0] +
                                    '</td><td class="align-middle fw-normal">' + valor_medic_select[2] +
                                    '</td><td class="align-middle fw-normal">' + cantidad +
                                    '<input type="text" hidden name="cantidad[]" value="' + cantidad +
                                    '"><input type="hidden" name="medicamento_id[]" value="' + valor_medic_select[5] +
                                    '"><input type="hidden" name="precio[]" value="' + precio +
                                    '"><input type="hidden" name="subtotal_[]" value="' + valor_total +
                                    '"></td><td class="align-middle fw-normal">' + precio +
                                    '</td><td class="align-middle fw-normal">' + valor_total +
                                    '</td><td class="align-middle"><button type="button" class="bg-transparent border-0 text-danger" onclick="eliminardtc(' +
                            contador_mps +');"><i class="bi bi-trash"></i></button></td></tr>';

                            contador_mps++;

                            $('#medicamento__id').prop('selectedIndex', 0).change();
                            $('#cantidad_venta_id').val("");
                            $('#precio_venta_id').val("");
                            $('#dtll_farmacia').append(fila);

                            let subtotal_fijo = 0;
                            let subtotal_cal;
                            [...document.getElementsByName("subtotal_[]")].forEach(function(element) {
                                if (element.value !== '') {
                                    subtotal_fijo += parseFloat((element.value));
                                    console.log(subtotal_fijo); 

                                    subtotal_cal = parseFloat(subtotal_fijo/1.18);
                                    $('#subtotal_html').html(subtotal_cal.toFixed(2));
                                    $('#subtotal_id').val(subtotal_cal.toFixed(2));

                                    igv_total = subtotal_cal*0.18;
                                    igv_total = igv_total.toFixed(2);

                                    $('#igv_html').html(igv_total);
                                    $('#igv_id').val(igv_total);

                                    $('#total_html').html(subtotal_fijo);
                                    $('#total_id').val(subtotal_fijo);

                                }else{
                                    $('#subtotal_html').html(0.00);
                                    $('#subtotal_id').val(0.00);

                                    $('#igv_html').html(0.00);
                                    $('#igv_id').val(0.00);

                                    $('#total_html').html(0.00);
                                    $('#total_id').val(0.00);
                                }
                            });

                    }
                });
            }
            
        });
    });

    function eliminardtc(indexmp) {
        var contando_card = $('#acomulador_card').val();
        $("#filamp" + indexmp).remove();
        var nuevo_cont_card = contando_card-1;
        $('#acomulador_card').val(nuevo_cont_card);

        if(nuevo_cont_card > 0){
                let subtotal_fijo = 0;
                let subtotal_cal;
                [...document.getElementsByName("subtotal_[]")].forEach(function(element) {
                    if (element.value !== '') {
                        subtotal_fijo += parseFloat((element.value));
                        
                        subtotal_cal = parseFloat(subtotal_fijo/1.18);
                        $('#subtotal_html').html(subtotal_cal.toFixed(2));
                        $('#subtotal_id').val(subtotal_cal.toFixed(2));

                        igv_total = subtotal_cal*0.18;
                        igv_total = igv_total.toFixed(2);

                        $('#igv_html').html(igv_total);
                        $('#igv_id').val(igv_total);

                        $('#total_html').html(subtotal_fijo);
                        $('#total_id').val(subtotal_fijo);

                    }
                });
        }else{
            $('#subtotal_html').html(0.00);
            $('#subtotal_id').val(0.00);

            $('#igv_html').html(0.00);
            $('#igv_id').val(0.00);

            $('#total_html').html(0.00);
            $('#total_id').val(0.00);
        }
    };
</script>
@endsection