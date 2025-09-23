<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KAITA | @yield('title')</title>
    <link rel="icon" href="/images/icon.png">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/administrador.css">
    <link rel="stylesheet" href="/css/datatables/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="/css/datatables/select.bootstrap5.min.css">
    <link rel="stylesheet" href="/css/datatables/responsive.bootstrap.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/select2.min.css">
    @yield('css')
</head>
<body class="bg-kaita">
    <div class="alert alert-light" role="alert">
        <label style="color: red;">Bienvenido</label>
        <label class="text-danger">{!!$body!!}</label>
                        
                    </div>
    <!-- fin contenido -->
        
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/jquery-3.6.0.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="/js/sweetalert2.all.min.js"></script>
    <script src="/js/datatables/jquery.dataTables.min.js"></script>
    <script src="/js/datatables/dataTables.bootstrap5.min.js"></script>
    <script src="/js/datatables/dataTables.fixedHeader.min.js"></script>
    <script src="/js/datatables/dataTables.responsive.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="/js/select2.min.js"></script>
    @yield('js')
    @stack('scripts')
    <script>
        AOS.init();
    </script>
    <script>
          $(document).ready(function() {
            $('.select2').select2();
            valor_venta_zona = $('#venta_ruta_id').val();
            valor_monto_meta = $('#monto_metas_id').val();
            valor_id_vendedor = $('#ide_vendedor_id').val();

            setInterval(() => {
                $.get('/vigencia_os');
                $.get('/vigencia_plani');
                $.get('/metas_vendedor',{venta_ruta_meta: valor_venta_zona, monto_metas:valor_monto_meta, ide_vendedor:valor_id_vendedor});
            }, 5000);
            console.log(valor_venta_zona,valor_monto_meta,valor_id_vendedor)
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
    <script>
        var nav = document.querySelector('nav');
        window.addEventListener('scroll', function(){
            if(window.pageYOffset > 30){
                nav.classList.add('bg-nav');
                nav.classList.add('shadow-sm');
            }else{
                nav.classList.remove('bg-nav');
                nav.classList.remove('shadow-sm');
            }
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            $('table.display').DataTable( {
                responsive: true,
                fixedHeader: true,
                order: [[0, "desc"]],
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "No se encontró nada, lo siento",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(Filtrado de _MAX_ registros totales)",
                    "search": "Buscar:",
                    "paginate":{
                        "next": "&raquo;",
                        "previous": "&laquo;"
                    } 
                }
            } );
        new $.fn.dataTable.FixedHeader( table );
        } );
    </script>

    <script>
        $(document).ready(function() {
            $('table.noresponsive').DataTable( {
                scrollX: true,
                order: [[0, "desc"]],
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "No se encontró nada, lo siento",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(Filtrado de _MAX_ registros totales)",
                    "search": "Buscar:",
                    "paginate":{
                        "next": "&raquo;",
                        "previous": "&laquo;"
                    } 
                }
            } );
        } );
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
</body>
</html>