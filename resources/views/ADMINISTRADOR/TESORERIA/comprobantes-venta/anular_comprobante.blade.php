<div class="modal fade" id="anularcomp{{ $admin_comp_venta->slug }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-secondary text-uppercase text-white py-2">
                <span class="modal-title" id="staticBackdropLabel">Anular comprobante</span>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/admin-comp-ventas/anulacionD" enctype="multipart/form-data">
                    @csrf
                    <input hidden name="comprob_anular" value="{{ $admin_comp_venta->slug}}">
                    <p class="text-uppercase text-center fw-bold small">
                        {{ $admin_comp_venta->tipo_comprobante.': '.$admin_comp_venta->serie.'-'.$admin_comp_venta->correlativo }}
                    </p>
                    <div class="alert alert-light" role="alert">
                        Debes agregar el motivo de la anulación para generar la baja.
                    </div>
                    <div class="mb-3">
                        <label for="motivo_anulacion__id" class="form-label">Motivo de anulación<span class="text-danger">*</span></label>
                        <textarea type="text" name="motivo_d" id="motivo_anulacion__id" class="form-control form-control-sm" style="height: 100px">{{old('motivo_anulacion')}}</textarea>
                        @error('motivo_d')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="text-center pt-4">
                        <button type="submit" class="btn btn-secondary text-uppercase small px-5 text-white">Anular</button>   
                    </div> 
                </form> 
            </div>
        </div>
    </div>
</div>