<div class="card border-0">
    <div class="card-body">
            <form method="POST" action="/guardar_procedimiento" enctype="multipart/form-data" autocomplete="off" class="needs-validation" novalidate>
            @csrf
            <input hidden name="atenciones_id" value="{{$admin_atencione->id}}">
            <div class="row g-2 mb-3">
                <div class="col-12 col-md-4 col-lg-3">
                    <label for="registro_dolor__id">Registro de dolor</label>
                    <select name="registro_dolor" id="registro_dolor" class="form-select select2_bootstrap_2" data-placeholder="Seleccione">
                        <option value="{{ old('registro_dolor') }}" selected="selected" hidden="hidden">{{ old('registro_dolor') }}</option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>
                <div class="col-12 col-md-8 col-lg-9">
                    <textarea name="detalle_registro_dolor" id="detalle_registro_dolor" rows="3" class="form-control"></textarea>
                </div>
            </div>
            <!-- <div class="mb-3">
                <p class="fw-bold text-uppercase small text-secondary mb-1" style="font-size: 14px">Plan de trabajo/Comentario y/o Observaciones</p>
                <textarea name="plan_trabajo" id="plan_trabajo" rows="3" class="form-control"></textarea>
            </div> -->
            
            <div class="mb-3">
                <p class="fw-bold text-uppercase small text-secondary mb-1" style="font-size: 14px">Diagnóstico</p>
                <div class="row g-2">
                    <div class="col-6 col-md-4">
                        <label for="categoria__id">Categoría</label>
                        <select id="categoria__id" class="form-select form-select-sm select2_bootstrap" data-placeholder="Seleccione">
                            <option selected="selected" hidden="hidden">Seleccione una opcion</option>
                            @foreach ($categories as $categorie)
                                <option value="{{ $categorie->id }}">{{ '('.$categorie->codigo.') - '.$categorie->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 col-md-7">
                        <label for="diagnostico__id">Diagnóstico</label>
                        <select id="diagnostico__id" class="form-select form-select-sm select2_bootstrap_2" data-placeholder="Seleccione">
                            <option value="{{ old('registro_dolor') }}" selected="selected" hidden="hidden">{{ old('registro_dolor') }}</option>
                        
                        </select>
                    </div>
                    <div class="col-12 col-md-1">
                        <label for="agre" class="d-block text-white">..</label>
                        <button type="button" id="btnasignar_categories" class="btn btn-grey btn-sm w-100 align-bottom mt-2 mt-md-0">
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
                                <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 50%">Descripción Diagnóstico</th>
                                <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 10%">Tipo</th>
                                <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 10%">Caso</th>
                                <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 10%">Alta</th>
                                <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 5%"></th>
                            </tr>
                        </thead>
                        <form method="post" id="formulario">
                            <tbody id="dt_categories" class="text-center">
                                
                            </tbody>
                        </form>
                    </table>
                </div>
            </div>

            
            <div class="row g-3 mb-3">
                <div class="col-12 col-lg-2 d-flex">
                    <div class="clearfix align-self-center w-100">
                        <span class="float-start fw-bold small text-muted" style="font-size: 13px">Información adicional</span>
                        <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                    </div>
                </div>
                <div class="col-12 col-lg-10">
                    <textarea name="informacion_adicional" id="informacion_adicional" rows="3" class="form-control"></textarea>
                </div>
                <!-- <div class="col-12 col-lg-2 d-flex">
                    <div class="clearfix align-self-center w-100">
                        <span class="float-start fw-bold small text-muted" style="font-size: 13px">Resultado Atención</span>
                        <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                    </div>
                </div>
                <div class="col-12 col-lg-2">
                    <select name="resultado_atencion" id="resultado_atencion" class="form-select select2_bootstrap_2" data-placeholder="Seleccione">
                        <option value="{{ old('resultado_atencion') }}" selected="selected" hidden="hidden">{{ old('resultado_atencion') }}</option>
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                    </select>
                </div> -->
            </div>

            @if($admin_atencione->estado == 'En atención')
            <div class="pt-3 text-end" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                <button type="submit" id="guardar_procedimiento" class="btn btn-primary btn-sm px-5 my-2 my-md-0 text-white">Guardar</button>
            </div>
            @endif
        </form>
    </div>

</div>

@section('js_procedimiento')
    <script>
        $('#categoria__id').on('change', function(){
            value_categoria = $(this).val();
            $.get('/busqueda_categoria_diagnos',{value_categoria: value_categoria}, function(busqueda){
                $('#diagnostico__id').empty("");
                $('#diagnostico__id').append("<option disabled selected>Selecciona una opcion</option>");
                $.each(busqueda, function(index, value){
                    $('#diagnostico__id').append("<option value='" + index +'_'+value[0]+'_'+value[1]+"'>"+'('+value[1]+') - '+ value[0]+"</option>"); 
                });
            });
        });

        var contador_categories = 1;
        var $divs = $(".contador_divs").toArray().length;
        $('#acomulador_card').val($divs+1);
        $('#btnasignar_categories').click(function() {
            valor_categories_select = $('#categoria__id').val();
            valor_diagnos_select = $('#diagnostico__id').val().split('_');

            if (valor_categories_select != "" && valor_diagnos_select != "") {

                var fila = '<tr class="selected contador_divs" id="filamp' + contador_categories +
                            '"><td class="align-middle fw-normal">' + contador_categories + '</td><td class="align-middle fw-normal">' + valor_diagnos_select[2] +
                            '</td><td class="align-middle fw-normal">' + valor_diagnos_select[1] +
                            '</td><td class="align-middle"><select name="tipo_procedimiento[]" id="tipo_procedimiento" class="form-select form-select-sm"><option disabled selected>Seleccion opcion</option><option value="Definitivo">Definitivo</option><option value="Presuntivo">Presuntivo</option></select></td><td class="align-middle"><select name="caso_procedimiento[]" id="" class="form-select form-select-sm"><option disabled selected>Seleccion opcion</option><option value="Nuevo">Nuevo</option><option value="Recurrente">Recurrente</option></select></td><td class="align-middle"><select name="alta_procedimiento[]" id="" class="form-select form-select-sm"><option disabled selected>Seleccion opcion</option><option value="Si">Si</option><option value="No">No</option></select></td><input type="hidden" name="diagnostico_procedimiento[]" value="' + valor_diagnos_select[0] +
                            '"><td class="align-middle"><button type="button" class="bg-transparent border-0 text-danger" onclick="eliminardtc(' +
                    contador_categories +');"><i class="bi bi-trash"></i></button></td></tr>';

                    contador_categories++;

                    $('#categoria__id').prop('selectedIndex', 0).change();
                    $('#diagnostico__id').prop('selectedIndex', 0).change();

                    $('#dt_categories').append(fila);


            }
        });

        function eliminardtc(indexmp) {
            var contando_card = $('#acomulador_card').val();
            $("#filamp" + indexmp).remove();
            var nuevo_cont_card = contando_card-1;
            $('#acomulador_card').val(nuevo_cont_card);
            
        };

        valor_atencion_id = $('#atenciones_id').val();
        /* PROCEDIMIENTO */

            /* precargar vista de procedimiento */
                
                $.get('/cargar_procedimiento',{tipo_consulta:'cargar',valor_atencion_id: valor_atencion_id}, function(busqueda){
                    $.each(busqueda, function(index, value){

                        $('#registro_dolor option[value="'+ value[1] +'"]').attr("selected",true).change();
                        $('#registro_dolor').val(value[1]);
                        $('#detalle_registro_dolor').val(value[2]);
                        $('#plan_trabajo').val(value[3]);
                        $('#informacion_adicional').val(value[4]);
                        $('#resultado_atencion option[value="'+ value[5] +'"]').attr("selected",true).change();
                    });
                });
                
                $.get('/cargar_dtlleprocedimiento',{tipo_consulta:'cargar',valor_atencion_id: valor_atencion_id}, function(busqueda){
                    $('#dt_categories').empty("");
                    
                    $.each(busqueda, function(index, value){
                        const random = Math.random().toString(36).substring(2, 5);
                        console.log(value);
                        var fila = '<tr class="selected contador_divs" id="filamp' + contador_categories +
                                '"><td class="align-middle fw-normal">' + contador_categories + '</td><td class="align-middle fw-normal">' + value[0] +
                                '</td><td class="align-middle fw-normal">' + value[1] +
                                '</td><td class="align-middle"><select name="tipo_procedimiento[]" id="tipo_procedimiento'+random+'" class="form-select form-select-sm"><option disabled selected>Seleccion opcion</option><option value="Definitivo">Definitivo</option><option value="Presuntivo">Presuntivo</option></select></td><td class="align-middle"><select name="caso_procedimiento[]" id="caso_procedimiento'+random+'" class="form-select form-select-sm"><option disabled selected>Seleccion opcion</option><option value="Nuevo">Nuevo</option><option value="Recurrente">Recurrente</option></select></td><td class="align-middle"><select name="alta_procedimiento[]" id="alta_procedimiento'+random+'" class="form-select form-select-sm"><option disabled selected>Seleccion opcion</option><option value="Si">Si</option><option value="No">No</option></select></td><input type="hidden" name="diagnostico_procedimiento[]" value="' + value[2] +
                                '"><td class="align-middle"><button type="button" class="bg-transparent border-0 text-danger" onclick="eliminardtc(' +
                        contador_categories +');"><i class="bi bi-trash"></i></button></td></tr>';
                        
                        contador_categories++;
                        
                        $('#dt_categories').append(fila);
                        
                        // $('#tipo_procedimiento'+random).append("<option selected=selected value='"+value[4]+"'>"+value[4]+"</option>");

                        // $('#caso_procedimiento'+random).append("<option selected=selected value='"+value[5]+"'>"+value[5]+"</option>");

                        // $('#alta_procedimiento'+random).append("<option selected=selected value='"+value[6]+"'>"+value[6]+"</option>");

                        $('#tipo_procedimiento'+random+' option[value="'+ value[4] +'"]').attr("Selected",true);
                        $('#caso_procedimiento'+random+' option[value="'+ value[5] +'"]').attr("Selected",true);
                        $('#alta_procedimiento'+random+' option[value="'+ value[6] +'"]').attr("Selected",true);

                        $('#guardar_procedimiento').html('Actualizar').css("background","#ffc107").css("border-color","#ffc107");
                        
                    });
                });

            /* fin de precarga de la consulta */

        /* FIN DE PROCEDIMIENTO */
    </script>
@endsection
