@extends('TEMPLATE.administrador')

@section('title', 'PACIENTES')

@section('css')
@endsection
 
@section('content')
<!-- Encabezado -->
    <div class="header_section">
        <div class="bg-transparent mb-3" style="height: 67px"></div>
        <div class="container-fluid">
            <div class="" data-aos="fade-right">
                <h1 class="titulo h2 text-uppercase fw-bold mb-0">PACIENTES</h1>
                <div class="" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="">Principal</a></li>
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="{{ url('admin-pacientes') }}">Pacientes</a></li>
                        <li class="breadcrumb-item link" aria-current="page">Nuevo registro</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
<!-- Fin encabezado-->

{{-- Contenido --}}
<form method="POST" action="{{ route('admin-pacientes.store') }}" enctype="multipart/form-data" autocomplete="off" class="needs-validation" novalidate>
    @csrf
    <div class="container-fluid">   
        <div class="card border-4 borde-top-primary shadow-sm h-100" style="border-radius: 20px; min-height: 500px" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
            <div class="card-body">
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-3 col-lg-2 order-2 order-md-1">
                        <img for="uploadImage1" id="uploadPreview1" alt="" class="rounded imagecard" src="/images/icon-photo.png">   
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>
                    <div class="col-12 col-md-9 col-lg-10 order-1 order-md-2">
                        <div class="card border-0 rounded-0 border-start border-3 border-info mb-4" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 1px 0px; background-color: #fcfcfc">
                            <div class="card-body py-2">
                                <i class="bi bi-info-circle text-info me-2"></i>Importante:
                                <ul class="list-unstyled mb-0 pb-0">
                                    <li class="mb-0 pb-0">
                                        <small class="text-muted py-0 my-0 text-start"> Se consideran campos obligatorios los campos que tengan este simbolo: <span class="text-danger">*</small></span>
                                    </li>
                                    <li class="mb-0 pb-0">
                                        <small class="text-muted">Se recomienda tener en cuenta las siguientes medidas para la imágen: <span class="fw-bold">720px. x 720px.</span> Peso máximo de imagen:<span class="fw-bold"> 2 MB.</span></small>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <input id="uploadImage1" class="form-control-file" type="file" name="imagen" accept="image/*" onchange="previewImage(1);" hidden/>
                        <label for="uploadImage1" class="btn btn-dark btn-sm">Cargar imagen</label>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-12 col-md-2 col-lg-2">
                        <label for="nro_identificacion_id">Nro. de identificación<span class="text-danger">*</span></label>
                        <div class="input-group has-validation">
                            <input name="nro_identificacion" id="nro_identificacion_id" type="number" class="form-control" value="{{ old('nro_identificacion') }}" required>
                            <button type="button" class="btn btn-dark" id="button_addon2"><i class="bi bi-search"></i></button>
                            <div class="invalid-feedback">
                                El campo no puede estar vacío
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-5 col-lg-5">
                        <label for="name_id">Nombres<span class="text-danger">*</span></label>
                        <input name="name" id="name_id" type="text" class="form-control" value="{{ old('name') }}" required>
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>
                    <div class="col-12 col-md-5 col-lg-5">
                        <label for="surnames_id">Apellidos<span class="text-danger">*</span></label>
                        <input name="surnames" id="surnames_id" type="text" class="form-control" value="{{ old('surnames') }}" required>
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="identificacion__id">Identificación<span class="text-danger">*</span></label>
                        <select name="identificacion" id="identificacion__id" class="form-select select2_bootstrap_2" data-placeholder="Seleccione" required>
                            <option value="{{ old('identificacion') }}" selected="selected" hidden="hidden">{{ old('identificacion') }}</option>
                            @foreach($identificaciones as $identificacion)
                                <option value="{{ $identificacion->abreviatura }}">{{ $identificacion->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="nro_contacto_id">Nro. de contacto</label>
                        <input name="nro_contacto" id="nro_contacto_id" type="number" class="form-control" value="{{ old('nro_contacto') }}">
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="fecha_nacimiento_id">Fecha de Nacimiento</label>
                        <input name="fecha_nacimiento" id="fecha_nacimiento_id" type="date" class="form-control" value="{{ old('fecha_nacimiento') }}">
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="sexo__id">Sexo<span class="text-danger">*</span></label>
                        <select name="sexo" id="sexo__id" class="form-select select2_bootstrap_2" data-placeholder="Seleccione" required>
                            <option value="{{ old('sexo') }}" selected="selected" hidden="hidden">{{ old('sexo') }}</option>
                            <option value="Hombre">Hombre</option>
                            <option value="Mujer">Mujer</option>
                        </select>
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-2">
                        <label for="estado_civil__id">Estado civil<span class="text-danger">*</span></label>
                        <select name="estado_civil" id="estado_civil__id" class="form-select select2_bootstrap" data-placeholder="Seleccione" required>
                            <option value="{{ old('estado_civil') }}" selected="selected" hidden="hidden">{{ old('estado_civil') }}</option>
                            <option value="Soltero">Soltero</option>
                            <option value="Casado">Casado</option>
                            <option value="Divorciado">Divorciado</option>
                            <option value="Viudo">Viudo</option>
                            <option value="Conviviente">Conviviente</option>
                        </select>
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-5">
                        <label for="ocupacion__id">Ocupación<span class="text-danger">*</span></label>
                        <input name="ocupacion" id="ocupacion__id" type="text" class="form-control" value="{{ old('ocupacion') }}" required>
                    </div>
                    <div class="col-12 col-md-6 col-lg-5">
                        <label for="responsable__id">Responsable<span class="text-danger">*</span></label>
                        <input name="responsable" id="responsable__id" type="text" class="form-control" value="{{ old('responsable') }}" required>
                    </div>
                    <div class="col-12 col-md-6 col-lg-5">
                        <label for="direccion_id">Dirección<span class="text-danger">*</span><span class="text-danger">*</span></label>
                        <input name="direccion" id="direccion_id" type="text" class="form-control" value="{{ old('direccion') }}" required>
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-5">
                        <label for="referencia__id">Referencia</label>
                        <input name="referencia" id="referencia__id" type="text" class="form-control" value="{{ old('referencia') }}">
                    </div>
                    <div class="col-12 col-md-6 col-lg-2">
                        <label for="historia_clinica__id">Historia clínica<span class="text-danger">*</span></label>
                        <input name="historia_clinica" id="historia_clinica__id" type="number" class="form-control" value="{{ old('historia_clinica') }}" required>
                    </div>
                </div>

                {{-- <div class="form-check mb-2 mt-3">
                    <input class="form-check-input" type="checkbox" name="credenciales" value="Si" id="check_credenciales">
                    <label class="form-check-label text-muted small text-uppercase fw-bold" for="check_credenciales">
                    Datos de usuario
                    </label>
                </div> --}}

                <div class="row g-3" id="credenciales">
                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="email">Correo electrónico</label>
                        <div class="input-group mb-3">
                            <input type="email" name="email" id="email" class="form-control">
                            <button class="border rounded-end px-2" style="background-color: #f6f6f6; color:#535353" type="button" id="btn_copiar_email"><i class="bi bi-clipboard-fill icono_copy_email"></i></button>
                        </div>
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="password">Contraseña</label>
                        <div class="input-group mb-3">
                            <input type="password" name="password" id="password" class="form-control" maxlength="16">
                            <span class="input-group-text border px-2" style="background-color: #f6f6f6; color:#535353"><i class="bi bi-lock-fill icono" style="cursor: pointer"></i></span>
                            <button class="border rounded-end px-2" style="background-color: #f6f6f6; color:#535353" type="button" id="btn_copiar_pass"><i class="bi bi-clipboard-fill icono_copy_pass"></i></button>
                        </div>
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>
                </div>
                   
            </div>
        </div>
        <div class="pt-3 text-end" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
            <a href="{{ route('admin-pacientes.index') }}" class="btn btn-grey">Cancelar</a>
            <button type="submit" class="btn btn-primary px-5 my-2 my-md-0 text-white">Guardar</button>
        </div>
    </div>
</form>
{{-- Fin contenido --}}
@endsection
@section('js')
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
    const   pass = document.getElementById("password"),
            icon = document.querySelector(".icono");
    icon.addEventListener("click", e => {
        if (password.type === "password"){
            password.type = "text";
            icon.classList.remove('bi-lock-fill');
            icon.classList.add('bi-unlock-fill');
        }else{
            password.type = "password";
            icon.classList.add('bi-lock-fill');
            icon.classList.remove('bi-unlock-fill');
        }
    })
</script>
<script>
    const btn_copy_pass = document.querySelector('#btn_copiar_pass');
    const pass_copy = document.querySelector('#password');
    const icon_copy_pass = document.querySelector('.icono_copy_pass'); 

    btn_copy_pass.addEventListener( 'click', copyPass);

    function copyPass(e){
        e.preventDefault();
        navigator.clipboard.writeText(pass_copy.value).then( () => {
            icon_copy_pass.classList.remove('bi-clipboard-fill');
            icon_copy_pass.classList.add('bi-clipboard-check-fill');

            setTimeout(() => {
                icon_copy_pass.classList.remove('bi-clipboard-check-fill');
                icon_copy_pass.classList.add('bi-clipboard-fill');
            }, 3000);
        })
    }
</script>
<script>
    const btn_copy_email = document.querySelector('#btn_copiar_email');
    const email_copy = document.querySelector('#email');
    const icon_copy_email = document.querySelector('.icono_copy_email'); 

    btn_copy_email.addEventListener( 'click', copyEmail);

    function copyEmail(e){
        e.preventDefault();
        navigator.clipboard.writeText(email_copy.value).then( () => {
            icon_copy_email.classList.remove('bi-clipboard-fill');
            icon_copy_email.classList.add('bi-clipboard-check-fill');

            setTimeout(() => {
                icon_copy_email.classList.remove('bi-clipboard-check-fill');
                icon_copy_email.classList.add('bi-clipboard-fill');
            }, 3000);
        })
    }
</script>
<script>
    $("#nro_identificacion_id").on("keyup change", function(e) {
        valor_identificacion = $(this).val();
        $('#historia_clinica__id').val(valor_identificacion);
    })
</script>
<script>
    $("#credenciales").hide();
    $(function () {
        $("#check_credenciales").click(function () {
            if ($(this).is(":checked")) {
                $("#credenciales").show();
                nombre = $('#name_id').val();
                apellido = $('#surnames_id').val();
                ndocumento = $('#nro_identificacion_id').val();
                
                $('#email').val(nombre[0].toUpperCase()+''+apellido[0].toUpperCase()+''+ndocumento+'@cvictormendoza.com');
                $('#password').val(ndocumento);
            }else{
                $("#credenciales").hide();
                $('#email').val('');
                $('#password').val('');
            }
        });
    });



    /*Consulta de busqueda por DNI o RUC*/

    $(document).ready(function() {
            $('#button_addon2').on('click', function(){
                var busqueda_iden = $('#nro_identificacion_id').val();
                if(busqueda_iden.length == 11){
                    var tipo_reniec = 'RUC';
                    $('#identificacion__id').prop('selectedIndex', 1).attr('selected',true).change();
                    console.log(tipo_reniec);
                }if(busqueda_iden.length == 8){
                    var tipo_reniec = 'DNI';
                    $('#identificacion__id').prop('selectedIndex', 2).attr('selected',true).change();
                    console.log(busqueda_iden.length,tipo_reniec);
                }
                $.get('/busqueda_reniec',{buscando: busqueda_iden, tipo_reniecs:tipo_reniec}, function(busqueda){
                    $.each(busqueda, function(index, value){
                        let datos = JSON.parse(value);
                        var valor_docu_ruc = datos.data.nombre_o_razon_social;
                        var valor_docu_dni = datos.data.numero;
                        console.log(datos);
                        if(valor_docu_ruc){
                            $('#name_id').val("");
                            $('#surnames_id').val("");
                            $('#direccion_id').val("");
                            $('#name_id').val(datos.data.nombre_o_razon_social);
                            $('#direccion_id').val(datos.data.direccion);
                        }if(valor_docu_dni){
                            $('#name_id').val("");
                            $('#surnames_id').val("");
                            $('#name_id').val(datos.data.nombres);
                            $('#surnames_id').val(datos.data.apellido_paterno+' '+datos.data.apellido_materno);
                        }
                    })
                });
            });

            /*$('#identificacion_id').on('change', function(){
                var iden = document.getElementById('identificacion_id').value.split('_');
                console.log(iden[0]);
                $('#tipod_id').empty();
                $('#tipod_id').val(iden[1]);
            });*/
        });

    /*Fin de consulta*/
</script>
@endsection