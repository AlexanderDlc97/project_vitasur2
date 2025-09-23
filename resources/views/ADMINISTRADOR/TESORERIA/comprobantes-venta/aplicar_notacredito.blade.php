<div class="modal fade" id="aplicar_nc{{ $admin_comp_venta->slug }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-secondary text-uppercase text-white py-2">
                <span class="modal-title" id="staticBackdropLabel">Aplicar nota de crédito</span>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/admin-comp-ventas" enctype="multipart/form-data">
                @csrf
                    <p class="text-uppercase text-center fw-bold small">
                        {{ $admin_comp_venta->tipo_comprobante.': '.$admin_comp_venta->serie.'-'.$admin_comp_venta->correlativo }}
                    </p>
                    <input hidden name="compr_id" value="{{$admin_comp_venta->id}}">
                    <input hidden name="serieref" value="{{$admin_comp_venta->serie}}">   
                    <input hidden name="correlativoref" value="{{$admin_comp_venta->correlativo}}">
                    <input hidden name="codigomotivo" value="{{$admin_comp_venta->codigo_comprobante}}">
                    @if($correlativo_reiniciar == 'Inicio')
                        <input hidden type="text"  name="seriecorrelativo_nc" class="form-control form-control-sm bg-white" value="{{$admin_comp_venta->comprobante == 'Factura'?'F'.$serial[0].''.$serial[1].''.$serial[3]:'B'.$serial[0].''.$serial[1].''.$serial[3].' - '.$correlativo_pro}}">
                        <input hidden name="serie" value="{{$admin_comp_venta->comprobante == 'Factura'?F.''.$serial[0].''.$serial[1].''.$serial[3]:'B'.$serial[0].''.$serial[1].''.$serial[3]}}">   
                        <input hidden name="correlativo" value="{{$correlativo_pro}}">
                    @elseif($correlativo_reiniciar == 'avanzando')
                        <input hidden type="text"  name="seriecorrelativo_nc" class="form-control form-control-sm bg-white" value="{{$admin_comp_venta->comprobante == 'Factura'?$serial.' - '.$correlativo_pro:$serial.' - '.$correlativo_pro}}">
                        <input hidden name="serie" value="{{$admin_comp_venta->comprobante == 'Factura'?$serial:$serial}}">      
                        <input hidden name="correlativo" value="{{$correlativo_pro}}">
                    @elseif($correlativo_reiniciar == 'reiniciar')
                        <input hidden type="text"  name="seriecorrelativo_nc" class="form-control form-control-sm bg-white" value="{{$admin_comp_venta->comprobante == 'Factura'?$serial.' - '.$correlativo_pro:$serial.' - '.$correlativo_pro}}">
                        <input hidden name="serie" value="{{$admin_comp_venta->comprobante == 'Factura'?$serial:$serial}}">      
                        <input hidden name="correlativo" value="{{$correlativo_pro}}">
                    @else
                        <input hidden type="text"  name="seriecorrelativo_nc" class="form-control form-control-sm bg-white text-danger" value="Genere una nueva serie y correlativo">
                        <input hidden name="serie" value="No permitido">   
                        <input hidden name="correlativo" value="No permitido">
                    @endif
                    <div class="row g-2">
                        <div class="col-12 col-md-4 mb-3">
                            <label for="" class="form-label">Tipo<span class="text-danger">*</span></label>
                            <select name="aplicacion_nc" id="" class="form-select form-select-sm">
                                <option selected="selected" hidden="hidden">--Seleccione--</option>
                                @foreach ($tipocredito as $tipocreditos)
                                    <option value="{{$tipocreditos->name}}">{{$tipocreditos->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-4 mb-3">
                            <label for="" class="form-label">Fecha<span class="text-danger">*</span></label>
                            <input type="date" class="form-control form-control-sm bg-white" disabled value="{{$fecha_actual}}">
                            <input type="date" name="fechaemision" class="form-control form-control-sm" hidden value="{{$fecha_actual}}">
                        </div>
                        <div class="col-12 col-md-4 mb-3">
                            <label for="" class="form-label">Moneda<span class="text-danger">*</span></label>
                            <select name="codigo_moneda" id="" class="form-select form-select-sm">
                                <option selected="selected" value="{{$admin_comp_venta->codigo_moneda}}" hidden="hidden">{{$admin_comp_venta->codigo_moneda == 'PEN'?'Soles':'Dolares'}}</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="" class="form-label">Motivo</label>
                            <textarea type="text" name="motivo_nc" id="" class="form-control form-control-sm" style="height: 100px"></textarea>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="" class="form-label">Notas</label>
                            <textarea type="text" name="nota" id="" class="form-control form-control-sm" style="height: 100px"></textarea>
                        </div>
                    </div>
                    <div class="text-center pt-4">
                        <button type="submit" class="btn btn-secondary text-uppercase small px-5 text-white">Aplicar</button>   
                    </div>
                </form>  
            </div>
        </div>
    </div>
</div>