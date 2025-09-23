<div class="modal fade" id="reporte_PDF" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white py-2">
                <span class="modal-title" id="staticBackdropLabel">Imprimir reporte en PDF</span>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route'=>'admin-pagos.resultadosPDF', 'method'=>'POST']) !!}
                    <div class="mb-3" id="">
                        <label for="">Filtrar Sede</label>
                        <select name="sede_id" id="" class="form-select form-select-sm">
                            <option value="" selected="selected" hidden="hidden">-- Selecione --</option>
                                @if(Gate::allows('gerencia',Auth()->user()))
                                    @foreach($sedes as $sede)
                                    <option value="{{ $sede->id }}">{{ $sede->name }}</option>
                                    @endforeach
                                @elseif(Gate::allows('administracion',Auth()->user()) || Gate::allows('recepcion',Auth()->user()) || Gate::allows('tesoreria',Auth()->user()))
                                    @if($sedes->id == Auth::user()->persona->sede_id)
                                        <option value="{{ $sedes->id }}">{{ $sedes->name }}</option>
                                    @endif
                                @endif
                        </select>
                    </div>
                    <div class="mb-3" id="">
                        <label for="">Filtrar Concepto</label>
                        <select name="id_concepto_pdf" id="id_concepto_pdf" class="form-select form-select-sm select2" style="width:100%">
                            <option value="" selected="selected" hidden="hidden">-- Selecione --</option>
                            <option value="COMPRA">Compra</option>
                            <option value="Proveedor">Proveedor</option>
                            <option value="Empleado">Empleado</option>
                            <option value="Vendedor">Vendedor</option>
                            <option value="Servicio">Servicio</option>
                        </select>
                    </div>
                    <div class="mb-3" id="">
                        <label for="">Filtrar Proveedor</label>
                        <select name="proveedor_name" id="id_proveedor_pdf" class="form-select form-select-sm select2" style="width:100%">
                            <option value="" selected="selected" hidden="hidden">-- Selecione --</option>
                            @foreach($proveedor_compra as $proveedor_compras)
                                <option value="{{ $proveedor_compras->proveedor }}">{{ $proveedor_compras->proveedor }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="my-3" id="">
                        <label for="">Filtrar desde</label>
                        <input type="date" id="start-date"  name="fecha_ini" class="form-control form-control-sm">
                    </div>
                    <div class="my-3" id="">
                        <label for="">Filtrar hasta</label>
                        <input type="date" id="end-date"   name="fecha_fin" class="form-control form-control-sm">
                    </div>
        
                    <button type="submit" target=_blank  class="btn btn-dark w-100 mt-3">Generar Reporte</button>
                {!! Form::close() !!}
                <a href="{{ route('print-pagos.pdf') }}" target=_blank class="border border-secondary text-secondary btn w-100 mt-3">Descargar Todo</a>
            </div>
        </div>
    </div>
</div>