@extends('TEMPLATE.administrador')

@section('title', 'ATENCIONES')

@section('css')
<style>
    .img_paciente{
        width: 100%; height: 90px;
    }

    @media (max-width: 992px) {
        .img_paciente{
            width: 150px; height: 150px;
        }
    }
</style>
@endsection
 
@section('content')
<!-- Encabezado -->
    <div class="header_section">
        <div class="bg-transparent mb-3" style="height: 67px"></div>
        <div class="container-fluid">
            <div class="" data-aos="fade-right">
                <h1 class="titulo h2 text-uppercase fw-bold mb-0">ATENCIONES</h1>
                <div class="" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="">Clínica</a></li>
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="{{ url('admin-atenciones') }}">Atenciones</a></li>
                        <li class="breadcrumb-item link" aria-current="page">{{ $admin_atencione->codigo }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
<!-- Fin encabezado-->

{{-- Contenido --}}
<div class="container-fluid">   
    <div class="card border-4 borde-top-primary shadow-sm h-100" style="border-radius: 20px; min-height: 500px" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
        <input hidden id="atenciones_id" value="{{$admin_atencione->id}}">
        <div class="card-body">
            <div class="datos_paciente mb-3">
                <label for="" class="text-uppercase bg-white px-2 ms-3 fw-bold">Datos del paciente</label>
                <div class="form-control border-primary" style="margin-top: -12px; min-height: 31px">
                    <div class="row g-2 mt-1">
                        <div class="col-12 col-md-3 col-lg-1 order-1 order-md-2">
                            <p class="mb-0 text-center">
                                <img src="
                                @if($admin_atencione->paciente->persona->imagen == "NULL")
                                    /images/user.jpg
                                @else
                                    /images/personas/{{ $admin_atencione->paciente->persona->imagen }}
                                @endif
                                " class="rounded img_paciente" alt="">
                            </p>
                            <p class="mb-0 text-center">
                                <span class="badge bg-success text-uppercase small">Activo</span>
                            </p>
                            
                        </div>
                        <div class="col-12 col-md-9 col-lg-11 order-2 order-md-1">
                            <div class="row">
                                <div class="col-12 col-lg-2">
                                    <div class="clearfix">
                                        <span class="float-start fw-bold text-uppercase small text-muted" style="font-size: 12px">Nombres y Apellidos</span>
                                        <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    {{ $admin_atencione->paciente->persona->name. ' ' .$admin_atencione->paciente->persona->surnames }}
                                </div>
                                <div class="col-12 col-lg-2">
                                    <div class="clearfix">
                                        <span class="float-start fw-bold text-uppercase small text-muted" style="font-size: 12px">Identificación</span>
                                        <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-2">
                                    {{ $admin_atencione->paciente->persona->identificacion. ' - ' .$admin_atencione->paciente->persona->nro_identificacion }}
                                </div>
                                <div class="col-12 col-lg-2">
                                    <div class="clearfix">
                                        <span class="float-start fw-bold text-uppercase small text-muted" style="font-size: 12px">Dirección</span>
                                        <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    {{ $admin_atencione->paciente->persona->direccion }}
                                </div>
                                <div class="col-12 col-lg-2">
                                    <div class="clearfix">
                                        <span class="float-start fw-bold text-uppercase small text-muted" style="font-size: 12px">Contacto</span>
                                        <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-2">
                                    {{ $admin_atencione->paciente->persona->nro_contacto }}
                                </div>
                                <div class="col-12 col-lg-2">
                                    <div class="clearfix">
                                        <span class="float-start fw-bold text-uppercase small text-muted" style="font-size: 12px">Responsable</span>
                                        <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    {{ $admin_atencione->paciente->responsable }}
                                </div>
                                <div class="col-12 col-lg-2">
                                    <div class="clearfix">
                                        <span class="float-start fw-bold text-uppercase small text-muted" style="font-size: 12px">Historia Clínica</span>
                                        <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-2">
                                    {{ $admin_atencione->paciente->historia_clinica }}
                                </div>
                                <div class="col-12 col-lg-2">
                                    <div class="clearfix">
                                        <span class="float-start fw-bold text-uppercase small text-muted" style="font-size: 12px">Estado civil</span>
                                        <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    {{ $admin_atencione->paciente->persona->estado_civil }}
                                </div>
                                <div class="col-12 col-lg-2">
                                    <div class="clearfix">
                                        <span class="float-start fw-bold text-uppercase small text-muted" style="font-size: 12px">Sexo</span>
                                        <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-2">
                                    {{ $admin_atencione->paciente->persona->sexo }}
                                </div>
                                <div class="col-12 col-lg-2">
                                    <div class="clearfix">
                                        <span class="float-start fw-bold text-uppercase small text-muted" style="font-size: 12px">Ocupación</span>
                                        <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    {{ $admin_atencione->paciente->ocupacion }}
                                </div>
                                <div class="col-12 col-lg-2">
                                    <div class="clearfix">
                                        <span class="float-start fw-bold text-uppercase small text-muted" style="font-size: 12px">F. N.</span>
                                        <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-2">
                                    @if(empty($admin_atencione->paciente->persona->fecha_nacimiento))
                                        --
                                    @else
                                        {{ \Carbon\Carbon::parse($admin_atencione->paciente->persona->fecha_nacimiento)->format('d-m-Y').' - ('.$edad.' años)'}}
                                    @endif
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="atención mb-3">
                <label for="" class="text-uppercase bg-white px-2 ms-3 fw-bold">Acto Médico</label>
                <div class="form-control border-primary" style="margin-top: -12px; min-height: 31px">
                    <div class="row g-2 mt-1">
                        <div class="col-12 col-md-9 col-lg-11">
                            <div class="row">
                                <div class="col-12 col-lg-2">
                                    <div class="clearfix">
                                        <span class="float-start fw-bold text-uppercase small text-muted" style="font-size: 12px">Código</span>
                                        <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    {{ $admin_atencione->codigo }}
                                </div>
                                <div class="col-12 col-lg-2">
                                    <div class="clearfix">
                                        <span class="float-start fw-bold text-uppercase small text-muted" style="font-size: 12px">Tipo</span>
                                        <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-2">
                                    {{ $admin_atencione->tipo }}
                                </div>
                                <div class="col-12 col-lg-2">
                                    <div class="clearfix">
                                        <span class="float-start fw-bold text-uppercase small text-muted" style="font-size: 12px">Especialidad</span>
                                        <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    {{ $admin_atencione->especialidad->name }}
                                </div>
                                <div class="col-12 col-lg-2">
                                    <div class="clearfix">
                                        <span class="float-start fw-bold text-uppercase small text-muted" style="font-size: 12px">Nro. Cita</span>
                                        <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-2">
                                    @if(empty($admin_atencione->cita_id))
                                        --
                                    @else
                                        {{ $admin_atencione->cita->codigo }}
                                    @endif
                                </div>
                                <div class="col-12 col-lg-2">
                                    <div class="clearfix">
                                        <span class="float-start fw-bold text-uppercase small text-muted" style="font-size: 12px">Profesional</span>
                                        <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    {{ $admin_atencione->medico->persona->name. ' ' .$admin_atencione->medico->persona->surnames }}
                                </div>
                                <div class="col-12 col-lg-2">
                                    <div class="clearfix">
                                        <span class="float-start fw-bold text-uppercase small text-muted" style="font-size: 12px">Fecha | Hora</span>
                                        <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-2">
                                    {{ \Carbon\Carbon::parse($admin_atencione->fecha)->format('d-m-Y'). ' | ' .\Carbon\Carbon::parse($admin_atencione->hora)->format('H:i') }}
                                </div>
                                <div class="col-12 col-lg-2">
                                    <div class="clearfix">
                                        <span class="float-start fw-bold text-uppercase small text-muted" style="font-size: 12px">Estado</span>
                                        <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    @if($admin_atencione->estado == 'En atención')
                                        <span class="badge text-uppercase small bg-success border-0">{{ $admin_atencione->estado }}</span>
                                    @else
                                        <span class="badge text-uppercase small bg-dark border-0">{{ $admin_atencione->estado }}</span>
                                    @endif
                                </div>
                                <div class="col-12 col-lg-2">
                                    <div class="clearfix">
                                        <span class="float-start fw-bold text-uppercase small text-muted" style="font-size: 12px">Duración</span>
                                        <span class="float-end fw-bold text-uppercase small d-none d-lg-flex">:</span>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-2">
                                    {{ $admin_atencione->duracion }} MIN.
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3 col-lg-1">                           
                        </div>
                    </div>
                </div>
            </div>

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="consulta-tab" data-bs-toggle="tab" data-bs-target="#consulta-tab-pane" type="button" role="tab" aria-controls="consulta-tab-pane" aria-selected="true">Consulta</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="procedimiento-tab" data-bs-toggle="tab" data-bs-target="#procedimiento-tab-pane" type="button" role="tab" aria-controls="procedimiento-tab-pane" aria-selected="false">Procedimiento</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="receta-tab" data-bs-toggle="tab" data-bs-target="#receta-tab-pane" type="button" role="tab" aria-controls="receta-tab-pane" aria-selected="false">Receta</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="examauxiliar-tab" data-bs-toggle="tab" data-bs-target="#examauxiliar-tab-pane" type="button" role="tab" aria-controls="examauxiliar-tab-pane" aria-selected="false">Exam. Auxiliares</button>
                </li>
                <!-- <li class="nav-item" role="presentation">
                    <button class="nav-link" id="rx-tab" data-bs-toggle="tab" data-bs-target="#rx-tab-pane" type="button" role="tab" aria-controls="rx-tab-pane" aria-selected="false">RX</button>
                </li> -->
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="consulta-tab-pane" role="tabpanel" aria-labelledby="consulta-tab" tabindex="0">
                    @if($admin_atencione->estado == 'En atención')
                        @include('ADMINISTRADOR.CLINICA.atenciones.detalles.create_consulta')
                    @else
                        @include('ADMINISTRADOR.CLINICA.atenciones.detalles.show_consulta')
                    @endif
                </div>
                <div class="tab-pane fade" id="procedimiento-tab-pane" role="tabpanel" aria-labelledby="procedimiento-tab" tabindex="0">
                    @if($admin_atencione->estado == 'En atención')
                        @include('ADMINISTRADOR.CLINICA.atenciones.detalles.create_procedimiento')
                    @else
                        @include('ADMINISTRADOR.CLINICA.atenciones.detalles.show_procedimiento')
                    @endif
                </div>
                <div class="tab-pane fade" id="receta-tab-pane" role="tabpanel" aria-labelledby="receta-tab" tabindex="0">
                    @if($admin_atencione->estado == 'En atención')
                        @include('ADMINISTRADOR.CLINICA.atenciones.detalles.create_receta')
                    @else
                        @include('ADMINISTRADOR.CLINICA.atenciones.detalles.show_receta')
                    @endif
                </div>
                <div class="tab-pane fade" id="examauxiliar-tab-pane" role="tabpanel" aria-labelledby="examauxiliar-tab" tabindex="0">
                    @if($admin_atencione->estado == 'En atención')
                        @include('ADMINISTRADOR.CLINICA.atenciones.detalles.create_eauxiliar')
                    @else
                        @include('ADMINISTRADOR.CLINICA.atenciones.detalles.show_eauxiliar')
                    @endif
                </div>
                
            </div>
        </div>
    </div>
    @php
        $validar_co = \App\Models\Consulta::where('atencion_id',$admin_atencione->id)->exists();
        $validar_inter = \App\Models\Consulta::where('atencion_id',$admin_atencione->id)->first();
        $validar_pro = \App\Models\Receta::where('atencion_id',$admin_atencione->id)->exists();
        $validar_ea = \App\Models\Eauxiliar::where('atencion_id',$admin_atencione->id)->exists();
        $validar_rx = \App\Models\Rx::where('atencion_id',$admin_atencione->id)->exists();
    @endphp
        <!--<div class="pt-3 text-end" data-aos="fade-up" data-aos-anchor-placement="top-bottom">-->
        <div class="p-3 text-end">
        @if($admin_atencione->estado == 'En atención')
        <button type="button" id="finalizar_atencion_id" class="btn btn-primary px-5 my-2 my-md-0 text-white">Finalizar atención</button>
        @else
            @if($validar_co)
                <a target="_blank" href="{{route('admin-atenciones.pdf',$admin_atencione->slug)}}" class="btn btn-dark"><i class="bi bi-download me-2"></i>Descargar HC</a>
            @endif    
            @if($validar_co && $validar_inter->interconsulta)
                <a target="blank" href="{{route('admin-interconsulta.pdf',$admin_atencione->slug)}}" class="btn btn-light border border-dark"><i class="bi bi-download me-2"></i>Descargar Interconsulta</a>
            @endif
            @if($validar_pro)
                <a target="blank" href="{{route('admin-receta.pdf',$admin_atencione->slug)}}" class="btn btn-info"><i class="bi bi-download me-2"></i>Descargar Receta</a>
            @endif
            @if($validar_ea)
                <a target="blank" href="{{route('admin-eauxiliar.pdf',$admin_atencione->slug)}}" class="btn btn-warning"><i class="bi bi-download me-2"></i>Descargar Examen Auxiliar</a>
            @endif
            <!-- @if($validar_rx)
                <a target="blank" href="{{route('admin-rx.pdf',$admin_atencione->slug)}}" class="btn btn-warning"><i class="bi bi-download me-2"></i>Descargar Rx</a>
            @endif -->
        @endif
        <a href="{{ route('admin-atenciones.index') }}" class="btn btn-grey">Volver</a>
    </div>
</div>
{{-- Fin contenido --}}
@endsection
@section('js')
<script>
    /* FINALIZAR PROCESO DE ATENCION */
        $('#finalizar_atencion_id').on('click', function(){
            redirect = '/admin-atenciones';
            $.get('/finalizar_atencion',{tipo_consulta:'finalizar_atencion',valor_atencion_id: valor_atencion_id}, function(busqueda){
                $.each(busqueda, function(index, value){

                    if(value[0] == 'consulta_generada'){
                        Swal.fire({
                        icon: 'success',
                        confirmButtonColor: '#1C3146',
                        title: '¡Éxito!',
                        text: 'Atencion finalizada correctamente',
                        })

                        location.href = redirect;

                    }
                });
            });
        });
    /* FIN DE FINALIZAR PROCESO */
</script>
@endsection