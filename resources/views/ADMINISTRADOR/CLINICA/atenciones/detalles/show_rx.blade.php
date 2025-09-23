<div class="card border-0">
    <div class="card-body">
        <form method="POST" action="/guardar_rx" enctype="multipart/form-data" autocomplete="off" class="needs-validation" novalidate>
        @csrf
            <input hidden name="atenciones_id_rx" id="atenciones_id_rx" value="{{$admin_atencione->id}}">
            <div class="row">
                <div class="col-12 col-lg-2">
                    <div class="clearfix">
                        <span class="float-start fw-bold small text-muted" style="font-size: 13px">Nro. Solicitud</span>
                        <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                    </div>
                </div>
                <div class="col-12 col-lg-6" id="nsolicitud_rx">
                    0000001
                </div>
                <input hidden name="nro_solicitud" id="nsolicitud_rx_value">
                <div class="col-12 col-lg-2">
                    <div class="clearfix">
                        <span class="float-start fw-bold small text-muted" style="font-size: 13px">Fecha</span>
                        <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                    </div>
                </div>
                <div class="col-12 col-lg-2">
                    <input type="date" name="fecha" value="{{$fecha_actual}}" class="form-control form-control-sm">
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-12">
                <div class="pb-2">
                    <label for="descripcion" class="fw-bold text-uppercase small text-secondary mb-1" style="font-size: 14px">Descripción</label>
                    <div class="row g-2 mb-3">
                        @php
                            if(\App\Models\Rx::where('atencion_id',$admin_atencione->id)->exists()){
                                $valor_rx = \App\Models\Rx::where('atencion_id',$admin_atencione->id)->first();
                            }else{
                                $valor_rx = '';
                            }
                        @endphp
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="form-control bg-white pb-0" >
                                @if($valor_rx != '')
                                    {!!$valor_rx->descripcion_rx!!}
                                @else
                                @endif
                            </div>
                        </div>
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
                                    <!-- <div class="row">
                                        <div class="col-12 col-md-6">
                                            <label for="multiple__imagenes" class="btn btn-sm btn-secondary text-dark"><i class="bi bi-upload me-2"></i>Subir imágenes</label>
                                            <input type="file" onchange="preview()" multiple accept="image/*" id="multiple__imagenes" name="images_opcional[]" hidden>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <p id="numero_archivos" class="text-start text-md-end small fw-bold text-muted">0 archivos seleccionados</p>
                                        </div>
                                    </div> -->
                                    <div id="container_images_multiple">

                                    </div>
                                    <div class="row my-3">
                                        @if($valor_rx)
                                            @if(Auth::user()->role_id == '6')
                                                @foreach($valor_rx->images as $image)
                                                    <div class="col-6 col-md-3 col-lg-4">
                                                        <div class="card text-center imagecard rounded bg-light mb-0" style="height: 160px">  
                                                            <label class=" my-auto text-center">
                                                                <img for="uploadImage1" id="uploadPreview1" alt="" class="py-auto rounded" style="width: 100%; height: 156px;" src="{{$image->url}}">   
                                                            </label>
                                                            <!-- <div class="card-img-overlay"> -->
                                                                <button type="button" class="bg-secondary border-0 px-0 mx-0 float-end" data-bs-toggle="modal" data-bs-target="#show_images_rx{{ $image->id }}"><i class="bi bi-eye-fill p-2"></i></button>
                                                                @include('ADMINISTRADOR.CLINICA.atenciones.detalles.show_images_rx')
                                                            <!-- </div> -->
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                @foreach($valor_rx->images as $image)
                                                    <div class="col-6 col-md-3 col-lg-4">
                                                        <div class="card text-center imagecard rounded bg-light mb-0" style="height: 160px">  
                                                            <label class=" my-auto text-center">
                                                                <img for="uploadImage1" id="uploadPreview1" alt="" class="py-auto rounded" style="width: 100%; height: 156px;" src="{{$image->url}}">   
                                                            </label>
                                                            <!-- <div class="card-img-overlay"> -->
                                                                <button type="button" class="bg-secondary border-0 px-0 mx-0 float-end" data-bs-toggle="modal" data-bs-target="#show_images_rx{{ $image->id }}"><i class="bi bi-eye-fill p-2"></i></button>
                                                                @include('ADMINISTRADOR.CLINICA.atenciones.detalles.show_images_rx')
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
            @if($admin_atencione->estado == 'En atención')
            <div class="pt-3 text-end" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                <button type="submit" id="guardar_rx_atencione" class="btn btn-primary btn-sm px-5 my-2 my-md-0 text-white">Guardar</button>
            </div>
            @endif
        </form>
    </div>
</div>
{{-- @foreach($valor_rx->images as $image)
    @include('ADMINISTRADOR.CLINICA.atenciones.detalles.show_images_rx')
@endforeach --}}
@section('js_rx')
<script>
    $(document).on('show.bs.modal', '.modal', function () {
        $(this).appendTo('body');
    });
</script>
<script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
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
    /* precargar vista de rx */
        valor_atencion_id = $('#atenciones_id').val();

        $.get('/busqueda_solicitud_rx',{value_solicitud: 'mostrar_solicitud', valor_atencion_id: valor_atencion_id}, function(busqueda){
            $('#nsolicitud_rx').html("");
            $.each(busqueda, function(index, value){
                console.log(value,'aqui');
                if(value[1] == 'codigo_existente'){
                    $('#nsolicitud_rx').html('Rx'+value[0]);
                    $('#nsolicitud_rx_value').val(value[0]);
                }else{
                    $('#nsolicitud_rx').html('Rx'+value[0]);
                    $('#nsolicitud_rx_value').val(value[0]);
                }
            });
        });

        $.get('/cargar_rx',{tipo_consulta:'cargar',valor_atencion_id: valor_atencion_id}, function(busqueda){
            $.each(busqueda, function(index, value){
                $('#guardar_rx_atencione').html('Actualizar').css("background","#ffc107").css("border-color","#ffc107");
            });
        });

    /*fin de precarga de rx*/ 
</script>
@endsection