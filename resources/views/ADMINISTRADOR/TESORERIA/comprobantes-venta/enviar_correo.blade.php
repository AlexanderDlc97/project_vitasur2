<div class="modal fade" id="enviar_correo{{ $admin_comp_venta->slug }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-secondary text-uppercase text-white py-2">
                <span class="modal-title" id="staticBackdropLabel">Enviar por correo</span>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/admin_correo_store" enctype="multipart/form-data">
                @csrf
                    <p class="text-uppercase text-center fw-bold small">
                        {{ $admin_comp_venta->tipo_comprobante.': '.$admin_comp_venta->serie.'-'.$admin_comp_venta->correlativo }}
                    </p>
                    <div class="alert alert-light" role="alert">
                        Especificar una dirección de correo electrónico
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Para<span class="text-danger">*</span></label>
                        <input type="email" name="email" value="{{$admin_comp_venta->email}}" class="form-control form-control-sm">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Asunto<span class="text-danger">*</span></label>
                        <input type="text" name="asunto" class="form-control form-control-sm" value="Envío de comprobante con número {{$admin_comp_venta->serie.'-'.$admin_comp_venta->correlativo}}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Mensaje<span class="text-danger">*</span></label>
                        <textarea type="text" name="mensaje" id="editor" class="form-control form-control-sm" style="height: 100px">
                            <p>!!Reciba un cordial saludo!!</p>
                            <p>En este correo se adjunta el numero de comprobante {{$admin_comp_venta->serie.'-'.$admin_comp_venta->correlativo}} con fecha {{$admin_comp_venta->fechaemision}}, le agradecemos por elegir KAITA INTERNATIONAL.</p>
                            <p>Cualquier inquietud será atendida en el teléfono: 665-4576 / 952-314-831.</p>
                            <p>Para consultar el comprobante ingresar a : <a href="https://fe4.masydase.com/Consultar/20608321773">https://fe4.masydase.com/Consultar/20608321773</a></p>
                            <p>Si desea responder a este correo, por favor hacerlo a ventasweb48@gmail.com</p>
                            <p>Atentamente,</p>
                            <p>KAITA INTERNATIONAL</p>
                        </textarea>
                    </div>
                    <div class="text-center pt-4">
                        <button type="submit" class="btn btn-secondary text-uppercase small px-5 text-white">Enviar</button>   
                    </div> 
                </form> 
            </div>
        </div>
    </div>
</div>