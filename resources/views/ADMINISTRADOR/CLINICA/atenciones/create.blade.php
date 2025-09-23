@extends('TEMPLATE.administrador')

@section('title', 'ATENCIONES MÉDICAS')

@section('css')
@endsection
 
@section('content')
<!-- Encabezado -->
    <div class="header_section">
        <div class="bg-transparent mb-3" style="height: 67px"></div>
        <div class="container-fluid">
            <div class="" data-aos="fade-right">
                <h1 class="titulo h2 text-uppercase fw-bold mb-0">ATENCIONES MÉDICAS</h1>
                <div class="" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="">Clinica</a></li>
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="{{ url('admin-atenciones') }}">Atenciones</a></li>
                        <li class="breadcrumb-item link" aria-current="page">Nuevo registro</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
<!-- Fin encabezado-->

{{-- Contenido --}}
<form method="POST" action="{{ route('admin-atenciones.store') }}" enctype="multipart/form-data" autocomplete="off" class="needs-validation" novalidate>
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
    
                <div class="row g-3">
                    <div class="col-12 col-md-3 col-lg-2">
                        <label for="codigo__id">Código<span class="text-danger">*</span></label>
                        <input id="codigo__id" type="text" class="form-control bg-white" value="AT{{$codigo_atenc_slug}}" disabled required>
                        <input type="text" name="codigo" hidden value="{{$codigo_atenc_slug}}">
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>

                    <div class="col-12 col-md-3 col-lg-2">
                        <label for="tipo__id">Tipo<span class="text-danger">*</span></label>
                        <select name="tipo" id="tipo__id" class="form-select select2_bootstrap_2" data-placeholder="Seleccione" required>
                            <option value="{{ old('tipo') }}" selected="selected" hidden="hidden">{{ old('tipo') }}</option>
                            <option value="Cita programada">CITA PROGRAMADA</option>
                            <option value="Atención directa">ATENCIÓN DIRECTA</option>
                        </select>
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>

                    <div class="col-12 col-md-4 col-lg-2">
                        <label for="cita__id">Citas</label>
                        <select id="cita__id" class="form-select select2_bootstrap_2" disabled data-placeholder="Seleccione" required>
                            <option value="{{ old('cita_id') }}" selected="selected" hidden="hidden">{{ old('cita_id') }}</option>
                        </select>
                        <input hidden name="cita_id" id="cita__id_value">
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>

                    <div class="col-12 col-md-4 col-lg-2">
                        <label for="fecha__id">Fecha<span class="text-danger">*</span></label>
                        <input name="fecha" id="fecha__id" type="date" class="form-control" value="{{ old('fecha') }}" required>
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-2">
                        <label for="hora__id">Hora<span class="text-danger">*</span></label>
                        <input name="hora" id="hora__id" type="text" value="{{$now->format('H:i:s')}}" class="form-control" required>
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-2">
                        <label for="duracion__id">Duración<span class="text-danger">*</span></label>
                        <select name="duracion" id="duracion__id" class="form-select select2_bootstrap_2" data-placeholder="Seleccione" required>
                            <option value="{{ old('duracion') }}" selected="selected" hidden="hidden">{{ old('duracion') }}</option>
                            <option value="15">15 minutos</option>
                            <option value="30">30 minutos</option>
                            <option value="45">45 minutos</option>
                            <option value="60">60 minutos</option>
                        </select>
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>
                
                    <div class="col-12 col-md-4 col-lg-4">
                        <label for="paciente__id">Paciente<span class="text-danger">*</span></label>
                        <select name="paciente_id" id="paciente__id" class="form-select select2_bootstrap" data-placeholder="Seleccione" required>
                            <option value="{{ old('paciente_id') }}" selected="selected" hidden="hidden">{{ old('paciente_id') }}</option>
                            @foreach($pacientes as $paciente)
                                <option value="{{ $paciente->id }}">{{ $paciente->persona->name.' '.$paciente->persona->surnames }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>

                    <div class="col-12 col-md-4 col-lg-4">
                        <label for="especialidad__id">Especialidad<span class="text-danger">*</span></label>
                        <select name="especialidad_id" id="especialidad__id" class="form-select select2_bootstrap_2" data-placeholder="Seleccione" required>
                            <option value="{{ old('especialidad_id') }}" selected="selected" hidden="hidden">{{ old('especialidad_id') }}</option>
                            @foreach($especialidades as $especialidad)
                                <option value="{{ $especialidad->id }}">{{ $especialidad->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>

                    <div class="col-12 col-md-12 col-lg-4">
                        <label for="medico__id">Profesional<span class="text-danger">*</span></label>
                        <select name="medico_id" id="medico__id" class="form-select select2_bootstrap_2" data-placeholder="Seleccione" required>
                            <option value="{{ old('medico_id') }}" selected="selected" hidden="hidden">{{ old('medico_id') }}</option>
                            @foreach($medicos as $medico)
                                <option value="{{ $medico->id }}">{{ $medico->persona->name.' '.$medico->persona->surnames }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-12 col-lg-12" id="borrar_editor">
                        <label for="editor">Descripción</label>
                        <textarea name="descripcion" class="form-control" id="editor" rows="5"></textarea>
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>
                </div>      
            </div>             
        </div>
        <div class="pt-3 text-end" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
            <a href="{{ route('admin-atenciones.index') }}" class="btn btn-grey">Cancelar</a>
            <button type="submit" class="btn btn-primary px-5 my-2 my-md-0 text-white">Empezar</button>
        </div>
    </div>
</form>
{{-- Fin contenido --}}
@endsection
@section('js')
<script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
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
    $('#tipo__id').on('change', function(){
        value_tipo = $(this).val();
        $.get('/busqueda_tipo_citas',{value_tipo: value_tipo}, function(busqueda){
            $('#cita__id').empty("");
            $('#cita__id').append("<option value='' selected='selected' hidden='hidden'></option>");
            $('#paciente__id').empty("");
            $('#paciente__id').append("<option value='' selected='selected' hidden='hidden'></option>");
            $.each(busqueda, function(index, value){
                if(value[0] == 'citas_programadas'){
                    $('#cita__id').attr('disabled',false);
                    $('#cita__id').append("<option value='" + index +'_'+value[2]+'_'+value[3]+'_'+value[4]+'_'+value[5]+'_'+value[6]+'_'+value[7]+'_'+value[8]+'_'+value[9]+'_'+value[10]+'_'+value[11]+"'>" + value[1]+' | '+ value[6]+' - '+ value[2]+"</option>");
                }else{
                    hora_actualizada = new Date() 
                    hour =   hora_actualizada.getHours() 
                    minutes = hora_actualizada.getMinutes() 
                    seconds = hora_actualizada.getSeconds() 

                    $('#cita__id').attr('disabled',true);
                    $('#fecha__id').val(moment(hora_actualizada).format('YYYY-MM-DD'));
                    $('#hora__id').val(hour + ":" + minutes + ":" + seconds);
                    $('#duracion__id').val("").trigger("change");

                    $.get('/busqueda_pacientes',{value_tipo: value_tipo}, function(busqueda){
                        $('#paciente__id').empty("");
                        $('#paciente__id').append("<option value='' selected='selected' hidden='hidden'></option>");
                        $.each(busqueda, function(index, value){
                            $('#paciente__id').append("<option value='" + index +"'>" + value[0]+"</option>")
                        });
                    });

                    $.get('/busqueda_especialidades',{value_tipo: value_tipo}, function(busqueda){
                        $('#especialidad__id').empty("");
                        $('#especialidad__id').append("<option value='' selected='selected' hidden='hidden'></option>");
                        $.each(busqueda, function(index, value){
                            $('#especialidad__id').append("<option value='" + index +"'>" + value[0]+"</option>"); 
                        });
                    });
                }
            });
        });
        $('#cita__id').on('change', function(){
            var valor_cita_select = document.getElementById('cita__id').value.split('_');
                $('#cita__id_value').val(valor_cita_select[0]);
                $('#fecha__id').val(valor_cita_select[1]);
                // $('#hora__id').val(Date(valor_cita_select[2]));
                $("#duracion__id option[value="+ valor_cita_select[3] +"]").attr("selected",true).change();
                $('#paciente__id').empty("");
                $('#paciente__id').append("<option value='' selected='selected' hidden='hidden'></option>");
                $('#paciente__id').append("<option selected value='" + valor_cita_select[4] +"'>" + valor_cita_select[5]+"</option>");
                $('#especialidad__id').empty("");
                $('#especialidad__id').append("<option value='' selected='selected' hidden='hidden'></option>");
                $('#especialidad__id').append("<option selected value='" + valor_cita_select[6] +"'>" + valor_cita_select[7]+"</option>"); 
                $('#medico__id').empty("");
                $('#medico__id').append("<option value='' selected='selected' hidden='hidden'></option>");
                $('#medico__id').append("<option selected value='" + valor_cita_select[8] +"'>" + valor_cita_select[9]+"</option>");
                $('#borrar_editor').empty();
                $('#borrar_editor').append('<label for="editor">Descripción</label><textarea name="descripcion" class="form-control" id="editor" rows="5">'+valor_cita_select[10]+'</textarea><div class="invalid-feedback">El campo no puede estar vacío</div>');
                // $('#editor').append(valor_cita_select[10]);

                ClassicEditor
                    .create( document.querySelector( '#editor' ) )
                    .catch( error => {
                        console.error( error );
                    } );
        });
    });
</script>
@endsection