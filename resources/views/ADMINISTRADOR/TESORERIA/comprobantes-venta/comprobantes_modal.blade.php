<div class="modal fade" id="printcomp{{ $admin_comp_venta->slug }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-secondary text-uppercase text-white py-2">
                <span class="modal-title" id="staticBackdropLabel">Elegir formato de comprobante</span>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-uppercase text-center fw-bold text-primary small">
                    {{ $admin_comp_venta->tipo_comprobante.': '.$admin_comp_venta->serie.'-'.$admin_comp_venta->correlativo }}
                </p>
                <div class="row mb-3">
                    <div class="col-6 d-flex justify-content-center align-items-center">
                        <div class="text-center">
                            <p class="text-uppercase fw-bold small">Imprimir formato Ticket</p>
                            <p class="text-center">
                                 <img src="/images/ticket.png" alt="" class="border shadow-sm" style="width: 55px; height: auto;">   
                            </p>
                            <a target="_blank" href="{{ route('print-comprobante-ticket.pdf', $admin_comp_venta->slug) }}" class=" btn btn-sm btn-dark">
                                <i class="bi bi-printer"></i>
                                Imprimir
                            </a>
                        </div>
                    </div>
                    <div class="col-6 d-flex justify-content-center align-items-center">
                        <div class="text-center">
                            <p class="text-uppercase fw-bold small">Imprimir formato A4</p>
                            <p class="text-center">
                                <img src="/images/a4.png" alt="" class="border shadow-sm" style="width: 120px; height: auto;">
                            </p>
                            <a target="_blank" href="{{ route('print-comprobante.pdf', $admin_comp_venta->slug) }}" class=" btn btn-sm btn-dark">
                                <i class="bi bi-printer"></i>
                                Imprimir
                            </a>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                        <a download target="_blank" href="" class="btn btn-sm border-dark text-dark">
                            <i class="bi bi-filetype-xml me-2"></i>
                            Descagar XML
                        </a>
                        <a download target="_blank" href="" class="btn btn-sm border-dark text-dark">
                            <i class="bi bi-file-earmark-excel me-2"></i>
                            Descagar EXCEL
                        </a>
                </div>
            </div>
        </div>
    </div>
</div>