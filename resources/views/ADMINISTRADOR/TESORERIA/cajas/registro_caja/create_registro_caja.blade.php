<div class="modal fade" id="create_registro_caja" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-secondary text-white py-2">
                <span class="modal-title text-uppercase small" id="staticBackdropLabel">APERTURA DE CAJA -
                    20230402001</span>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span class="text-danger">* <small class="text-muted py-0 my-0 text-start"> - Campos
                        obligatorios</small></span>
                <form method="POST" action="/admin-caja">
                    @csrf
                    <div class="py-1 clearfix">
                        <span class="float-start">
                            <label for="name_id" class=" text-uppercase">Caja<span
                                    class="text-danger">*</span></label>
                        </span>
                        <span class="float-end">
                            <input type="text" name="name" id="name_id" value="{{ $admin_caja->name_caja }}" disabled class="bg-white disabled form-control fw-light form-control-sm" maxLength="100">
                            <input type="text" hidden name="sede_id" value="{{ $admin_caja->sede_id }}">
                        </span>
                    </div>

                    <div class="py-1">
                        <label for="name_id" class=" text-uppercase">Fecha - Hora apertura<span
                                class="text-danger">*</span></label>
                        <div class="input-group input-group-sm">
                            <input type="date" name="fecha_apertura" id="" required value="{{ $fecha }}"
                                class="form-control">
                            @error('fecha_apertura')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <input type="time" name="hora" id=""  required value="{{ $hora }}"
                                class="form-control">
                            @error('hora')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="py-1">
                                <label for="name_id" class=" text-uppercase">Saldo Inicial<span
                                        class="text-danger">*</span></label>
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">S/</span>
                                    <input type="text" required class="form-control" name="saldo_inicial"
                                        value="{{ $admin_caja->total_cuenta_banco }}" aria-label="Sizing example input"
                                        aria-describedby="inputGroup-sizing-sm">
                                </div>
                                @error('saldo_inicial')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="py-1">
                                <label for="name_id" class=" text-uppercase">Efectivo Inicial<span
                                        class="text-danger">*</span></label>
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">S/</span>
                                    <input type="text" required class="form-control" name="total_efectivo"
                                        value="{{ $admin_caja->total_efectivo }}" aria-label="Sizing example input"
                                        aria-describedby="inputGroup-sizing-sm">
                                </div>
                                @error('total_efectivo')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="text-center pt-4">
                        <button type="submit"
                            class="btn btn-secondary text-uppercase small px-5 text-white">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
