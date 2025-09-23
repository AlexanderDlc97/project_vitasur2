@extends('TEMPLATE.administrador')

@section('title', 'CITAS MÉDICAS')

@section('css')
@endsection
 
@section('content')
<!-- Encabezado -->
    <div class="header_section">
        <div class="bg-transparent mb-3" style="height: 67px"></div>
        <div class="container-fluid">
            <div class="" data-aos="fade-right">
                <h1 class="titulo h2 text-uppercase fw-bold mb-0">CITAS MÉDICAS</h1>
                <div class="" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="">Clinica</a></li>
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="{{ url('admin-citas') }}">Citas</a></li>
                        <li class="breadcrumb-item link" aria-current="page">Nuevo registro</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
<!-- Fin encabezado-->

{{-- Contenido --}}
<form method="POST" action="{{ route('admin-citas.store') }}" enctype="multipart/form-data" autocomplete="off" class="needs-validation" novalidate>
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
                    <div class="col-12 col-md-4 col-lg-3">
                        <label for="codigo__id">Código<span class="text-danger">*</span></label>
                        <input id="codigo__id" type="text" class="form-control bg-white" value="C{{$codigo_cit_slug}}" disabled required>
                        <input type="text" name="codigo" hidden value="{{$codigo_cit_slug}}">
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-3">
                        <label for="fecha__id">Fecha<span class="text-danger">*</span></label>
                        <input name="fecha" id="fecha__id" type="date" class="form-control" value="{{$now->format('Y-m-d')}}" required>
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-3">
                        <label for="hora__id">Hora<span class="text-danger">*</span></label>
                        <input name="hora" id="hora__id" type="time" class="form-control" value="{{$now->format('H:i:s')}}" required>
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-3">
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
                        <select id="especialidad__id" class="form-select select2_bootstrap_2" data-placeholder="Seleccione" required>
                            <option value="{{ old('especialidad_id') }}" selected="selected" hidden="hidden">{{ old('especialidad_id') }}</option>
                            @foreach($especialidades as $especialidad)
                                <option value="{{ $especialidad->id }}_{{ $especialidad->profesione_id }}">{{ $especialidad->name }}</option>
                            @endforeach
                        </select>
                        <input hidden name="especialidad_id" id="especilida_value_id">
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
                    
                    <div class="col-12 col-md-12 col-lg-12">
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
            <a href="{{ route('admin-citas.index') }}" class="btn btn-grey">Cancelar</a>
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
    $('#especialidad__id').on('change', function(){
        value_especial = document.getElementById('especialidad__id').value.split('_');
        $('#especilida_value_id').val(value_especial[0]);
        $.get('/busqueda_profesion',{value_especial: value_especial[1]}, function(busqueda){
            $('#medico__id').empty("");
            $('#medico__id').append("<option value='' selected='selected' hidden='hidden'></option>");
            $.each(busqueda, function(index, value){
                $('#medico__id').append("<option value='" + index +"'>" + value[0] +' '+value[1]+"</option>");
            });
        });
    });
</script>
@endsection