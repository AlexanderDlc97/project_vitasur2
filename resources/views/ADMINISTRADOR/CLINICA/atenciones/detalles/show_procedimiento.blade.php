<div class="card border-0">
    <div class="card-body">
        @php
            $procedimiento = \App\Models\Procedimiento::where('atencion_id', $admin_atencione->id)->first();
        @endphp
        <div class="row g-2 mb-3">
            <div class="col-12 col-md-4 col-lg-3">
                <label for="registro_dolor__id">Registro de dolor</label>
                <input class="form-control form-control-sm bg-transparent" disabled value="{{ $procedimiento?$procedimiento->registro_dolor:'' }}">
            </div>
            <div class="col-12 col-md-8 col-lg-9">
                <div class="form-control" style="min-height: 100px">{{ $procedimiento?$procedimiento->detalle_registro_dolor:'' }}</div>
            </div>
        </div>
        <!-- <div class="mb-3">
            <p class="fw-bold text-uppercase small text-secondary mb-1" style="font-size: 14px">Plan de trabajo/Comentario y/o Observaciones</p>
            <div class="form-control" style="min-height: 100px">{{ $procedimiento?$procedimiento->plan_trabajo:'' }}</div>
        </div> -->
        <div class="mb-3">
            <p class="fw-bold text-uppercase small text-secondary mb-1" style="font-size: 14px">Diagnóstico</p>
            <div class="table-responsive mt-3" style="min-height: 150px">
                <table class="table table-sm table-hover w-100">
                    <thead>
                        <tr>
                            <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 5%">N°</th>
                            <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 10%">Código</th>
                            <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 50%">Descripción Diagnóstico</th>
                            <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 10%">Tipo</th>
                            <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 10%">Caso</th>
                            <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 10%">Alta</th>
                        </tr>
                    </thead>
                    <form method="post" id="formulario">
                        <tbody class="text-center">
                            @php
                                $contador_prod = 1;
                                $diagnosticos = \App\Models\Diagnosticoprocedimiento::where('procedimiento_id', $procedimiento?$procedimiento->id:'')->get();
                            @endphp
                            @foreach($diagnosticos as $item_diagnostico)
                                <tr>
                                    <td class="fw-normal text-center align-middle text-md-center">{{ $contador_prod }}</td>
                                    <td class="fw-normal text-center align-middle text-md-center">{{ $item_diagnostico->diagnostico->codigo }}</td>
                                    <td class="fw-normal text-center align-middle text-md-center">{{ $item_diagnostico->diagnostico->name }}</td>
                                    <td class="fw-normal text-center align-middle text-md-center">{{ $item_diagnostico->tipo }}</td>
                                    <td class="fw-normal text-center align-middle text-md-center">{{ $item_diagnostico->caso }}</td>
                                    <td class="fw-normal text-center align-middle text-md-center">{{ $item_diagnostico->alta }}</td>
                                </tr>
                                @php
                                    $contador_prod++;
                                @endphp
                            @endforeach
                        </tbody>
                    </form>
                </table>
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-12 col-lg-2 d-flex">
                <div class="clearfix align-self-center w-100">
                    <span class="float-start fw-bold small text-muted" style="font-size: 13px">Información adicional</span>
                    <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                </div>
            </div>
            <div class="col-12 col-lg-10">
                <div class="form-control" style="min-height: 100px">{{ $procedimiento?$procedimiento->informacion_adicional:'' }}</div>
            </div>
            <!-- <div class="col-12 col-lg-2 d-flex">
                <div class="clearfix align-self-center w-100">
                    <span class="float-start fw-bold small text-muted" style="font-size: 13px">Resultado Atención</span>
                    <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                </div>
            </div>
            <div class="col-12 col-lg-2">
                <input class="form-control" value="{{ $procedimiento?$procedimiento->resultado_atencion:'' }}">
            </div> -->
        </div> 
    </div>
</div>
