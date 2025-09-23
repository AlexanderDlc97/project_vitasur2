<div class="card border-0">
    <div class="card-body">
        @php
            $consulta = \App\Models\Consulta::where('atencion_id', $admin_atencione->id)->first();
        @endphp
        @if($admin_atencione->paciente->persona->sexo == "Mujer")                                  
            <div class="row mb-3">
                <div class="col-12 col-lg-2 d-flex">
                    <div class="clearfix align-self-center w-100">
                        <span class="float-start fw-bold text-uppercase small">¿Gestando?</span>
                        <span class="float-end fw-bold text-uppercase small">:</span>
                    </div>
                </div>
                <div class="col-12 col-lg-2">
                    <input class="form-control form-control-sm bg-transparent" disabled value="{{ $consulta?$consulta->gestando:''}}">
                </div>
            </div>
        @endif
        <div class="col-12 col-md-12 col-lg-12">
            <div class="pb-2">
                <label for="antecedentes_patologico" class="fw-bold text-uppercase small text-secondary mb-1" style="font-size: 14px">ANTECEDENTES PATOLOGICOS</label>
                <div class="row g-2 mb-3">
                    @if($admin_atencione->especialidad->id == '1')
                        
                        <div class="col-12 col-md-4 col-lg-4">
                            <select class="form-select form-select-sm select2_bootstrap_2 bg-transparent" disabled multiple data-placeholder="Seleccione una opcion">
                                <option disabled >Seleccion opcion</option>
                                @php
                                    if($consulta){
                                        $cargar_consulta_select = DB::table('antecedentes_patologicos as antpat')->join('antecedentepatologico_consulta as apatocon','apatocon.antecedentepatologico_id','=','antpat.id')->select('apatocon.id','antpat.id as id_antecedente','antpat.name')->where('apatocon.consulta_id',$consulta->id)->get();
                                    }else{
                                        $cargar_consulta_select = '';
                                    }
                                @endphp
                                @if($cargar_consulta_select)
                                    @foreach($cargar_consulta_select as $cargar_consulta_selects)
                                        <option selected value="{{$cargar_consulta_selects->id_antecedente}}">{{$cargar_consulta_selects->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    @else
                    @endif
                    <div class="col-12 col-md-8 col-lg-8">
                        <textarea rows="3" class="form-control form-control-sm bg-transparent" disabled>{{$consulta?$consulta->otros:''}}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-12 mb-3">
            <div class="pb-2">
                <div class="row">
                    @if($admin_atencione->especialidad->id == '1')
                    <div class="col-6 col-md-6 col-lg-6 mb-3">
                        <label for="antecedentes_id" class="fw-bold text-uppercase small text-secondary mb-1" style="font-size: 14px">ANTECEDENTES FAMILIARES</label>
                        <textarea name="antecedentes" id="antecedentes_id" placeholder="" rows="3" class="form-control">{{$consulta?$consulta->antecedentes:''}}</textarea>
                    </div>
                    <div class="col-6 col-md-6 col-lg-6 mb-3">
                        <label for="habitos_nocivos_id" class="fw-bold text-uppercase small text-secondary mb-1" style="font-size: 14px">HABITOS NOCIVOS</label>
                        <select class="form-select form-select-sm select2_bootstrap_2 bg-transparent" disabled multiple data-placeholder="Seleccione una opcion">
                            <option  disabled>Seleccion opcion</option>
                            @php
                                if($consulta){
                                    $cargar_habnoc_select = DB::table('habitos_nocivos as habnoc')->join('consulta_habitonocivo as habicons','habicons.habitonocivo_id','=','habnoc.id')->select('habicons.id','habnoc.id as id_habito','habnoc.name')->where('habicons.consulta_id',$consulta->id)->get();
                                }else{
                                    $cargar_habnoc_select = '';
                                }
                            @endphp
                            @if($cargar_habnoc_select)
                                @foreach ($cargar_habnoc_select as $cargar_habnoc_selects)
                                    <option selected value="{{$cargar_habnoc_selects->id_habito}}">{{$cargar_habnoc_selects->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="mb-3">
            <p class="fw-bold text-uppercase small text-secondary mb-1" style="font-size: 14px">Anamnesis</p>
            <div class="form-control" style="min-height: 100px">{{ $consulta?$consulta->anamnesis:'' }}</div>
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
                    <input class="form-control bg-transparent" disabled value="{{ $consulta?$consulta->presion_arterial_uno:'' }}">
                    <span class="input-group-text">/</span>
                    <input class="form-control bg-transparent" disabled value="{{ $consulta?$consulta->presion_arterial_dos:'' }}">
                </div>
            </div>
            <div class="col-12 col-lg-2 d-flex">
                <div class="clearfix align-self-center w-100">
                    <span class="float-start fw-bold small text-muted" style="font-size: 13px">Frecuencia Cardiaca (Latidos x Min)</span>
                    <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                </div>
            </div>
            <div class="col-12 col-lg-1">
                <input class="form-control form-control-sm bg-transparent" disabled value="{{ $consulta?$consulta->frecuencia_cardiaca:'' }}">
            </div>
            <div class="col-12 col-lg-1"></div>
            <div class="col-12 col-lg-2 d-flex">
                <div class="clearfix align-self-center w-100">
                    <span class="float-start fw-bold small text-muted" style="font-size: 13px">Temperatura Corporal (°C)</span>
                    <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                </div>
            </div>
            <div class="col-12 col-lg-1">
                <input class="form-control form-control-sm bg-transparent" disabled value="{{ $consulta?$consulta->temperatura_corporal:'' }}">
            </div>
            <div class="col-12 col-lg-1"></div>

            <div class="col-12 col-lg-2 d-flex">
                <div class="clearfix align-self-center w-100">
                    <span class="float-start fw-bold small text-muted" style="font-size: 13px">Presión Venosa Central (cm H20)</span>
                    <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                </div>
            </div>
            <div class="col-12 col-lg-1">
                <input class="form-control form-control-sm bg-transparent" disabled value="{{ $consulta?$consulta->presion_venosa_central:'' }}">
            </div>
            <div class="col-12 col-lg-1"></div>
            <div class="col-12 col-lg-2 d-flex">
                <div class="clearfix align-self-center w-100">
                    <span class="float-start fw-bold small text-muted" style="font-size: 13px">Frecuencia Respiratoria x Min</span>
                    <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                </div>
            </div>
            <div class="col-12 col-lg-1">
                <input class="form-control form-control-sm bg-transparent" disabled value="{{ $consulta?$consulta->Frecuencia_respiratoria:'' }}">
            </div>
            <div class="col-12 col-lg-1"></div>
            <div class="col-12 col-lg-2 d-flex">
                <div class="clearfix align-self-center w-100">
                    <span class="float-start fw-bold small text-muted" style="font-size: 13px">Sat. O2</span>
                    <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                </div>
            </div>
            <div class="col-12 col-lg-1">
                <input class="form-control form-control-sm bg-transparent" disabled value="{{ $consulta?$consulta->sat_o2:'' }}">
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
                <input class="form-control form-control-sm bg-transparent" disabled value="{{ $consulta?$consulta->peso:'' }}">
            </div>

            <div class="col-12 col-lg-1"></div>
            <div class="col-12 col-lg-1 d-flex">
                <div class="clearfix align-self-center w-100">
                    <span class="float-start fw-bold small text-muted" style="font-size: 13px">Talla (m)</span>
                    <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                </div>
            </div>
            <div class="col-12 col-lg-1">
                <input class="form-control form-control-sm bg-transparent" disabled value="{{ $consulta?$consulta->talla:'' }}">
            </div>

            <div class="col-12 col-lg-1"></div>
            <div class="col-12 col-lg-1 d-flex">
                <div class="clearfix align-self-center w-100">
                    <span class="float-start fw-bold small text-muted" style="font-size: 13px">IMC (%)</span>
                    <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                </div>
            </div>
            <div class="col-12 col-lg-1">
                <input class="form-control form-control-sm bg-transparent" disabled value="{{ $consulta?$consulta->imc:'' }}">
            </div>

            <div class="col-12 col-lg-2 d-flex">
                <div class="clearfix align-self-center w-100 ps-lg-5">
                    <span class="float-start fw-bold small text-muted" style="font-size: 13px">Perímetro Abdominal (cm)</span>
                    <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                </div>
            </div>
            <div class="col-12 col-lg-1">
                <input class="form-control form-control-sm bg-transparent" disabled value="{{ $consulta?$consulta->perimetro_abdominal:'' }}">
            </div>
        </div>
        @if($admin_atencione->especialidad->id == '5')
            <p class="fw-bold text-uppercase small text-secondary mb-1" style="font-size: 14px">Aparatos y Sistemas</p>
            <div class="col-12 col-md-12 col-lg-12 mb-3">
                <div class="pb-2">
                    <div class="row">
                        <div class="col-6 col-md-4 col-lg-4 mb-3">
                            <span class="float-start fw-bold small text-muted" style="font-size: 13px">Pulsos Periféricos: </span>
                            <textarea placeholder="" rows="2" class="form-control form-control-sm bg-transparent" disabled>{{$consulta->pulsos_perifericos}}</textarea>
                        </div>
                        <div class="col-6 col-md-4 col-lg-4 mb-3">
                            <span class="float-start fw-bold small text-muted" style="font-size: 13px">Aparato Respiratorio: </span>
                            <textarea placeholder="" rows="2" class="form-control form-control-sm bg-transparent" disabled>{{$consulta->aparato_respiratorio}}</textarea>
                        </div>
                        <div class="col-6 col-md-4 col-lg-4 mb-3">
                            <span class="float-start fw-bold small text-muted" style="font-size: 13px">Abdomen: </span>
                            <textarea placeholder="" rows="2" class="form-control form-control-sm bg-transparent" disabled>{{$consulta->abdomen}}</textarea>
                        </div>
                        <div class="col-6 col-md-4 col-lg-4 mb-3">
                            <span class="float-start fw-bold small text-muted" style="font-size: 13px">Extremidades: </span>
                            <textarea placeholder="" rows="2" class="form-control form-control-sm bg-transparent" disabled>{{$consulta->extremidades}}</textarea>
                        </div>
                        <div class="col-6 col-md-4 col-lg-4 mb-3">
                            <span class="float-start fw-bold small text-muted" style="font-size: 13px">Electro cardiograma: </span>
                            <textarea placeholder="" rows="2" class="form-control form-control-sm bg-transparent" disabled>{{$consulta->electro_cardiograma}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <p class="fw-bold text-uppercase small text-secondary mb-1" style="font-size: 14px">RIESGO QUIRURGICO</p>
            <div class="row g-2">
                <div class="col-4 col-lg-4">
                    <div class="mb-3">
                        <input class="form-control form-control-sm bg-transparent" disabled value="{{ $consulta?$consulta->riesgo_quirurgico:'' }}">
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
                            <input type="decimal" disabled value="{{$consulta->sesiones_programadas}}" class="form-control form-control-sm bg-transparent">
                        </div>
                        <div class="col-12 col-md-4 col-lg-4 mb-3">
                            <span class="float-start fw-bold small text-muted" style="font-size: 13px">Frecuencia de Sesiones: </span>
                            <input class="form-control form-control-sm bg-transparent" disabled value="{{ $consulta?$consulta->frecuencia_sesiones:'' }}">
                        </div>
                        <div class="col-12 col-md-4 col-lg-4 mb-3">
                            <label for="recursos_terapeuticos_id" class="text-start fw-bold small text-muted" style="font-size: 13px;">Recursos terapeuticos</label>
                            <div class="row">
                                <select class="form-select form-select-sm select2_bootstrap_2 bg-transparent" disabled multiple>
                                    <option  disabled>Seleccion opcion</option>
                                    @php
                                        $cargar_recurst_select = DB::table('recursos_terapeuticos as rectera')->join('consulta_recursoterapeutico as consrecu','consrecu.recursoterapeutico_id','=','rectera.id')->select('consrecu.id','rectera.id as id_recursot','rectera.name')->where('consrecu.consulta_id',$consulta->id)->get();
                                    @endphp
                                    @foreach ($cargar_recurst_select as $cargar_recurst_selects)
                                        <option selected value="{{$cargar_recurst_selects->id_recursot}}">{{$cargar_recurst_selects->name}}</option>
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
                    <textarea disabled rows="3" class="form-control form-control-sm bg-transparent">{{ $consulta?$consulta->tratamiento:'' }}</textarea>
                </div>
            </div>
        </div>
        @if($admin_atencione->especialidad->id == '2' || $admin_atencione->especialidad->id == '3' || $admin_atencione->especialidad->id == '4')
            <div class="row g-2">
                <div class="col-4 col-lg-4">
                    <div class="mb-3">
                        <p class="fw-bold text-uppercase small text-secondary mb-1" style="font-size: 14px">Interconsulta</p>
                        <input class="form-control form-control-sm bg-transparent" disabled value="{{ $consulta?$consulta->interconsulta:'' }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6 col-lg-6">
                    <div class="mb-3">
                        <textarea class="form-control form-control-sm bg-transparent" disabled rows="3" >{{ $consulta?$consulta->motivo_interconsulta:'' }}</textarea>
                    </div>
                </div>
                <div class="col-6 col-lg-6">
                    <div class="mb-3">
                        <textarea class="form-control form-control-sm bg-transparent" disabled rows="3" >{{ $consulta?$consulta->solicitud_interconsulta:'' }}</textarea>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>