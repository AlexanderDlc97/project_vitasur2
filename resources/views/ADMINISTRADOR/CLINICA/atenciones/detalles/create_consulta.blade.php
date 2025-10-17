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
    <script>
        function colorear_diente(color,tipo) {
            if(tipo == 'PEX'){
                // diente 18
                    const rectangulo_izq_id_1 = document.getElementById('rectangulo_izq_id_1');
                    rectangulo_izq_id_1.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_1.style.color = color;
                            id_diente_1.innerHTML="X";
                            id_diente_1.style.marginBottom  = '0px';
                        
                    });
                    const rectangulo_der_id_1 = document.getElementById('rectangulo_der_id_1');
                    rectangulo_der_id_1.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_1.style.color = color;
                            id_diente_1.innerHTML="X";
                            id_diente_1.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 18
                // diente 17
                    const rectangulo_izq_id_2 = document.getElementById('rectangulo_izq_id_2');
                    rectangulo_izq_id_2.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_2.style.color = color;
                            id_diente_2.innerHTML="X";
                            id_diente_2.style.marginBottom  = '0px';
                        
                    });
                    const rectangulo_der_id_2 = document.getElementById('rectangulo_der_id_2');
                    rectangulo_der_id_2.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_2.style.color = color;
                            id_diente_2.innerHTML="X";
                            id_diente_2.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 17
                // diente 16
                    const rectangulo_izq_id_3 = document.getElementById('rectangulo_izq_id_3');
                    rectangulo_izq_id_3.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_3.style.color = color;
                            id_diente_3.innerHTML="X";
                            id_diente_3.style.marginBottom  = '0px';
                        
                    });
                    const rectangulo_der_id_3 = document.getElementById('rectangulo_der_id_3');
                    rectangulo_der_id_3.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_3.style.color = color;
                            id_diente_3.innerHTML="X";
                            id_diente_3.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 16
                // diente 15
                    const cuadrado_id_4 = document.getElementById('cuadrado_id_4');
                    cuadrado_id_4.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_4.style.color = color;
                            id_diente_4.innerHTML="X";
                            id_diente_4.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 15
                // diente 14
                    const cuadrado_id_5 = document.getElementById('cuadrado_id_5');
                    cuadrado_id_5.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_5.style.color = color;
                            id_diente_5.innerHTML="X";
                            id_diente_5.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 14
                // diente 13
                    const rectangulo_id_6 = document.getElementById('rectangulo_id_6');
                    rectangulo_id_6.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_6.style.color = color;
                            id_diente_6.innerHTML="X";
                            id_diente_6.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 13
                // diente 12
                    const rectangulo_small_id_7 = document.getElementById('rectangulo_small_id_7');
                    rectangulo_small_id_7.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_7.style.color = color;
                            id_diente_7.innerHTML="X";
                            id_diente_7.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 12
                // diente 11
                    const rectangulo_id_8 = document.getElementById('rectangulo_id_8');
                    rectangulo_id_8.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_8.style.color = color;
                            id_diente_8.innerHTML="X";
                            id_diente_8.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 11
                // diente 21
                    const rectangulo_id_9 = document.getElementById('rectangulo_id_9');
                    rectangulo_id_9.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_9.style.color = color;
                            id_diente_9.innerHTML="X";
                            id_diente_9.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 21
                // diente 22
                    const rectangulo_small_id_10 = document.getElementById('rectangulo_small_id_10');
                    rectangulo_small_id_10.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_10.style.color = color;
                            id_diente_10.innerHTML="X";
                            id_diente_10.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 22
                // diente 23
                    const rectangulo_id_11 = document.getElementById('rectangulo_id_11');
                    rectangulo_id_11.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_11.style.color = color;
                            id_diente_11.innerHTML="X";
                            id_diente_11.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 23
                // diente 24
                    const cuadrado_id_12 = document.getElementById('cuadrado_id_12');
                    cuadrado_id_12.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_12.style.color = color;
                            id_diente_12.innerHTML="X";
                            id_diente_12.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 24
                // diente 25
                    const cuadrado_id_13 = document.getElementById('cuadrado_id_13');
                    cuadrado_id_13.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_13.style.color = color;
                            id_diente_13.innerHTML="X";
                            id_diente_13.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 25
                // diente 26
                    const rectangulo_izq_id_14 = document.getElementById('rectangulo_izq_id_14');
                    rectangulo_izq_id_14.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_14.style.color = color;
                            id_diente_14.innerHTML="X";
                            id_diente_14.style.marginBottom  = '0px';
                        
                    });
                    const rectangulo_der_id_14 = document.getElementById('rectangulo_der_id_14');
                    rectangulo_der_id_14.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_14.style.color = color;
                            id_diente_14.innerHTML="X";
                            id_diente_14.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 26
                // diente 27
                    const rectangulo_izq_id_15 = document.getElementById('rectangulo_izq_id_15');
                    rectangulo_izq_id_15.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_15.style.color = color;
                            id_diente_15.innerHTML="X";
                            id_diente_15.style.marginBottom  = '0px';
                        
                    });
                    const rectangulo_id_15 = document.getElementById('rectangulo_id_15');
                    rectangulo_id_15.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_15.style.color = color;
                            id_diente_15.innerHTML="X";
                            id_diente_15.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 27
                // diente 28
                    const rectangulo_izq_id_16 = document.getElementById('rectangulo_izq_id_16');
                    rectangulo_izq_id_16.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_16.style.color = color;
                            id_diente_16.innerHTML="X";
                            id_diente_16.style.marginBottom  = '0px';
                        
                    });
                    const rectangulo_der_id_16 = document.getElementById('rectangulo_der_id_16');
                    rectangulo_der_id_16.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_16.style.color = color;
                            id_diente_16.innerHTML="X";
                            id_diente_16.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 28

                // diente 55
                    const rectangulo_izq_id_17 = document.getElementById('rectangulo_izq_id_17');
                    rectangulo_izq_id_17.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_17.style.color = color;
                            id_diente_17.innerHTML="X";
                            id_diente_17.style.marginBottom  = '0px';
                        
                    });
                    const rectangulo_der_id_17 = document.getElementById('rectangulo_der_id_17');
                    rectangulo_der_id_17.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_17.style.color = color;
                            id_diente_17.innerHTML="X";
                            id_diente_17.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 55
                // diente 54
                    const rectangulo_izq_id_18 = document.getElementById('rectangulo_izq_id_18');
                    rectangulo_izq_id_18.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_18.style.color = color;
                            id_diente_18.innerHTML="X";
                            id_diente_18.style.marginBottom  = '0px';
                        
                    });
                    const rectangulo_der_id_18 = document.getElementById('rectangulo_der_id_18');
                    rectangulo_der_id_18.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_18.style.color = color;
                            id_diente_18.innerHTML="X";
                            id_diente_18.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 54
                // diente 53
                    const rectangulo_id_19 = document.getElementById('rectangulo_id_19');
                    rectangulo_id_19.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_19.style.color = color;
                            id_diente_19.innerHTML="X";
                            id_diente_19.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 53
                // diente 52
                    const rectangulo_small_id_20 = document.getElementById('rectangulo_small_id_20');
                    rectangulo_small_id_20.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_20.style.color = color;
                            id_diente_20.innerHTML="X";
                            id_diente_20.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 52
                // diente 51
                    const rectangulo_id_21 = document.getElementById('rectangulo_id_21');
                    rectangulo_id_21.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_21.style.color = color;
                            id_diente_21.innerHTML="X";
                            id_diente_21.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 51
                // diente 61
                    const rectangulo_id_22 = document.getElementById('rectangulo_id_22');
                    rectangulo_id_22.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_22.style.color = color;
                            id_diente_22.innerHTML="X";
                            id_diente_22.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 61
                // diente 62
                    const rectangulo_small_id_23 = document.getElementById('rectangulo_small_id_23');
                    rectangulo_small_id_23.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_23.style.color = color;
                            id_diente_23.innerHTML="X";
                            id_diente_23.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 62
                // diente 63
                    const rectangulo_id_24 = document.getElementById('rectangulo_id_24');
                    rectangulo_id_24.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_24.style.color = color;
                            id_diente_24.innerHTML="X";
                            id_diente_24.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 63
                // diente 64
                    const rectangulo_izq_id_25 = document.getElementById('rectangulo_izq_id_25');
                    rectangulo_izq_id_25.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_25.style.color = color;
                            id_diente_25.innerHTML="X";
                            id_diente_25.style.marginBottom  = '0px';
                        
                    });
                    const rectangulo_der_id_25 = document.getElementById('rectangulo_der_id_25');
                    rectangulo_der_id_25.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_25.style.color = color;
                            id_diente_25.innerHTML="X";
                            id_diente_25.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 64
                // diente 65
                    const trapecio_izq_id_26 = document.getElementById('trapecio_izq_id_26');
                    trapecio_izq_id_26.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_26.style.color = color;
                            id_diente_26.innerHTML="X";
                            id_diente_26.style.marginBottom  = '0px';
                        
                    });
                    const trapecio_der_id_26 = document.getElementById('trapecio_der_id_26');
                    trapecio_der_id_26.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_26.style.color = color;
                            id_diente_26.innerHTML="X";
                            id_diente_26.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 65

                // diente 85
                    const rectangulo_izq_id_27 = document.getElementById('rectangulo_izq_id_27');
                    rectangulo_izq_id_27.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_27.style.color = color;
                            id_diente_27.innerHTML="X";
                            id_diente_27.style.marginBottom  = '0px';
                        
                    });
                    const rectangulo_der_id_27 = document.getElementById('rectangulo_der_id_27');
                    rectangulo_der_id_27.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_27.style.color = color;
                            id_diente_27.innerHTML="X";
                            id_diente_27.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 85
                // diente 84
                    const rectangulo_izq_id_28 = document.getElementById('rectangulo_izq_id_28');
                    rectangulo_izq_id_28.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_28.style.color = color;
                            id_diente_28.innerHTML="X";
                            id_diente_28.style.marginBottom  = '0px';
                        
                    });
                    const rectangulo_der_id_28 = document.getElementById('rectangulo_der_id_28');
                    rectangulo_der_id_28.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_28.style.color = color;
                            id_diente_28.innerHTML="X";
                            id_diente_28.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 84
                // diente 83
                    const rectangulo_id_29 = document.getElementById('rectangulo_id_29');
                    rectangulo_id_29.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_29.style.color = color;
                            id_diente_29.innerHTML="X";
                            id_diente_29.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 83
                // diente 82
                    const rectangulo_small_id_30 = document.getElementById('rectangulo_small_id_30');
                    rectangulo_small_id_30.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_30.style.color = color;
                            id_diente_30.innerHTML="X";
                            id_diente_30.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 82
                // diente 81
                    const rectangulo_id_31 = document.getElementById('rectangulo_id_31');
                    rectangulo_id_31.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_31.style.color = color;
                            id_diente_31.innerHTML="X";
                            id_diente_31.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 81
                // diente 71
                    const rectangulo_id_32 = document.getElementById('rectangulo_id_32');
                    rectangulo_id_32.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_32.style.color = color;
                            id_diente_32.innerHTML="X";
                            id_diente_32.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 71
                // diente 72
                    const rectangulo_small_left_id_33 = document.getElementById('rectangulo_small_left_id_33');
                    rectangulo_small_left_id_33.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_33.style.color = color;
                            id_diente_33.innerHTML="X";
                            id_diente_33.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 72
                // diente 73
                    const rectangulo_id_34 = document.getElementById('rectangulo_id_34');
                    rectangulo_id_34.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_34.style.color = color;
                            id_diente_34.innerHTML="X";
                            id_diente_34.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 73
                // diente 74
                    const rectangulo_izq_id_35 = document.getElementById('rectangulo_izq_id_35');
                    rectangulo_izq_id_35.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_35.style.color = color;
                            id_diente_35.innerHTML="X";
                            id_diente_35.style.marginBottom  = '0px';
                        
                    });
                    const rectangulo_der_id_35 = document.getElementById('rectangulo_der_id_35');
                    rectangulo_der_id_35.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_35.style.color = color;
                            id_diente_35.innerHTML="X";
                            id_diente_35.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 74
                // diente 75
                    const rectangulo_izq_id_36 = document.getElementById('rectangulo_izq_id_36');
                    rectangulo_izq_id_36.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_36.style.color = color;
                            id_diente_36.innerHTML="X";
                            id_diente_36.style.marginBottom  = '0px';
                        
                    });
                    const rectangulo_der_id_36 = document.getElementById('rectangulo_der_id_36');
                    rectangulo_der_id_36.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            id_diente_36.style.color = color;
                            id_diente_36.innerHTML="X";
                            id_diente_36.style.marginBottom  = '0px';
                        
                    });
                // Fin de diente 75
            }else{

                // diente 18
                    const trapecio_left_id_1 = document.getElementById('trapecio_left_id_1');
                    trapecio_left_id_1.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_left_id_1.classList.add('validartrapecio-left');
                            trapecio_left_id_1.classList.add('validartrapecio-left');
                            trapecio_left_id_1.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_right_id_1 = document.getElementById('trapecio_right_id_1');
                    trapecio_right_id_1.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_right_id_1.classList.add('validartrapecio-right');
                            trapecio_right_id_1.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_top_id_1 = document.getElementById('trapecio_top_id_1');
                    trapecio_top_id_1.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_top_id_1.classList.add('validartrapecio-top');
                            trapecio_top_id_1.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_bottom_id_1 = document.getElementById('trapecio_bottom_id_1');
                    trapecio_bottom_id_1.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_bottom_id_1.classList.add('validartrapecio-bottom');
                            trapecio_bottom_id_1.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 18
    
                // diente 17
                    const trapecio_left_id_2 = document.getElementById('trapecio_left_id_2');
                    trapecio_left_id_2.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_left_id_2.classList.add('validartrapecio-left');
                            trapecio_left_id_2.classList.add('validartrapecio-left');
                            trapecio_left_id_2.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_right_id_2 = document.getElementById('trapecio_right_id_2');
                    trapecio_right_id_2.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_right_id_2.classList.add('validartrapecio-right');
                            trapecio_right_id_2.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_top_id_2 = document.getElementById('trapecio_top_id_2');
                    trapecio_top_id_2.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_top_id_2.classList.add('validartrapecio-top');
                            trapecio_top_id_2.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_bottom_id_2 = document.getElementById('trapecio_bottom_id_2');
                    trapecio_bottom_id_2.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_bottom_id_2.classList.add('validartrapecio-bottom');
                            trapecio_bottom_id_2.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 17
    
                // diente 16
                    const trapecio_left_id_3 = document.getElementById('trapecio_left_id_3');
                    trapecio_left_id_3.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_left_id_3.classList.add('validartrapecio-left');
                            trapecio_left_id_3.classList.add('validartrapecio-left');
                            trapecio_left_id_3.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_left_id_3').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_right_id_3 = document.getElementById('trapecio_right_id_3');
                    trapecio_right_id_3.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_right_id_3.classList.add('validartrapecio-right');
                            trapecio_right_id_3.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_top_id_3 = document.getElementById('trapecio_top_id_3');
                    trapecio_top_id_3.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_top_id_3.classList.add('validartrapecio-top');
                            trapecio_top_id_3.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_bottom_id_3 = document.getElementById('trapecio_bottom_id_3');
                    trapecio_bottom_id_3.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_bottom_id_3.classList.add('validartrapecio-bottom');
                            trapecio_bottom_id_3.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 16
    
                // diente 15
                    const trapecio_cuadrado_left_id_4 = document.getElementById('trapecio_cuadrado_left_id_4');
                    trapecio_cuadrado_left_id_4.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_cuadrado_left_id_4.classList.add('validartrapecio-left');
                            trapecio_cuadrado_left_id_4.classList.add('validartrapecio-left');
                            trapecio_cuadrado_left_id_4.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_cuadrado_left_id_4').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_cuadrado_right_id_4 = document.getElementById('trapecio_cuadrado_right_id_4');
                    trapecio_cuadrado_right_id_4.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_cuadrado_right_id_4.classList.add('validartrapecio-right');
                            trapecio_cuadrado_right_id_4.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_cuadrado_top_id_4 = document.getElementById('trapecio_cuadrado_top_id_4');
                    trapecio_cuadrado_top_id_4.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_cuadrado_top_id_4.classList.add('validartrapecio-top');
                            trapecio_cuadrado_top_id_4.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_cuadrado_bottom_id_4 = document.getElementById('trapecio_cuadrado_bottom_id_4');
                    trapecio_cuadrado_bottom_id_4.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_cuadrado_bottom_id_4.classList.add('validartrapecio-bottom');
                            trapecio_cuadrado_bottom_id_4.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 15
    
                // diente 14
                    const trapecio_cuadrado_left_id_5 = document.getElementById('trapecio_cuadrado_left_id_5');
                    trapecio_cuadrado_left_id_5.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_cuadrado_left_id_5.classList.add('validartrapecio-left');
                            trapecio_cuadrado_left_id_5.classList.add('validartrapecio-left');
                            trapecio_cuadrado_left_id_5.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_cuadrado_left_id_5').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_cuadrado_right_id_5 = document.getElementById('trapecio_cuadrado_right_id_5');
                    trapecio_cuadrado_right_id_5.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_cuadrado_right_id_5.classList.add('validartrapecio-right');
                            trapecio_cuadrado_right_id_5.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_cuadrado_top_id_5 = document.getElementById('trapecio_cuadrado_top_id_5');
                    trapecio_cuadrado_top_id_5.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_cuadrado_top_id_5.classList.add('validartrapecio-top');
                            trapecio_cuadrado_top_id_5.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_cuadrado_bottom_id_5 = document.getElementById('trapecio_cuadrado_bottom_id_5');
                    trapecio_cuadrado_bottom_id_5.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_cuadrado_bottom_id_5.classList.add('validartrapecio-bottom');
                            trapecio_cuadrado_bottom_id_5.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 14
    
                // diente 13
                    const trapecio_rectangulo_left_id_6 = document.getElementById('trapecio_rectangulo_left_id_6');
                    trapecio_rectangulo_left_id_6.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_rectangulo_left_id_6.classList.add('validartrapecio-left');
                            trapecio_rectangulo_left_id_6.classList.add('validartrapecio-left');
                            trapecio_rectangulo_left_id_6.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_rectangulo_left_id_6').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_right_id_6 = document.getElementById('trapecio_rectangulo_right_id_6');
                    trapecio_rectangulo_right_id_6.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_right_id_6.classList.add('validartrapecio-right');
                            trapecio_rectangulo_right_id_6.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_top_id_6 = document.getElementById('trapecio_rectangulo_top_id_6');
                    trapecio_rectangulo_top_id_6.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_top_id_6.classList.add('validartrapecio-top');
                            trapecio_rectangulo_top_id_6.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_bottom_id_6 = document.getElementById('trapecio_rectangulo_bottom_id_6');
                    trapecio_rectangulo_bottom_id_6.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_bottom_id_6.classList.add('validartrapecio-bottom');
                            trapecio_rectangulo_bottom_id_6.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 13
    
                // diente 12
                    const trapecio_rectangulo_small_left_id_7 = document.getElementById('trapecio_rectangulo_small_left_id_7');
                    trapecio_rectangulo_small_left_id_7.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_rectangulo_small_left_id_7.classList.add('validartrapecio-left');
                            trapecio_rectangulo_small_left_id_7.classList.add('validartrapecio-left');
                            trapecio_rectangulo_small_left_id_7.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_rectangulo_small_left_id_7').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_small_right_id_7 = document.getElementById('trapecio_rectangulo_small_right_id_7');
                    trapecio_rectangulo_small_right_id_7.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_small_right_id_7.classList.add('validartrapecio-right');
                            trapecio_rectangulo_small_right_id_7.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_small_top_id_7 = document.getElementById('trapecio_rectangulo_small_top_id_7');
                    trapecio_rectangulo_small_top_id_7.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_small_top_id_7.classList.add('validartrapecio-top');
                            trapecio_rectangulo_small_top_id_7.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_small_bottom_id_7 = document.getElementById('trapecio_rectangulo_small_bottom_id_7');
                    trapecio_rectangulo_small_bottom_id_7.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_small_bottom_id_7.classList.add('validartrapecio-bottom');
                            trapecio_rectangulo_small_bottom_id_7.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 12
    
                // diente 11
                    const trapecio_rectangulo_left_id_8 = document.getElementById('trapecio_rectangulo_left_id_8');
                    trapecio_rectangulo_left_id_8.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_rectangulo_left_id_8.classList.add('validartrapecio-left');
                            trapecio_rectangulo_left_id_8.classList.add('validartrapecio-left');
                            trapecio_rectangulo_left_id_8.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_rectangulo_left_id_8').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_right_id_8 = document.getElementById('trapecio_rectangulo_right_id_8');
                    trapecio_rectangulo_right_id_8.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_right_id_8.classList.add('validartrapecio-right');
                            trapecio_rectangulo_right_id_8.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_top_id_8 = document.getElementById('trapecio_rectangulo_top_id_8');
                    trapecio_rectangulo_top_id_8.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_top_id_8.classList.add('validartrapecio-top');
                            trapecio_rectangulo_top_id_8.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_bottom_id_8 = document.getElementById('trapecio_rectangulo_bottom_id_8');
                    trapecio_rectangulo_bottom_id_8.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_bottom_id_8.classList.add('validartrapecio-bottom');
                            trapecio_rectangulo_bottom_id_8.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 11
    
                // diente 10
                    const trapecio_rectangulo_left_id_9 = document.getElementById('trapecio_rectangulo_left_id_9');
                    trapecio_rectangulo_left_id_9.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_rectangulo_left_id_9.classList.add('validartrapecio-left');
                            trapecio_rectangulo_left_id_9.classList.add('validartrapecio-left');
                            trapecio_rectangulo_left_id_9.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_rectangulo_left_id_9').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_right_id_9 = document.getElementById('trapecio_rectangulo_right_id_9');
                    trapecio_rectangulo_right_id_9.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_right_id_9.classList.add('validartrapecio-right');
                            trapecio_rectangulo_right_id_9.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_top_id_9 = document.getElementById('trapecio_rectangulo_top_id_9');
                    trapecio_rectangulo_top_id_9.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_top_id_9.classList.add('validartrapecio-top');
                            trapecio_rectangulo_top_id_9.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_bottom_id_9 = document.getElementById('trapecio_rectangulo_bottom_id_9');
                    trapecio_rectangulo_bottom_id_9.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_bottom_id_9.classList.add('validartrapecio-bottom');
                            trapecio_rectangulo_bottom_id_9.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 10
    
                // diente 11
                    const trapecio_rectangulo_small_left_id_10 = document.getElementById('trapecio_rectangulo_small_left_id_10');
                    trapecio_rectangulo_small_left_id_10.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_rectangulo_small_left_id_10.classList.add('validartrapecio-left');
                            trapecio_rectangulo_small_left_id_10.classList.add('validartrapecio-left');
                            trapecio_rectangulo_small_left_id_10.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_rectangulo_small_left_id_10').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_small_right_id_10 = document.getElementById('trapecio_rectangulo_small_right_id_10');
                    trapecio_rectangulo_small_right_id_10.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_small_right_id_10.classList.add('validartrapecio-right');
                            trapecio_rectangulo_small_right_id_10.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_small_top_id_10 = document.getElementById('trapecio_rectangulo_small_top_id_10');
                    trapecio_rectangulo_small_top_id_10.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_small_top_id_10.classList.add('validartrapecio-top');
                            trapecio_rectangulo_small_top_id_10.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_small_bottom_id_10 = document.getElementById('trapecio_rectangulo_small_bottom_id_10');
                    trapecio_rectangulo_small_bottom_id_10.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_small_bottom_id_10.classList.add('validartrapecio-bottom');
                            trapecio_rectangulo_small_bottom_id_10.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 11
    
                // diente 12
                    const trapecio_rectangulo_left_id_11 = document.getElementById('trapecio_rectangulo_left_id_11');
                    trapecio_rectangulo_left_id_11.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_rectangulo_left_id_11.classList.add('validartrapecio-left');
                            trapecio_rectangulo_left_id_11.classList.add('validartrapecio-left');
                            trapecio_rectangulo_left_id_11.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_rectangulo_left_id_11').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_right_id_11 = document.getElementById('trapecio_rectangulo_right_id_11');
                    trapecio_rectangulo_right_id_11.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_right_id_11.classList.add('validartrapecio-right');
                            trapecio_rectangulo_right_id_11.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_top_id_11 = document.getElementById('trapecio_rectangulo_top_id_11');
                    trapecio_rectangulo_top_id_11.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_top_id_11.classList.add('validartrapecio-top');
                            trapecio_rectangulo_top_id_11.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_bottom_id_11 = document.getElementById('trapecio_rectangulo_bottom_id_11');
                    trapecio_rectangulo_bottom_id_11.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_bottom_id_11.classList.add('validartrapecio-bottom');
                            trapecio_rectangulo_bottom_id_11.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 12
    
                // diente 13
                    const trapecio_cuadrado_left_id_12 = document.getElementById('trapecio_cuadrado_left_id_12');
                    trapecio_cuadrado_left_id_12.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_cuadrado_left_id_12.classList.add('validartrapecio-left');
                            trapecio_cuadrado_left_id_12.classList.add('validartrapecio-left');
                            trapecio_cuadrado_left_id_12.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_cuadrado_left_id_12').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_cuadrado_right_id_12 = document.getElementById('trapecio_cuadrado_right_id_12');
                    trapecio_cuadrado_right_id_12.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_cuadrado_right_id_12.classList.add('validartrapecio-right');
                            trapecio_cuadrado_right_id_12.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_cuadrado_top_id_12 = document.getElementById('trapecio_cuadrado_top_id_12');
                    trapecio_cuadrado_top_id_12.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_cuadrado_top_id_12.classList.add('validartrapecio-top');
                            trapecio_cuadrado_top_id_12.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_cuadrado_bottom_id_12 = document.getElementById('trapecio_cuadrado_bottom_id_12');
                    trapecio_cuadrado_bottom_id_12.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_cuadrado_bottom_id_12.classList.add('validartrapecio-bottom');
                            trapecio_cuadrado_bottom_id_12.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 13
    
                // diente 14
                    const trapecio_cuadrado_left_id_13 = document.getElementById('trapecio_cuadrado_left_id_13');
                    trapecio_cuadrado_left_id_13.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_cuadrado_left_id_13.classList.add('validartrapecio-left');
                            trapecio_cuadrado_left_id_13.classList.add('validartrapecio-left');
                            trapecio_cuadrado_left_id_13.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_cuadrado_left_id_13').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_cuadrado_right_id_13 = document.getElementById('trapecio_cuadrado_right_id_13');
                    trapecio_cuadrado_right_id_13.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_cuadrado_right_id_13.classList.add('validartrapecio-right');
                            trapecio_cuadrado_right_id_13.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_cuadrado_top_id_13 = document.getElementById('trapecio_cuadrado_top_id_13');
                    trapecio_cuadrado_top_id_13.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_cuadrado_top_id_13.classList.add('validartrapecio-top');
                            trapecio_cuadrado_top_id_13.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_cuadrado_bottom_id_13 = document.getElementById('trapecio_cuadrado_bottom_id_13');
                    trapecio_cuadrado_bottom_id_13.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_cuadrado_bottom_id_13.classList.add('validartrapecio-bottom');
                            trapecio_cuadrado_bottom_id_13.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 14
    
                // diente 15
                    const trapecio_left_id_14 = document.getElementById('trapecio_left_id_14');
                    trapecio_left_id_14.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_left_id_14.classList.add('validartrapecio-left');
                            trapecio_left_id_14.classList.add('validartrapecio-left');
                            trapecio_left_id_14.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_left_id_14').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_right_id_14 = document.getElementById('trapecio_right_id_14');
                    trapecio_right_id_14.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_right_id_14.classList.add('validartrapecio-right');
                            trapecio_right_id_14.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_top_id_14 = document.getElementById('trapecio_top_id_14');
                    trapecio_top_id_14.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_top_id_14.classList.add('validartrapecio-top');
                            trapecio_top_id_14.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_bottom_id_14 = document.getElementById('trapecio_bottom_id_14');
                    trapecio_bottom_id_14.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_bottom_id_14.classList.add('validartrapecio-bottom');
                            trapecio_bottom_id_14.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 15
    
                // diente 16
                    const trapecio_left_id_15 = document.getElementById('trapecio_left_id_15');
                    trapecio_left_id_15.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_left_id_15.classList.add('validartrapecio-left');
                            trapecio_left_id_15.classList.add('validartrapecio-left');
                            trapecio_left_id_15.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_left_id_15').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_right_id_15 = document.getElementById('trapecio_right_id_15');
                    trapecio_right_id_15.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_right_id_15.classList.add('validartrapecio-right');
                            trapecio_right_id_15.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_top_id_15 = document.getElementById('trapecio_top_id_15');
                    trapecio_top_id_15.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_top_id_15.classList.add('validartrapecio-top');
                            trapecio_top_id_15.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_bottom_id_15 = document.getElementById('trapecio_bottom_id_15');
                    trapecio_bottom_id_15.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_bottom_id_15.classList.add('validartrapecio-bottom');
                            trapecio_bottom_id_15.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 16
    
                // diente 17
                    const trapecio_left_id_16 = document.getElementById('trapecio_left_id_16');
                    trapecio_left_id_16.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_left_id_16.classList.add('validartrapecio-left');
                            trapecio_left_id_16.classList.add('validartrapecio-left');
                            trapecio_left_id_16.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_left_id_16').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_right_id_16 = document.getElementById('trapecio_right_id_16');
                    trapecio_right_id_16.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_right_id_16.classList.add('validartrapecio-right');
                            trapecio_right_id_16.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_top_id_16 = document.getElementById('trapecio_top_id_16');
                    trapecio_top_id_16.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_top_id_16.classList.add('validartrapecio-top');
                            trapecio_top_id_16.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_bottom_id_16 = document.getElementById('trapecio_bottom_id_16');
                    trapecio_bottom_id_16.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_bottom_id_16.classList.add('validartrapecio-bottom');
                            trapecio_bottom_id_16.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 17
    
                // diente 18
                    const trapecio_left_id_17 = document.getElementById('trapecio_left_id_17');
                    trapecio_left_id_17.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_left_id_17.classList.add('validartrapecio-left');
                            trapecio_left_id_17.classList.add('validartrapecio-left');
                            trapecio_left_id_17.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_left_id_17').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_right_id_17 = document.getElementById('trapecio_right_id_17');
                    trapecio_right_id_17.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_right_id_17.classList.add('validartrapecio-right');
                            trapecio_right_id_17.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_top_id_17 = document.getElementById('trapecio_top_id_17');
                    trapecio_top_id_17.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_top_id_17.classList.add('validartrapecio-top');
                            trapecio_top_id_17.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_bottom_id_17 = document.getElementById('trapecio_bottom_id_17');
                    trapecio_bottom_id_17.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_bottom_id_17.classList.add('validartrapecio-bottom');
                            trapecio_bottom_id_17.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 18
    
                // diente 19
                    const trapecio_left_id_18 = document.getElementById('trapecio_left_id_18');
                    trapecio_left_id_18.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_left_id_18.classList.add('validartrapecio-left');
                            trapecio_left_id_18.classList.add('validartrapecio-left');
                            trapecio_left_id_18.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_left_id_18').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_right_id_18 = document.getElementById('trapecio_right_id_18');
                    trapecio_right_id_18.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_right_id_18.classList.add('validartrapecio-right');
                            trapecio_right_id_18.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_top_id_18 = document.getElementById('trapecio_top_id_18');
                    trapecio_top_id_18.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_top_id_18.classList.add('validartrapecio-top');
                            trapecio_top_id_18.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_bottom_id_18 = document.getElementById('trapecio_bottom_id_18');
                    trapecio_bottom_id_18.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_bottom_id_18.classList.add('validartrapecio-bottom');
                            trapecio_bottom_id_18.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 19
    
                // diente 20
                    const trapecio_rectangulo_left_id_19 = document.getElementById('trapecio_rectangulo_left_id_19');
                    trapecio_rectangulo_left_id_19.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_rectangulo_left_id_19.classList.add('validartrapecio-left');
                            trapecio_rectangulo_left_id_19.classList.add('validartrapecio-left');
                            trapecio_rectangulo_left_id_19.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_rectangulo_left_id_19').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_right_id_19 = document.getElementById('trapecio_rectangulo_right_id_19');
                    trapecio_rectangulo_right_id_19.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_right_id_19.classList.add('validartrapecio-right');
                            trapecio_rectangulo_right_id_19.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_top_id_19 = document.getElementById('trapecio_rectangulo_top_id_19');
                    trapecio_rectangulo_top_id_19.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_top_id_19.classList.add('validartrapecio-top');
                            trapecio_rectangulo_top_id_19.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_bottom_id_19 = document.getElementById('trapecio_rectangulo_bottom_id_19');
                    trapecio_rectangulo_bottom_id_19.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_bottom_id_19.classList.add('validartrapecio-bottom');
                            trapecio_rectangulo_bottom_id_19.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 20
    
                // diente 21
                    const trapecio_rectangulo_small_left_id_20 = document.getElementById('trapecio_rectangulo_small_left_id_20');
                    trapecio_rectangulo_small_left_id_20.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_rectangulo_small_left_id_20.classList.add('validartrapecio-left');
                            trapecio_rectangulo_small_left_id_20.classList.add('validartrapecio-left');
                            trapecio_rectangulo_small_left_id_20.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_rectangulo_small_left_id_20').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_small_right_id_20 = document.getElementById('trapecio_rectangulo_small_right_id_20');
                    trapecio_rectangulo_small_right_id_20.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_small_right_id_20.classList.add('validartrapecio-right');
                            trapecio_rectangulo_small_right_id_20.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_small_top_id_20 = document.getElementById('trapecio_rectangulo_small_top_id_20');
                    trapecio_rectangulo_small_top_id_20.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_small_top_id_20.classList.add('validartrapecio-top');
                            trapecio_rectangulo_small_top_id_20.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_small_bottom_id_20 = document.getElementById('trapecio_rectangulo_small_bottom_id_20');
                    trapecio_rectangulo_small_bottom_id_20.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_small_bottom_id_20.classList.add('validartrapecio-bottom');
                            trapecio_rectangulo_small_bottom_id_20.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 21
    
                // diente 22
                    const trapecio_rectangulo_left_id_21 = document.getElementById('trapecio_rectangulo_left_id_21');
                    trapecio_rectangulo_left_id_21.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_rectangulo_left_id_21.classList.add('validartrapecio-left');
                            trapecio_rectangulo_left_id_21.classList.add('validartrapecio-left');
                            trapecio_rectangulo_left_id_21.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_rectangulo_left_id_21').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_right_id_21 = document.getElementById('trapecio_rectangulo_right_id_21');
                    trapecio_rectangulo_right_id_21.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_right_id_21.classList.add('validartrapecio-right');
                            trapecio_rectangulo_right_id_21.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_top_id_21 = document.getElementById('trapecio_rectangulo_top_id_21');
                    trapecio_rectangulo_top_id_21.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_top_id_21.classList.add('validartrapecio-top');
                            trapecio_rectangulo_top_id_21.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_bottom_id_21 = document.getElementById('trapecio_rectangulo_bottom_id_21');
                    trapecio_rectangulo_bottom_id_21.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_bottom_id_21.classList.add('validartrapecio-bottom');
                            trapecio_rectangulo_bottom_id_21.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 22
    
                // diente 23
                    const trapecio_rectangulo_left_id_22 = document.getElementById('trapecio_rectangulo_left_id_22');
                    trapecio_rectangulo_left_id_22.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_rectangulo_left_id_22.classList.add('validartrapecio-left');
                            trapecio_rectangulo_left_id_22.classList.add('validartrapecio-left');
                            trapecio_rectangulo_left_id_22.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_rectangulo_left_id_22').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_right_id_22 = document.getElementById('trapecio_rectangulo_right_id_22');
                    trapecio_rectangulo_right_id_22.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_right_id_22.classList.add('validartrapecio-right');
                            trapecio_rectangulo_right_id_22.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_top_id_22 = document.getElementById('trapecio_rectangulo_top_id_22');
                    trapecio_rectangulo_top_id_22.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_top_id_22.classList.add('validartrapecio-top');
                            trapecio_rectangulo_top_id_22.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_bottom_id_22 = document.getElementById('trapecio_rectangulo_bottom_id_22');
                    trapecio_rectangulo_bottom_id_22.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_bottom_id_22.classList.add('validartrapecio-bottom');
                            trapecio_rectangulo_bottom_id_22.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 23
    
                // diente 24
                    const trapecio_rectangulo_small_left_id_23 = document.getElementById('trapecio_rectangulo_small_left_id_23');
                    trapecio_rectangulo_small_left_id_23.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_rectangulo_small_left_id_23.classList.add('validartrapecio-left');
                            trapecio_rectangulo_small_left_id_23.classList.add('validartrapecio-left');
                            trapecio_rectangulo_small_left_id_23.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_rectangulo_small_left_id_23').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_small_right_id_23 = document.getElementById('trapecio_rectangulo_small_right_id_23');
                    trapecio_rectangulo_small_right_id_23.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_small_right_id_23.classList.add('validartrapecio-right');
                            trapecio_rectangulo_small_right_id_23.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_small_top_id_23 = document.getElementById('trapecio_rectangulo_small_top_id_23');
                    trapecio_rectangulo_small_top_id_23.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_small_top_id_23.classList.add('validartrapecio-top');
                            trapecio_rectangulo_small_top_id_23.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_small_bottom_id_23 = document.getElementById('trapecio_rectangulo_small_bottom_id_23');
                    trapecio_rectangulo_small_bottom_id_23.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_small_bottom_id_23.classList.add('validartrapecio-bottom');
                            trapecio_rectangulo_small_bottom_id_23.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 24
    
                // diente 25
                    const trapecio_rectangulo_left_id_24 = document.getElementById('trapecio_rectangulo_left_id_24');
                    trapecio_rectangulo_left_id_24.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_rectangulo_left_id_24.classList.add('validartrapecio-left');
                            trapecio_rectangulo_left_id_24.classList.add('validartrapecio-left');
                            trapecio_rectangulo_left_id_24.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_rectangulo_left_id_24').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_right_id_24 = document.getElementById('trapecio_rectangulo_right_id_24');
                    trapecio_rectangulo_right_id_24.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_right_id_24.classList.add('validartrapecio-right');
                            trapecio_rectangulo_right_id_24.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_top_id_24 = document.getElementById('trapecio_rectangulo_top_id_24');
                    trapecio_rectangulo_top_id_24.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_top_id_24.classList.add('validartrapecio-top');
                            trapecio_rectangulo_top_id_24.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_bottom_id_24 = document.getElementById('trapecio_rectangulo_bottom_id_24');
                    trapecio_rectangulo_bottom_id_24.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_bottom_id_24.classList.add('validartrapecio-bottom');
                            trapecio_rectangulo_bottom_id_24.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 25
    
                // diente 26
                    const trapecio_left_id_25 = document.getElementById('trapecio_left_id_25');
                    trapecio_left_id_25.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_left_id_25.classList.add('validartrapecio-left');
                            trapecio_left_id_25.classList.add('validartrapecio-left');
                            trapecio_left_id_25.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_left_id_25').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_right_id_25 = document.getElementById('trapecio_right_id_25');
                    trapecio_right_id_25.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_right_id_25.classList.add('validartrapecio-right');
                            trapecio_right_id_25.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_top_id_25 = document.getElementById('trapecio_top_id_25');
                    trapecio_top_id_25.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_top_id_25.classList.add('validartrapecio-top');
                            trapecio_top_id_25.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_bottom_id_25 = document.getElementById('trapecio_bottom_id_25');
                    trapecio_bottom_id_25.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_bottom_id_25.classList.add('validartrapecio-bottom');
                            trapecio_bottom_id_25.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 26
    
                // diente 27
                    const trapecio_left_id_26 = document.getElementById('trapecio_left_id_26');
                    trapecio_left_id_26.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_left_id_26.classList.add('validartrapecio-left');
                            trapecio_left_id_26.classList.add('validartrapecio-left');
                            trapecio_left_id_26.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_left_id_26').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_right_id_26 = document.getElementById('trapecio_right_id_26');
                    trapecio_right_id_26.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_right_id_26.classList.add('validartrapecio-right');
                            trapecio_right_id_26.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_top_id_26 = document.getElementById('trapecio_top_id_26');
                    trapecio_top_id_26.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_top_id_26.classList.add('validartrapecio-top');
                            trapecio_top_id_26.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_bottom_id_26 = document.getElementById('trapecio_bottom_id_26');
                    trapecio_bottom_id_26.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_bottom_id_26.classList.add('validartrapecio-bottom');
                            trapecio_bottom_id_26.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 27
    
                // diente 28
                    const trapecio_left_id_27 = document.getElementById('trapecio_left_id_27');
                    trapecio_left_id_27.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_left_id_27.classList.add('validartrapecio-left');
                            trapecio_left_id_27.classList.add('validartrapecio-left');
                            trapecio_left_id_27.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_left_id_27').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_right_id_27 = document.getElementById('trapecio_right_id_27');
                    trapecio_right_id_27.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_right_id_27.classList.add('validartrapecio-right');
                            trapecio_right_id_27.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_top_id_27 = document.getElementById('trapecio_top_id_27');
                    trapecio_top_id_27.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_top_id_27.classList.add('validartrapecio-top');
                            trapecio_top_id_27.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_bottom_id_27 = document.getElementById('trapecio_bottom_id_27');
                    trapecio_bottom_id_27.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_bottom_id_27.classList.add('validartrapecio-bottom');
                            trapecio_bottom_id_27.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 28
    
                // diente 29
                    const trapecio_left_id_28 = document.getElementById('trapecio_left_id_28');
                    trapecio_left_id_28.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_left_id_28.classList.add('validartrapecio-left');
                            trapecio_left_id_28.classList.add('validartrapecio-left');
                            trapecio_left_id_28.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_left_id_28').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_right_id_28 = document.getElementById('trapecio_right_id_28');
                    trapecio_right_id_28.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_right_id_28.classList.add('validartrapecio-right');
                            trapecio_right_id_28.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_top_id_28 = document.getElementById('trapecio_top_id_28');
                    trapecio_top_id_28.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_top_id_28.classList.add('validartrapecio-top');
                            trapecio_top_id_28.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_bottom_id_28 = document.getElementById('trapecio_bottom_id_28');
                    trapecio_bottom_id_28.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_bottom_id_28.classList.add('validartrapecio-bottom');
                            trapecio_bottom_id_28.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 29
    
                // diente 30
                    const trapecio_rectangulo_left_id_29 = document.getElementById('trapecio_rectangulo_left_id_29');
                    trapecio_rectangulo_left_id_29.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_rectangulo_left_id_29.classList.add('validartrapecio-left');
                            trapecio_rectangulo_left_id_29.classList.add('validartrapecio-left');
                            trapecio_rectangulo_left_id_29.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_rectangulo_left_id_29').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_right_id_29 = document.getElementById('trapecio_rectangulo_right_id_29');
                    trapecio_rectangulo_right_id_29.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_right_id_29.classList.add('validartrapecio-right');
                            trapecio_rectangulo_right_id_29.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_top_id_29 = document.getElementById('trapecio_rectangulo_top_id_29');
                    trapecio_rectangulo_top_id_29.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_top_id_29.classList.add('validartrapecio-top');
                            trapecio_rectangulo_top_id_29.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_bottom_id_29 = document.getElementById('trapecio_rectangulo_bottom_id_29');
                    trapecio_rectangulo_bottom_id_29.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_bottom_id_29.classList.add('validartrapecio-bottom');
                            trapecio_rectangulo_bottom_id_29.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 30
    
                // diente 31
                    const trapecio_rectangulo_left_id_30 = document.getElementById('trapecio_rectangulo_left_id_30');
                    trapecio_rectangulo_left_id_30.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_rectangulo_left_id_30.classList.add('validartrapecio-left');
                            trapecio_rectangulo_left_id_30.classList.add('validartrapecio-left');
                            trapecio_rectangulo_left_id_30.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_rectangulo_left_id_30').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_small_right_id_30 = document.getElementById('trapecio_rectangulo_small_right_id_30');
                    trapecio_rectangulo_small_right_id_30.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_small_right_id_30.classList.add('validartrapecio-right');
                            trapecio_rectangulo_small_right_id_30.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_small_top_id_30 = document.getElementById('trapecio_rectangulo_small_top_id_30');
                    trapecio_rectangulo_small_top_id_30.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_small_top_id_30.classList.add('validartrapecio-top');
                            trapecio_rectangulo_small_top_id_30.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_small_bottom_id_30 = document.getElementById('trapecio_rectangulo_small_bottom_id_30');
                    trapecio_rectangulo_small_bottom_id_30.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_small_bottom_id_30.classList.add('validartrapecio-bottom');
                            trapecio_rectangulo_small_bottom_id_30.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 31
    
                // diente 32
                    const trapecio_rectangulo_left_id_31 = document.getElementById('trapecio_rectangulo_left_id_31');
                    trapecio_rectangulo_left_id_31.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_rectangulo_left_id_31.classList.add('validartrapecio-left');
                            trapecio_rectangulo_left_id_31.classList.add('validartrapecio-left');
                            trapecio_rectangulo_left_id_31.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_rectangulo_left_id_31').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_right_id_31 = document.getElementById('trapecio_rectangulo_right_id_31');
                    trapecio_rectangulo_right_id_31.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_right_id_31.classList.add('validartrapecio-right');
                            trapecio_rectangulo_right_id_31.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_top_id_31 = document.getElementById('trapecio_rectangulo_top_id_31');
                    trapecio_rectangulo_top_id_31.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_top_id_31.classList.add('validartrapecio-top');
                            trapecio_rectangulo_top_id_31.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_bottom_id_31 = document.getElementById('trapecio_rectangulo_bottom_id_31');
                    trapecio_rectangulo_bottom_id_31.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_bottom_id_31.classList.add('validartrapecio-bottom');
                            trapecio_rectangulo_bottom_id_31.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 32
    
                // diente 33
                    const trapecio_rectangulo_left_id_32 = document.getElementById('trapecio_rectangulo_left_id_32');
                    trapecio_rectangulo_left_id_32.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_rectangulo_left_id_32.classList.add('validartrapecio-left');
                            trapecio_rectangulo_left_id_32.classList.add('validartrapecio-left');
                            trapecio_rectangulo_left_id_32.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_rectangulo_left_id_32').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_right_id_32 = document.getElementById('trapecio_rectangulo_right_id_32');
                    trapecio_rectangulo_right_id_32.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_right_id_32.classList.add('validartrapecio-right');
                            trapecio_rectangulo_right_id_32.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_top_id_32 = document.getElementById('trapecio_rectangulo_top_id_32');
                    trapecio_rectangulo_top_id_32.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_top_id_32.classList.add('validartrapecio-top');
                            trapecio_rectangulo_top_id_32.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_bottom_id_32 = document.getElementById('trapecio_rectangulo_bottom_id_32');
                    trapecio_rectangulo_bottom_id_32.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_bottom_id_32.classList.add('validartrapecio-bottom');
                            trapecio_rectangulo_bottom_id_32.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 33
    
                // diente 34
                    const trapecio_rectangulo_small_left_id_33 = document.getElementById('trapecio_rectangulo_small_left_id_33');
                    trapecio_rectangulo_small_left_id_33.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_rectangulo_small_left_id_33.classList.add('validartrapecio-left');
                            trapecio_rectangulo_small_left_id_33.classList.add('validartrapecio-left');
                            trapecio_rectangulo_small_left_id_33.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_rectangulo_small_left_id_33').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_small_right_id_33 = document.getElementById('trapecio_rectangulo_small_right_id_33');
                    trapecio_rectangulo_small_right_id_33.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_small_right_id_33.classList.add('validartrapecio-right');
                            trapecio_rectangulo_small_right_id_33.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_small_top_id_33 = document.getElementById('trapecio_rectangulo_small_top_id_33');
                    trapecio_rectangulo_small_top_id_33.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_small_top_id_33.classList.add('validartrapecio-top');
                            trapecio_rectangulo_small_top_id_33.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_small_bottom_id_33 = document.getElementById('trapecio_rectangulo_small_bottom_id_33');
                    trapecio_rectangulo_small_bottom_id_33.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_small_bottom_id_33.classList.add('validartrapecio-bottom');
                            trapecio_rectangulo_small_bottom_id_33.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 34
    
                // diente 35
                    const trapecio_rectangulo_left_id_34 = document.getElementById('trapecio_rectangulo_left_id_34');
                    trapecio_rectangulo_left_id_34.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_rectangulo_left_id_34.classList.add('validartrapecio-left');
                            trapecio_rectangulo_left_id_34.classList.add('validartrapecio-left');
                            trapecio_rectangulo_left_id_34.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_rectangulo_left_id_34').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_right_id_34 = document.getElementById('trapecio_rectangulo_right_id_34');
                    trapecio_rectangulo_right_id_34.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_right_id_34.classList.add('validartrapecio-right');
                            trapecio_rectangulo_right_id_34.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_top_id_34 = document.getElementById('trapecio_rectangulo_top_id_34');
                    trapecio_rectangulo_top_id_34.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_top_id_34.classList.add('validartrapecio-top');
                            trapecio_rectangulo_top_id_34.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_bottom_id_34 = document.getElementById('trapecio_rectangulo_bottom_id_34');
                    trapecio_rectangulo_bottom_id_34.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_bottom_id_34.classList.add('validartrapecio-bottom');
                            trapecio_rectangulo_bottom_id_34.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 35
    
                // diente 36
                    const trapecio_left_id_35 = document.getElementById('trapecio_left_id_35');
                    trapecio_left_id_35.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_left_id_35.classList.add('validartrapecio-left');
                            trapecio_left_id_35.classList.add('validartrapecio-left');
                            trapecio_left_id_35.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_left_id_35').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_right_id_35 = document.getElementById('trapecio_right_id_35');
                    trapecio_right_id_35.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_right_id_35.classList.add('validartrapecio-right');
                            trapecio_right_id_35.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_top_id_35 = document.getElementById('trapecio_top_id_35');
                    trapecio_top_id_35.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_top_id_35.classList.add('validartrapecio-top');
                            trapecio_top_id_35.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_bottom_id_35 = document.getElementById('trapecio_bottom_id_35');
                    trapecio_bottom_id_35.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_bottom_id_35.classList.add('validartrapecio-bottom');
                            trapecio_bottom_id_35.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 36
    
                // diente 37
                    const trapecio_left_id_36 = document.getElementById('trapecio_left_id_36');
                    trapecio_left_id_36.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_left_id_36.classList.add('validartrapecio-left');
                            trapecio_left_id_36.classList.add('validartrapecio-left');
                            trapecio_left_id_36.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_left_id_36').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_right_id_36 = document.getElementById('trapecio_right_id_36');
                    trapecio_right_id_36.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_right_id_36.classList.add('validartrapecio-right');
                            trapecio_right_id_36.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_top_id_36 = document.getElementById('trapecio_top_id_36');
                    trapecio_top_id_36.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_top_id_36.classList.add('validartrapecio-top');
                            trapecio_top_id_36.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_bottom_id_36 = document.getElementById('trapecio_bottom_id_36');
                    trapecio_bottom_id_36.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_bottom_id_36.classList.add('validartrapecio-bottom');
                            trapecio_bottom_id_36.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 37
    
                // diente 38
                    const trapecio_left_id_37 = document.getElementById('trapecio_left_id_37');
                    trapecio_left_id_37.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_left_id_37.classList.add('validartrapecio-left');
                            trapecio_left_id_37.classList.add('validartrapecio-left');
                            trapecio_left_id_37.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_left_id_37').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_right_id_37 = document.getElementById('trapecio_right_id_37');
                    trapecio_right_id_37.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_right_id_37.classList.add('validartrapecio-right');
                            trapecio_right_id_37.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_top_id_37 = document.getElementById('trapecio_top_id_37');
                    trapecio_top_id_37.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_top_id_37.classList.add('validartrapecio-top');
                            trapecio_top_id_37.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_bottom_id_37 = document.getElementById('trapecio_bottom_id_37');
                    trapecio_bottom_id_37.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_bottom_id_37.classList.add('validartrapecio-bottom');
                            trapecio_bottom_id_37.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 38
    
                // diente 39
                    const trapecio_left_id_38 = document.getElementById('trapecio_left_id_38');
                    trapecio_left_id_38.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_left_id_38.classList.add('validartrapecio-left');
                            trapecio_left_id_38.classList.add('validartrapecio-left');
                            trapecio_left_id_38.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_left_id_38').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_right_id_38 = document.getElementById('trapecio_right_id_38');
                    trapecio_right_id_38.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_right_id_38.classList.add('validartrapecio-right');
                            trapecio_right_id_38.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_top_id_38 = document.getElementById('trapecio_top_id_38');
                    trapecio_top_id_38.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_top_id_38.classList.add('validartrapecio-top');
                            trapecio_top_id_38.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_bottom_id_38 = document.getElementById('trapecio_bottom_id_38');
                    trapecio_bottom_id_38.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_bottom_id_38.classList.add('validartrapecio-bottom');
                            trapecio_bottom_id_38.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 39
    
                // diente 40
                    const trapecio_left_id_39 = document.getElementById('trapecio_left_id_39');
                    trapecio_left_id_39.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_left_id_39.classList.add('validartrapecio-left');
                            trapecio_left_id_39.classList.add('validartrapecio-left');
                            trapecio_left_id_39.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_left_id_39').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_right_id_39 = document.getElementById('trapecio_right_id_39');
                    trapecio_right_id_39.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_right_id_39.classList.add('validartrapecio-right');
                            trapecio_right_id_39.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_top_id_39 = document.getElementById('trapecio_top_id_39');
                    trapecio_top_id_39.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_top_id_39.classList.add('validartrapecio-top');
                            trapecio_top_id_39.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_bottom_id_39 = document.getElementById('trapecio_bottom_id_39');
                    trapecio_bottom_id_39.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_bottom_id_39.classList.add('validartrapecio-bottom');
                            trapecio_bottom_id_39.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 40
    
                // diente 41
                    const trapecio_cuadrado_left_id_40 = document.getElementById('trapecio_cuadrado_left_id_40');
                    trapecio_cuadrado_left_id_40.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_cuadrado_left_id_40.classList.add('validartrapecio-left');
                            trapecio_cuadrado_left_id_40.classList.add('validartrapecio-left');
                            trapecio_cuadrado_left_id_40.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_cuadrado_left_id_40').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_cuadrado_right_id_40 = document.getElementById('trapecio_cuadrado_right_id_40');
                    trapecio_cuadrado_right_id_40.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_cuadrado_right_id_40.classList.add('validartrapecio-right');
                            trapecio_cuadrado_right_id_40.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_cuadrado_top_id_40 = document.getElementById('trapecio_cuadrado_top_id_40');
                    trapecio_cuadrado_top_id_40.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_cuadrado_top_id_40.classList.add('validartrapecio-top');
                            trapecio_cuadrado_top_id_40.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_cuadrado_bottom_id_40 = document.getElementById('trapecio_cuadrado_bottom_id_40');
                    trapecio_cuadrado_bottom_id_40.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_cuadrado_bottom_id_40.classList.add('validartrapecio-bottom');
                            trapecio_cuadrado_bottom_id_40.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 41
    
                // diente 42
                    const trapecio_cuadrado_left_id_41 = document.getElementById('trapecio_cuadrado_left_id_41');
                    trapecio_cuadrado_left_id_41.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_cuadrado_left_id_41.classList.add('validartrapecio-left');
                            trapecio_cuadrado_left_id_41.classList.add('validartrapecio-left');
                            trapecio_cuadrado_left_id_41.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_cuadrado_left_id_41').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_cuadrado_right_id_41 = document.getElementById('trapecio_cuadrado_right_id_41');
                    trapecio_cuadrado_right_id_41.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_cuadrado_right_id_41.classList.add('validartrapecio-right');
                            trapecio_cuadrado_right_id_41.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_cuadrado_top_id_41 = document.getElementById('trapecio_cuadrado_top_id_41');
                    trapecio_cuadrado_top_id_41.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_cuadrado_top_id_41.classList.add('validartrapecio-top');
                            trapecio_cuadrado_top_id_41.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_cuadrado_bottom_id_41 = document.getElementById('trapecio_cuadrado_bottom_id_41');
                    trapecio_cuadrado_bottom_id_41.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_cuadrado_bottom_id_41.classList.add('validartrapecio-bottom');
                            trapecio_cuadrado_bottom_id_41.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 42
    
                // diente 43
                    const trapecio_rectangulo_left_id_42 = document.getElementById('trapecio_rectangulo_left_id_42');
                    trapecio_rectangulo_left_id_42.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_rectangulo_left_id_42.classList.add('validartrapecio-left');
                            trapecio_rectangulo_left_id_42.classList.add('validartrapecio-left');
                            trapecio_rectangulo_left_id_42.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_rectangulo_left_id_42').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_right_id_42 = document.getElementById('trapecio_rectangulo_right_id_42');
                    trapecio_rectangulo_right_id_42.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_right_id_42.classList.add('validartrapecio-right');
                            trapecio_rectangulo_right_id_42.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_top_id_42 = document.getElementById('trapecio_rectangulo_top_id_42');
                    trapecio_rectangulo_top_id_42.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_top_id_42.classList.add('validartrapecio-top');
                            trapecio_rectangulo_top_id_42.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_bottom_id_42 = document.getElementById('trapecio_rectangulo_bottom_id_42');
                    trapecio_rectangulo_bottom_id_42.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_bottom_id_42.classList.add('validartrapecio-bottom');
                            trapecio_rectangulo_bottom_id_42.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 43
    
                // diente 44
                    const trapecio_rectangulo_small_left_id_43 = document.getElementById('trapecio_rectangulo_small_left_id_43');
                    trapecio_rectangulo_small_left_id_43.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_rectangulo_small_left_id_43.classList.add('validartrapecio-left');
                            trapecio_rectangulo_small_left_id_43.classList.add('validartrapecio-left');
                            trapecio_rectangulo_small_left_id_43.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_rectangulo_small_left_id_43').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_small_right_id_43 = document.getElementById('trapecio_rectangulo_small_right_id_43');
                    trapecio_rectangulo_small_right_id_43.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_small_right_id_43.classList.add('validartrapecio-right');
                            trapecio_rectangulo_small_right_id_43.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_small_top_id_43 = document.getElementById('trapecio_rectangulo_small_top_id_43');
                    trapecio_rectangulo_small_top_id_43.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_small_top_id_43.classList.add('validartrapecio-top');
                            trapecio_rectangulo_small_top_id_43.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_small_bottom_id_43 = document.getElementById('trapecio_rectangulo_small_bottom_id_43');
                    trapecio_rectangulo_small_bottom_id_43.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_small_bottom_id_43.classList.add('validartrapecio-bottom');
                            trapecio_rectangulo_small_bottom_id_43.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 44
    
                // diente 45
                    const trapecio_rectangulo_left_id_44 = document.getElementById('trapecio_rectangulo_left_id_44');
                    trapecio_rectangulo_left_id_44.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_rectangulo_left_id_44.classList.add('validartrapecio-left');
                            trapecio_rectangulo_left_id_44.classList.add('validartrapecio-left');
                            trapecio_rectangulo_left_id_44.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_rectangulo_left_id_44').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_right_id_44 = document.getElementById('trapecio_rectangulo_right_id_44');
                    trapecio_rectangulo_right_id_44.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_right_id_44.classList.add('validartrapecio-right');
                            trapecio_rectangulo_right_id_44.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_top_id_44 = document.getElementById('trapecio_rectangulo_top_id_44');
                    trapecio_rectangulo_top_id_44.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_top_id_44.classList.add('validartrapecio-top');
                            trapecio_rectangulo_top_id_44.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_bottom_id_44 = document.getElementById('trapecio_rectangulo_bottom_id_44');
                    trapecio_rectangulo_bottom_id_44.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_bottom_id_44.classList.add('validartrapecio-bottom');
                            trapecio_rectangulo_bottom_id_44.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 45
    
                // diente 46
                    const trapecio_rectangulo_left_id_45 = document.getElementById('trapecio_rectangulo_left_id_45');
                    trapecio_rectangulo_left_id_45.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_rectangulo_left_id_45.classList.add('validartrapecio-left');
                            trapecio_rectangulo_left_id_45.classList.add('validartrapecio-left');
                            trapecio_rectangulo_left_id_45.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_rectangulo_left_id_45').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_right_id_45 = document.getElementById('trapecio_rectangulo_right_id_45');
                    trapecio_rectangulo_right_id_45.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_right_id_45.classList.add('validartrapecio-right');
                            trapecio_rectangulo_right_id_45.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_top_id_45 = document.getElementById('trapecio_rectangulo_top_id_45');
                    trapecio_rectangulo_top_id_45.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_top_id_45.classList.add('validartrapecio-top');
                            trapecio_rectangulo_top_id_45.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_bottom_id_45 = document.getElementById('trapecio_rectangulo_bottom_id_45');
                    trapecio_rectangulo_bottom_id_45.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_bottom_id_45.classList.add('validartrapecio-bottom');
                            trapecio_rectangulo_bottom_id_45.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 46
    
                // diente 47
                    const trapecio_rectangulo_small_left_id_46 = document.getElementById('trapecio_rectangulo_small_left_id_46');
                    trapecio_rectangulo_small_left_id_46.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_rectangulo_small_left_id_46.classList.add('validartrapecio-left');
                            trapecio_rectangulo_small_left_id_46.classList.add('validartrapecio-left');
                            trapecio_rectangulo_small_left_id_46.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_rectangulo_small_left_id_46').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_small_right_id_46 = document.getElementById('trapecio_rectangulo_small_right_id_46');
                    trapecio_rectangulo_small_right_id_46.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_small_right_id_46.classList.add('validartrapecio-right');
                            trapecio_rectangulo_small_right_id_46.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_small_top_id_46 = document.getElementById('trapecio_rectangulo_small_top_id_46');
                    trapecio_rectangulo_small_top_id_46.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_small_top_id_46.classList.add('validartrapecio-top');
                            trapecio_rectangulo_small_top_id_46.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_small_bottom_id_46 = document.getElementById('trapecio_rectangulo_small_bottom_id_46');
                    trapecio_rectangulo_small_bottom_id_46.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_small_bottom_id_46.classList.add('validartrapecio-bottom');
                            trapecio_rectangulo_small_bottom_id_46.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 47
    
                // diente 48
                    const trapecio_rectangulo_left_id_47 = document.getElementById('trapecio_rectangulo_left_id_47');
                    trapecio_rectangulo_left_id_47.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_rectangulo_left_id_47.classList.add('validartrapecio-left');
                            trapecio_rectangulo_left_id_47.classList.add('validartrapecio-left');
                            trapecio_rectangulo_left_id_47.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_rectangulo_left_id_47').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_right_id_47 = document.getElementById('trapecio_rectangulo_right_id_47');
                    trapecio_rectangulo_right_id_47.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_right_id_47.classList.add('validartrapecio-right');
                            trapecio_rectangulo_right_id_47.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_top_id_47 = document.getElementById('trapecio_rectangulo_top_id_47');
                    trapecio_rectangulo_top_id_47.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_top_id_47.classList.add('validartrapecio-top');
                            trapecio_rectangulo_top_id_47.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_rectangulo_bottom_id_47 = document.getElementById('trapecio_rectangulo_bottom_id_47');
                    trapecio_rectangulo_bottom_id_47.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_rectangulo_bottom_id_47.classList.add('validartrapecio-bottom');
                            trapecio_rectangulo_bottom_id_47.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 48
    
                // diente 49
                    const trapecio_cuadrado_left_id_48 = document.getElementById('trapecio_cuadrado_left_id_48');
                    trapecio_cuadrado_left_id_48.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_cuadrado_left_id_48.classList.add('validartrapecio-left');
                            trapecio_cuadrado_left_id_48.classList.add('validartrapecio-left');
                            trapecio_cuadrado_left_id_48.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_cuadrado_left_id_48').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_cuadrado_right_id_48 = document.getElementById('trapecio_cuadrado_right_id_48');
                    trapecio_cuadrado_right_id_48.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_cuadrado_right_id_48.classList.add('validartrapecio-right');
                            trapecio_cuadrado_right_id_48.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_cuadrado_top_id_48 = document.getElementById('trapecio_cuadrado_top_id_48');
                    trapecio_cuadrado_top_id_48.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_cuadrado_top_id_48.classList.add('validartrapecio-top');
                            trapecio_cuadrado_top_id_48.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_cuadrado_bottom_id_48 = document.getElementById('trapecio_cuadrado_bottom_id_48');
                    trapecio_cuadrado_bottom_id_48.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_cuadrado_bottom_id_48.classList.add('validartrapecio-bottom');
                            trapecio_cuadrado_bottom_id_48.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 49
    
                // diente 50
                    const trapecio_cuadrado_left_id_49 = document.getElementById('trapecio_cuadrado_left_id_49');
                    trapecio_cuadrado_left_id_49.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_cuadrado_left_id_49.classList.add('validartrapecio-left');
                            trapecio_cuadrado_left_id_49.classList.add('validartrapecio-left');
                            trapecio_cuadrado_left_id_49.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_cuadrado_left_id_49').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_cuadrado_right_id_49 = document.getElementById('trapecio_cuadrado_right_id_49');
                    trapecio_cuadrado_right_id_49.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_cuadrado_right_id_49.classList.add('validartrapecio-right');
                            trapecio_cuadrado_right_id_49.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_cuadrado_top_id_49 = document.getElementById('trapecio_cuadrado_top_id_49');
                    trapecio_cuadrado_top_id_49.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_cuadrado_top_id_49.classList.add('validartrapecio-top');
                            trapecio_cuadrado_top_id_49.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_cuadrado_bottom_id_49 = document.getElementById('trapecio_cuadrado_bottom_id_49');
                    trapecio_cuadrado_bottom_id_49.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_cuadrado_bottom_id_49.classList.add('validartrapecio-bottom');
                            trapecio_cuadrado_bottom_id_49.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 50
    
                // diente 51
                    const trapecio_left_id_50 = document.getElementById('trapecio_left_id_50');
                    trapecio_left_id_50.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_left_id_50.classList.add('validartrapecio-left');
                            trapecio_left_id_50.classList.add('validartrapecio-left');
                            trapecio_left_id_50.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_left_id_50').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_right_id_50 = document.getElementById('trapecio_right_id_50');
                    trapecio_right_id_50.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_right_id_50.classList.add('validartrapecio-right');
                            trapecio_right_id_50.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_top_id_50 = document.getElementById('trapecio_top_id_50');
                    trapecio_top_id_50.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_top_id_50.classList.add('validartrapecio-top');
                            trapecio_top_id_50.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_bottom_id_50 = document.getElementById('trapecio_bottom_id_50');
                    trapecio_bottom_id_50.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_bottom_id_50.classList.add('validartrapecio-bottom');
                            trapecio_bottom_id_50.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 51
    
                // diente 52
                  const trapecio_left_id_51 = document.getElementById('trapecio_left_id_51');
                    trapecio_left_id_51.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_left_id_51.classList.add('validartrapecio-left');
                            trapecio_left_id_51.classList.add('validartrapecio-left');
                            trapecio_left_id_51.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_left_id_51').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_right_id_51 = document.getElementById('trapecio_right_id_51');
                    trapecio_right_id_51.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_right_id_51.classList.add('validartrapecio-right');
                            trapecio_right_id_51.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_top_id_51 = document.getElementById('trapecio_top_id_51');
                    trapecio_top_id_51.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_top_id_51.classList.add('validartrapecio-top');
                            trapecio_top_id_51.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_bottom_id_51 = document.getElementById('trapecio_bottom_id_51');
                    trapecio_bottom_id_51.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_bottom_id_51.classList.add('validartrapecio-bottom');
                            trapecio_bottom_id_51.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 52
    
                // diente 53
                   const trapecio_left_id_52 = document.getElementById('trapecio_left_id_52');
                    trapecio_left_id_52.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            // trapecio_left_id_52.classList.add('validartrapecio-left');
                            trapecio_left_id_52.classList.add('validartrapecio-left');
                            trapecio_left_id_52.style.borderLeft   = '10px solid ' + color;
                            // $('#trapecio_left_id_52').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_right_id_52 = document.getElementById('trapecio_right_id_52');
                    trapecio_right_id_52.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_right_id_52.classList.add('validartrapecio-right');
                            trapecio_right_id_52.style.borderRight   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_top_id_52 = document.getElementById('trapecio_top_id_52');
                    trapecio_top_id_52.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_top_id_52.classList.add('validartrapecio-top');
                            trapecio_top_id_52.style.borderTop   = '10px solid ' + color;
                            // $('#trapecio_left_id_2').css('color', '#FF2800');
                        
                    });
    
                    const trapecio_bottom_id_52 = document.getElementById('trapecio_bottom_id_52');
                    trapecio_bottom_id_52.addEventListener('click', function() {
                        // 3. Definir la acción a realizar al hacer clic
                            trapecio_bottom_id_52.classList.add('validartrapecio-bottom');
                            trapecio_bottom_id_52.style.borderBottom   = '10px solid ' + color;
                            // $('#trapecio_left_id_1').css('color', '#FF2800');
                        
                    });
                // Fin de diente 53
            }
        }
        $('#btn_pextraer').on('click', function(){
            $('#value_procedimientos').val('PEX');
            color_rojo = '#e70b0bff';
            colorear_diente(color_rojo,'PEX')
        });
        $('#btn_protesis').on('click', function(){
            $('#value_procedimientos').val('PRO');
        });
        $('#btn_perdida').on('click', function(){
            $('#value_procedimientos').val('PER');
        });
        $('#btn_obturada').on('click', function(){
            $('#value_procedimientos').val('OBT');
            color_azul = '#3EA7E6';
            colorear_diente(color_azul,'OBT')
        });
        $('#btn_cariada').on('click', function(){
            $('#value_procedimientos').val('CAR');
            color_rojo = '#e70b0bff';
            colorear_diente(color_rojo,'CAR')
        });
        $('#btn_borrar').on('click', function(){
            $('#value_procedimientos').val('BOR');
        });
    </script>
@endsection