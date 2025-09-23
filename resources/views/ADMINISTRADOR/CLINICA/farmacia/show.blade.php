<div class="modal fade" id="showfarmacia{{ $admin_farmacia->slug }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white py-2">
                <span class="modal-title text-uppercase small" id="staticBackdropLabel">Detalle de venta de medicamentos</span>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-6 col-md-6 col-lg-2">
                        <label for="" class="small text-uppercase bg-white px-1 ms-2"><small>Código</small></label>
                        <div class="form-control bg-white pb-0 text-center" style="margin-top: -12px; min-height: 31px">{{ $admin_farmacia->codigo }}</div>
                    </div>
                    <div class="col-6 col-md-6 col-lg-2">
                        <label for="" class="small text-uppercase bg-white px-1 ms-2"><small>Fecha</small></label>
                        <div class="form-control bg-white pb-0 text-center" style="margin-top: -12px; min-height: 31px">{{ \Carbon\Carbon::parse($admin_farmacia->fecha)->format('d-m-Y') }}</div>
                    </div>
                    <div class="col-6 col-md-6 col-lg-3">
                        <label for="" class="small text-uppercase bg-white px-1 ms-2"><small>Tipo atención</small></label>
                        <div class="form-control bg-white pb-0 text-center" style="margin-top: -12px; min-height: 31px">{{ $admin_farmacia->tipo_atencion }}</div>
                    </div>
                    <div class="col-6 col-md-6 col-lg-5">
                        <label for="" class="small text-uppercase bg-white px-1 ms-2"><small>Atención</small></label>
                        <div class="form-control bg-white pb-0 text-center" style="margin-top: -12px; min-height: 31px">{{ $admin_farmacia->atencion }}</div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-12">
                        <label for="" class="small text-uppercase bg-white px-1 ms-2"><small>Paciente</small></label>
                        <div class="form-control bg-white pb-0 text-center" style="margin-top: -12px; min-height: 31px">{{ $pacientes_value?$pacientes_value->name.' '.$pacientes_value->surnames:'General' }}</div>
                    </div>
                </div>
                <div class="table-responsive mt-3" style="min-height: 150px">
                    <table class="table table-sm table-hover w-100">
                        <thead>
                            <tr>
                                <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 5%">N°</th>
                                <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 10%">Código</th>
                                <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 45%">Descripción</th>
                                <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 10%">Unidad</th>
                                <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 10%">Cantidad</th>
                                <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 10%">Precio</th>
                                <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 10%">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @php
                                $dtt_farmacia = \App\Models\Detallefarmacia::where('farmacia_id', $admin_farmacia->id)->get();
                                $contador_dte = 1;
                            @endphp
                            @foreach($dtt_farmacia as $item_med)
                                <tr>
                                    <td class="fw-normal text-center align-middle">{{ $contador_dte }}</td>
                                    <td class="fw-normal text-center align-middle text-md-center">{{ $item_med->codigo }}</td>
                                    <td class="fw-normal text-center align-middle text-md-center">{{ $item_med->medicamento }}</td>
                                    <td class="fw-normal text-center align-middle text-md-center">{{ $item_med->umedida }}</td>
                                    <td class="fw-normal text-center align-middle text-md-center">{{ $item_med->cantidad }}</td>
                                    <td class="fw-normal text-center align-middle text-md-center">{{ number_format($item_med->precio, 2,'.',',') }}</td>
                                    <td class="fw-normal text-center align-middle text-md-center">{{ number_format($item_med->subtotal, 2,'.',',') }}</td>
                                </tr>
                                @php
                                    $contador_dte++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row mt-3 d-flex justify-content-end">
                    <div class="col-12 col-md-5">
                        <table class="w-100">
                            <tr>
                                <td class="border-0 ps-2 py-1 bg-light" style="width: 50%">
                                    Subtotal
                                </td>
                                <td class="border-0 pe-2 py-1 bg-light" style="width: 50%">
                                    <div class="clearfix">
                                        <span class="float-start ps-2">S/ </span>
                                        <span class="float-end"">
                                            {{ number_format($admin_farmacia->subtotal, 2,'.',',') }}
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="border-0 ps-2 py-1" style="width: 50%">
                                    I.G.V.
                                </td>
                                <td class="border-0 pe-2 py-1" style="width: 50%">
                                    <div class="clearfix">
                                        <span class="float-start ps-2">S/ </span>
                                        <span class="float-end"">
                                            {{ number_format($admin_farmacia->igv, 2,'.',',') }}
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="border-0 fw-bold ps-2 py-1 bg-light" style="width: 50%">
                                    TOTAL
                                </td>
                                <td class="border-0 fw-bold pe-2 py-1 bg-light" style="width: 50%">
                                    <div class="clearfix">
                                        <span class="float-start ps-2">S/ </span>
                                        <span class="float-end">
                                            {{ number_format($admin_farmacia->total, 2,'.',',') }}
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>