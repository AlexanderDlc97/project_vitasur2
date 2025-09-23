<div class="modal fade" id="showcita{{ $admin_cita->slug }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white py-2">
                <span class="modal-title text-uppercase small" id="staticBackdropLabel">Detalle de citas</span>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-12 col-md-4 col-lg-3">
                        <label for="" class="small text-uppercase bg-white px-1 ms-2"><small>Código</small></label>
                        <div class="form-control bg-white pb-0 text-center" style="margin-top: -12px; min-height: 31px">{{ $admin_cita->codigo }}</div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-3">
                        <label for="" class="small text-uppercase bg-white px-1 ms-2"><small>Fecha</small></label>
                        <div class="form-control bg-white pb-0 text-center" style="margin-top: -12px; min-height: 31px">{{ $admin_cita->fecha }}</div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-3">
                        <label for="" class="small text-uppercase bg-white px-1 ms-2"><small>Hora</small></label>
                        <div class="form-control bg-white pb-0 text-center" style="margin-top: -12px; min-height: 31px">{{ $admin_cita->hora }}</div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-3">
                        <label for="" class="small text-uppercase bg-white px-1 ms-2"><small>Duración</small></label>
                        <div class="form-control bg-white pb-0 text-center" style="margin-top: -12px; min-height: 31px">{{ $admin_cita->duracion }} Min.</div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-4">
                        <label for="" class="small text-uppercase bg-white px-1 ms-2"><small>Paciente</small></label>
                        <div class="form-control bg-white pb-0 text-center" style="margin-top: -12px; min-height: 31px">{{ $admin_cita->paciente->persona->name }}</div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-4">
                        <label for="" class="small text-uppercase bg-white px-1 ms-2"><small>Especialidad</small></label>
                        <div class="form-control bg-white pb-0 text-center" style="margin-top: -12px; min-height: 31px">{{ $admin_cita->especialidad->name }}</div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-4">
                        <label for="" class="small text-uppercase bg-white px-1 ms-2"><small>Profesional</small></label>
                        <div class="form-control bg-white pb-0 text-center" style="margin-top: -12px; min-height: 31px">{{ $admin_cita->medico->persona->name }}</div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-12">
                        <label for="" class="small text-uppercase bg-white px-1 ms-2"><small>Descripción</small></label>
                        <div class="form-control bg-white pb-0 text-center" style="margin-top: -12px; min-height: 31px">{!! $admin_cita->descripcion !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>