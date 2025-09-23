@extends('TEMPLATE.administrador')

@section('title', 'IMAGENOLOGIA')

@section('css')
@endsection
 
@section('content')
<!-- Encabezado -->
    <div class="header_section">
        <div class="bg-transparent mb-3" style="height: 67px"></div>
        <div class="container-fluid">
            <div class="" data-aos="fade-right">
                <h1 class="titulo h2 text-uppercase fw-bold mb-0">IMAGENOLOGIA</h1>
                <div class="" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="">Principal</a></li>
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="{{ url('admin-pacientes') }}">Pacientes</a></li>
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="javascript:history.back()">Imagenologia  </a></li>
                        <li class="breadcrumb-item link" aria-current="page">Detalles</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
<!-- Fin encabezado-->

{{-- Contenido --}}
<form method="POST" action="{{ route('admin-imagenologias.update_imagenes',$admin_imagenologia->slug) }}" enctype="multipart/form-data" autocomplete="off" class="needs-validation" novalidate>
    @csrf
    @method('put')
    <div class="container-fluid">   
        <div class="card border-4 borde-top-primary shadow-sm h-100" style="border-radius: 20px; min-height: 500px" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
            <div class="card-body">
                <input hidden name="imagenologia_id" id="imagenologia_id" value="{{$admin_imagenologia->id}}">
                <div class="row">
                    <div class="col-12 col-lg-2">
                        <div class="clearfix">
                            <span class="float-start fw-bold small text-muted" style="font-size: 13px">Nro. Solicitud</span>
                            <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6" id="nsolicitud_imagenologia">
                        0000001
                    </div>
                    <input hidden name="nro_solicitud" id="nsolicitud_imagenologia_value">
                    <input hidden name="paciente" value="{{$admin_imagenologia->paciente}}">
                    <div class="col-12 col-lg-2">
                        <div class="clearfix">
                            <span class="float-start fw-bold small text-muted" style="font-size: 13px">Fecha</span>
                            <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                        </div>
                    </div>
                    <div class="col-12 col-lg-2">
                        <input type="date" name="fecha" value="{{$fecha_actual}}" class="form-control form-control-sm bg-white">
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="pb-2">
                        <label for="descripcion" class="fw-bold text-uppercase small text-secondary mb-1" style="font-size: 14px">Descripción</label>
                        <div class="row g-2 mb-3">
                            @if(Auth::user()->role_id == '6' || Auth::user()->role_id == '2')
                                <div class="col-12 col-md-12 col-lg-12">
                                    <textarea name="descripcion_imagenologia" class="form-control" id="editor" rows="5">
                                        @if($admin_imagenologia != '')
                                            {!!$admin_imagenologia->descripcion_imagenologia!!}
                                        @else
                                        @endif
                                    </textarea>
                                    <div class="invalid-feedback">
                                        El campo no puede estar vacío
                                    </div>
                                </div>
                            @else
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="form-control bg-white pb-0" >
                                        @if($admin_imagenologia != '')
                                            {!!$admin_imagenologia->descripcion_imagenologia!!}
                                        @else
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-12 mb-3">
                    <div class="pb-2">
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-12">
                                <p class="fw-bold text-uppercase small text-secondary mb-1" style="font-size: 14px">Cargue más imágenes (opcional)</p> 
                                <div class="card imagecardfiles" style="min-height: 200px">
                                    <div class="card-body">
                                        @if(Auth::user()->role_id == '6')
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <label for="multiple__imagenes" class="btn btn-sm btn-secondary text-dark"><i class="bi bi-upload me-2"></i>Subir imágenes</label>
                                                    <input type="file" onchange="preview()" multiple accept="image/*" id="multiple__imagenes" name="images_opcional[]" hidden>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <p id="numero_archivos" class="text-start text-md-end small fw-bold text-muted">0 archivos seleccionados</p>
                                                </div>
                                            </div>
                                        @else
                                        @endif
                                        <div id="container_images_multiple">

                                        </div>
                                        <div class="row my-3">
                                            @if($admin_imagenologia)
                                                @if(Auth::user()->role_id == '6')
                                                    @if($admin_imagenologia->images)
                                                        @foreach($admin_imagenologia->images as $image)
                                                            <div class="col-6 col-md-3 col-lg-4">
                                                                <div class="card text-center imagecard rounded bg-light mb-0" style="height: 160px">  
                                                                    <label class=" my-auto text-center">
                                                                        <img for="uploadImage1" id="uploadPreview1" alt="" class="py-auto rounded" style="width: 100%; height: 156px;" src="{{ $image->url }}">   
                                                                    </label>
                                                                    <div class="card-img-overlay">
                                                                        <a type="button" href="/images/{{$image->id}}/delete" class="btn btn-danger btn-sm float-end"><i class="bi bi-trash"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                @else
                                                    @foreach($admin_imagenologia->images as $image)
                                                        <div class="col-6 col-md-3 col-lg-4">
                                                            <div class="card text-center imagecard rounded bg-light mb-0" style="height: 160px">  
                                                                <label class=" my-auto text-center">
                                                                    <img for="uploadImage1" id="uploadPreview1" alt="" class="py-auto rounded" style="width: 100%; height: 156px;" src="{{ $image->url }}">   
                                                                </label>
                                                                <!-- <div class="card-img-overlay"> -->
                                                                    <button type="button" class="bg-secondary border-0 px-0 mx-0 float-end" data-bs-toggle="modal" data-bs-target="#show_images_rx{{ $image->id }}"><i class="bi bi-eye-fill p-2"></i></button>
                                                                    @include('ADMINISTRADOR.PRINCIPAL.pacientes.show_imgmultiples')
                                                                <!-- </div> -->
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pt-3 text-end" data-aos-anchor-placement="top-bottom">
            @if(Auth::user()->role_id == '6' || Auth::user()->role_id == '2')
                <a href="javascript:history.back()" class="btn btn-grey">Atras</a>
                <button type="submit" class="btn btn-primary px-5 my-2 my-md-0 text-white">Guardar</button>
            @else
                <a href="javascript:history.back()" class="btn btn-grey">Atras</a>
            @endif
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
    $(document).on('show.bs.modal', '.modal', function () {
        $(this).appendTo('body');
    });
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
    let multiple__imagenes = document.getElementById("multiple__imagenes");
    let container_images_multiple = document.getElementById("container_images_multiple");
    let numero_archivos = document.getElementById("numero_archivos");

    function preview(){
        // container_images_multiple.innerHTML = "";
        numero_archivos.textContent = `${multiple__imagenes.files.length} archivos seleccionados`;

        for(i of multiple__imagenes.files){
            let reader = new FileReader();
            let figure = document.createElement("figure");
            let figCap = document.createElement("figcaption");
            figCap.innerText = i.name;
            figure.appendChild(figCap);
            reader.onload=()=>{
                let img = document.createElement("img");
                img.setAttribute("src",reader.result);
                img.classList.add('img_opcional');
                figure.insertBefore(img,figCap);
            }
            container_images_multiple.appendChild(figure);
            reader.readAsDataURL(i);
        }

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
    /* precargar vista de rx */
        valor_imagenologia_id = $('#imagenologia_id').val();

        $.get('/busqueda_solicitud_imagenologia',{value_solicitud: 'mostrar_solicitud', valor_imagenologia_id: valor_imagenologia_id}, function(busqueda){
            $('#nsolicitud_imagenologia').html("");
            $.each(busqueda, function(index, value){
                console.log(value,'aqui');
                if(value[1] == 'codigo_existente'){
                    $('#nsolicitud_imagenologia').html('IM'+value[0]);
                    $('#nsolicitud_imagenologia_value').val(value[0]);
                }else{
                    $('#nsolicitud_imagenologia').html('IM'+value[0]);
                    $('#nsolicitud_imagenologia_value').val(value[0]);
                }
            });
        });

    /*fin de precarga de rx*/ 
</script>
@endsection