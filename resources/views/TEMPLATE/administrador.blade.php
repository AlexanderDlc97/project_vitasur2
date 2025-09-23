<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VITASUR | @yield('title')</title>
    @laravelPWA
    <link rel="icon" href="/images/icon.png">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/dashboard.css">
    <link rel="stylesheet" href="/css/select2.min.css"/>
    <link rel="stylesheet" href="/css/select2-bootstrap-5-theme.min.css"/>
    <link rel="stylesheet" href="/css/dataTables.bootstrap5.css"/>
    <link rel="stylesheet" href="/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="/css/responsive.bootstrap5.css"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield('css')
    @stack('meta')
    
        <style>
        .scroll___carrito {
              max-height: 600px;
              overflow-y: scroll;
        }
    </style>
    
</head>
<body class="bg-light">
    <!-- sidebar -->      
        <div class="offcanvas offcanvas-start sidebar-nav" tabindex="-1" id="offcanvasmenu">
            <div class="card content_user">
                <img src="/images/header_control.jpg" class="header_user" alt="">
                <div class="card-body text-center">
                    <div class="avatar">
                        <img src="/images/personas/medico.jpg" alt="">
                    </div>
                    <div class="info_user">
                        <p class="fw-bold text-white fs-5 mb-0">{{ Auth::user()->persona->name.' '.Auth::user()->persona->surnames }}</p>
                        <p class="fw-light text-light mb-0">{{ Auth::user()->email }}</p>
                        <p class="mb-0">
                            <span class="badge bg-info text-uppercase small">{{ Auth::user()->role->name }}</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="offcanvas-body pb-2 p-0">
                <div class="navbar-white">
                    <ul class="navbar-nav">
                        <div class="">
                            @if(Auth::user()->role_id == '6')
                            @else
                                <li>
                                    <div class="text-white small fw-bold text-uppercase px-3">Principal</div>
                                </li>
                            @endif
                            @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 4 || Auth::user()->role_id == 5)
                            <li class="mx-2 my-1">
                                <a href="{{ url('admin-configuraciones') }}" class="nav-link px-3 menu {{ request()->is(['admin-configuraciones*', 'admin-usuarios*', 'admin-profesiones', 'admin-perfil*', 'admin-especialidades*', 'admin-diagnosticos*', 'admin-medicamentos*', 'admin-cuentas-bancarias*', 'admin-medios-pagos*'])? 'active-item' : null }}">
                                    <span class="fw-bold">
                                        <i class="bi bi-gear me-2"></i>
                                    </span>
                                    <span>
                                        Configuraciones
                                    </span>
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 4)
                            <li class="mx-2 my-1">
                                <a href="{{url('admin-medicos')}}" class="nav-link px-3 menu {{ request()->is(['admin-medicos*'])? 'active-item' : null}}">
                                    <span class="fw-bold">
                                        <i class="fa-solid fa-user-doctor me-2"></i>
                                    </span>
                                    <span>
                                        Médicos
                                    </span>
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->role_id == 2 || Auth::user()->role_id == 1 || Auth::user()->role_id == 4 || Auth::user()->role_id == 6)
                            <li class="mx-2 my-1">
                                <a href="{{url('admin-pacientes')}}" class="nav-link px-3 {{ request()->is(['admin-pacientes*'])? 'active-item' : null}} menu">
                                    <span class="fw-bold">
                                        <i class="fa-solid fa-bed-pulse me-2"></i>
                                    </span>
                                    <span>
                                        Pacientes
                                    </span>
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->role_id == 2 || Auth::user()->role_id == 4 || Auth::user()->role_id == 1 || Auth::user()->role_id == 5)
                            <li>
                                <div class="text-white small fw-bold text-uppercase px-3">Clínica</div>
                            </li>
                            @endif
                            @if(Auth::user()->role_id == 4 || Auth::user()->role_id == 1)
                            <li class="mx-2 my-1">
                                <a href="{{url('admin-citas')}}" class="nav-link px-3 {{ request()->is(['admin-citas*'])? 'active-item' : null}} menu">
                                    <span class="fw-bold">
                                        <i class="fa-solid fa-calendar-check me-2"></i>
                                    </span>
                                    <span>
                                        Citas
                                    </span>
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->role_id == 2 || Auth::user()->role_id == 1)
                            <li class="mx-2 my-1">
                                <a href="{{url('admin-atenciones')}}" class="nav-link px-3 {{ request()->is(['admin-atenciones*'])? 'active-item' : null}} menu">
                                    <span class="fw-bold">
                                        <i class="fa-solid fa-hospital-user me-2"></i>
                                    </span>
                                    <span>
                                        Atenciones
                                    </span>
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->role_id == 5 || Auth::user()->role_id == 1)
                            <li class="mx-2 my-1">
                                <a href="{{url('admin-farmacia')}}" class="nav-link px-3 {{ request()->is(['admin-farmacia*'])? 'active-item' : null}} menu">
                                    <span class="fw-bold">
                                        <i class="fa-solid fa-prescription-bottle-medical me-2"></i>
                                    </span>
                                    <span>
                                        Farmacia
                                    </span>
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->role_id == 4 || Auth::user()->role_id == 1)
                            <li>
                                <div class="text-white small fw-bold text-uppercase px-3">Tesorería</div>
                            </li>
                
                            <li class="mx-2 my-1">
                                <a href="{{url('admin-caja')}}" class="nav-link px-3 {{ request()->is(['admin-caja*'])? 'active-item' : null}} menu">
                                    <span class="fw-bold">
                                        <i class="bi bi-calculator me-2"></i>
                                    </span>
                                    <span>
                                        Caja
                                    </span>
                                </a>
                            </li>

                            <li class="mx-2 my-1">
                                <a href="{{url('admin-cobros')}}" class="nav-link px-3 {{ request()->is(['admin-cobros*'])? 'active-item' : null}} menu">
                                    <span class="fw-bold">
                                        <i class="bi bi-file-plus me-2"></i>
                                    </span>
                                    <span>
                                        Cobros
                                    </span>
                                </a>
                            </li>

                            <li class="mx-2 my-1">
                                <a href="{{url('admin-pagos')}}" class="nav-link px-3 {{ request()->is(['admin-pagos*'])? 'active-item' : null}} menu">
                                    <span class="fw-bold">
                                        <i class="bi bi-file-minus me-2"></i>
                                    </span>
                                    <span>
                                        Pagos
                                    </span>
                                </a>
                            </li>
                            @endif
                        </div> 
                    </ul>
                </div>
            </div>
            <div class="offcanvas-footer border-top">
                <div class="text-white py-2">
                    <p class="mb-0" style="font-size: 12px" align="center">Copyright © <?php echo date("Y");?> <a href="#" style="text-decoration: none;" class="text-white fw-bold">VITASUR</a> - Todos los derechos Reservados</p>
                </div>
            </div>
        </div>
    <!-- fin sidebar -->
    @php
        $fecha_actual = \Carbon\Carbon::now()->format('Y-m-d');
        $valor_medicamentos = \App\Models\Producto::where('cantidad','<','20')->where('sede_id',1)->get();
        $citas_programadas = \App\Models\Cita::where('fecha',$fecha_actual)->where('estado','Activo')->where('sede_id',1)->get();
    @endphp
    <!-- contenido -->
    <main>
        <!-- navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top py-3 mb-2">
                <div class="container-fluid mt-1">
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasmenu" aria-controls="offcanvasmenu">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                        <div class="ms-auto d-flex">
                            @if(Auth::user()->role_id == 5)
                            <button class="btn btn-sm btn-info rounded-pill align-self-center me-3"
                                type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-bell-fill"></i>
                                <span class="ms-1 badge bg-primary">
                                    {{$valor_medicamentos->count()}}
                                </span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end scroll___carrito shadow border-0 me-4"
                                aria-labelledby="dropdownMenuButton1" style="width: 290px; font-size: 15px;">
                                @foreach ($valor_medicamentos as $valor_medicamentoss)
                                    <li>
                                        <a class="list-group-item border-0">
                                            <div class="row g-0 align-items-center p-2">
                                                <div class="col-2">
                                                    <i class="bi bi-capsule fs-1 text-danger"></i>
                                                </div>
                                                <div class="col-10 ps-2 ">
                                                    <div class="text-start">
                                                        <span class="fw-bold text-muted">Medicamento: </span>
                                                        <span class="fw-bold">{{$valor_medicamentoss->name}}</span>
                                                        <span>esta por debajo de las 20 unidades</span>
                                                        <div class="clarfix">
                                                            <span class="text-muted small"> {{$valor_medicamentoss->created_at->diffForHumans()}}</span>
                                                            <span
                                                                class="float-end badge rounded-circle bg-info small text-info"
                                                                style="font-size: 8px;">0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            @elseif(Auth::user()->role_id == 1 || Auth::user()->role_id == 4)
                            <button class="btn btn-sm btn-info rounded-pill align-self-center me-3"
                                type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-bell-fill"></i>
                                <span class="ms-1 badge bg-primary">
                                    {{$valor_medicamentos->count()+$citas_programadas->count()}}
                                </span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end scroll___carrito shadow border-0 me-4"
                                aria-labelledby="dropdownMenuButton1" style="width: 290px; font-size: 15px;">
                                @foreach ($valor_medicamentos as $valor_medicamentoss)
                                    <li>
                                        <a class="list-group-item border-0">
                                            <div class="row g-0 align-items-center p-2">
                                                <div class="col-2">
                                                    <i class="bi bi-capsule fs-1 text-danger"></i>
                                                </div>
                                                <div class="col-10 ps-2 ">
                                                    <div class="text-start">
                                                        <span class="fw-bold text-muted">Medicamento: </span>
                                                        <span class="fw-bold">{{$valor_medicamentoss->name}}</span>
                                                        <span>esta por debajo de las 20 unidades</span>
                                                        <div class="clarfix">
                                                            <span class="text-muted small"> {{$valor_medicamentoss->created_at->diffForHumans()}}</span>
                                                            <span
                                                                class="float-end badge rounded-circle bg-info small text-info"
                                                                style="font-size: 8px;">0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach

                                @foreach ($citas_programadas as $citas_programadass)
                                    <li>
                                        <a class="list-group-item border-0">
                                            <div class="row g-0 align-items-center p-2">
                                                <div class="col-2">
                                                    <i class="bi bi-clipboard2-pulse-fill fs-1 text-success"></i>
                                                </div>
                                                <div class="col-10 ps-2 ">
                                                    <div class="text-start">
                                                        <span class="fw-bold text-muted">Paciente: </span>
                                                        <span class="fw-bold">{{$citas_programadass->paciente->persona->name.' '.$citas_programadass->paciente->persona->surnames}}</span>
                                                        <span>Tiene una cita programada a las {{$citas_programadass->hora}}</span>
                                                        <div class="clarfix">
                                                            <span class="text-muted small"> {{$citas_programadass->created_at->diffForHumans()}}</span>
                                                            <span
                                                                class="float-end badge rounded-circle bg-info small text-info"
                                                                style="font-size: 8px;">0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                        <div class="dropdown align-self-center">
                            <a class="dropdown-toggle text-decoration-none text-info" href="#" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                            {{Auth::user()->persona->name.' '.Auth::user()->persona->surnames}}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 py-0" aria-labelledby="dropdownMenuButton2" style="width: 285px; font-size: 15px; border-radius: 20px; overflow: hidden">
                                <img src="/images/header_control.jpg" class="header_user" style="border-radius: 20px 20px 0 0" alt="">
                                <div class="contenido">
                                    <div class="avatar_dropdown ps-3">
                                        <img src="/images/personas/medico.jpg" alt="">
                                    </div>
                                    <div class="info_user ps-3">
                                        <p class="fw-bold mb-0">{{Auth::user()->persona->name.' '.Auth::user()->persona->surnames}}</p>
                                        <p class="fw-light small text-muted mb-0">{{Auth::user()->email}}</p>
                                    </div>
                                </div>
                                <li>
                                    <a class="dropdown-item py-2" href="/admin-perfil">
                                        <i class="bi bi-person-circle me-2"></i>
                                        Mi perfil
                                    </a>
                                </li>
                                
                                <li>
                                    <a class="dropdown-item py-2" href="{{ route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-2"></i>
                                        Cerrar Sesión
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div> 
                </div>
            </nav>
        <!-- fin navbar -->

        <div class="mb-3" id="contenido">
            @yield('content')
        </div>
    </main>
    <!-- fin contenido -->
        
    <script src="/js/jquery-3.7.1.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/sweetalert2.all.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="/js/select2.full.min.js"></script>
    <script src="/js/dataTables.js"></script>
    <script src="/js/dataTables.bootstrap5.js"></script>
    <script src="/js/dataTables.responsive.js"></script>
    <script src="/js/responsive.bootstrap5.js"></script>
    <script>
        $( '.select2_bootstrap' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
        } );
    </script>
    <script>
        $( '.select2_bootstrap_2' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
        } );
    </script>

    <script>
        $( '.select2_bootstrap_multiple' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: false,
        } );
    </script>
    <script>
        AOS.init();
    </script>
    <script>
        var nav = document.querySelector('nav');
        window.addEventListener('scroll', function(){
            if(window.pageYOffset > 30){
                nav.classList.add('bg-nav');
                nav.classList.add('shadow');
            }else{
                nav.classList.remove('bg-nav');
                nav.classList.remove('shadow');
            }
        });
    </script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        new DataTable('#display', {
            responsive: true,
            fixedHeader: true,
            order: [[0, "desc"]],
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontró nada, lo siento",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(Filtrado de _MAX_ registros totales)",
                "search": "Buscar:"
            }
        });
    </script> 
    <script>
          $(document).ready(function() {
            setInterval(() => {
                $.get('/calcular_vigencia_eauxiliar');
            }, 5000);
        });
    </script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>

    <script>
        $('.select_location').on('change', function(){
            window.location = $(this).val();
        });
    </script>
    @yield('js')
    @stack('scripts')
    @yield('js_consulta')
    @yield('js_procedimiento')
    @yield('js_receta')
    @yield('js_eauxiliar')
    @yield('js_rx')
</body>
</html>