@extends('TEMPLATE.administrador')

@section('title', 'FARMACIA')

@section('css')
@endsection
 
@section('content')
<!-- Encabezado -->
    <div class="header_section">
        <div class="bg-transparent mb-3" style="height: 67px"></div>
        <div class="container-fluid">
            <div class="" data-aos="fade-right">
                <h1 class="titulo h2 text-uppercase fw-bold mb-0">FARMACIA</h1>
                <div class="" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="">Clínica</a></li>
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="{{ url('admin-farmacia') }}">Farmacia</a></li>
                        <li class="breadcrumb-item link" aria-current="page">Inicio</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
<!-- Fin encabezado-->

{{-- Contenido --}}
<div class="container-fluid">   
    <div class="card border-4 borde-top-primary shadow-sm h-100" style="border-radius: 20px; min-height: 500px" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
        <div class="card-header bg-transparent">
            <div class="row justify-content-between">
                <div class="col-9 col-md-3 col-xl-2 mb-2 mb-lg-0 order-1 order-md-1 order-lg-1 order-xl-1">
                    <a href="{{ route('admin-farmacia.create') }}" class="btn btn-primary btn-sm text-uppercase text-white w-100" style="border-radius: 20px">
                        <i class="bi bi-plus-circle me-2"></i>
                        Nuevo registro
                    </a>
                </div>
                <div class="col-3 col-md-2 col-xl-1 mb-2 mb-lg-0 order-2 order-md-3 order-lg-3 order-xl-3">
                    <button type="button" class="btn btn-dark btn-sm w-100" style="border-radius: 20px" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-download"></i></button>
                    <ul class="dropdown-menu">      
                        <li class="dropdown-item">
                            <button class="bg-transparent border-0 px-0 mx-0" data-bs-toggle="modal" data-bs-target="#reporte_Excel"><i class="bi bi-file-excel me-2"></i><small>EXCEL</small></button>
                        </li>                                            
                        <!--<li class="dropdown-item">
                            <button class="bg-transparent border-0 px-0 mx-0" data-bs-toggle="modal" data-bs-target="#reporte_PDF"><i class="bi bi-file-pdf me-2"></i><small>PDF</small></button>
                        </li>-->                                                       
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-2 col-12 col-md-6">
                <span class="text-uppercase">Total de registros encontrados: <span class="fw-bold">{{ number_format($admin_farmaciaa->count(), 0,'.',',') }}</span></span>
            </div>
            <table id="display" class="table table-hover table-sm" cellspacing="0" style="width:100%">
                <thead class="bg-dark text-white border-0">
                    <tr>
                        <th class="h6 small text-center text-uppercase fw-bold">N°</th>
                        <th class="h6 small text-center text-uppercase fw-bold">Código</th>
                        <th class="h6 small text-center text-uppercase fw-bold">Fecha</th>
                        <th class="h6 small text-center text-uppercase fw-bold">Atención</th>
                        <th class="h6 small text-center text-uppercase fw-bold">Paciente</th>
                        <th class="h6 small text-center text-uppercase fw-bold">Receta</th>
                        <th class="h6 small text-center text-uppercase fw-bold">Total</th>
                        <th class="h6 small text-center text-uppercase fw-bold">Estado</th>
                        <th class="h6 small text-center text-uppercase fw-bold">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $contador = 1;
                    @endphp
                    @foreach ($admin_farmaciaa as $admin_farmacia)
                        @php
                            $pacientes_value = DB::table('personas as per')
                            ->join('pacientes as pa','pa.persona_id','=','per.id')
                            ->join('atencions as ate','ate.paciente_id','=','pa.id')
                            ->join('recetas as rec','rec.atencion_id','=','ate.id')
                            ->select('rec.nro_solicitud','per.name','per.surnames')
                            ->where('ate.codigo',$admin_farmacia->atencion)->first();
                        @endphp

                        <tr>
                            <td class="fw-normal text-center align-middle">{{ $contador }}</td>
                            <td class="fw-normal text-center align-middle text-md-center">{{ $admin_farmacia->codigo }}</td>
                            <td class="fw-normal text-center align-middle text-md-center">{{ $admin_farmacia->fecha }}</td>
                            <td class="fw-normal text-center align-middle text-md-center">{{ $admin_farmacia->tipo_atencion}}</td>
                            <td class="fw-normal text-center align-middle text-md-center">{{ $pacientes_value?$pacientes_value->name.' '.$pacientes_value->surnames:'General' }}</td>
                            <td class="fw-normal text-center align-middle text-md-center">{{ $pacientes_value?$pacientes_value->nro_solicitud:'No' }}</td>
                            <td class="fw-normal text-center align-middle text-md-center">{{ number_format($admin_farmacia->total, 2, '.',',') }}</td>
                            <td class="fw-normal align-middle small text-md-center">
                                @if($admin_farmacia->estado == 'Pendiente')
                                    <form method="POST" action="{{ route('admin-farmacia.validar_confirmacion',$admin_farmacia->slug) }}" class="form-put">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="bg-transparent mx-0 px-0 border-0"><span class="badge text-uppercase small bg-warning border-0">{{ $admin_farmacia->estado }}</span></button>        
                                    </form>
                                @elseif($admin_farmacia->estado == 'Completado')
                                    <span class="badge text-uppercase small bg-dark border-0">{{ $admin_farmacia->estado }}</span>
                                @endif
                            </td>    
                            <td class="text-center align-middle">                                        
                                <div class="text-start text-md-center">
                                    <div class="dropstart">
                                        <button type="button" class="btn btn-grey btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
                                           <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">                                                
                                            <li class="dropdown-item">
                                                <button class="bg-transparent border-0 px-0 mx-0" data-bs-toggle="modal" data-bs-target="#showfarmacia{{ $admin_farmacia->slug }}"><i class="bi bi-eye-fill me-2"></i>Ver detalles</button>
                                            </li>      
                                           <!-- <li class="dropdown-item">
                                                <a href="{{ route('admin-farmacia.edit',$admin_farmacia->slug) }}" class="text-decoration-none" style="color: #000;"><i class="bi bi-pencil-square me-2"></i>Editar</a>
                                           </li>  
                                           <li class="dropdown-item">
                                                <form method="POST" action="{{ route('admin-farmacia.destroy',$admin_farmacia->slug) }}" class="form-delete">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-transparent mx-0 px-0 border-0"><i class="bi bi-trash-fill me-2"></i>Eliminar</button>        
                                                </form>
                                           </li>                                           -->
                                        </ul>
                                   </div>
                                </div>      
                            </td>
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
{{-- Fin contenido --}}
@include('ADMINISTRADOR.CLINICA.farmacia.reporte_modal_excel')  
    @foreach($admin_farmaciaa as $admin_farmacia)
        @include('ADMINISTRADOR.CLINICA.farmacia.show')
    @endforeach
@endsection
@section('js')
    @if(session('medicamento') == 'ok')
        <script>
            Swal.fire({
                icon: 'success',
                confirmButtonColor: '#1C3146',
                title: '¡Éxito!',
                text: 'Registro generado correctamente',
            })
        </script>
    @endif

    @if(session('addregister') == 'ok')
        <script>
            Swal.fire({
                icon: 'success',
                confirmButtonColor: '#1C3146',
                title: '¡Éxito!',
                text: 'Nuevo registro guardado correctamente',
            })
        </script>
    @endif

    @if(session('exists') == 'ok')
        <script>
            Swal.fire({
            icon: 'warning',
            confirmButtonColor: '#1C3146',
            title: '¡Lo sentimos!',
            text: 'El registro ingresado ya existe',
            })
        </script>
    @endif

    @if(session('update_estado_entrega') == 'ok')
        <script>
            Swal.fire({
                icon: 'success',
                confirmButtonColor: '#1C3146',
                title: '¡Éxito!',
                text: 'Excelente, medicamento entregado',
            })
        </script>
    @endif

    <!--sweet alert actualizar-->
    @if(session('update') == 'ok')
        <script>
            Swal.fire({
                icon: 'success',
                confirmButtonColor: '#1C3146',
                title: '¡Actualizado!',
                text: 'Registro actualizado correctamente',
            })
        </script>
    @endif
    
    <!--sweet alert validar_estado_entrega-->
    <script>
        $('.form-put').submit(function(e){
            e.preventDefault();

            Swal.fire({
            title: '¿Desea Confirmar la Entrega?',
            text: "¡No podrás revertir esto!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1C3146',
            cancelButtonColor: '#FF9C00',
            confirmButtonText: '¡Sí, entregar!',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.isConfirmed) {
                
            this.submit();
            }
            })

        });
    </script>

    <!--sweet alert eliminar-->
    @if(session('delete') == 'ok')
        <script>
            Swal.fire({
                icon: 'success',
                confirmButtonColor: '#1C3146',
                title: '¡Eliminado!',
                text: 'Registro eliminado correctamente',
            })
        </script>
    @endif
    <script>
        $('.form-delete').submit(function(e){
            e.preventDefault();

            Swal.fire({
            title: '¿Estas seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1C3146',
            cancelButtonColor: '#FF9C00',
            confirmButtonText: '¡Sí, eliminar!',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.isConfirmed) {
                
            this.submit();
            }
            })

        });
    </script>
    
    @if(session('error') == 'ok')
        <script>
            Swal.fire({
            icon: 'warning',
            confirmButtonColor: '#1C3146',
            title: '¡Lo sentimos!',
            text: 'Este registro no se puede eliminar porque está siendo utilizado en otro registro',
            })
        </script>
    @endif
@endsection