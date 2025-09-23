<div class="card border-0">
    <div class="card-body">
        <form method="POST" action="/guardar_eauxiliar" enctype="multipart/form-data" autocomplete="off" class="needs-validation" novalidate>
        @csrf
            <input hidden name="atenciones_id_eauxiliar" value="{{$admin_atencione->id}}">
            <div class="row">
                <div class="col-12 col-lg-2">
                    <div class="clearfix">
                        <span class="float-start fw-bold small text-muted" style="font-size: 13px">Nro. Solicitud</span>
                        <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                    </div>
                </div>
                <div class="col-12 col-lg-6" id="nsolicitud_eauxiliar">
                    0000001
                </div>
                <input hidden name="nro_solicitud" id="nsolicitud_eauxiliar_value">
                <div class="col-12 col-lg-2">
                    <div class="clearfix">
                        <span class="float-start fw-bold small text-muted" style="font-size: 13px">Fecha</span>
                        <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                    </div>
                </div>
                <div class="col-12 col-lg-2">
                    <input type="date" name="fecha_auxiliar" value="{{$fecha_actual}}" class="form-control form-control-sm">
                </div>
            </div>
            <p class="fw-bold text-uppercase small text-secondary mb-1" style="font-size: 14px">Solicitud de Examen Auxiliar</p>
            <div class="row g-2">
                <div class="col-6 col-md-4">
                    <label for="analisis__id">Analisis</label>
                    <select id="analisis__id" class="form-select form-select-sm select2_bootstrap" data-placeholder="Seleccione">
                        <option selected="selected" disabled>Seleccione opcion</option>
                        <option value="Hematologia">Hematologia</option>
                        <option value="Perfil de Anemia">Perfil de Anemia</option>
                        <option value="Perfil Diabetes">Perfil Diabetes</option>
                        <option value="Bioquimicos">Bioquimicos</option>
                        <option value="Marcadores Tumorales">Marcadores Tumorales</option>
                        <option value="Inmunologia y Autoinmunidad">Inmunologia y Autoinmunidad</option>
                        <option value="Rx">Rx</option>
                        <option value="Ecografia">Ecografia</option>
                        <option value="Resonancia Magnetica (RM)">Resonancia Magnetica (RM)</option>
                        <option value="Endoscopias">Endoscopias</option>
                    
                    </select>
                </div>
                <div class="col-6 col-md-5">
                    <label for="tipo_analisis__id">Tipo de Analisis</label>
                    <input type="text" id="tipo_analisis__id" class="form-control form-control-sm">
                </div>
                <div class="col-12 col-md-1">
                    <label for="agre" class="d-block text-white">..</label>
                    <button type="button" id="btnasignar_eauxiliar" class="btn btn-grey btn-sm w-100 align-bottom mt-2 mt-md-0">
                        <i class="bi bi-plus-circle"></i>
                    </button>
                </div>
            </div>

            <div class="table-responsive mt-3" style="min-height: 150px">
                <table class="table table-sm table-hover w-100">
                    <thead>
                        <tr>
                            <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 5%">N°</th>
                            <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 30%">Descripción</th>
                            <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 30%">Tipo de Analisis</th>
                            <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 5%"></th>
                        </tr>
                    </thead>
                    <tbody id="dt_eauxiliar" class="text-center">
                    </tbody>
                </table>
            </div>

            @if($admin_atencione->estado == 'En atención')
            <div class="pt-3 text-end" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                <button type="submit" id="guardar_euxiliar" class="btn btn-primary btn-sm px-5 my-2 my-md-0 text-white">Guardar</button>
            </div>
            @endif
        </form>
    </div>
</div>

@section('js_eauxiliar')
    <script>
        valor_atencion_id = $('#atenciones_id').val();

        $.get('/busqueda_solicitud_eauxiliar',{value_solicitud: 'mostrar_solicitud', valor_atencion_id: valor_atencion_id}, function(busqueda){
            $('#nsolicitud_eauxiliar').html("");
            $.each(busqueda, function(index, value){
                if(value[1] == 'codigo_existente'){
                    $('#nsolicitud_eauxiliar').html('EA'+value[0]);
                    $('#nsolicitud_eauxiliar_value').val(value[0]);
                }else{
                    $('#nsolicitud_eauxiliar').html('EA'+value[0]);
                    $('#nsolicitud_eauxiliar_value').val(value[0]);
                }
            });
        });


        var contador_eauxiliar = 1;
        $('#btnasignar_eauxiliar').click(function() {
            valor_analisis_select = $('#analisis__id').val();
            valor_tanalisis_select = $('#tipo_analisis__id').val();

            if (valor_analisis_select != "" && valor_tanalisis_select != "" ) {

                var $divs = $(".contador_divs_eauxiliar").toArray().length;
                var fila = '<tr class="selected contador_divs_eauxiliar" id="filamp' + contador_eauxiliar +
                            '"><td class="align-middle fw-normal">' + contador_eauxiliar + '</td><td class="align-middle fw-normal">' + valor_analisis_select +
                            '<input type="text" class="form-control form-control-sm" hidden name="analisis[]" value="' + valor_analisis_select +
                            '"></td><td class="align-middle fw-normal"><input type="text" class="form-control form-control-sm" name="tipo_analisis[]" value="' + valor_tanalisis_select +
                            '"></td><td class="align-middle"><button type="button" class="bg-transparent border-0 text-danger" onclick="eliminardtea(' +
                    contador_eauxiliar +');"><i class="bi bi-trash"></i></button></td></tr>';

                    contador_eauxiliar++;

                    $('#analisis__id').prop('selectedIndex', 0).change();
                    $('#tipo_analisis__id').val("");

                    $('#dt_eauxiliar').append(fila);


            }
        });

        function eliminardtea(indexmp) {
            var contando_card = $('#acomulador_card').val();
            $("#filamp" + indexmp).remove();
            var nuevo_cont_card = contando_card-1;
            $('#acomulador_card').val(nuevo_cont_card);
            
        };

        /* RECETA */
            /* precargar vista de receta */
                $.get('/cargar_dtllemedica_eauxiliar',{tipo_consulta:'cargar',valor_atencion_id: valor_atencion_id}, function(busqueda){
                    $('#dt_eauxiliar').empty("");
                    $.each(busqueda, function(index, value){
                        const random = Math.random().toString(36).substring(2, 5);
                        valor_via_select = value[5];
                        valor_analisis_select = value[0];
                        valor_tanalisis_select = value[1];

                        var $divs = $(".contador_divs_eauxiliar").toArray().length;
                        var fila = '<tr class="selected contador_divs_eauxiliar" id="filamp' + contador_eauxiliar +
                            '"><td class="align-middle fw-normal">' + contador_eauxiliar + '</td><td class="align-middle fw-normal">' + valor_analisis_select +
                            '<input type="text" class="form-control form-control-sm" hidden name="analisis[]" value="' + valor_analisis_select +
                            '"></td><td class="align-middle fw-normal"><input type="text" class="form-control form-control-sm" name="tipo_analisis[]" value="' + valor_tanalisis_select +
                            '"></td><td class="align-middle"><button type="button" class="bg-transparent border-0 text-danger" onclick="eliminardtea(' +
                    contador_eauxiliar +');"><i class="bi bi-trash"></i></button></td></tr>';

                        contador_eauxiliar++;

                        $('#dt_eauxiliar').append(fila);

                        $('#guardar_euxiliar').html('Actualizar').css("background","#ffc107").css("border-color","#ffc107");
                    });
                });
            /* fin de precarga de la consulta */
        /* FIN DE RECETA */
    </script>
@endsection