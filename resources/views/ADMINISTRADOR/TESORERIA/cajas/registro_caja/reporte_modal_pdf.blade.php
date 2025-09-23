<div class="modal fade" id="reporte_PDF" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white py-2">
                <span class="modal-title" id="staticBackdropLabel">Imprimir reporte en PDF</span>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin-caja.resultadosPDF') }}" method="POST">
                    @csrf
                    <input type="text" hidden name="caja_id" value="{{ $admin_caja->id }}">
                    <div class="my-3" id="">
                        <label for="">Filtrar desde</label>
                        <input type="date" id="start-date"  name="fecha_ini" class="form-control form-control-sm">
                    </div>
                    <div class="my-3" id="">
                        <label for="">Filtrar hasta</label>
                        <input type="date" id="end-date"   name="fecha_fin" class="form-control form-control-sm">
                    </div>
                    <button type="submit" target=_blank  class="btn btn-dark w-100 mt-3">Generar Reporte</button>
                </form>
                <a href="{{ route('print-caja.pdf', $admin_caja->slug) }}" target=_blank class="border border-secondary text-secondary btn w-100 mt-3">Descargar Todo</a>
            </div>
        </div>
    </div>
</div>