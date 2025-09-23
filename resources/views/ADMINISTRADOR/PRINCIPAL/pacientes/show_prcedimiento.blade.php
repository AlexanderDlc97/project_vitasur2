<div class="modal fade" id="registro_procedimiento_ambulatorio" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white py-2">
                <span class="modal-title text-uppercase small" id="staticBackdropLabel">REGISTRO DE PROCEDIMIENTOS AMBULATORIOS</span>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @php
                    $detall_registro_procedi = DB::table('imagenologias')->select('imagenologias.*')->where('imagenologias.paciente',$admin_paciente->name.' '.$admin_paciente->surnames)->get();
                @endphp 
                <div class="row g-1">
                    <div class="col-12 col-md-6 mb-2 mb-lg-0">
                        <span class="text-uppercase">Total de registros encontrados: <span class="fw-bold" id="contador_registro">{{ $detall_registro_procedi->count() }}</span></span>
                    </div>
                    <div class="col-12 col-md-4"></div>
                </div>
                <div class="table-responsive mt-0 mt-md-3">
                    <table id="" class="display table table-hover table-sm py-2 text-center" cellspacing="0" style="width:100%">
                        <thead class="bg-light">
                            <tr>
                                <th class="h6 text-uppercase fw-bold small">N°</th>
                                <th class="h6 text-uppercase fw-bold small">MOTIVO</th>
                                <th class="h6 text-uppercase fw-bold small">FECHA</th>
                                <th class="h6 text-uppercase fw-bold small">IMAGENOLOGIA</th>
                            </tr>
                        </thead>
                            <tbody> 
                                @php
                                    $contador = 1;
                                @endphp         
                                @foreach ($detall_registro_procedi as $admin_imagenologia)
                                    <tr class="">
                                        <td class="fw-normal align-middle">{{ $contador }}</td>
                                        <td class="fw-normal align-middle small text-uppercase">{{ $admin_imagenologia->motivo }}</td>
                                        <td class="fw-normal align-middle">{{ $admin_imagenologia->created_at }}</td>
                                        <td><a href="/admin-pacientes/showimagenologia/{{ $admin_imagenologia->slug }}" class="btn btn-sm btn-grey" ><i class="bi bi-heart-pulse-fill"></i></a>
                                        @if($admin_imagenologia->descripcion_imagenologia) 
                                            <a target="blank" href="{{route('admin-imagenologia.pdf',$admin_imagenologia->slug)}}" class="btn btn-sm btn-warning"><i class="bi bi-download me-2"></i>Descargar Img.</a></td>
                                        @else                                        
                                        @endif
                                    </tr>
                                @php
                                    $contador++;
                                @endphp
                                @endforeach              
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>