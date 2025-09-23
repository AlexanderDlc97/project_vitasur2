<div class="modal fade" id="show_medicamento{{$admin_medicamento->slug}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white py-2">
                <span class="modal-title text-uppercase small" id="staticBackdropLabel">Detalle de registro</span>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-3 col-lg-3">
                        <div class="mb-3">
                            <img for="uploadImage1" id="uploadPreview1" alt="" class="py-auto" style="width: 100%; height: 165px; object-fit: cover;  border-radius: 20px" src="
                            @if($admin_medicamento->imagen != "NULL")
                                /images/medicamentos/{{$admin_medicamento->imagen}}
                            @else
                                /images/image.png
                            @endif
                            ">   
                        </div>
                        <div class="mb-3 mb-lg-0">
                            <label class="small text-uppercase bg-white px-1 ms-2"><small>Código</small></label>
                            <div class="form-control bg-white pb-0 text-center" style="margin-top: -12px; min-height: 31px">{{$admin_medicamento->codigo}}</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-9 col-lg-9">
                        <div class="row g-3">
                            <div class="col-12 col-md-12 col-lg-12">
                                <label for="" class="small text-uppercase bg-white px-1 ms-2"><small>Nombre</small></label>
                                <div class="form-control bg-white pb-0 text-center" style="margin-top: -12px; min-height: 31px">{{$admin_medicamento->name}}</div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <label class="small text-uppercase bg-white px-1 ms-2"><small>Clasificación</small></label>
                                <div class="form-control bg-white pb-0 text-center" style="margin-top: -12px; min-height: 31px">{{$admin_medicamento->clasificacion?$admin_medicamento->clasificacion->name:'Otros'}}</div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <label class="small text-uppercase bg-white px-1 ms-2"><small>Unidad de medida</small></label>
                                <div class="form-control bg-white pb-0 text-center" style="margin-top: -12px; min-height: 31px">NIU</div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <label class="small text-uppercase bg-white px-1 ms-2"><small>Marca</small></label>
                                <div class="form-control bg-white pb-0 text-center" style="margin-top: -12px; min-height: 31px">{{$admin_medicamento->marca}}</div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <label class="small text-uppercase bg-white px-1 ms-2"><small>Cantidad</small></label>
                                <div class="form-control bg-white pb-0 text-center" style="margin-top: -12px; min-height: 31px">
                                    @if(empty($admin_medicamento->cantidad))
                                        -
                                    @else
                                        {{ $admin_medicamento->cantidad }}
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <label class="small text-uppercase bg-white px-1 ms-2"><small>Precio</small></label>
                                <div class="form-control bg-white pb-0 text-center" style="margin-top: -12px; min-height: 31px">{{$admin_medicamento->precio_venta}}</div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <label class="small text-uppercase bg-white px-1 ms-2"><small>Estado</small></label>
                                <div class="form-control bg-white pb-0 text-center" style="margin-top: -12px; min-height: 31px">
                                    @if($admin_medicamento->estado == 'Activo')
                                        <span class="badge text-uppercase small bg-success border-0">Activo</span>
                                    @else
                                        <span class="badge text-uppercase small bg-danger border-0">Inactivo</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-12 col-md-12 col-lg-12">
                                <label class="small text-uppercase bg-white px-1 ms-2"><small>Descripción</small></label>
                                <div class="form-control bg-white pb-0 text-center" style="margin-top: -12px; min-height: 70px">{!!$admin_medicamento->descripcion!!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>