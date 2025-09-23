<div class="card border-0">
    <div class="card-body">
        <form method="POST" action="/guardar_receta" enctype="multipart/form-data" autocomplete="off" class="needs-validation" novalidate>
        @csrf
            <input hidden name="atenciones_id_receta" id="atenciones_id_receta" value="{{$admin_atencione->id}}">
            <div class="row">
                <div class="col-12 col-lg-2">
                    <div class="clearfix">
                        <span class="float-start fw-bold small text-muted" style="font-size: 13px">Nro. Solicitud</span>
                        <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                    </div>
                </div>
                <div class="col-12 col-lg-6" id="nsolicitud_receta">
                    0000001
                </div>
                <input hidden name="nro_solicitud" id="nsolicitud_receta_value">
                <div class="col-12 col-lg-2">
                    <div class="clearfix">
                        <span class="float-start fw-bold small text-muted" style="font-size: 13px">Fecha</span>
                        <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                    </div>
                </div>
                <div class="col-12 col-lg-2">
                    <input type="date" name="fecha" value="{{$fecha_actual}}" class="form-control form-control-sm">
                </div>
            </div>
            <p class="fw-bold text-uppercase small text-secondary mb-1" style="font-size: 14px">Medicamentos recetados</p>
            <div class="row g-2">
                <div class="col-6 col-md-4">
                    <label for="medicamento__id">Medicamento</label>
                    <select id="medicamento__id" class="form-select form-select-sm select2_bootstrap" data-placeholder="Seleccione">
                        <option selected="selected" disabled>Seleccione opcion</option>
                        @foreach ($admin_medicamento as $admin_medicamentos)
                            <option value="{{$admin_medicamentos->id}}_{{$admin_medicamentos->name}}_{{$admin_medicamentos->precio_venta}}_{{$admin_medicamentos->unidad_medida}}_ {{$admin_medicamentos->cantidad}}_{{$admin_medicamentos->codigo}}">{{$admin_medicamentos->name}}</option>
                        @endforeach
                    
                    </select>
                </div>
                <div class="col-6 col-md-1">
                    <label for="via__id">Vía</label>
                    <select id="via__id" class="form-select form-select-sm select2_bootstrap_2" data-placeholder="Seleccione">
                        <option  selected="selected" disabled="disabled">Selecciona un opcion</option>
                        <option value="ORAL">ORAL</option>
                        <option value="TÓPICA">TÓPICA</option>
                        <option value="EV">EV</option>
                        <option value="IM">IM</option>
                        <option value="INH">INH</option>
                    </select>
                </div>
                <div class="col-6 col-md-1">
                    <label for="cantidad__id">Cantidad</label>
                    <input type="decimal" id="cantidad__id" class="form-control form-control-sm">
                </div>
                <div class="col-6 col-md-5">
                    <label for="indicaciones__id">Indicaciones</label>
                    <input type="text" id="indicaciones__id" class="form-control form-control-sm">
                </div>
                <div class="col-12 col-md-1">
                    <label for="agre" class="d-block text-white">..</label>
                    <button type="button" id="btnasignar_receta" class="btn btn-grey btn-sm w-100 align-bottom mt-2 mt-md-0">
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
                            <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 30%">Descripción</th>
                            <!-- <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 5%">Unidad</th> -->
                            <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 5%">Vía</th>
                            <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 10%">Cantidad</th>
                            <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 30%">Indicaciones</th>
                            <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 5%"></th>
                        </tr>
                    </thead>
                    <tbody id="dt_receta" class="text-center">
                    </tbody>
                </table>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-12 col-lg-2 d-flex">
                    <div class="clearfix align-self-center w-100">
                        <span class="float-start fw-bold small text-muted" style="font-size: 13px">Información adicional</span>
                        <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                    </div>
                </div>
                <div class="col-12 col-lg-10">
                    <textarea name="informacion_adicionales" id="informacion_adicionales_id" rows="3" class="form-control"></textarea>
                </div>
            </div>
            
            @if($admin_atencione->estado == 'En atención')
            <div class="pt-3 text-end" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                <button type="submit" id="guardar_atenciones" class="btn btn-primary btn-sm px-5 my-2 my-md-0 text-white">Guardar</button>
            </div>
            @endif
        </form>
    </div>
</div>

@section('js_receta')
    <script>
        valor_atencion_id = $('#atenciones_id_receta').val();

        $.get('/busqueda_solicitud_receta',{value_solicitud: 'mostrar_solicitud', valor_atencion_id: valor_atencion_id}, function(busqueda){
            $('#nsolicitud_receta').html("");
            $.each(busqueda, function(index, value){
                console.log(value,'aqui');
                if(value[1] == 'codigo_existente'){
                    $('#nsolicitud_receta').html('R'+value[0]);
                    $('#nsolicitud_receta_value').val(value[0]);
                }else{
                    $('#nsolicitud_receta').html('R'+value[0]);
                    $('#nsolicitud_receta_value').val(value[0]);
                }
            });
        });


        var contador_recetas = 1;
        $('#btnasignar_receta').click(function() {
            valor_medic_select = $('#medicamento__id').val().split('_');
            valor_via_select = $('#via__id').val();
            valor_canti_select = $('#cantidad__id').val();
            valor_indic_select = $('#indicaciones__id').val();

            console.log(valor_medic_select, valor_via_select);
            if (valor_medic_select != "" && valor_via_select != "" && valor_canti_select != 0 && valor_canti_select != '') {

                var $divs = $(".contador_divs_receta").toArray().length;
                var fila = '<tr class="selected contador_divs_receta" id="filamp' + contador_recetas +
                            '"><td class="align-middle fw-normal">' + contador_recetas + '</td><td class="align-middle fw-normal">' + valor_medic_select[5] +
                            '</td><td class="align-middle fw-normal">' + valor_medic_select[1] +
                            '</td><td class="align-middle fw-normal">' + valor_via_select +
                            '</td><td class="align-middle fw-normal"><input type="text" class="form-control form-control-sm" name="cantidad[]" value="' + valor_canti_select +
                            '"></td><td class="align-middle fw-normal"><input type="text" class="form-control form-control-sm" name="indicaciones[]" value="' + valor_indic_select +
                            '"></td><input type="hidden" name="medicamento_id[]" value="' + valor_medic_select[0] +
                            '"><input type="hidden" name="via[]" value="' + valor_via_select +
                            '"><td class="align-middle"><button type="button" class="bg-transparent border-0 text-danger" onclick="eliminardtr(' +
                    contador_recetas +');"><i class="bi bi-trash"></i></button></td></tr>';

                    contador_recetas++;

                    $('#medicamento__id').prop('selectedIndex', 0).change();
                    $('#via__id').prop('selectedIndex', 0).change();
                    $('#cantidad__id').val("");
                    $('#indicaciones__id').val("");

                    $('#dt_receta').append(fila);


            }
        });

        function eliminardtr(indexmp) {
            var contando_card = $('#acomulador_card').val();
            $("#filamp" + indexmp).remove();
            var nuevo_cont_card = contando_card-1;
            $('#acomulador_card').val(nuevo_cont_card);
            
        };

        /* RECETA */
            /* precargar vista de receta */
                $.get('/cargar_receta',{tipo_consulta:'cargar',valor_atencion_id: valor_atencion_id}, function(busqueda){
                    $.each(busqueda, function(index, value){

                        $('#informacion_adicionales_id').html(value[1]);
                    });
                });
                console.log(valor_atencion_id);
                $.get('/cargar_dtllemedica_receta',{tipo_consulta:'cargar',valor_atencion_id: valor_atencion_id}, function(busqueda){
                    $('#dt_receta').empty("");
                    $.each(busqueda, function(index, value){
                        console.log(value);
                        const random = Math.random().toString(36).substring(2, 5);
                        valor_via_select = value[5];
                        valor_canti_select = value[6];
                        valor_indic_select = value[7];

                        var $divs = $(".contador_divs_receta").toArray().length;
                        var fila = '<tr class="selected contador_divs_receta" id="filamp' + contador_recetas +
                                '"><td class="align-middle fw-normal">' + contador_recetas + '</td><td class="align-middle fw-normal">' + value[0] +
                                '</td><td class="align-middle fw-normal">' + value[1] +
                                '</td><td class="align-middle fw-normal">' + value[2] +
                                '</td><td class="align-middle fw-normal">' + valor_canti_select +
                                '</td><td class="align-middle fw-normal">' + valor_indic_select +
                                '</td><input type="hidden" name="medicamento_id[]" value="' + value[3] +
                                '"><input type="hidden" name="via[]" value="' + valor_via_select +
                                '"><input type="hidden" name="cantidad[]" value="' + valor_canti_select +
                                '"><input type="hidden" name="indicaciones[]" value="' + valor_indic_select +
                                '"><td class="align-middle"><button type="button" class="bg-transparent border-0 text-danger" onclick="eliminardtr(' +
                        contador_recetas +');"><i class="bi bi-trash"></i></button></td></tr>';

                        contador_recetas++;

                        $('#dt_receta').append(fila);
                        
                        // $('#tipo_procedimiento'+random).append("<option selected=selected value='"+value[4]+"'>"+value[4]+"</option>");

                        // $('#caso_procedimiento'+random).append("<option selected=selected value='"+value[5]+"'>"+value[5]+"</option>");

                        // $('#alta_procedimiento'+random).append("<option selected=selected value='"+value[6]+"'>"+value[6]+"</option>");

                        $('#tipo_procedimiento'+random+' option[value="'+ value[4] +'"]').attr("Selected",true);
                        $('#caso_procedimiento'+random+' option[value="'+ value[5] +'"]').attr("Selected",true);
                        $('#alta_procedimiento'+random+' option[value="'+ value[6] +'"]').attr("Selected",true);

                        $('#guardar_atenciones').html('Actualizar').css("background","#ffc107").css("border-color","#ffc107");
                    });
                });
            /* fin de precarga de la consulta */
        /* FIN DE RECETA */
    </script>
@endsection