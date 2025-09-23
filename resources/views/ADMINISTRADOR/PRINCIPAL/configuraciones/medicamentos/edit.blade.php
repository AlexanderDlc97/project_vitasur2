@extends('TEMPLATE.administrador')

@section('title', 'MEDICAMENTOS')

@section('css')
@endsection
 
@section('content')
<!-- Encabezado -->
    <div class="header_section">
        <div class="bg-transparent mb-3" style="height: 67px"></div>
        <div class="container-fluid">
            <div class="" data-aos="fade-right">
                <h1 class="titulo h2 text-uppercase fw-bold mb-0">MEDICAMENTOS</h1>
                <div class="" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="">Principal</a></li>
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="{{ url('admin-configuraciones') }}">Configuraciones</a></li>
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="{{ url('admin-medicamentos') }}">Medicamentos</a></li>
                        <li class="breadcrumb-item link" aria-current="page">Actualizar registro</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
<!-- Fin encabezado-->

{{-- Contenido --}}
<form method="POST" action="{{ route('admin-medicamentos.update',$admin_medicamento->slug) }}" enctype="multipart/form-data" autocomplete="off" class="needs-validation" novalidate>
    @csrf
    @method('put')
    <div class="container-fluid">   
        <div class="card border-4 borde-top-primary shadow-sm h-100" style="border-radius: 20px; min-height: 500px" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
            <div class="card-body">
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-3 col-lg-2 order-2 order-md-1">
                        <img for="uploadImage1" id="uploadPreview1" alt="" class="rounded imagecard" src="
                        @if($admin_medicamento->imagen == 'NULL')
                            /images/icon-photo.png
                        @else
                            /images/medicamentos/{{$admin_medicamento->imagen}}
                        @endif
                        ">   
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
                    <div class="col-12 col-md-4 col-lg-3">
                        <label for="codigo__id">Código<span class="text-danger">*</span></label>
                        <input name="codigo" id="codigo__id" type="text" class="form-control" value="{{ $admin_medicamento->codigo }}" required>
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>
                    <div class="col-12 col-md-8 col-lg-9">
                        <label for="name_id">Nombres<span class="text-danger">*</span></label>
                        <input name="name" id="name_id" type="text" class="form-control" value="{{ $admin_medicamento->name }}" required>
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="tipo_producto_id">Tipo de Bien<span class="text-danger">*</span></label>
                        <select name="tipo_producto" id="tipo_producto_id" class="form-select select2_bootstrap_2" data-placeholder="Seleccione" required>
                            <option value="{{ $admin_medicamento->tipo_producto }}" selected="selected" hidden>{{ $admin_medicamento->tipo_producto }}</option>
                            <option value="Medicamento">MEDICAMENTO</option>
                            <option value="Otros">OTROS</option>
                        </select>
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>
                    @if($admin_medicamento->tipo_producto == 'Medicamento')
                        <div class="col-12 col-md-6 col-lg-3" >
                            <label for="clasificacion__id">Clasificación<span class="text-danger">*</span></label>
                            <select name="clasificacion_id" id="clasificacion__id" class="form-select select2_bootstrap_2" data-placeholder="Seleccione" required>
                                <option value="{{$admin_medicamento->clasificacion->id}}" selected>{{$admin_medicamento->clasificacion->name}}</option>
                                @foreach($clasificaciones as $clasificacion)
                                    <option value="{{ $clasificacion->id }}" @if( $admin_medicamento->clasificacion_id == $clasificacion->id) selected="selected" @endif>{{ $clasificacion->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                El campo no puede estar vacío
                            </div>
                        </div>
                    @else
                        <div class="col-12 col-md-6 col-lg-3" id="mostrar_clasificacion">
                            <label for="clasificacion__id">Clasificación<span class="text-danger">*</span></label>
                            <select id="clasificacion__id" class="form-select select2_bootstrap_2" data-placeholder="Seleccione" required>
                                <option value="Otros" selected>Otros</option>
                            </select>
                            <div class="invalid-feedback">
                                El campo no puede estar vacío
                            </div>
                        </div>
                    @endif
                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="marca__id">Marca<span class="text-danger">*</span></label>
                        <input name="marca" id="marca__id" type="text" class="form-control" value="{{ $admin_medicamento->marca }}" required>
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="cantidad__id">Cantidad</label>
                        <input name="cantidad" id="cantidad__id" type="number" class="form-control" value="{{ $admin_medicamento->cantidad }}">
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="precio_venta__id">Precio<span class="text-danger">*</span></label>
                        <input name="precio_venta" id="precio_venta__id" type="decimal" class="form-control" value="{{ $admin_medicamento->precio_venta }}" required>
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-12">
                        <label for="editor">Descripción</label>
                        <textarea name="descripcion" class="form-control" id="editor" rows="5">{!! $admin_medicamento->descripcion !!}</textarea>
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>
                </div>               
            </div>
        </div>
        <div class="pt-3 text-end" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
            <a href="{{ route('admin-medicamentos.index') }}" class="btn btn-grey">Cancelar</a>
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
    $('#mostrar_clasificacion').hide();
    $('#tipo_producto_id').on('change', function(){
        valor_tipop = $(this).val();
        if(valor_tipop == 'Medicamento'){
            $('#mostrar_clasificacion').show();
            $('#clasificacion__id').prop('disabled',false);
        }else{
            $('#mostrar_clasificacion').hide();
            $('#clasificacion__id').prop('disabled',true);
            $('#clasificacion__id').prop('SelectedIndex',0);
        }
    });
</script>
@endsection