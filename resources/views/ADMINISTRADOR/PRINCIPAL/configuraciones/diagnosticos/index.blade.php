@extends('TEMPLATE.administrador')

@section('title', 'DIAGNÓSTICOS')

@section('css')
@endsection
 
@section('content')
<!-- Encabezado -->
    <div class="header_section">
        <div class="bg-transparent mb-3" style="height: 67px"></div>
        <div class="container-fluid">
            <div class="" data-aos="fade-right">
                <h1 class="titulo h2 text-uppercase fw-bold mb-0">DIAGNÓSTICOS</h1>
                <div class="" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="">Principal</a></li>
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="{{ url('admin-configuraciones') }}">Configuraciones</a></li>
                        <li class="breadcrumb-item"><a class="text-decoration-none link" href="{{ url('admin-diagnosticos') }}">Diagnósticos</a></li>
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
                <div class="row">
                    <div class="col-12 col-md-3 col-xl-2 d-flex">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#creatediagnosticos" class="btn btn-primary btn-sm text-uppercase text-white w-100" style="border-radius: 20px">
                            <i class="bi bi-plus-circle me-2"></i>
                            Nuevo registro
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-2 col-12 col-md-6">
                    <span class="text-uppercase">Total de registros encontrados: <span class="fw-bold">{{ number_format($admin_diagnosticos->count(), 0,'.',',') }}</span></span>
                </div>
                <table id="display" class="table table-hover table-sm" cellspacing="0" style="width:100%">
                    <thead class="bg-dark text-white border-0">
                        <tr>
                            <th class="h6 small text-center text-uppercase fw-bold">N°</th>
                            <th class="h6 small text-center text-uppercase fw-bold">Cod. C.</th>
                            <th class="h6 small text-center text-uppercase fw-bold">Categoría</th>
                            <th class="h6 small text-center text-uppercase fw-bold">Estado</th>
                            <th class="h6 small text-center text-uppercase fw-bold">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $contador = 1;
                        @endphp
                        @foreach ($admin_diagnosticos as $admin_diagnostico)
                            <tr>
                                <td class="fw-normal text-center align-middle">{{ $contador }}</td>
                                <td class="fw-normal text-center align-middle">{{ $admin_diagnostico->codigo }}</td>
                                <td class="fw-normal text-center align-middle">{{ $admin_diagnostico->name }}</td>
                                <td class="fw-normal text-center align-middle small">
                                    <form method="POST" action="/admin-diagnosticos/estado/{{ $admin_diagnostico->slug }}" class="form-update">
                                        @csrf
                                        @method('PUT')
                                            @if($admin_diagnostico->estado == 'Activo')
                                                <button type="submit" class="badge text-uppercase small bg-success border-0">Activo</button>
                                            @else
                                                <button type="submit" class="badge text-uppercase small bg-danger border-0">Inactivo</button>
                                            @endif
                                    </form>
                                </td>  
                                <td class="text-center align-middle">                                        
                                    <div class="text-start text-md-center">
                                        <div class="dropstart">
                                            <button type="button" class="btn btn-grey btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu">   
                                                <li class="dropdown-item">
                                                    <button class="bg-transparent border-0 px-0 mx-0" data-bs-toggle="modal" data-id="{{ $admin_diagnostico->slug }}" id="show_button{{ $admin_diagnostico->slug }}" data-bs-target="#show_diagnostico{{ $admin_diagnostico->slug }}"><i class="bi bi-eye-fill me-2"></i>Ver detalles</button>
                                                </li>                                               
                                                {{-- <li class="dropdown-item">
                                                    <button class="bg-transparent border-0 px-0 mx-0" data-bs-toggle="modal" data-id="{{ $admin_diagnostico->slug }}" id="edit_button{{ $admin_diagnostico->slug }}" data-bs-target="#edit_diagnostico{{ $admin_diagnostico->slug }}"><i class="bi bi-pencil-square me-2"></i>Editar</button>
                                                </li>   --}}
                                                {{-- <li class="dropdown-item">
                                                    <form method="POST" action="{{ route('admin-diagnosticos.destroy',$admin_diagnostico->slug) }}" class="form-delete">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="bg-transparent mx-0 px-0 border-0"><i class="bi bi-trash-fill me-2"></i>Eliminar</button>        
                                                    </form>
                                                </li>                                           --}}
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
    @include('ADMINISTRADOR.PRINCIPAL.configuraciones.diagnosticos.create')
    @foreach ($admin_diagnosticos as $admin_diagnostico)
        @include('ADMINISTRADOR.PRINCIPAL.configuraciones.diagnosticos.show')
    @endforeach
{{-- Fin contenido --}}
@endsection
@section('js')
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
    
    @if(session('adddiagnos') == 'ok')
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
    
    <script>
        var contador_dx = 1;
        $('#btnasignar_dx').click(function() {
            valor_codigo_p = $('#codigo_p').val();
            valor_diag_p = $('#diag_p').val();
            valor_codigo_s = $('#codigo_s').val();
            valor_diag_s = $('#diag_s').val();

            console.log(valor_codigo_p, valor_diag_p,valor_codigo_s,valor_diag_s);
            if (valor_codigo_p != "" && valor_diag_p != "" && valor_codigo_s != "" && valor_diag_s != "") {

                var $divs = $(".contador_divs_receta").toArray().length;
                var fila = '<tr class="selected contador_divs_receta" id="filamp' + contador_dx +
                            '"><td class="align-middle fw-normal"><input type="text" hidden class="form-control form-control-sm" name="contadores[]" value="' + contador_dx +
                            '">' + contador_dx + '</td><td class="align-middle fw-normal"><input type="text" class="form-control form-control-sm" name="valor_codigo_s[]" value="' + valor_codigo_s +
                            '"></td><td class="align-middle fw-normal"><input type="text" class="form-control form-control-sm" name="valor_diag_s[]" value="' + valor_diag_s +
                            '"></td><td class="align-middle"><button type="button" class="bg-transparent border-0 text-danger" onclick="eliminardtr(' +
                    contador_dx +');"><i class="bi bi-trash"></i></button></td></tr>';

                    contador_dx++;

                    $('#codigo_s').val("");
                    $('#diag_s').val("");

                    $('#dt_dx').append(fila);


            }
        });
        
        function eliminardtr(indexmp) {
            var contando_card = $('#acomulador_card').val();
            $("#filamp" + indexmp).remove();
            var nuevo_cont_card = contando_card-1;
            $('#acomulador_card').val(nuevo_cont_card);
            
        };
    </script>
@endsection