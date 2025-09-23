@php
    $admin_comp_venta = \App\Models\Venta::find($admin_venta_id);
@endphp
<div class="modal fade" id="ncredito{{$admin_comp_venta->slug}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-secondary text-white py-2">
                <span class="modal-title text-uppercase small" id="staticBackdropLabel">Nota de crédito</span>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span class="text-danger">* <small class="text-muted py-0 my-0 text-start"> - Campos
                        obligatorios</small></span>
                <form method="POST" action="/admin-notacredtos" enctype="multipart/form-data">
                    @csrf
                    <div class="py-1">
                        <label for="tipos__id" class="form-label">Serie - numero<span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm bg-white" disabled value="{{$admin_comp_venta->serie.' - '.$admin_comp_venta->correlativo}}">
                        <input type="text" hidden name="codigo_venta" class="form-control form-control-sm bg-white" value="{{$admin_comp_venta->codigo}}">
                        <input hidden name="serieref" value="{{$admin_comp_venta->serie}}">   
                        <input hidden name="correlativoref" value="{{$admin_comp_venta->correlativo}}">
                        <input hidden name="codigomotivo" value="{{$admin_comp_venta->codigo_comprobante}}">
                        @if($correlativo_reiniciar == 'Inicio')
                            <input type="text" hidden name="seriecorrelativo_nc" class="form-control form-control-sm bg-white" value="{{$serial.' - '.$correlativo_pro}}">
                            <input hidden name="serie" value="{{$admin_comp_venta->tipo_comprobante == 'Factura'?'F'.$serial:'B'.$serial}}">   
                            <input hidden name="correlativo" value="{{$correlativo_pro}}">
                        @elseif($correlativo_reiniciar == 'avanzando')
                            <input type="text" hidden name="seriecorrelativo_nc" class="form-control form-control-sm bg-white" value="{{$serial.' - '.$correlativo_pro}}">
                            <input hidden name="serie" value="{{$admin_comp_venta->tipo_comprobante == 'Factura'?'F'.$serial:'B'.$serial}}">   
                            <input hidden name="correlativo" value="{{$correlativo_pro}}">
                        @else
                            <input type="text" hidden name="seriecorrelativo_nc" class="form-control form-control-sm bg-white" value="{{$serial.' - '.$correlativo_pro}}">
                            <input hidden name="serie" value="{{$admin_comp_venta->tipo_comprobante == 'Factura'?'F'.$serial:'B'.$serial}}">   
                            <input hidden name="correlativo" value="{{$correlativo_pro}}">
                        @endif
                        {{-- <select class="form-select form-select-sm" name="tipo_id" id="tipos__id">
                            <option disabled>Seleccione una opción</option>
                            @foreach ($comrpobantes as $comrpobante)
                                @if($comrpobante->id == 4)
                                    <option selected value="{{ $comrpobante->id }}">{{ $comrpobante->name }}</option>
                                @endif
                            @endforeach
                        </select> --}}
                        @error('tipo_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="py-1">
                        <label for="name_id" class="form-label">Tipo de nota de credito<span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm" id="tipo_concepto{{$admin_comp_venta->id}}">
                            <option disabled selected>Seleccione una opción</option>
                            @foreach ($tipo_ncs as $tipo_nc)
                                <option value="{{ $tipo_nc->name}}_{{$tipo_nc->codigo}}">{{ $tipo_nc->name }}</option>
                            @endforeach
                        </select>
                        <input hidden name="codigo_comprobante" id="codigo_comprobante{{$admin_comp_venta->id}}">
                        <input hidden name="descripmotivo" id="descripmotivo{{$admin_comp_venta->id}}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="text-center pt-4">
                        @if($correlativo_reiniciar == 'vacio')
                            <button type="submit"
                                class="btn btn-secondary text-uppercase small px-5 text-white disabled">Generar registro</button>
                        @else
                            <button type="submit"
                                class="btn btn-secondary text-uppercase small px-5 text-white">Generar registro</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
