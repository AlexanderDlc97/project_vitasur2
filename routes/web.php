<?php

use App\Http\Controllers\admin_AtencionesController;
use App\Http\Controllers\admin_CajaController;
use App\Http\Controllers\admin_CitasController;
use App\Http\Controllers\admin_CobrosController;
use App\Http\Controllers\admin_ConfiguracionesController;
use App\Http\Controllers\admin_CuentabancariaController;
use App\Http\Controllers\admin_DashboardController;
use App\Http\Controllers\admin_DiagnosticosController;
use App\Http\Controllers\admin_EspecialidadesController;
use App\Http\Controllers\admin_FarmaciaController;
use App\Http\Controllers\admin_MedicamentosController;
use App\Http\Controllers\admin_MedicosController;
use App\Http\Controllers\admin_MediospagoController;
use App\Http\Controllers\admin_NotificacionesController;
use App\Http\Controllers\admin_PacientesController;
use App\Http\Controllers\admin_PagosController;
use App\Http\Controllers\admin_PerfilController;
use App\Http\Controllers\admin_ProcedimientosclinicoController;
use App\Http\Controllers\admin_ProfesionesController;
use App\Http\Controllers\admin_UsuariosController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/check-path', function () {
    return public_path();
});

Route::get('/offline', function () {
    return view('vendor.laravelpwa.offline');
});

Route::middleware('auth')->group(function () {
    Route::get('admin-dashboard', [admin_DashboardController::class, 'index'])->name('admin-dashboard.index');
    Route::get('admin-configuraciones', [admin_ConfiguracionesController::class, 'index'])->name('admin-configuraciones.index');
    Route::get('admin-notificaciones', [admin_NotificacionesController::class, 'index'])->name('admin-notificaciones.index');

    Route::resource('admin-usuarios', admin_UsuariosController::class);
    Route::put('/admin-usuarios/estado/{admin_usuario}', [admin_UsuariosController::class, 'estado']);
    Route::resource('admin-profesiones', admin_ProfesionesController::class);
    Route::put('/admin-profesiones/estado/{admin_profesione}', [admin_ProfesionesController::class, 'estado']);
    Route::resource('admin-perfil', admin_PerfilController::class);

    Route::resource('admin-especialidades', admin_EspecialidadesController::class);
    Route::put('/admin-especialidades/estado/{admin_especialidade}', [admin_EspecialidadesController::class, 'estado']);
    Route::resource('admin-diagnosticos', admin_DiagnosticosController::class);
    Route::put('/admin-diagnosticos/estado/{admin_diagnostico}', [admin_DiagnosticosController::class, 'estado']);
    Route::resource('admin-medicamentos', admin_MedicamentosController::class);
    Route::put('/admin-medicamentos/estado/{admin_medicamento}', [admin_MedicamentosController::class, 'estado']);
    Route::post('admin-medicamentos/resultadosEXCEL', [admin_MedicamentosController::class, 'reporteMedicamentoPrintExcelFechas'])->name('admin-medicamentos.resultadosEXCEL');

    Route::resource('admin-procedimientosclinicos', admin_ProcedimientosclinicoController::class);
    Route::put('/admin-procedimientosclinicos/estado/{admin_procedimientoclinico}', [admin_ProcedimientosclinicoController::class, 'estado']);

    Route::resource('admin-medicos', admin_MedicosController::class);
    Route::put('/admin-medicos/estado/{admin_medico}', [admin_MedicosController::class, 'estado']);
    
    Route::resource('admin-pacientes', admin_PacientesController::class);
    Route::get('/admin-pacientes/showimagenologia/{admin_imagenologia}', [admin_PacientesController::class, 'getshowimagenologia']);
    Route::put('/admin-pacientes/putimagenologia/{admin_imagenologia}', [admin_PacientesController::class, 'update_imagenologia'])->name('admin-imagenologias.update_imagenes');
    Route::put('/admin-pacientes/estado/{admin_paciente}', [admin_PacientesController::class, 'estado']);
    Route::get('busqueda_reniec', [admin_PacientesController::class, 'getBusquedaReniec']);
    Route::get('busqueda_solicitud_imagenologia', [admin_PacientesController::class, 'getbusqueda_solicitud_imagenologia']);
    Route::get('/admin-pacientes/imagenologia-pdf/{admin_imagenologia}', [admin_PacientesController::class, 'getImagenologiaPdf'])->name('admin-imagenologia.pdf');
    
    
    Route::resource('admin-citas', admin_CitasController::class);
    Route::get('busqueda_profesion', [admin_CitasController::class, 'getbusqueda_profesion']);
    Route::post('busqueda_list_cita_fecha', [admin_CitasController::class, 'getindex_cita'])->name('admin-index-cita.index_filtro');
    
    Route::resource('admin-atenciones', admin_AtencionesController::class);
    Route::post('busqueda_list_atencione_fecha', [admin_AtencionesController::class, 'getindex_atencione'])->name('admin-index-atencione.index_filtro');
    Route::get('busqueda_tipo_citas', [admin_AtencionesController::class, 'getbusqueda_tipo_citas']);
    Route::get('busqueda_pacientes', [admin_AtencionesController::class, 'getbusqueda_pacientes']);
    Route::get('busqueda_especialidades', [admin_AtencionesController::class, 'getbusqueda_especialidades']);
    Route::get('busqueda_categoria_diagnos', [admin_AtencionesController::class, 'getbusqueda_categoria_diagnos']);
    Route::get('busqueda_solicitud_receta', [admin_AtencionesController::class, 'getbusqueda_solicitud_receta']);
    Route::get('busqueda_solicitud_eauxiliar', [admin_AtencionesController::class, 'getbusqueda_solicitud_eauxiliar']);
    Route::get('busqueda_solicitud_rx', [admin_AtencionesController::class, 'getbusqueda_solicitud_rx']);
    Route::get('guardar_consulta', [admin_AtencionesController::class, 'getguardar_consulta']);
    Route::get('cargar_select_multiple', [admin_AtencionesController::class, 'getguardar_selectmultiple']);
    Route::post('/guardar_procedimiento', [admin_AtencionesController::class, 'getguardar_procedimiento']);
    Route::get('/cargar_procedimiento', [admin_AtencionesController::class, 'getcargar_procedimiento']);
    Route::get('/cargar_dtlleprocedimiento', [admin_AtencionesController::class, 'getcargar_dtlleprocedimiento']);
    Route::post('/guardar_receta', [admin_AtencionesController::class, 'getguardar_receta']);
    Route::get('/cargar_receta', [admin_AtencionesController::class, 'getcargar_receta']);
    Route::get('/cargar_dtllemedica_receta', [admin_AtencionesController::class, 'getcargar_dtllemedica_receta']);
    Route::post('/guardar_eauxiliar', [admin_AtencionesController::class, 'getguardar_eauxiliar']);
    Route::get('/cargar_eauxiliar', [admin_AtencionesController::class, 'getcargar_eauxiliar']);
    Route::get('/cargar_dtllemedica_eauxiliar', [admin_AtencionesController::class, 'getcargar_dtllemedica_eauxiliar']);
    Route::post('/guardar_rx', [admin_AtencionesController::class, 'getguardar_rx']);
    Route::get('/cargar_rx', [admin_AtencionesController::class, 'getcargar_rx']);
    Route::get('/images/{id}/delete', [admin_AtencionesController::class, 'deleteImage']);
    Route::get('/finalizar_atencion', [admin_AtencionesController::class, 'getfinalizar_atencion']);
    Route::post('admin-atenciones/resultadosEXCEL', [admin_AtencionesController::class, 'reporteAtencionesPrintExcelFechas'])->name('admin-atenciones.resultadosEXCEL');
    Route::get('/admin-atenciones/atencion-pdf/{admin_atencione}', [admin_AtencionesController::class, 'getAtencionPdf'])->name('admin-atenciones.pdf');
    Route::get('/admin-atenciones/interconsulta-pdf/{admin_atencione}', [admin_AtencionesController::class, 'getInterconsultaPdf'])->name('admin-interconsulta.pdf');
    Route::get('/admin-atenciones/receta-pdf/{admin_atencione}', [admin_AtencionesController::class, 'getRecetaPdf'])->name('admin-receta.pdf');
    Route::get('/admin-atenciones/eauxiliar-pdf/{admin_atencione}', [admin_AtencionesController::class, 'getEauxiliarPdf'])->name('admin-eauxiliar.pdf');
    Route::get('/calcular_vigencia_eauxiliar', [admin_AtencionesController::class, 'getcalcular_vigencia_eauxiliar']);
    Route::get('/admin-atenciones/rx-pdf/{admin_atencione}', [admin_AtencionesController::class, 'getRxPdf'])->name('admin-rx.pdf');

    Route::resource('admin-farmacia', admin_FarmaciaController::class);
    Route::get('/admin-farmacia/farmacia-pdf/{admin_farmacia}', [admin_FarmaciaController::class, 'getFarmaciaPdf'])->name('admin-farmacia.pdf');
    Route::put('/admin-farmacia/farmacia/validar_estado_entrega/{admin_farmacia}', [admin_FarmaciaController::class, 'getEstadoentrega'])->name('admin-farmacia.validar_confirmacion');
    Route::get('busqueda_tipo_atencion', [admin_FarmaciaController::class, 'getbusqueda_tipo_atencion']);
    Route::get('busqueda_tipo_medicamento', [admin_FarmaciaController::class, 'getbusqueda_tipo_medicamento']);
    Route::get('busqueda_tipo_atencion_medicamento', [admin_FarmaciaController::class, 'getbusqueda_tipo_atencion_medicamento']);
    Route::post('admin-farmacia/resultadosEXCEL', [admin_FarmaciaController::class, 'reporteFarmaciaPrintExcelFechas'])->name('admin-farmacia.resultadosEXCEL');
    
    Route::resource('admin-medios-pagos', admin_MediospagoController::class);
    Route::put('/admin-medios-pagos/estado/{admin_medios_pago}', [admin_MediospagoController::class, 'estado']);
    Route::resource('admin-cuentas-bancarias', admin_CuentabancariaController::class);
    Route::put('/admin-cuentas-bancarias/estado/{admin_cuentas_bancaria}', [admin_CuentabancariaController::class, 'estado']);

    Route::resource('admin-caja', admin_CajaController::class);
    Route::post('busqueda_list_caja_fecha', [admin_CajaController::class, 'getindex_caja'])->name('admin-index-cajas.index_filtro');
    Route::post('admin-caja/resultadosPDF', [admin_CajaController::class, 'reporteCajaPrintPdfFechas'])->name('admin-caja.resultadosPDF'); //reporte PDF caja por sede
    Route::post('admin-caja/resultadosEXCEL', [admin_CajaController::class, 'reporteCajaPrintExcelFechas'])->name('admin-caja.resultadosEXCEL');
    Route::get('admin-caja/export/{admin_caja}', [admin_CajaController::class, 'reportePrintPdf'])->name('print-caja.pdf'); //reporte PDF total de caja
    Route::get('admin-caja/detalle-mov_caja-pdf/{registro}', [admin_CajaController::class, 'getRegistroCajapdf'])->name('detalle_mov_caja.pdf');
    Route::get('admin-caja/detalle-mov_caja-excel/{registro}', [admin_CajaController::class, 'getRegistroCajaexcel'])->name('detalle_mov_caja.excel');

    Route::resource('admin-cobros', admin_CobrosController::class);
    Route::post('busqueda_list_cobro_fecha', [admin_CobrosController::class, 'getindex_cobro'])->name('admin-index-cobros.index_filtro');
    Route::get('trans_cobros', [admin_CobrosController::class, 'getTransa_cobros']);
    Route::get('trans_cobros_medic', [admin_CobrosController::class, 'getTrans_cobros_medic']);
    Route::get('trans_cobros_medic_productos', [admin_CobrosController::class, 'getTrans_cobros_medic_productos']);
    Route::get('trans_cobros_precio', [admin_CobrosController::class, 'getTransa_cobros_precio']);
    Route::get('trans_procedimientos', [admin_CobrosController::class, 'getTransa_procedimientos']);
    Route::get('trans_procedimientos_precio', [admin_CobrosController::class, 'getTransa_procedimientos_precio']);
    Route::get('dt_ventas', [admin_CobrosController::class, 'getDt_ventas']);
    Route::get('dt_ventas_medicamen', [admin_CobrosController::class, 'getDt_ventas_medicamen']);
    Route::get('busqueda_profesion_cobro', [admin_CobrosController::class, 'getbusqueda_profesion']);
    Route::get('/cobros/filtrar/fecha', [admin_CobrosController::class, 'filtrar_fecha']);
    Route::post('admin-cobros/resultadosEXCEL', [admin_CobrosController::class, 'reporteCobroPrintExcelFechas'])->name('admin-cobros.resultadosEXCEL');
    Route::get('admin-cobros/resultadosEXCEL/show', [admin_CobrosController::class, 'reporteCobroPrintExcelFechas'])->name('admin-cobros.resultadosEXCELshow');
    Route::get('admin-cobros/detalle-cobros-pdf/{admin_cobro}', [admin_CobrosController::class, 'getCobropdf'])->name('detalle_cobros.pdf'); //reporte PDF detalle de cobros
    Route::get('dt_eauxiliar', [admin_CobrosController::class, 'getDt_eauxiliar']);

    Route::resource('admin-pagos', admin_PagosController::class);
    Route::post('busqueda_list_pago_fecha', [admin_PagosController::class, 'getindex_pago'])->name('admin-index-pagos.index_filtro');
    Route::get('trans_compra', [admin_PagosController::class, 'getTrans_compra']);
    Route::get('trans_pagos_medic', [admin_PagosController::class, 'getTrans_pagos_medic']);
    Route::get('trans_filtro_pdf', [admin_PagosController::class, 'gettrans_filtro_pdf']);
    Route::get('dt_compras', [admin_PagosController::class, 'getDt_compras']);
    Route::get('dt_ordenesservicios', [admin_PagosController::class, 'getDt_servicios']);
    Route::get('dt_vendedores', [admin_PagosController::class, 'getDt_ventas_vendedor']);
    Route::get('/pagos/filtrar/fecha', [admin_PagosController::class, 'filtrar_fecha']);
    Route::post('admin-pagos/resultadosEXCEL', [admin_PagosController::class, 'reportePagoPrintExcelFechas'])->name('admin-pagos.resultadosEXCEL');
    Route::get('admin-pagos/resultadosEXCEL/show', [admin_PagosController::class, 'reportePagoPrintExcelFechas'])->name('admin-pagos.resultadosEXCELshow');
    Route::get('admin-pagos/detalle-pagos-pdf/{admin_pago}', [admin_PagosController::class, 'getPagopdf'])->name('detalle_pagos.pdf'); //reporte PDF detalle de pagos
});

require __DIR__.'/auth.php';
