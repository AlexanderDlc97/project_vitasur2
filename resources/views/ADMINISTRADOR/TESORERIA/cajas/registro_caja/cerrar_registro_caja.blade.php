<div class="modal fade" id="cerrar_registro_caja{{ $registro->slug }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <form method="POST" action="/admin-caja/{{ $registro->slug }}">
                    @csrf
                    @method('PUT')
                    <div class="text-center">
                        <i class="bi bi-exclamation-circle-fill h1 display-2 text-danger"></i>
                        <p class="fw-bold  mb-0 text-danger text-uppercase small fs-4">Cerrar caja</p> 
                        <p class="mb-0">TOTAL: S/ {{ ($registro->saldo_inicial+$registro->saldo_ingreso)-$registro->saldo_egreso }}</p>
                        <p class="fw-bold  mb-0 fs-5">¿Estas seguro?</p> 
                        <p class="text-muted fs-6">¡No podrás revertir esto!</p>  
                        <button type="submit" class="btn btn-danger text-white mt-2">CERRAR CAJA</button>
                        <button type="button" class="btn btn-outline-primary mt-2" data-bs-dismiss="modal">Cancelar</button>
                    </div>      
                </form>
            </div>
        </div>
    </div>
</div>