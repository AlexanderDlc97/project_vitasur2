<div class="modal fade" id="createcuentabancaria" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-secondary text-white py-2">
                <span class="modal-title text-uppercase small" id="staticBackdropLabel">Nueva cuenta bancaria</span>
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
                <form method="POST" action="/admin-cuentas-bancarias" autocomplete="off" class="needs-validation" novalidate>            
                    @csrf
                    <div class="mb-3">
                        <label for="name_id" class="">Nombre<span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name_id" value="{{ old('name') }}" class="form-control form-control-sm @error('name') is-invalid @enderror" required maxLength="100">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>  
                    <div class="mb-3">
                        <label for="tipos__id" class="">Tipo de cuenta<span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm @error('tipocuenta_id') is-invalid @enderror" name="tipocuenta_id" id="tipos__id" required>
                            <option selected="selected" hidden="hidden">{{ old('tipocuenta_id') }}</option>
                            @foreach($tipo_cuentas as $tipo_cuenta)
                                <option value="{{ $tipo_cuenta->id }}">{{ $tipo_cuenta->name }}</option>
                            @endforeach
                        </select>
                            @error('tipocuenta_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                    </div> 
                    <div class="mb-3">
                        <label for="banco__id" class="">Banco<span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm @error('banco_id') is-invalid @enderror" name="banco_id" id="banco__id" required>
                            <option selected="selected" hidden="hidden">{{ old('banco_id') }}</option>
                            @foreach($bancos as $banco)
                                <option value="{{ $banco->id }}">{{ $banco->name }}</option>
                            @endforeach
                        </select>
                            @error('banco_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nro_cuenta_id" class="">Nro de cuenta<span class="text-danger">*</span></label>
                        <input type="number" name="nro_cuenta" id="nro_cuenta" value="{{ old('nro_cuenta') }}" required class="form-control form-control-sm @error('nro_cuenta') is-invalid @enderror" maxLength="100">
                        @error('nro_cuenta')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>  

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <label for="nro_cuenta_cci" class="">Nro de cuenta CCI<span class="text-danger">*</span></label>
                                <input type="text" name="nro_cuenta_cci" id="nro_cuenta_cci" value="{{ old('nro_cuenta_cci') }}" required class="form-control form-control-sm @error('nro_cuenta_cci') is-invalid @enderror" maxLength="100">
                                @error('nro_cuenta_cci')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="apertura" class="">Apertura de cuenta<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text text-danger" style="height:31px"><label></label><label class="fs-6">S/.</label></span>
                                    <input type="number" step="0.05" name="apertura_cuenta" id="apertura" value="{{ old('apertura_cuenta') }}" required placeholder="Ingrese monto de la tarjeta" class="form-control form-control-sm @error('apertura_cuenta') is-invalid @enderror">
                                </div>
                                @error('apertura_cuenta')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>  
                    </div>  
                                            
                    <div class="text-center pt-4">
                        <button type="submit" class="btn btn-secondary text-uppercase small px-5 text-white">Registrar</button>   
                    </div>  
                </form>
            </div>
        </div>
    </div>
</div>