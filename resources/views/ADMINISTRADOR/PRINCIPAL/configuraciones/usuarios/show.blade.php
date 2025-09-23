<div class="modal fade" id="showmedico{{ $admin_usuario->persona->slug }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <div class="modal-content" style="border-radius: 20px !important">
            <div class="modal-body p-0">
                <div class="card content_user">
                    <img src="/images/header_control.jpg" class="header_user" alt="">
                    <div class="card-body text-center">
                        <div class="avatar">
                            <img src="
                            @if($admin_usuario->persona->imagen == "NULL")
                                /images/user.jpg
                            @else
                                /images/personas/{{ $admin_usuario->persona->imagen }}
                            @endif
                            " alt="">
                        </div>
                        <div class="info_user">
                            <p class="fw-bold text-uppercase fs-5 mb-0">{{$admin_usuario->persona->name.' '.$admin_usuario->persona->surnames}}</p>
                            @if($admin_usuario->persona->tipo_persona != 'Médico')
                                    <span class="text-muted text-uppercase small">No requerido</span>
                            @else
                                @if(empty($admin_usuario->role_id))
                                    <span class="text-muted text-uppercase small">No requerido</span>
                                @else
                                    <span class="text-muted text-uppercase small">{{$admin_usuario->role->name}}</span>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card border-0">
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-3">
                                <div class="clearfix">
                                    <span class="float-start fw-bold text-uppercase small">{{$admin_usuario->persona->identificacion}}</span>
                                    <span class="float-end fw-bold text-uppercase small">:</span>

                                </div>
                            </div>
                            <div class="col-3">
                                {{ $admin_usuario->persona->nro_identificacion }}
                            </div>
                            <div class="col-3">
                                <div class="clearfix">
                                    <span class="float-start fw-bold text-uppercase small">Contacto</span>
                                    <span class="float-end fw-bold text-uppercase small">:</span>
                                </div>
                            </div>
                            <div class="col-3">
                                <a href="tel:{{$admin_usuario->nro_contacto}}">{{$admin_usuario->persona->nro_contacto}}</a>
                            </div>
                            <div class="col-3">
                                <div class="clearfix">
                                    <span class="float-start fw-bold text-uppercase small">Fecha de Nac.</span>
                                    <span class="float-end fw-bold text-uppercase small">:</span>
                                </div>
                            </div>
                            <div class="col-3">
                                {{ \Carbon\Carbon::parse($admin_usuario->persona->fecha_nacimiento)->format('d-m-Y') }}
                            </div>
                            <div class="col-3">
                                <div class="clearfix">
                                    <span class="float-start fw-bold text-uppercase small">Sexo</span>
                                    <span class="float-end fw-bold text-uppercase small">:</span>
                                </div>
                            </div>
                            <div class="col-3">
                                {{$admin_usuario->persona->sexo}}
                            </div>
                            <div class="col-3">
                                <div class="clearfix">
                                    <span class="float-start fw-bold text-uppercase small">Estado civil</span>
                                    <span class="float-end fw-bold text-uppercase small">:</span>
                                </div>
                            </div>
                            <div class="col-3">
                                {{$admin_usuario->persona->estado_civil}}
                            </div>
                            <div class="col-3">
                                <div class="clearfix">
                                    <span class="float-start fw-bold text-uppercase small">Estado</span>
                                    <span class="float-end fw-bold text-uppercase small">:</span>
                                </div>
                            </div>
                            <div class="col-3">
                                @if($admin_usuario->estado == 'Activo')
                                    <span class="badge text-uppercase small bg-success border-0">{{$admin_usuario->estado}}</button>
                                @elseif($admin_usuario->estado == 'Inactivo')
                                    <span class="badge text-uppercase small bg-danger border-0">{{$admin_usuario->estado}}</button>
                                @else
                                    <span class="badge text-uppercase small bg-light border-0">{{$admin_usuario->estado}}</span>
                                @endif
                            </div>
                            <div class="col-3">
                                <div class="clearfix">
                                    <span class="float-start fw-bold text-uppercase small">Dirección</span>
                                    <span class="float-end fw-bold text-uppercase small">:</span>
                                </div>
                            </div>
                            <div class="col-9">
                                {{$admin_usuario->persona->direccion}}
                            </div>
                            
                            <div class="col-3">
                                <div class="clearfix">
                                    <span class="float-start fw-bold text-uppercase small">Email</span>
                                    <span class="float-end fw-bold text-uppercase small">:</span>
                                </div>
                            </div>
                            <div class="col-9">
                                @if(empty($admin_usuario->email))
                                    <span class="text-muted text-uppercase small">No requerido</span>
                                @else
                                    <a href="mailto:{{$admin_usuario->email}}">{{$admin_usuario->email}}</a>
                                @endif
                            </div>
                            <div class="col-3">
                                <div class="clearfix">
                                    <span class="float-start fw-bold text-uppercase small">Rol</span>
                                    <span class="float-end fw-bold text-uppercase small">:</span>
                                </div>
                            </div>
                            <div class="col-9">
                                @if($admin_usuario->persona->tipo_persona != 'Médico')
                                    <span class="text-muted text-uppercase small">No requerido</span>
                                @else
                                    @if(empty($admin_usuario->role_id))
                                        <span class="text-muted text-uppercase small">No requerido</span>
                                    @else
                                        <span class="text-muted text-uppercase small">{{$admin_usuario->role->name}}</span>
                                    @endif
                                @endif
                            </div>
                            
                        </div>
                    </div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 318"><path fill="#065892" fill-opacity="1" d="M0,288L120,293.3C240,299,480,309,720,298.7C960,288,1200,256,1320,240L1440,224L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path></svg>
                <div class="bg-primary text-end px-3 pb-3">
                    <div class="row">
                        <div class="col-6 d-flex">
                            <span class="text-white align-self-center" style="font-size: 11px"><b>CLÍNICA VITASUR</b></span>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('admin-usuarios.edit',$admin_usuario->persona->slug) }}" class="btn btn-sm border-white text-white rounded rounded-pill"><i class="bi bi-pencil-square me-2"></i>Editar</a>
                            <button type="button" class="btn btn-sm border-white text-white rounded-pill" data-bs-dismiss="modal"><i class="bi bi-x-circle me-2"></i>Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>