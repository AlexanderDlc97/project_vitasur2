<div class="modal fade" id="show_diagnostico{{ $admin_diagnostico->slug }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white py-2">
                <span class="modal-title text-uppercase small" id="staticBackdropLabel">Diagnósticos</span>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-1">
                        <p class="fw-bold text-uppercase">{{ $admin_diagnostico->codigo }}</p>
                    </div>
                    <div class="col-11">
                        <p class="text-uppercase">{{ $admin_diagnostico->name }}</p>
                    </div>
                </div>
                <table id="display" class="table table-hover table-sm py-2 text-start text-md-center" cellspacing="0" style="width:100%">
                    <thead class="bg-light">
                        <tr>
                            <th class="h6 text-uppercase fw-bold small">N°</th>
                            <th class="h6 text-uppercase fw-bold small">Código</th>
                            <th class="h6 text-uppercase fw-bold small">Diagnóstico</th>
                            <th class="h6 text-uppercase fw-bold small">Estado</th>
                        </tr>
                    </thead>
                    @php
                        $contador_d = 1;
                    @endphp
                    @foreach($admin_diagnostico->diagnosticos as $item) 
                        <tr>
                            <td class="fw-normal align-middle">{{ $contador_d }}</td>
                            <td class="fw-normal align-middle">{{ $item->codigo }}</td>
                            <td class="fw-normal align-middle">	{{ $item->name }}</td>
                            <td class="fw-normal align-middle">
                                <span class="badge bg-success small text-uppercase">{{ $item->estado }}</span>
                            </td>
                        </tr>
                        @php
                            $contador_d++;
                        @endphp
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>