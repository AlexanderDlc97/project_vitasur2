
<div class="modal fade" id="edit_especialidad{{ $admin_especialidade->slug }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white py-2">
                <span class="modal-title text-uppercase small" id="staticBackdropLabel">Actualizar registro</span>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="POST" action="{{ route('admin-especialidades.update', $admin_especialidade->slug) }}" enctype="multipart/form-data" autocomplete="off" class="needs-validation" novalidate>      
                @csrf    
                @method('put')
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
                        <label for="profesione_id">Profesion<span class="text-danger">*</span></label>
                        <select name="profesione_id" id="profesione_id" class="form-select select2_bootstrap_2" data-placeholder="Seleccione" required>
                            <option value="{{$admin_especialidade->profesione_id}}" selected="selected" hidden="hidden">{{$admin_especialidade->profesione->name}}</option>
                            @foreach ($admin_profesione as $profesiones)
                                <option value="{{$profesiones->id}}">{{$profesiones->name}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>    
                    <div class="mb-2">
                        <label for="name__id">Nombre<span class="text-danger">*</span></label>
                        <input name="name" value="{{ $admin_especialidade->name }}" id="name__id" type="text" class="form-control" required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="costo__id">Costo</label>
                        <input name="costo" id="costo__id" type="decimal" class="form-control" value="{{ $admin_especialidade->costo }}">
                        <div class="invalid-feedback">
                            El campo no puede estar vacío
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary text-uppercase small px-5 text-white">Actualizar</button>   
                </div>
            </form>
        </div>
    </div>
</div>