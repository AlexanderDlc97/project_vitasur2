<div class="modal fade" id="movimientos_registro_caja{{ $registro->slug }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white py-2">
                <span class="modal-title text-uppercase small" id="staticBackdropLabel">REGISTRO DE CAJA - {{ $registro->codigo }}</span>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @php
                    $detall_registro = \App\Models\Movimientocaja::where('registrocaja_id',$registro->id)->get();
                @endphp 
                <div class="row g-1">
                    <div class="col-12 col-md-6 mb-2 mb-lg-0">
                        <span class="text-uppercase">Total de registros encontrados: <span class="fw-bold" id="contador_registro">{{ $detall_registro->count() }}</span></span>
                    </div>
                    <div class="col-12 col-md-4"></div>
                    <div class="col-6 col-md-1 mb-2 mb-lg-0">
                        <!-- detalle_mov_caja.excel', $registro->slug -->
                        <a target="_blank" href="{{ route('detalle_mov_caja.excel', $registro->slug) }}" class="btn border-dark text-dark btn-sm w-100" data-bs-toggle="tooltip" data-bs-placement="top" title="Imprimir reporte en EXCEL"> <i class="bi bi-file-earmark-excel-fill me-2"></i>EXCEL</a>
                    </div>
                    <div class="col-6 col-md-1 mb-2 mb-lg-0">
                        <!-- detalle_mov_caja.pdf', $registro->slug -->
                        <a target="_blank" href="{{ route('detalle_mov_caja.pdf', $registro->slug) }}" class="btn border-dark text-dark btn-sm w-100" data-bs-toggle="tooltip" data-bs-placement="top" title="Imprimir reporte en PDF"> <i class="bi bi-file-earmark-pdf-fill me-2"></i>PDF</a>
                    </div>
                </div>
                <div class="table-responsive mt-0 mt-md-3">
                    <table id="" class="display table table-hover table-sm py-2 text-center" cellspacing="0" style="width:100%">
                        <thead class="bg-light">
                            <tr>
                                <th class="h6 text-uppercase fw-bold small">N°</th>
                                <th class="h6 text-uppercase fw-bold small">MOTIVO</th>
                                <th class="h6 text-uppercase fw-bold small">ASUNTO</th>
                                <th class="h6 text-uppercase fw-bold small">PACIENTE</th>
                                <th class="h6 text-uppercase fw-bold small">TOTAL</th>
                                <th class="h6 text-uppercase fw-bold small">MEDIO PAGO</th>
                            </tr>
                        </thead>
                            <tbody> 
                                @php
                                    $contador = 1;
                                @endphp         
                                @foreach ($detall_registro as $detall_registros)
                                    <tr class="">
                                        <td class="fw-normal align-middle">{{ $contador }}</td>
                                        <td class="fw-normal align-middle small text-uppercase">{{ $detall_registros->motivo }}</td>
                                        <td class="fw-normal align-middle">{{ $detall_registros->asunto }}</td>
                                        <td class="fw-normal align-middle">{{ $detall_registros->paciente }}</td>
                                        @if($detall_registros->operaciones == 'PAGO')
                                            <td class="fw-normal align-middle text-danger">
                                                <i class="bi bi-arrow-down-short me-1"></i>
                                                {{ number_format($detall_registros->total, 2, '.', ',') }}
                                            </td>
                                        @else
                                            <td class="fw-normal align-middle text-success">
                                                <i class="bi bi-arrow-up-short me-1"></i>
                                                {{ number_format($detall_registros->total, 2, '.', ',') }}
                                            </td>
                                        @endif
                                        <td class="fw-normal align-middle">{{ $detall_registros->metodo }}</td>
                                    </tr>
                                @php
                                    $contador++;
                                @endphp
                                @endforeach              
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>