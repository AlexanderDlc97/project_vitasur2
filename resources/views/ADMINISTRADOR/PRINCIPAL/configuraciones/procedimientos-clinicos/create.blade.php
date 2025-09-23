<form method="POST" action="{{ route('admin-procedimientosclinicos.store') }}" enctype="multipart/form-data" autocomplete="off" class="needs-validation" novalidate>      
    @csrf    
    <div class="modal fade" id="createprocedimientos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                    <div class="mb-2">
                        <label for="tipo_id">Tipo<span class="text-danger">*</span></label>
                        <select name="tipo" id="tipo_id" class="form-select select2_bootstrap_2" data-placeholder="Seleccione" required>
                            <option value="{{ old('tipo') }}" selected="selected" hidden="hidden">{{ old('tipo') }}</option>
                                <option value="Ecografia">ECOGRAFIA</option>
                                <option value="Rayos x">RAYOS X</option>
                                <option value="Atencion ambulatoria">ATENCION AMBULATORIA</option>
                        </select>
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="name_id">Nombre<span class="text-danger">*</span></label>
                        <input name="name" id="name_id" type="text" class="form-control" value="{{ old('name') }}" required>
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="costo__id">Costo</label>
                        <input name="costo" id="costo__id" type="decimal" class="form-control" value="{{ old('costo') }}" required>
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary text-uppercase small px-5 text-white">Registrar</button>   
                </div>
            </div>
        </div>
    </div>
</form>