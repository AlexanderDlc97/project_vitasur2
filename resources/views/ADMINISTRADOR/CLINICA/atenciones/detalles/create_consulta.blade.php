<div class="card border-0">
    <div class="card-body">
        @if($admin_atencione->paciente->persona->sexo == "Mujer")                                  
            <div class="row mb-3">
                <div class="col-12 col-lg-2 d-flex">
                    <div class="clearfix align-self-center w-100">
                        <span class="float-start fw-bold text-uppercase small">¿Gestando?</span>
                        <span class="float-end fw-bold text-uppercase small">:</span>
                    </div>
                </div>
                <div class="col-12 col-lg-2">
                    <select name="gestando" id="gestando__id" class="form-select select2_bootstrap_2" data-placeholder="Seleccione">
                        <option value="{{ old('gestando') }}" selected="selected" hidden="hidden">{{ old('gestando') }}</option>
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                    </select>
                </div>
            </div>
        @endif
        <div class="col-12 col-md-12 col-lg-12">
            <div class="pb-2">
                <label for="antecedentes_patologico" class="fw-bold text-uppercase small text-secondary mb-1" style="font-size: 14px">ANTECEDENTES PATOLOGICOS</label>
                <div class="row g-2 mb-3">
                    @if($admin_atencione->especialidad->id == '1')
                        <div class="col-12 col-md-4 col-lg-4">
                            <select class="form-select form-select-sm " id="multiple-select-field" name="antecedentes_patologicos[]" multiple data-placeholder="Seleccione una opcion">
                                <option  disabled>Seleccion opcion</option>
                                @foreach ($antecede_patologicos as $antecede_patologico)
                                    <option value="{{$antecede_patologico->id}}">{{$antecede_patologico->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    @else
                    @endif
                    <div class="col-12 col-md-8 col-lg-8 me-2">
                        <textarea name="otras_patologias" id="otras_patologias_id" placeholder="Otros" rows="3" class="form-control"></textarea>
                    </div>
                    @if($admin_atencione->especialidad->id == '9')
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="pt-3 text-center" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#createodontograma" class="btn btn-primary btn-sm text-uppercase text-white w-100" style="border-radius: 20px"><img src="/images/icons/icon_dental.png" class="img-fluid me-2" style="height: 35px;">REGISTRAR ODONTOGRAMA</button>
                            </div>
                        </div>
                    @else
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-12 mb-3">
            <div class="pb-2">
                <div class="row">
                    @if($admin_atencione->especialidad->id == '1')
                    <div class="col-6 col-md-6 col-lg-6 mb-3">
                        <label for="antecedentes_id" class="fw-bold text-uppercase small text-secondary mb-1" style="font-size: 14px">ANTECEDENTES FAMILIARES</label>
                        <textarea name="antecedentes" id="antecedentes_id" placeholder="" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="col-6 col-md-6 col-lg-6 mb-3">
                        <label for="habitos_nocivos_id" class="fw-bold text-uppercase small text-secondary mb-1" style="font-size: 14px">HABITOS NOCIVOS</label>
                        <select class="form-select form-select-sm select2_bootstrap_2" id="habitos_nocivos_id" name="habitos_nocivos[]" multiple data-placeholder="Seleccione una opcion">
                            <option  disabled>Seleccion opcion</option>
                            @foreach ($habitos_nocivos as $habitos_nocivo)
                                <option value="{{$habitos_nocivo->id}}">{{$habitos_nocivo->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="mb-3">
            <p class="fw-bold text-uppercase small text-secondary mb-1" style="font-size: 14px">Anamnesis</p>
            <textarea name="anamnesis" id="anamnesis" rows="3" class="form-control"></textarea>
        </div>
        <p class="fw-bold text-uppercase small text-secondary mb-1" style="font-size: 14px">Signos vitales</p>
        <div class="row g-2 mb-3">
            <div class="col-12 col-lg-2 d-flex">
                <div class="clearfix align-self-center w-100">
                    <span class="float-start fw-bold small text-muted" style="font-size: 13px">Presión Arterial (mm Hg)</span>
                    <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                </div>
            </div>
            <div class="col-12 col-lg-2">
                <div class="input-group input-group-sm pe-md-5">
                    <input type="number" name="presion_arterial_uno" id="presion_arterial_uno" class="form-control">
                    <span class="input-group-text">/</span>
                    <input type="number" name="presion_arterial_dos" id="presion_arterial_dos" class="form-control">
                </div>
            </div>
            <div class="col-12 col-lg-2 d-flex">
                <div class="clearfix align-self-center w-100">
                    <span class="float-start fw-bold small text-muted" style="font-size: 13px">Frecuencia Cardiaca (Latidos x Min)</span>
                    <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                </div>
            </div>
            <div class="col-12 col-lg-1">
                <input type="number" name="frecuencia_cardiaca" id="frecuencia_cardiaca" class="form-control form-control-sm">
            </div>
            <div class="col-12 col-lg-1"></div>
            <div class="col-12 col-lg-2 d-flex">
                <div class="clearfix align-self-center w-100">
                    <span class="float-start fw-bold small text-muted" style="font-size: 13px">Temperatura Corporal (°C)</span>
                    <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                </div>
            </div>
            <div class="col-12 col-lg-1">
                <input type="decimal" name="temperatura_corporal" id="temperatura_corporal" class="form-control form-control-sm">
            </div>
            <div class="col-12 col-lg-1"></div>

            <div class="col-12 col-lg-2 d-flex">
                <div class="clearfix align-self-center w-100">
                    <span class="float-start fw-bold small text-muted" style="font-size: 13px">Presión Venosa Central (cm H20)</span>
                    <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                </div>
            </div>
            <div class="col-12 col-lg-1">
                <input type="number" name="presion_venosa_central" id="presion_venosa_central" class="form-control form-control-sm">
            </div>
            <div class="col-12 col-lg-1"></div>
            <div class="col-12 col-lg-2 d-flex">
                <div class="clearfix align-self-center w-100">
                    <span class="float-start fw-bold small text-muted" style="font-size: 13px">Frecuencia Respiratoria x Min</span>
                    <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                </div>
            </div>
            <div class="col-12 col-lg-1">
                <input type="number" name="Frecuencia_respiratoria" id="Frecuencia_respiratoria" class="form-control form-control-sm">
            </div>
            <div class="col-12 col-lg-1"></div>
            <div class="col-12 col-lg-2 d-flex">
                <div class="clearfix align-self-center w-100">
                    <span class="float-start fw-bold small text-muted" style="font-size: 13px">Sat. O2</span>
                    <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                </div>
            </div>
            <div class="col-12 col-lg-1">
                <input type="number" name="sat_o2" id="sat_o2" class="form-control form-control-sm">
            </div>
            <div class="col-12 col-lg-1"></div>
        </div>
        <p class="fw-bold text-uppercase small text-secondary mb-1" style="font-size: 14px">Antropométria</p>
        <div class="row g-2 mb-3">
            <div class="col-12 col-lg-2 d-flex">
                <div class="clearfix align-self-center w-100">
                    <span class="float-start fw-bold small text-muted" style="font-size: 13px">Peso (Kg)</span>
                    <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                </div>
            </div>
            <div class="col-12 col-lg-1">
                <input type="decimal" name="peso" id="peso" class="form-control form-control-sm">
            </div>

            <div class="col-12 col-lg-1"></div>
            <div class="col-12 col-lg-1 d-flex">
                <div class="clearfix align-self-center w-100">
                    <span class="float-start fw-bold small text-muted" style="font-size: 13px">Talla (m)</span>
                    <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                </div>
            </div>
            <div class="col-12 col-lg-1">
                <input type="decimal" name="talla" id="talla" class="form-control form-control-sm">
            </div>

            <div class="col-12 col-lg-1"></div>
            <div class="col-12 col-lg-1 d-flex">
                <div class="clearfix align-self-center w-100">
                    <span class="float-start fw-bold small text-muted" style="font-size: 13px">IMC (%)</span>
                    <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                </div>
            </div>
            <div class="col-12 col-lg-1">
                <input type="decimal" name="imc" id="imc" class="form-control form-control-sm">
            </div>

            <div class="col-12 col-lg-2 d-flex">
                <div class="clearfix align-self-center w-100 ps-lg-5">
                    <span class="float-start fw-bold small text-muted" style="font-size: 13px">Perímetro Abdominal (cm)</span>
                    <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                </div>
            </div>
            <div class="col-12 col-lg-1">
                <input type="decimal" name="perimetro_abdominal" id="perimetro_abdominal" class="form-control form-control-sm">
            </div>
        </div>
        @if($admin_atencione->especialidad->id == '5')
            <p class="fw-bold text-uppercase small text-secondary mb-1" style="font-size: 14px">Aparatos y Sistemas</p>
            <div class="col-12 col-md-12 col-lg-12 mb-3">
                <div class="pb-2">
                    <div class="row">
                        <div class="col-6 col-md-4 col-lg-4 mb-3">
                            <span class="float-start fw-bold small text-muted" style="font-size: 13px">Pulsos Periféricos: </span>
                            <textarea name="pulsos_perifericos" id="pulsos_perifericos_id" placeholder="" rows="2" class="form-control"></textarea>
                        </div>
                        <div class="col-6 col-md-4 col-lg-4 mb-3">
                            <span class="float-start fw-bold small text-muted" style="font-size: 13px">Aparato Respiratorio: </span>
                            <textarea name="aparato_respiratorio" id="aparato_respiratorio_id" placeholder="" rows="2" class="form-control"></textarea>
                        </div>
                        <div class="col-6 col-md-4 col-lg-4 mb-3">
                            <span class="float-start fw-bold small text-muted" style="font-size: 13px">Abdomen: </span>
                            <textarea name="abdomen" id="abdomen_id" placeholder="" rows="2" class="form-control"></textarea>
                        </div>
                        <div class="col-6 col-md-4 col-lg-4 mb-3">
                            <span class="float-start fw-bold small text-muted" style="font-size: 13px">Extremidades: </span>
                            <textarea name="extremidades" id="extremidades_id" placeholder="" rows="2" class="form-control"></textarea>
                        </div>
                        <div class="col-6 col-md-4 col-lg-4 mb-3">
                            <span class="float-start fw-bold small text-muted" style="font-size: 13px">Electro cardiograma: </span>
                            <textarea name="electro_cardiograma" id="electro_cardiograma_id" placeholder="" rows="2" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <p class="fw-bold text-uppercase small text-secondary mb-1" style="font-size: 14px">RIESGO QUIRURGICO</p>
            <div class="row g-2">
                <div class="col-4 col-lg-4">
                    <div class="mb-3">
                        <select class="form-select form-select-sm select2_bootstrap_2" id="riesgo_quirurgico_id" name="riesgo_quirurgico">
                            <option selected disabled>Selecciona una opcion</option>
                            <option value="ASA I - Paciente sano">ASA I - Paciente sano</option>
                            <option value="ASA II - Paciente con enfermedad sistemica moderada">ASA II - Paciente con enfermedad sistemica moderada</option>
                            <option value="ASA III - Paciente con enfermedad sistemica severa">ASA III - Paciente con enfermedad sistemica severa</option>
                            <option value="ASA IV - Paciente con enfermedad sistemica severa">ASA IV - Paciente con enfermedad sistemica severa</option>
                            <option value="ASA V - Paciente moribundo cuya supervivencia es nula si no se realiza la cirugia">ASA V - Paciente moribundo cuya supervivencia es nula si no se realiza la cirugia</option>
                            <option value="ASA VI - Paciente declarado con muerte cerebral, soporte vital para procuracion de organos">ASA VI - Paciente declarado con muerte cerebral, soporte vital para procuracion de organos</option>
                        </select>
                    </div>
                </div>
            </div>
        @endif
        @if($admin_atencione->especialidad->id == '6')
            <p class="fw-bold text-uppercase small text-secondary mb-1" style="font-size: 14px">PLAN DE TRATAMIENTO</p>
            <div class="col-12 col-md-12 col-lg-12 mb-3">
                <div class="pb-2">
                    <div class="row">
                        <div class="col-12 col-md-4 col-lg-4 mb-3">
                            <span class="float-start fw-bold small text-muted" style="font-size: 13px">Sesiones Programadas: </span>
                            <input type="decimal" name="sesiones_programadas" id="sesiones_programadas_id" class="form-control form-control-sm">
                        </div>
                        <div class="col-12 col-md-4 col-lg-4 mb-3">
                            <span class="float-start fw-bold small text-muted" style="font-size: 13px">Frecuencia de Sesiones: </span>
                            <select class="form-select form-select-sm" id="frecuencia_sesiones_id" name="frecuencia_sesiones">
                                <option selected disabled>Selecciona una opcion</option>
                                <option value="Diarias">Diarias</option>
                                <option value="Interdiarias">Interdiarias</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-4 col-lg-4 mb-3">
                            <label for="recursos_terapeuticos_id" class="text-start fw-bold small text-muted" style="font-size: 13px;">Recursos terapeuticos</label>
                            <div class="row">
                                <select class="form-select form-select-sm select2_bootstrap_2" id="recursos_terapeuticos_id" name="recursos_terapeuticos[]" multiple>
                                    <option  disabled>Seleccion opcion</option>
                                    @foreach ($recursos_terapeuticos as $recursos_terapeutico)
                                        <option value="{{$recursos_terapeutico->id}}">{{$recursos_terapeutico->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="row g-2 mb-3">
            <div class="col-12 col-lg-12">
                <div class="mb-3">
                    <p class="fw-bold text-uppercase small text-secondary mb-1" style="font-size: 14px">Tratamiento</p>
                    <textarea name="tratamiento" id="tratamiento_id" rows="3" class="form-control"></textarea>
                </div>
            </div>
        </div>
        @if($admin_atencione->especialidad->id == '2' || $admin_atencione->especialidad->id == '3' || $admin_atencione->especialidad->id == '4')
            <div class="row g-2">
                <div class="col-4 col-lg-4">
                    <div class="mb-3">
                        <p class="fw-bold text-uppercase small text-secondary mb-1" style="font-size: 14px">Interconsulta</p>
                        <select class="form-select form-select-sm select2_bootstrap_2" id="interconsulta_id" name="interconsulta">
                            <option selected disabled>Selecciona una opcion</option>
                            @foreach ($especialidades as $especialidade)
                                <option value="{{$especialidade->name}}">{{$especialidade->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6 col-lg-6">
                    <div class="mb-3">
                        <textarea name="motivo_interconsulta" id="motivo_interconsulta_id" rows="3" class="form-control" placeholder="motivo de interconsulta"></textarea>
                    </div>
                </div>
                <div class="col-6 col-lg-6">
                    <div class="mb-3">
                        <textarea name="solicitud_interconsulta" id="solicitud_interconsulta_id" rows="3" class="form-control" placeholder="solicitud de interconsulta"></textarea>
                    </div>
                </div>
            </div>
        @endif

        @if($admin_atencione->estado == 'En atención')
            <div class="pt-3 text-end" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                <button type="button" id="guardar_consulta" class="btn btn-primary btn-sm px-5 my-2 my-md-0 text-white">Guardar</button>
            </div>
        @endif
    </div>
</div>

@section('js_consulta')
    <script>
        $( '#multiple-select-field' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: false,
            
        } );
        $( '#habitos_nocivos_id' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: false,
        } );
        $( '#recursos_terapeuticos_id' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: false,
        } );
    </script>
    <script>
        valor_atencion_id = $('#atenciones_id').val();
        /* CONSULTA */
            /* Guardar_consulta */
                $('#guardar_consulta').on('click', function(){
                    gestante = $('#gestando__id').val();
                    otras_patologias = $('#otras_patologias_id').val();
                    antecedentes_multiple = $('#multiple-select-field').val();
                    antecedentes = $('#antecedentes_id').val();
                    habitosnocivos_multiple = $('#habitos_nocivos_id').val();
                    recursosterapeuticos_multiple = $('#recursos_terapeuticos_id').val();
                    tratamiento = $('#tratamiento_id').val();
                    interconsulta = $('#interconsulta_id').val();
                    motivo_interconsulta = $('#motivo_interconsulta_id').val();
                    solicitud_interconsulta = $('#solicitud_interconsulta_id').val();
                    sesiones_programadas = $('#sesiones_programadas_id').val();
                    frecuencia_sesiones = $('#frecuencia_sesiones_id').val();
                    recursos_terapeuticos = $('#recursos_terapeuticos_id').val();
                    pulsos_perifericos = $('#pulsos_perifericos_id').val();
                    aparato_respiratorio = $('#aparato_respiratorio_id').val();
                    abdomen = $('#abdomen_id').val();
                    extremidades = $('#extremidades_id').val();
                    electro_cardiograma = $('#electro_cardiograma_id').val();
                    riesgo_quirurgico = $('#riesgo_quirurgico_id').val();
                    
                    anamnesis = $('#anamnesis').val();
                    presion_arterial_uno = $('#presion_arterial_uno').val();
                    presion_arterial_dos = $('#presion_arterial_dos').val();
                    frecuencia_cardiaca = $('#frecuencia_cardiaca').val();
                    temperatura_corporal = $('#temperatura_corporal').val();
                    presion_venosa_central = $('#presion_venosa_central').val();
                    Frecuencia_respiratoria = $('#Frecuencia_respiratoria').val();
                    sat_o2 = $('#sat_o2').val();
                    peso = $('#peso').val();
                    talla = $('#talla').val();
                    imc = $('#imc').val();
                    perimetro_abdominal = $('#perimetro_abdominal').val();

                    $.get('/guardar_consulta',{tipo_consulta:'generar',gestante:gestante,valor_atencion_id: valor_atencion_id,anamnesis: anamnesis,presion_arterial_uno: presion_arterial_uno,presion_arterial_dos: presion_arterial_dos,frecuencia_cardiaca: frecuencia_cardiaca,temperatura_corporal: temperatura_corporal,presion_venosa_central: presion_venosa_central,Frecuencia_respiratoria:Frecuencia_respiratoria,sat_o2:sat_o2,peso:peso,talla:talla,imc:imc,perimetro_abdominal:perimetro_abdominal,otras_patologias:otras_patologias,antecedentes:antecedentes,tratamiento:tratamiento, interconsulta:interconsulta, motivo_interconsulta:motivo_interconsulta, solicitud_interconsulta:solicitud_interconsulta,sesiones_programadas:sesiones_programadas,frecuencia_sesiones:frecuencia_sesiones,recursos_terapeuticos:recursos_terapeuticos,pulsos_perifericos:pulsos_perifericos,aparato_respiratorio:aparato_respiratorio,abdomen:abdomen,extremidades:extremidades,electro_cardiograma:electro_cardiograma,riesgo_quirurgico:riesgo_quirurgico, antecedentes_multiple:antecedentes_multiple,habitosnocivos_multiple:habitosnocivos_multiple,recursosterapeuticos_multiple:recursosterapeuticos_multiple}, function(busqueda){
                        $.each(busqueda, function(index, value){

                            if(value[0] == 'consulta_generada'){
                                Swal.fire({
                                icon: 'success',
                                confirmButtonColor: '#1C3146',
                                title: '¡Éxito!',
                                text: 'Consulta generada correctamente',
                                })
                            }

                            $('#gestando__id option[value="'+ value[1] +'"]').attr("selected",true).change();
                            $('#anamnesis').val(value[2]);
                            $('#presion_arterial_uno').val(value[3]);
                            $('#presion_arterial_dos').val(value[4]);
                            $('#frecuencia_cardiaca').val(value[5]);
                            $('#temperatura_corporal').val(value[6]);
                            $('#presion_venosa_central').val(value[7]);
                            $('#Frecuencia_respiratoria').val(value[8]);
                            $('#sat_o2').val(value[9]);
                            $('#peso').val(value[10]);
                            $('#talla').val(value[11]);
                            $('#imc').val(value[12]);
                            $('#perimetro_abdominal').val(value[13]);

                            // datos de medicina general
                                $('#otras_patologias_id').val(value[14]);
                                $('#antecedentes_id').val(value[15]);
                                $('#tratamiento_id').val(value[16]);
                            // fin de datos de me_general

                            // datos de traumatologia
                                $('#interconsulta_id option[value="'+ value[17] +'"]').attr("selected",true).change();
                                $('#motivo_interconsulta_id').val(value[18]);
                                $('#solicitud_interconsulta_id').val(value[19]);
                            // fin de datos de traumatologia

                            // datos de terapia
                                $('#sesiones_programadas_id').val(value[20]);
                                $('#frecuencia_sesiones_id option[value="'+ value[21] +'"]').attr("selected",true).change();
                            // fin de datos de terapia

                            // datos de cardiologia
                                $('#pulsos_perifericos_id').val(value[22]);
                                $('#aparato_respiratorio_id').val(value[23]);
                                $('#abdomen_id').val(value[24]);
                                $('#extremidades_id').val(value[25]);
                                $('#electro_cardiograma_id').val(value[26]);
                                $('#riesgo_quirurgico_id option[value="'+ value[27] +'"]').attr("selected",true).change();
                            // fin de datos de cardiologia

                            //Cargar selects multiples
                                $.get('/cargar_select_multiple',{tipo_consulta:'cargar_antec',valor_atencion_id: valor_atencion_id}, function(busqueda_apato){
                                    $.each(busqueda_apato, function(index, value){
                                        $('#multiple-select-field option[value="'+ value[0] +'"]').attr("selected",true).change();
                                    });
                                });

                                $.get('/cargar_select_multiple',{tipo_consulta:'cargar_habnoc',valor_atencion_id: valor_atencion_id}, function(busqueda_habnoc){
                                    $.each(busqueda_habnoc, function(index, value){
                                        $('#habitos_nocivos_id option[value="'+ value[0] +'"]').attr("selected",true).change();
                                    });
                                });

                                $.get('/cargar_select_multiple',{tipo_consulta:'cargar_recuter',valor_atencion_id: valor_atencion_id}, function(busqueda_rectera){
                                    $.each(busqueda_rectera, function(index, value){
                                        $('#recursos_terapeuticos_id option[value="'+ value[0] +'"]').attr("selected",true).change();
                                    });
                                });
                            // 
                            

                            $('#guardar_consulta').html('Actualizar').attr('color:warning');

                        });
                    });

                });
            /* Fin consulta */

            /* precargar vista de consulta */
                
                $.get('/guardar_consulta',{tipo_consulta:'cargar',valor_atencion_id: valor_atencion_id}, function(busqueda){
                    $.each(busqueda, function(index, value){

                        $('#gestando__id option[value="'+ value[1] +'"]').attr("selected",true).change();
                        $('#anamnesis').val(value[2]);
                        $('#presion_arterial_uno').val(value[3]);
                        $('#presion_arterial_dos').val(value[4]);
                        $('#frecuencia_cardiaca').val(value[5]);
                        $('#temperatura_corporal').val(value[6]);
                        $('#presion_venosa_central').val(value[7]);
                        $('#Frecuencia_respiratoria').val(value[8]);
                        $('#sat_o2').val(value[9]);
                        $('#peso').val(value[10]);
                        $('#talla').val(value[11]);
                        $('#imc').val(value[12]);
                        $('#perimetro_abdominal').val(value[13]);

                        // datos de medicina general
                            $('#otras_patologias_id').val(value[14]);
                            $('#antecedentes_id').val(value[15]);
                            $('#tratamiento_id').val(value[16]);
                        // fin de datos de me_general

                        // datos de traumatologia
                            $('#interconsulta_id option[value="'+ value[17] +'"]').attr("selected",true).change();
                            $('#motivo_interconsulta_id').val(value[18]);
                            $('#solicitud_interconsulta_id').val(value[19]);
                        // fin de datos de traumatologia

                        // datos de terapia
                                $('#sesiones_programadas_id').val(value[20]);
                                $('#frecuencia_sesiones_id option[value="'+ value[21] +'"]').attr("selected",true).change();
                        // fin de datos de terapia

                        // datos de cardiologia
                            $('#pulsos_perifericos_id').val(value[22]);
                            $('#aparato_respiratorio_id').val(value[23]);
                            $('#abdomen_id').val(value[24]);
                            $('#extremidades_id').val(value[25]);
                            $('#electro_cardiograma_id').val(value[26]);
                            $('#riesgo_quirurgico_id option[value="'+ value[27] +'"]').attr("selected",true).change();
                        // fin de datos de cardiologia

                        
                        $('#guardar_consulta').html('Actualizar').css("background","#ffc107").css("border-color","#ffc107");
                    });
                });

                //Cargar selects multiples
                    $.get('/cargar_select_multiple',{tipo_consulta:'cargar_antec',valor_atencion_id: valor_atencion_id}, function(busqueda_apato){
                        $.each(busqueda_apato, function(index, value){
                            $('#multiple-select-field option[value="'+ value[0] +'"]').attr("selected",true).change();
                        });
                    });

                    $.get('/cargar_select_multiple',{tipo_consulta:'cargar_habnoc',valor_atencion_id: valor_atencion_id}, function(busqueda_habnoc){
                        $.each(busqueda_habnoc, function(index, value){
                            $('#habitos_nocivos_id option[value="'+ value[0] +'"]').attr("selected",true).change();
                        });
                    });

                    $.get('/cargar_select_multiple',{tipo_consulta:'cargar_recuter',valor_atencion_id: valor_atencion_id}, function(busqueda_rectera){
                        $.each(busqueda_rectera, function(index, value){
                            $('#recursos_terapeuticos_id option[value="'+ value[0] +'"]').attr("selected",true).change();
                        });
                    });
                // 

            /* fin de precarga de la consulta */

        /* FIN DE LA CONSULTA */
    </script>
@endsection