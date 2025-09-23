<div class="modal fade" id="reporte_Excel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white py-2">
                <span class="modal-title" id="staticBackdropLabel">Imprimir reporte en Excel</span>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin-pagos.resultadosEXCEL') }}" method="POST">
                @csrf  
                    <div class="my-3" id="">
                        <label for="">Filtrar desde</label>
                        <input type="date" name="start-date"  id="fecha_ini" class="form-control form-control-sm">
                    </div>
                    <div class="my-3" id="">
                        <label for="">Filtrar hasta</label>
                        <input type="date" name="end-date"   id="fecha_fin" class="form-control form-control-sm">
                    </div>
                    <input hidden type="text" name="fecha_asignada" value="fecha_asignada">
                    <button type="submit" target=_blank  class="btn btn-dark w-100 mt-3">Generar Reporte</button>
                </form>
                {{-- <a href="{{ route('admin-pagos.resultadosEXCELshow') }}" class="border border-dark text-secondary btn w-100 mt-3">Descargar Todo</a> --}}
            </div>
        </div>
    </div>
</div>