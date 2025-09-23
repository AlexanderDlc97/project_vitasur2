<form method="POST" action="{{ route('admin-diagnosticos.store') }}" enctype="multipart/form-data" autocomplete="off" class="needs-validation" novalidate>      
    @csrf    
    <div class="modal fade" id="creatediagnosticos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white py-2">
                    <span class="modal-title text-uppercase small" id="staticBackdropLabel">Nuevo registro</span>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card border-0 rounded-0 border-start border-3 border-info mb-4" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 1px 0px; background-color: #f6f6f6">
                        <div class="card-body py-2">
                            <i class="bi bi-info-circle text-info me-2"></i>Importante:
                            <ul class="list-unstyled mb-0 pb-0">
                                <li class="mb-0 pb-0">
                                    <small class="text-muted py-0 my-0 text-start"> Se consideran campos obligatorios los campos que tengan este simbolo: <span class="text-danger">*</small></span>
                                </li>
                            </ul>
                        </div>
                    </div>   
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-4 col-xl-4">
                            <div class="mb-2">
                                <label for="name_id">Codigo<span class="text-danger">*</span></label>
                                <input name="codigo_p" id="codigo_p" type="text" class="form-control" value="{{ old('name') }}" required>
                                <div class="invalid-feedback">
                                    El campo no puede estar vacío
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-8 col-xl-8">
                            <div class="mb-2">
                                <label for="name_id">Diagnostico principal<span class="text-danger">*</span></label>
                                <input name="diag_p" id="diag_p" type="text" class="form-control" value="{{ old('name') }}" required>
                                <div class="invalid-feedback">
                                    El campo no puede estar vacío
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="fw-bold text-uppercase small text-secondary mb-1" style="font-size: 14px">Sub - diagnosticos</p>
                    <div class="row g-2">
                        <div class="col-6 col-md-4 col-lg-4 col-xl-4">
                            <label for="indicaciones__id">Codigo</label>
                            <input type="text" id="codigo_s" class="form-control form-control-sm">
                        </div>
                        <div class="col-6 col-md-7 col-lg-7 col-xl-7">
                            <label for="indicaciones__id">Diagnostico Secundario</label>
                            <input type="text" id="diag_s" class="form-control form-control-sm">
                        </div>
                        <div class="col-12 col-md-1">
                            <label for="agre" class="d-block text-white">..</label>
                            <button type="button" id="btnasignar_dx" class="btn btn-grey btn-sm w-100 align-bottom mt-2 mt-md-0">
                                <i class="bi bi-plus-circle"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="table-responsive mt-3" style="min-height: 150px">
                        <table class="table table-sm table-hover w-100">
                            <thead>
                                <tr>
                                    <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 5%">N°</th>
                                    <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 10%">Código</th>
                                    <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 30%">Descripción</th>
                                    <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 5%"></th>
                                </tr>
                            </thead>
                            <tbody id="dt_dx" class="text-center">
                            </tbody>
                        </table>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary text-uppercase small px-5 text-white">Registrar</button>   
                </div>
            </div>
        </div>
    </div>
</form>