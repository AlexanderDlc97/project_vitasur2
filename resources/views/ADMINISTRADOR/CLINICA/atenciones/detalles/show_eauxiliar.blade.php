<div class="card border-0">
    <div class="card-body">
        @php
            $eauxiliar = \App\Models\Eauxiliar::where('atencion_id', $admin_atencione->id)->first();
        @endphp
        <div class="row">
            <div class="col-12 col-lg-2">
                <div class="clearfix">
                    <span class="float-start fw-bold small text-muted" style="font-size: 13px">Nro. Solicitud</span>
                    <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                </div>
            </div>
            <div class="col-12 col-lg-6" id="nsolicitud_eauxiliar">
                {{ $eauxiliar?'EA'.$eauxiliar->nro_solicitud:'' }}
            </div>
            <input hidden name="nro_solicitud" id="nsolicitud_eauxiliar_value">
            <div class="col-12 col-lg-2">
                <div class="clearfix">
                    <span class="float-start fw-bold small text-muted" style="font-size: 13px">Fecha</span>
                    <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                </div>
            </div>
            <div class="col-12 col-lg-2">
                <input class="form-control" value="{{ \Carbon\Carbon::parse($eauxiliar?$eauxiliar->fecha:'')->format('d-m-Y') }}">
            </div>
        </div>
        <p class="fw-bold text-uppercase small text-secondary mb-1" style="font-size: 14px">Examenes Auxiliares Solicitados</p>
        <div class="table-responsive mt-3" style="min-height: 150px">
            <table class="table table-sm table-hover w-100">
                <thead>
                    <tr>
                        <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 5%">N°</th>
                        <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 30%">Analisis</th>
                        <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 30%">Tipo de Analisis</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @php
                    $contador_eauxil = 1;
                    $dtlleauxiliares = \App\Models\Detalleeauxiliar::where('eauxiliares_id', $eauxiliar?$eauxiliar->id:'')->get();
                @endphp
                @foreach($dtlleauxiliares as $item_med)
                    <tr>
                        <td class="fw-normal text-center align-middle text-md-center">{{ $contador_eauxil }}</td>
                        <td class="fw-normal text-center align-middle text-md-center">{{ $item_med->analisis }}</td>
                        <td class="fw-normal text-center align-middle text-md-center">{{ $item_med->t_analisis}}</td>
                    </tr>
                    @php
                        $contador_eauxil++;
                    @endphp
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>