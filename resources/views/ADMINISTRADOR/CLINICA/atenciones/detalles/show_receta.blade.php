<div class="card border-0">
    <div class="card-body">
        @php
            $receta = \App\Models\Receta::where('atencion_id', $admin_atencione->id)->first();
        @endphp
        <div class="row">
            <div class="col-12 col-lg-2">
                <div class="clearfix">
                    <span class="float-start fw-bold small text-muted" style="font-size: 13px">Nro. Solicitud</span>
                    <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                </div>
            </div>
            <div class="col-12 col-lg-6" id="nsolicitud_receta">
                {{ $receta?'R'.$receta->nro_solicitud:'' }}
            </div>
            <input hidden name="nro_solicitud" id="nsolicitud_receta_value">
            <div class="col-12 col-lg-2">
                <div class="clearfix">
                    <span class="float-start fw-bold small text-muted" style="font-size: 13px">Fecha</span>
                    <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                </div>
            </div>
            <div class="col-12 col-lg-2">
                <input class="form-control" value="{{ \Carbon\Carbon::parse($receta?$receta->fecha:'')->format('d-m-Y') }}">
            </div>
        </div>
        <p class="fw-bold text-uppercase small text-secondary mb-1" style="font-size: 14px">Medicamentos recetados</p>
        <div class="table-responsive mt-3" style="min-height: 150px">
            <table class="table table-sm table-hover w-100">
                <thead>
                    <tr>
                        <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 5%">N°</th>
                        <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 10%">Código</th>
                        <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 30%">Descripción</th>
                        <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 5%">Unidad</th>
                        <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 5%">Vía</th>
                        <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 10%">Cantidad</th>
                        <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 30%">Indicaciones</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @php
                    $contador_rec = 1;
                    $medicamentos = \App\Models\Medicamentoreceta::where('receta_id', $receta?$receta->id:'')->get();
                @endphp
                @foreach($medicamentos as $item_med)
                    <tr>
                        <td class="fw-normal text-center align-middle text-md-center">{{ $contador_rec }}</td>
                        <td class="fw-normal text-center align-middle text-md-center">{{ $item_med->producto->codigo }}</td>
                        <td class="fw-normal text-center align-middle text-md-center">{{ $item_med->producto->name }}</td>
                        <td class="fw-normal text-center align-middle text-md-center">{{ $item_med->producto->unidad_medida }}</td>
                        <td class="fw-normal text-center align-middle text-md-center">{{ $item_med->via }}</td>
                        <td class="fw-normal text-center align-middle text-md-center">{{ $item_med->cantidad }}</td>
                        <td class="fw-normal text-center align-middle text-md-center">{{ $item_med->indicaciones }}</td>
                    </tr>
                    @php
                        $contador_rec++;
                    @endphp
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-12 col-lg-2 d-flex">
                <div class="clearfix align-self-center w-100">
                    <span class="float-start fw-bold small text-muted" style="font-size: 13px">Información adicional</span>
                    <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                </div>
            </div>
            <div class="col-12 col-lg-10">
                <div class="form-control" style="min-height: 100px">{{ $receta?$receta->informacion_adicionales:'' }}</div>
            </div>
        </div>
    </div>
</div>