<?php

namespace App\Http\Controllers;

use App\Events\cobroEvent;
use App\Exports\CobroExportFecha;
use App\Exports\ExcelCobroExport;
use App\Exports\ExcelCobroFechaExport;
use App\Http\Requests\CobroRequest;
use App\Http\Requests\StoreCobroRequest;
use App\Models\Atencion;
use App\Models\Billeteradigital;
use App\Models\Caja;
use App\Models\Cita;
use App\Models\Cobro;
use App\Models\Consulta;
use App\Models\Cuentabancaria;
use App\Models\Cuentacontable;
use App\Models\Cuentasbanco;
use App\Models\Detallecobro;
use App\Models\Detallefarmacia;
use App\Models\Eauxiliar;
use App\Models\Especialidad;
use App\Models\Farmacia;
use App\Models\Medicamentoreceta;
use App\Models\Movimientocaja;
use App\Models\Paciente;
use App\Models\Procedimientoclinico;
use App\Models\Producto;
use App\Models\Razonsocial;
use App\Models\Receta;
use App\Models\Registrocaja;
use App\Models\Sede;
use App\Models\Venta;
use App\Models\Imagenologia;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use Luecano\NumeroALetras\NumeroALetras;
use Illuminate\Support\Facades\Gate;

class admin_CobrosController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if(Auth::user()->role_id == '1'){
            $now = Carbon::now();
            $sedes = Sede::all()->where('estado', 'Activo');
            $formatter = new NumeroALetras();
            $registro_caja = Registrocaja::latest('id')->where('estado','APERTURADA')->first();
            $cobros = Cobro::all();
            return view('ADMINISTRADOR.TESORERIA.cobros.index', compact('cobros','registro_caja', 'now', 'sedes', 'formatter'));
        }if(Auth::user()->role_id == '4'){
            $now = Carbon::now();
            $sedes = Sede::all()->where('estado', 'Activo');
            $formatter = new NumeroALetras();
            $registro_caja = Registrocaja::latest('id')->where('estado','APERTURADA')->first();
            $cobros = Cobro::where('sede_id', Auth::user()->persona->sede_id)->get();
            return view('ADMINISTRADOR.TESORERIA.cobros.index', compact('cobros','registro_caja', 'now', 'sedes', 'formatter'));
        }else{
            abort(403);
        };
    }

    public function getindex_cobro(Request $request)
    {   $valor_fecha_inicial = $request->input('fec_ini'). ' 00:00:00';
        $valor_fecha_final = $request->input('fec_fin'). ' 23:59:59';

        if(Auth::user()->role_id == '1'){
            $now = Carbon::now();
            $sedes = Sede::all()->where('estado', 'Activo');
            $formatter = new NumeroALetras();
            $registro_caja = Registrocaja::latest('id')->where('estado','APERTURADA')->first();
            $cobros = Cobro::whereBetween('fecha', [$valor_fecha_inicial,$valor_fecha_final])->get();
            return view('ADMINISTRADOR.TESORERIA.cobros.index', compact('cobros','registro_caja', 'now', 'sedes', 'formatter'));
        }if(Auth::user()->role_id == '4'){
            $now = Carbon::now();
            $sedes = Sede::all()->where('estado', 'Activo');
            $formatter = new NumeroALetras();
            $registro_caja = Registrocaja::latest('id')->where('estado','APERTURADA')->first();
            $cobros = Cobro::whereBetween('fecha', [$valor_fecha_inicial,$valor_fecha_final])->where('sede_id', Auth::user()->persona->sede_id)->get();
            return view('ADMINISTRADOR.TESORERIA.cobros.index', compact('cobros','registro_caja', 'now', 'sedes', 'formatter'));
        }else{
            abort(403);
        };
    }

    public function filtrar_cobros_sede(Request $request, Sede $admin_cobros_sede)
    {
        if(Auth::user()->role_id == '1' || Auth::user()->role_id == '4'){
            $now = Carbon::now();
            $sedes = Sede::all();
            $name_sede = Sede::where('id', $admin_cobros_sede->id)->first();
            $formatter = new NumeroALetras();
            $registro_caja = Registrocaja::latest('id')->where('estado','APERTURADA')->first();
            $cobros = Cobro::where('sede_id', "=", $admin_cobros_sede->id)->get();
            return view('ADMINISTRADOR.TESORERIA.cobros.index', compact('cobros','registro_caja', 'now', 'sedes', 'formatter', 'name_sede'));
        }else{
            abort(403);
        };
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role_id == '1' || Auth::user()->role_id == '4'){
            $now = Carbon::now();
            $fecha_actual = Carbon::now()->format('Y-m-d');
    
            $cobro = Cobro::orderBy('id','desc')->first();
            $nubRowv =$cobro?$cobro->id+1:1;
            $codigC = 'COB-'.$now->format('Ymd').'-'.$nubRowv;
            $bancos = Cuentabancaria::where('estado','Activo')->where('sede_id', Auth::user()->persona->sede_id)->get();
            $producto = Producto::where('tipo_producto','Otros')->where('cantidad','>','0')->get();
            $especialidades = Especialidad::where('estado', 'Activo')->get();
            return view('ADMINISTRADOR.TESORERIA.cobros.create', compact('fecha_actual','codigC','bancos','producto','especialidades'));
        }else{
            abort(403);
        };
    }

    public function getcodigo_cobro(Request $request){
        if($request->ajax()){
            $venta = Venta::where('estado_venta','ABIERTA')->where('id_user',$request->id_client)->get();
            foreach($venta as $ventas){
                $ArrayVenta[$ventas->id] = [$ventas->codigo_venta, $ventas->total_cobrado,$ventas->cliente,$ventas->direcciones,$ventas->nro_contacto,$ventas->nro_identificacion, $ventas->tipo_identificacion];
            }                   
            return response()->json($ArrayVenta);
            
        }
    }
    public function getTransa_cobros(Request $request){
        if($request->ajax()){
            if($request->tipo_atencion_val == 'Cita programada'){
                $transc_atencione = DB::table('personas as per')->join('pacientes as pac','pac.persona_id','=','per.id')->join('citas as cit','cit.paciente_id','=','pac.id')->select('per.id','per.name', 'per.surnames', 'per.nro_identificacion')->groupby('per.id','per.name', 'per.surnames', 'per.nro_identificacion')->where('per.sede_id', Auth::user()->persona->sede_id)->where('cit.estado','=','Activo')->get();
                foreach($transc_atencione as $transc_atenciones){
                    $ArrayVenta[$transc_atenciones->id] = [$transc_atenciones->name.' '.$transc_atenciones->surnames, $transc_atenciones->nro_identificacion];
                }                   
                return response()->json($ArrayVenta);
            }else{
                $transc_atencione = DB::table('personas as per')->join('pacientes as pac','pac.persona_id','=','per.id')->select('per.id','per.name','per.surnames')->select('per.id','per.name', 'per.surnames', 'per.nro_identificacion')->groupby('per.id','per.name', 'per.surnames', 'per.nro_identificacion')->where('per.sede_id', Auth::user()->persona->sede_id)->where('per.tipo_persona','Paciente')->where('pac.estado','Activo')->get();
                foreach($transc_atencione as $transc_atenciones){
                    $ArrayVenta[$transc_atenciones->id] = [$transc_atenciones->name.' '.$transc_atenciones->surnames, $transc_atenciones->nro_identificacion];
                }                   
                return response()->json($ArrayVenta);
            }
        }
    }

    public function getTrans_cobros_medic(Request $request){
        if($request->ajax()){
            if($request->tipo_receta_val == 'Receta'){
                if(DB::table('personas as per')->join('pacientes as pac','pac.persona_id','=','per.id')->join('atencions as ate','ate.paciente_id','=','pac.id')->select('per.id','per.name', 'per.surnames', 'per.nro_identificacion')->groupby('per.id','per.name', 'per.surnames', 'per.nro_identificacion')->where('per.sede_id', Auth::user()->persona->sede_id)->where('ate.estado','=','Completado')->exists()){

                    $transc_medic = DB::table('personas as per')->join('pacientes as pac','pac.persona_id','=','per.id')->join('atencions as ate','ate.paciente_id','=','pac.id')->select('per.id','per.name', 'per.surnames', 'per.nro_identificacion')->join('recetas as rec','rec.atencion_id','=','ate.id')->groupby('per.id','per.name', 'per.surnames', 'per.nro_identificacion')->where('per.sede_id', Auth::user()->persona->sede_id)->where('ate.estado','=','Completado')->where('rec.estado_pago','!=','Pagado')->get();
                    
                    foreach($transc_medic as $transc_medics){
                        if($transc_medics != ''){
                            $ArrayVenta[$transc_medics->id] = [$transc_medics->name.' '.$transc_medics->surnames, $transc_medics->nro_identificacion];
                        }else{
                            $ArrayVenta[1] = ['no_existe'];
                        }
                    }                   
                    return response()->json($ArrayVenta);
                }
            }else{
                $transc_libre = DB::table('personas as per')->join('pacientes as pac','pac.persona_id','=','per.id')->select('per.id','per.name', 'per.surnames', 'per.nro_identificacion')->groupby('per.id','per.name', 'per.surnames', 'per.nro_identificacion')->where('per.sede_id', Auth::user()->persona->sede_id)->where('per.tipo_persona','Paciente')->where('pac.estado','Activo')->get();
                foreach($transc_libre as $transc_libres){
                    $ArrayVenta[$transc_libres->id] = [$transc_libres->name.' '.$transc_libres->surnames, $transc_libres->nro_identificacion];
                }                   
                return response()->json($ArrayVenta);
            }
        }
    }

    public function getTrans_cobros_medic_productos (Request $request){
        if($request->ajax()){
            if($request->tipo_receta_val == 'Libre'){
                $valor_producto = Producto::where('cantidad','>','0')->where('tipo_producto','Medicamento')->get();
                foreach($valor_producto as $valor_productos){
                    $ArrayVenta[$valor_productos->id] = [$valor_productos->name];
                }
    
                return response()->json($ArrayVenta);
            }
        }
    }
    public function getTransa_cobros_precio(Request $request){
        if($request->ajax()){
            $valor_producto = Producto::where('id',$request->concepto)->first();
            $ArrayVenta[1] = [$valor_producto->precio_venta];

            return response()->json($ArrayVenta);
        }
    }

    public function getTransa_procedimientos(Request $request){
        if($request->ajax()){
            if($request->tipoprocedimiento == 'PROCEDIMIENTOS'){
                $valor_procedimiento = Procedimientoclinico::where('estado','Activo')->get();
                foreach($valor_procedimiento as $valor_procedimientos){
                    $ArrayVenta[$valor_procedimientos->id] = [$valor_procedimientos->name];
                }
    
                return response()->json($ArrayVenta);
            }
        }
    }

    public function getTransa_procedimientos_precio(Request $request){
        if($request->ajax()){
            $valor_producto = Procedimientoclinico::where('id',$request->concepto)->first();
            $ArrayVenta[1] = [$valor_producto->costo];

            return response()->json($ArrayVenta);
        }
    }

    public function getDt_ventas(Request $request){
        if($request->ajax()){
            if($request->tipo_atencion_val == 'Cita programada'){

                $now = Carbon::now();
                $atenc = Atencion::orderBy('id','desc')->first();
                if($atenc){
                    if($atenc->created_at->format('m') == $now->format('m')){
                        $nubRow =$atenc?$atenc->codigo+1:1;
                        //$nubRow ='2964';
                        $correlativo_prog = sprintf('%04d', trim($nubRow,'"'));
                        $codigo_atenc_slug = $correlativo_prog;
                    }else{
                        $nubRow =$atenc?1:1;
                        //$nubRow ='2964';
                        $correlativo_prog = sprintf('%04d', trim($nubRow,'"'));
                        $codigo_atenc_slug = $now->format('Y')[2].''.$now->format('Y')[3].''.$now->format('m').''.$correlativo_prog;
                    }
                }else{
                    $nubRow =$atenc?1:1;
                    //$nubRow ='2964';
                    $correlativo_prog = sprintf('%04d', trim($nubRow,'"'));
                    $codigo_atenc_slug = $now->format('Y')[2].''.$now->format('Y')[3].''.$now->format('m').''.$correlativo_prog;
                }

                $citas_cobro = DB::table('pacientes as pac')->join('citas as cit','cit.paciente_id','=','pac.id')->select('cit.id','cit.codigo','cit.especialidad_id','cit.fecha', 'cit.medico_id')->where('pac.persona_id',$request->operac_cliente)->where('cit.estado','Activo')->get();
                foreach($citas_cobro as $citas_cobros){
                    $especialidad_monto = Especialidad::where('id',$citas_cobros->especialidad_id)->first();
                    $ArrayVenta[$citas_cobros->id] = [$citas_cobros->codigo, $especialidad_monto->costo, $citas_cobros->fecha,'atencion_programada', $codigo_atenc_slug, $especialidad_monto->name, $especialidad_monto->id, $citas_cobros->medico_id];
                    
                    // if(Farmacia::where('atencion',$atenciones_cobros->codigo)->exists()){
                    //     $receta_monto = Farmacia::where('atencion',$atenciones_cobros->codigo)->first();
                    //     array_push($ArrayVenta, [$receta_monto->codigo, $receta_monto->total, $receta_monto->fecha,'receta']);
                    // }
                }                   
                return response()->json($ArrayVenta);
            }
            if($request->tipo_atencion_val == 'Atencion directa'){
                $now = Carbon::now();
                $atenc = Atencion::orderBy('id','desc')->first();
                if($atenc){
                    if($atenc->created_at->format('m') == $now->format('m')){
                        $nubRow =$atenc?$atenc->codigo+1:1;
                        //$nubRow ='2964';
                        $correlativo_prog = sprintf('%04d', trim($nubRow,'"'));
                        $codigo_atenc_slug = $correlativo_prog;
                    }else{
                        $nubRow =$atenc?1:1;
                        //$nubRow ='2964';
                        $correlativo_prog = sprintf('%04d', trim($nubRow,'"'));
                        $codigo_atenc_slug = $now->format('Y')[2].''.$now->format('Y')[3].''.$now->format('m').''.$correlativo_prog;
                    }
                }else{
                    $nubRow =$atenc?1:1;
                    //$nubRow ='2964';
                    $correlativo_prog = sprintf('%04d', trim($nubRow,'"'));
                    $codigo_atenc_slug = $now->format('Y')[2].''.$now->format('Y')[3].''.$now->format('m').''.$correlativo_prog;
                }

                // $paciente_val = Paciente::where('persona_id',$request->operac_cliente)->first();

                // $admin_atencione = new Atencion();
                // $admin_atencione->codigo = $codigo_atenc_slug;
                // $admin_atencione->slug = Str::slug('AT'.$codigo_atenc_slug);
                // $admin_atencione->tipo = 'Atención directa';
                // $admin_atencione->fecha = $now->format('Y-m-d');
                // $admin_atencione->hora = $now->format('H:i:s');
                // $admin_atencione->duracion = '15';
                // $admin_atencione->paciente_id = $paciente_val->id;
                // $admin_atencione->especialidad_id = $request->value_especial;
                // $admin_atencione->medico_id = $request->value_medic;
                // $admin_atencione->descripcion = 'sin descripcion';
                // $admin_atencione->registrado_por = Auth::user()->persona->name.' '.Auth::user()->persona->surnames.' - '.Auth::user()->role->name;
                // $admin_atencione->estado = 'En atención';
                // $admin_atencione->save();

                
                $especialidad_monto = Especialidad::where('id',$request->value_especial)->first();
                $ArrayVenta[1] = [$codigo_atenc_slug, $especialidad_monto->costo, $now->format('Y-m-d'),'atencion_directa', $codigo_atenc_slug, $especialidad_monto->name];

                return response()->json($ArrayVenta);
            }
        }
    }

    public function getDt_eauxiliar(Request $request){
        if($request->ajax()){
            if($request->tipo_atencion_val == 'EAUXILIAR'){
                $now = Carbon::now();
                $paciente_val = Paciente::where('persona_id',$request->operac_cliente)->first();
                $especialidad_monto = Especialidad::where('id',7)->first();

                if(DB::table('atencions as ate')->join('eauxiliares as exa','exa.atencion_id','=','ate.id')->where('ate.paciente_id',$paciente_val->id)->where('exa.estado_pago','Pendiente')->exists()){
                    $eauxiliar = DB::table('atencions as ate')->join('eauxiliares as exa','exa.atencion_id','=','ate.id')->where('ate.paciente_id',$paciente_val->id)->where('exa.estado_pago','Pendiente')->get();
                    foreach($eauxiliar as $eauxiliares){
                        $ArrayVenta[$eauxiliares->id] = [$eauxiliares->nro_solicitud,$especialidad_monto->costo,$eauxiliares->fecha_auxiliar,'examen_auxiliar',$eauxiliares->nro_solicitud,$especialidad_monto->name, $eauxiliares->atencion_id];
                    }
                    return response()->json($ArrayVenta);
                }
            }
        }
    }
    
    public function getDt_ventas_medicamen(Request $request){
        if($request->ajax()){
            if($request->tipo_receta_val == 'Receta'){
                $now = Carbon::now();
                
                if(DB::table('pacientes as pac')->join('atencions as aten','aten.paciente_id','=','pac.id')->join('recetas as rec','rec.atencion_id','=','aten.id')->join('medicamento_receta as medrec','medrec.receta_id','=','rec.id')->select('rec.id','aten.codigo','aten.id as atencion_id_val','rec.nro_solicitud','aten.especialidad_id','rec.fecha', 'aten.medico_id','medrec.cantidad as cantidades_medicamento','medrec.producto_id')->where('pac.persona_id',$request->operac_cliente)->where('rec.estado_pago','Pendiente')->exists()){

                    $recetas_cobro = DB::table('pacientes as pac')->join('atencions as aten','aten.paciente_id','=','pac.id')->join('recetas as rec','rec.atencion_id','=','aten.id')->join('medicamento_receta as medrec','medrec.receta_id','=','rec.id')->select('rec.id','aten.codigo','aten.id as atencion_id_val','rec.nro_solicitud','aten.especialidad_id','rec.fecha', 'aten.medico_id','medrec.cantidad as cantidades_medicamento','medrec.producto_id')->where('pac.persona_id',$request->operac_cliente)->where('rec.estado_pago','Pendiente')->get();
                        $costo_total_receta = 0;
                    foreach($recetas_cobro as $recetas_cobros){
    
                        //$dtlle_producto_costo = Producto::where('id',$recetas_cobros->producto_id)->where('tipo_producto','Medicamento')->first();
                        
                        $dtlle_producto_costo = Producto::where('id',$recetas_cobros->producto_id)->first();
    
                        $costo_total_receta = $costo_total_receta + floatval($recetas_cobros->cantidades_medicamento * $dtlle_producto_costo->precio_venta);
                        $especialidad_monto = Especialidad::where('id',$recetas_cobros->especialidad_id)->first();
                        
                        $ArrayVenta[$recetas_cobros->id] = [$recetas_cobros->codigo, $costo_total_receta, $recetas_cobros->fecha,'receta_programada', $recetas_cobros->nro_solicitud, $especialidad_monto->name, $especialidad_monto->id, $recetas_cobros->medico_id, $recetas_cobros->atencion_id_val];
                        
                        // if(Farmacia::where('atencion',$atenciones_cobros->codigo)->exists()){
                        //     $receta_monto = Farmacia::where('atencion',$atenciones_cobros->codigo)->first();
                        //     array_push($ArrayVenta, [$receta_monto->codigo, $receta_monto->total, $receta_monto->fecha,'receta']);
                        // }
                    }                   
                    return response()->json($ArrayVenta);
                }
            }
        };
    }
    public function getbusqueda_profesion(Request $request){
        if($request->ajax()){
            // $admin_profesionale = Medico::all()->where('estado', 'Activo')->where('id', '!=', 1)->where('profesion_id',$request->value_especial);
            $admin_profesionale = DB::table('personas as per')->join('medicos as med','med.persona_id','=','per.id')->select('med.id','per.name','per.surnames')->where('med.estado', 'Activo')->where('med.id', '!=', 1)->where('med.profesion_id',$request->value_especial)->get();

            foreach($admin_profesionale as $admin_profesionales){
                $ArrayList[$admin_profesionales->id] = [$admin_profesionales->name, $admin_profesionales->surnames];
            }

            return response()->json($ArrayList);
        }
    }

    public function filtrar_fecha(Request $request){
        if($request->ajax()){
            if($request->autenticado == 'TODOS'){
                $venta = Cobro::all();
                foreach($venta as $ventas){
                    $dtlle_cobro = Detallecobro::where('cobro_id',$ventas->id)->get();
                        foreach($dtlle_cobro as $dtlle_cobros){
                            $comprobante = $dtlle_cobros->concepto;
                        }
                    $Arraylist[$ventas->id] = [$ventas->nro_operacion,$ventas->cliente, $ventas == 'VENTA'?'Cobro a comprobantes: '.$comprobante:'Bajo otro concepto: '.$comprobante,$ventas->slug,'TODOS',$ventas->fecha,$ventas->total_cobrado];
                }

                return response()->json($Arraylist);
                
            }else{
                if($venta = Cobro::where('sede_id', $request->autenticado)->where('fecha',$request->fecha)->exists()){
                    $venta = Cobro::where('sede_id', $request->autenticado)->where('fecha',$request->fecha)->get();
                    
                    foreach($venta as $ventas){
                        $dtlle_cobro = Detallecobro::where('cobro_id',$ventas->id)->get();
                        foreach($dtlle_cobro as $dtlle_cobros){
                            $comprobante = $dtlle_cobros->concepto;
                        }
                        $Arraylist[$ventas->id] = [$ventas->nro_operacion,$ventas->cliente, $ventas == 'VENTA'?'Cobro a comprobantes: '.$comprobante:'Bajo otro concepto: '.$comprobante,$ventas->slug,$ventas->sede->name,$ventas->fecha,$ventas->total_cobrado];
                    }

                    return response()->json($Arraylist);
                }else{
                    $Arraylist[1] = ['vacio'];
                    return response()->json($Arraylist);
                }
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCobroRequest $request)
    {
        // echo '<pre>';
        // var_dump($request->hasFile('comprobante'));
        // die();
        // echo '</pre>';

        if(Cuentabancaria::where('nro_cuenta',$request->input('ingreso'))->exists()){
            $valor_cuenta_id = Cuentabancaria::where('nro_cuenta',$request->input('ingreso'))->first();
        }

        if($request->input('recibido') > $request->input('por_cobrar')){
            return redirect()->back()->with('montoElevado', 'ok');
        }else{
            
            $now = Carbon::now();
            $cobros = new Cobro();
            $cobros->nro_operacion = $request->input('nro_operacion');
            $cobros->slug = Str::slug($request->input('nro_operacion').'-'.Auth::user()->persona->sede_id);
            $cobros->tipo_transaccion = $request->input('tipo_transaccion');
            $cobros->fecha = $request->input('fecha');
            $cobros->tipo_moneda = $request->input('tipo_moneda');
            $cobros->cliente = $request->input('cliente');
            $cobros->ingreso = $request->input('ingreso');
            if($request->input('ingreso') != 'Efectivo'){
                $cobros->cuentabanco_id = $valor_cuenta_id?$valor_cuenta_id->id:0;
            }
            $cobros->medio_pago = $request->input('ingreso') == 'Efectivo'?'Efectivo':$request->input('medio_pago');
            $cobros->subtotal = $request->input('subtotal');
            $cobros->igv = $request->input('igv')?$request->input('igv'):0;
            $cobros->total_cobrado = $request->input('total_cobrado');
            $cobros->descripcion = $request->input('descripcion')?$request->input('descripcion'):'';
            $cobros->registrado_por = Auth::user()->persona->name.' '.Auth::user()->persona->lastname_padre.' - '.Auth::user()->role->name;
            $cobros->sede_id = Auth::user()->persona->sede_id;
            $cobros->save();
            
            // Creacion del registro de farmacia por estado pendiente
                $now = Carbon::now();
                $atenciones = Atencion::all();
        
                $farmac = Farmacia::orderBy('id','desc')->first();
                if($farmac){
                    if($farmac->created_at->format('m') == $now->format('m')){
                        $nubRow =$farmac?$farmac->codigo+1:1;
                        //$nubRow ='2964';
                        $correlativo_prog = sprintf('%04d', trim($nubRow,'"'));
                        $codigo_farmac_slug = $correlativo_prog;
                    }else{
                        $nubRow =$farmac?1:1;
                        //$nubRow ='2964';
                        $correlativo_prog = sprintf('%04d', trim($nubRow,'"'));
                        $codigo_farmac_slug = $now->format('Y')[2].''.$now->format('Y')[3].''.$now->format('m').''.$correlativo_prog;
                    }
                }else{
                    $nubRow =$farmac?1:1;
                    //$nubRow ='2964';
                    $correlativo_prog = sprintf('%04d', trim($nubRow,'"'));
                    $codigo_farmac_slug = $now->format('Y')[2].''.$now->format('Y')[3].''.$now->format('m').''.$correlativo_prog;
                }

                if($request->input('tipo_transaccion') == 'MEDICAMENTOS'){
                    if($request->input('tipo_receta') == 'Libre'){
                        $farmaciass = new Farmacia();
                        $farmaciass->codigo = $codigo_farmac_slug;
                        $farmaciass->slug = Str::slug('F'.$codigo_farmac_slug);
                        $farmaciass->fecha = $now->format('Y-m-d');
                        $farmaciass->tipo_atencion = 'Atencion Directa';
                        $farmaciass->descripcion = 'sin descripcion';
                        $farmaciass->subtotal = round(($request->input('total_cobrado')/1.18),2);
                        $farmaciass->igv = round((($request->input('total_cobrado')/1.18)*0.18),2);
                        $farmaciass->total = $request->input('total_cobrado');
                        $farmaciass->estado = 'Pendiente';
                        $farmaciass->sede_id = Auth::user()->persona->sede_id;
                        $farmaciass->save();
                    }
                }

            // fin de la creacion de la farmacia

            $paciente_val = Paciente::where('persona_id',$request->input('person_ids'))->first();

            $contador = $request->input('contador');
            $concepto = $request->input('concepto');
            $total = $request->input('total');
            $cobrado = $request->input('cobrado');
            $por_cobrar = $request->input('por_cobrar');
            $recibido = $request->input('recibido');
            $codigo_venta = $request->input('codigo_venta');
            
            $valor = $request->input('valor');
            $impuesto = $request->input('impuesto');
            $cantidad = $request->input('cantidad');
            $observaciones = $request->input('observaciones');
            
             
        
                if(isset($contador)){
                    foreach ($contador as $key => $name) {
                        if($request->input('tipo_transaccion') == 'ATENCION'){
                            if($request->input('tipo') == 'Atencion directa'){
                                if($recibido[$key] || $recibido[$key] == '0'){
                                    $espec_val_name = Especialidad::where('id', $request->input('value_especial')[$key])->first();

                                    $detallecobro = new Detallecobro();
                                    $detallecobro->cobro_id = $cobros->id;
                                    $detallecobro->codigo_venta = $codigo_venta[$key];
                                    $detallecobro->concepto = 'AT:'.$concepto[$key].' - '.$espec_val_name->name;
                                    $detallecobro->total = $total[$key];
                                    $detallecobro->cobrado = $recibido[$key];
                                    $detallecobro->por_cobrar = $por_cobrar[$key]-$recibido[$key];
                                    $detallecobro->monto_recibido = $recibido[$key];
                                    $detallecobro->save();

                                    // Creacion del codigo de la atencion
                                        $now = Carbon::now();
                                        $atenc = Atencion::orderBy('id','desc')->first();
                                        if($atenc){
                                            if($atenc->created_at->format('m') == $now->format('m')){
                                                $nubRow =$atenc?$atenc->codigo+1:1;
                                                //$nubRow ='2964';
                                                $correlativo_prog = sprintf('%04d', trim($nubRow,'"'));
                                                $codigo_atenc_slug = $correlativo_prog;
                                            }else{
                                                $nubRow =$atenc?1:1;
                                                //$nubRow ='2964';
                                                $correlativo_prog = sprintf('%04d', trim($nubRow,'"'));
                                                $codigo_atenc_slug = $now->format('Y')[2].''.$now->format('Y')[3].''.$now->format('m').''.$correlativo_prog;
                                            }
                                        }else{
                                            $nubRow =$atenc?1:1;
                                            //$nubRow ='2964';
                                            $correlativo_prog = sprintf('%04d', trim($nubRow,'"'));
                                            $codigo_atenc_slug = $now->format('Y')[2].''.$now->format('Y')[3].''.$now->format('m').''.$correlativo_prog;
                                        }
                                    // Fin del codigo de la atencion

                                    // Creamos la atencion, y asignamos el codigo de la parte superior
                                        $admin_atencione = new Atencion();
                                        $admin_atencione->codigo = $codigo_atenc_slug;
                                        $admin_atencione->slug = Str::slug('AT'.$codigo_atenc_slug);
                                        $admin_atencione->tipo = 'Atención directa';
                                        $admin_atencione->fecha = $now->format('Y-m-d');
                                        $admin_atencione->hora = $now->format('H:i:s');
                                        $admin_atencione->duracion = '15';
                                        $admin_atencione->paciente_id = $paciente_val->id;
                                        $admin_atencione->especialidad_id = $request->input('value_especial')[$key];
                                        $admin_atencione->medico_id = $request->input('profesional_id')[$key];
                                        $admin_atencione->descripcion = 'sin descripcion';
                                        $admin_atencione->registrado_por = Auth::user()->persona->name.' '.Auth::user()->persona->surnames.' - '.Auth::user()->role->name;
                                        $admin_atencione->estado = 'En atención';
                                        $admin_atencione->sede_id = Auth::user()->persona->sede_id;
                                        $admin_atencione->save();
                                        
                                        //Generar consulta si es por terapia
                                            $consult = Consulta::orderBy('id','desc')->first();
                                            if($consult){
                                                if($consult->created_at->format('m') == $now->format('m')){
                                                    $nubRow =$consult?$consult->nro_solicitud+1:1;
                                                    //$nubRow ='2964';
                                                    $correlativo_prog = sprintf('%04d', trim($nubRow,'"'));
                                                    $codigo_consult_slug = $correlativo_prog;
                                                }else{
                                                    $nubRow =$consult?1:1;
                                                    //$nubRow ='2964';
                                                    $correlativo_prog = sprintf('%04d', trim($nubRow,'"'));
                                                    $codigo_consult_slug = $now->format('Y')[2].''.$now->format('Y')[3].''.$now->format('m').''.$correlativo_prog;
                                                }
                                            }else{
                                                $nubRow =$consult?1:1;
                                                //$nubRow ='2964';
                                                $correlativo_prog = sprintf('%04d', trim($nubRow,'"'));
                                                $codigo_consult_slug = $now->format('Y')[2].''.$now->format('Y')[3].''.$now->format('m').''.$correlativo_prog;
                                            }

                                            if($request->input('value_especial')[$key] == '6'){
                                                $store_consulta_sesion = new Consulta();
                                                $store_consulta_sesion->nro_solicitud = $codigo_consult_slug;
                                                $store_consulta_sesion->slug = Str::slug('CO'.$codigo_consult_slug);
                                                $store_consulta_sesion->sesiones_programadas = $request->input('sesiones_value');
                                                $store_consulta_sesion->atencion_id = $admin_atencione->id;
                                                $store_consulta_sesion->save();
                                            }
                                        //
                                    // Fin de la creacion de la atencion

                                    $update_estado_atencion = Atencion::where('codigo',$admin_atencione->codigo)->first();
                                    if($update_estado_atencion){
                                        $update_estado_atencion->estado_pago = 'Pagado';
                                        $update_estado_atencion->save();
                    
                                    }
                    
                                    if($request->input('medio_pago') != 'Efectivo'){
                                        $cuentas = Cuentabancaria::where('nro_cuenta',$request->input('ingreso'))->first();
                                        if($cuentas){
                                            $cuentas->apertura_cuenta = $cuentas->apertura_cuenta+$recibido[$key];
                                            $cuentas->save();
                        
                                            $cuenta_banco_total = DB::table('cuentasbancos')->select(DB::raw('sum(apertura_cuenta) as cuenta_t'))->where('nro_cuenta',$request->input('ingreso'))->first();
                                            $caja = Caja::where('sede_id',Auth::user()->persona->sede_id)->first();
                                            $caja->total_cuenta_banco = $cuenta_banco_total->cuenta_t;
                                            $caja->total = $caja->total_efectivo+$caja->total_cuenta_banco;
                                            $caja->save();
                    
                                            $registro = Registrocaja::latest('id')->where('sede_id',Auth::user()->persona->sede_id)->first();
                                            $registro->saldo_ingreso = $registro->saldo_ingreso+$recibido[$key];
                                            $registro->save();
                    
                                            $now = Carbon::now();
                                            $mov_caja = Movimientocaja::orderBy('id','desc')->first();
                                            $nubRow =$mov_caja?$mov_caja->id+1:1;
                                            $codigo = 'MOVCAJA-'.$now->format('Ymd').'-'.$nubRow;
                    
                                            $movimiento_caja = new Movimientocaja();
                                            $movimiento_caja->codigo = $codigo;
                                            $movimiento_caja->slug = Str::slug($codigo);
                                            $movimiento_caja->motivo = 'ATENCION DIRECTA';
                                            $movimiento_caja->asunto = $espec_val_name->name;
                                            $movimiento_caja->paciente = $request->input('asunto');
                                            $movimiento_caja->metodo = $request->input('medio_pago');
                                            $movimiento_caja->total = $recibido[$key];
                                            $movimiento_caja->registrocaja_id = $registro->id;
                                            $movimiento_caja->operaciones = 'COBRO';
                                            $movimiento_caja->cuenta = $request->input('ingreso');
                                            $movimiento_caja->save();
                                        }
                                    }
                    
                                    if($request->input('medio_pago') == 'Efectivo'){
                                        $caja = Caja::where('sede_id',Auth::user()->persona->sede_id)->first();
                                        $caja->total_efectivo = $caja->total_efectivo+$recibido[$key];
                                        $caja->total = $caja->total_efectivo+$caja->total_cuenta_banco;
                                        $caja->save();
                    
                                        $registro = Registrocaja::latest('id')->where('sede_id',Auth::user()->persona->sede_id)->first();
                                        $registro->saldo_ingreso = $registro->saldo_ingreso+$recibido[$key];
                                        $registro->save();
                    
                                        $now = Carbon::now();
                                        $mov_caja = Movimientocaja::orderBy('id','desc')->first();
                                        $nubRow =$mov_caja?$mov_caja->id+1:1;
                                        $codigo = 'MOVCAJA-'.$now->format('Ymd').'-'.$nubRow;
                    
                                        $movimiento_caja = new Movimientocaja();
                                        $movimiento_caja->codigo = $codigo;
                                        $movimiento_caja->slug = Str::slug($codigo);
                                        $movimiento_caja->motivo = 'ATENCION DIRECTA';
                                        $movimiento_caja->asunto = $espec_val_name->name;
                                        $movimiento_caja->paciente = $request->input('asunto');
                                        $movimiento_caja->metodo = $request->input('medio_pago');
                                        $movimiento_caja->total = $recibido[$key];
                                        $movimiento_caja->registrocaja_id = $registro->id;
                                        $movimiento_caja->operaciones = 'COBRO';
                                        $movimiento_caja->cuenta = $request->input('ingreso');
                                        $movimiento_caja->save();
                                    }
        
                                }
                            }else{
                                if($recibido[$key] || $recibido[$key] == '0'){
                                    $espec_val_name = Especialidad::where('id', $request->input('value_especial')[$key])->first();

                                    $detallecobro = new Detallecobro();
                                    $detallecobro->cobro_id = $cobros->id;
                                    $detallecobro->codigo_venta = $codigo_venta[$key];
                                    $detallecobro->concepto = 'AT:'.$concepto[$key].' - '.$espec_val_name->name;
                                    $detallecobro->total = $total[$key];
                                    $detallecobro->cobrado = $recibido[$key];
                                    $detallecobro->por_cobrar = $por_cobrar[$key]-$recibido[$key];
                                    $detallecobro->monto_recibido = $recibido[$key];
                                    $detallecobro->save();
                    
                                    
                                    // Creacion del codigo de la atencion
                                        $now = Carbon::now();
                                        $atenc = Atencion::orderBy('id','desc')->first();
                                        if($atenc){
                                            if($atenc->created_at->format('m') == $now->format('m')){
                                                $nubRow =$atenc?$atenc->codigo+1:1;
                                                //$nubRow ='2964';
                                                $correlativo_prog = sprintf('%04d', trim($nubRow,'"'));
                                                $codigo_atenc_slug = $correlativo_prog;
                                            }else{
                                                $nubRow =$atenc?1:1;
                                                //$nubRow ='2964';
                                                $correlativo_prog = sprintf('%04d', trim($nubRow,'"'));
                                                $codigo_atenc_slug = $now->format('Y')[2].''.$now->format('Y')[3].''.$now->format('m').''.$correlativo_prog;
                                            }
                                        }else{
                                            $nubRow =$atenc?1:1;
                                            //$nubRow ='2964';
                                            $correlativo_prog = sprintf('%04d', trim($nubRow,'"'));
                                            $codigo_atenc_slug = $now->format('Y')[2].''.$now->format('Y')[3].''.$now->format('m').''.$correlativo_prog;
                                        }
                                    // Fin del codigo de la atencion
                                    
                                    // Creamos la atencion, y asignamos el codigo de la parte superior
                                        $admin_atencione = new Atencion();
                                        $admin_atencione->codigo = $codigo_atenc_slug;
                                        $admin_atencione->slug = Str::slug('AT'.$codigo_atenc_slug);
                                        $admin_atencione->tipo = 'Cita programada';
                                        $admin_atencione->fecha = $now->format('Y-m-d');
                                        $admin_atencione->hora = $now->format('H:i:s');
                                        $admin_atencione->duracion = '15';
                                        $admin_atencione->paciente_id = $paciente_val->id;
                                        $admin_atencione->especialidad_id = $request->input('value_especial')[$key];
                                        $admin_atencione->medico_id = $request->input('profesional_id')[$key];
                                        $admin_atencione->descripcion = 'sin descripcion';
                                        $admin_atencione->registrado_por = Auth::user()->persona->name.' '.Auth::user()->persona->surnames.' - '.Auth::user()->role->name;
                                        $admin_atencione->estado = 'En atención';
                                        $admin_atencione->sede_id = Auth::user()->persona->sede_id;
                                        $admin_atencione->save();
                                    // Fin de la creacion de la atencion

                                    $update_estado_atencion = Atencion::where('codigo',$admin_atencione->codigo)->first();
                                    if($update_estado_atencion){
                                        $update_estado_atencion->estado_pago = 'Pagado';
                                        $update_estado_atencion->save();
                    
                                    }
                                    
                                    // Validamos la cita programada y cambiamos estado a completo
                                        $update_estado_cita = Cita::where('codigo',$request->input('cita_codigo_value')[$key])->first();
                                        if($update_estado_cita){
                                            $update_estado_cita->estado = 'Completado';
                                            $update_estado_cita->save();
                        
                                        }
                                    // Fin de la validacion de estado
                                    if($request->input('medio_pago') != 'Efectivo'){
                                        $cuentas = Cuentabancaria::where('nro_cuenta',$request->input('ingreso'))->first();
                                        if($cuentas){
                                            $cuentas->apertura_cuenta = $cuentas->apertura_cuenta+$recibido[$key];
                                            $cuentas->save();
                        
                                            $cuenta_banco_total = DB::table('cuentasbancos')->select(DB::raw('sum(apertura_cuenta) as cuenta_t'))->where('nro_cuenta',$request->input('ingreso'))->first();
                                            $caja = Caja::where('sede_id',Auth::user()->persona->sede_id)->first();
                                            $caja->total_cuenta_banco = $cuenta_banco_total->cuenta_t;
                                            $caja->total = $caja->total_efectivo+$caja->total_cuenta_banco;
                                            $caja->save();
                    
                                            $registro = Registrocaja::latest('id')->where('sede_id',Auth::user()->persona->sede_id)->first();
                                            $registro->saldo_ingreso = $registro->saldo_ingreso+$recibido[$key];
                                            $registro->save();
                    
                                            $now = Carbon::now();
                                            $mov_caja = Movimientocaja::orderBy('id','desc')->first();
                                            $nubRow =$mov_caja?$mov_caja->id+1:1;
                                            $codigo = 'MOVCAJA-'.$now->format('Ymd').'-'.$nubRow;
                    
                                            $movimiento_caja = new Movimientocaja();
                                            $movimiento_caja->codigo = $codigo;
                                            $movimiento_caja->slug = Str::slug($codigo);
                                            $movimiento_caja->motivo = 'ATENCION PROGRAMADA';
                                            $movimiento_caja->asunto = $espec_val_name->name;
                                            $movimiento_caja->paciente = $request->input('asunto');
                                            $movimiento_caja->metodo = $request->input('medio_pago');
                                            $movimiento_caja->total = $recibido[$key];
                                            $movimiento_caja->registrocaja_id = $registro->id;
                                            $movimiento_caja->operaciones = 'COBRO';
                                            $movimiento_caja->cuenta = $request->input('ingreso');
                                            $movimiento_caja->save();
                                        }
                                    }
                    
                                    if($request->input('medio_pago') == 'Efectivo'){
                                        $caja = Caja::where('sede_id',Auth::user()->persona->sede_id)->first();
                                        $caja->total_efectivo = $caja->total_efectivo+$recibido[$key];
                                        $caja->total = $caja->total_efectivo+$caja->total_cuenta_banco;
                                        $caja->save();
                    
                                        $registro = Registrocaja::latest('id')->where('sede_id',Auth::user()->persona->sede_id)->first();
                                        $registro->saldo_ingreso = $registro->saldo_ingreso+$recibido[$key];
                                        $registro->save();
                    
                                        $now = Carbon::now();
                                        $mov_caja = Movimientocaja::orderBy('id','desc')->first();
                                        $nubRow =$mov_caja?$mov_caja->id+1:1;
                                        $codigo = 'MOVCAJA-'.$now->format('Ymd').'-'.$nubRow;
                    
                                        $movimiento_caja = new Movimientocaja();
                                        $movimiento_caja->codigo = $codigo;
                                        $movimiento_caja->slug = Str::slug($codigo);
                                        $movimiento_caja->motivo = 'ATENCION PROGRAMADA';
                                        $movimiento_caja->asunto = $espec_val_name->name;
                                        $movimiento_caja->paciente = $request->input('asunto');
                                        $movimiento_caja->metodo = $request->input('medio_pago');
                                        $movimiento_caja->total = $recibido[$key];
                                        $movimiento_caja->registrocaja_id = $registro->id;
                                        $movimiento_caja->operaciones = 'COBRO';
                                        $movimiento_caja->cuenta = $request->input('ingreso');
                                        $movimiento_caja->save();
                                    }
        
                                }
                            }
                        }if($request->input('tipo_transaccion') == 'EAUXILIAR'){
                            // if($request->input('tipo') == 'Atencion directa'){
                                if($recibido[$key] || $recibido[$key] == '0'){
                                    $espec_val_name = Especialidad::where('id', 7)->first();

                                    $detallecobro = new Detallecobro();
                                    $detallecobro->cobro_id = $cobros->id;
                                    $detallecobro->codigo_venta = $codigo_venta[$key];
                                    $detallecobro->concepto = 'EA:'.$concepto[$key].' - '.$espec_val_name->name;
                                    $detallecobro->total = $total[$key];
                                    $detallecobro->cobrado = $recibido[$key];
                                    $detallecobro->por_cobrar = $por_cobrar[$key]-$recibido[$key];
                                    $detallecobro->monto_recibido = $recibido[$key];
                                    $detallecobro->save();

                                    // Creacion del codigo de la atencion
                                        $now = Carbon::now();
                                        $auxil = Eauxiliar::orderBy('id','desc')->first();

                                        if(Eauxiliar::where('atencion_id', $request->por_atencion_id)->exists()){
                                            $valor_codigo_eauxiliar = Eauxiliar::where('atencion_id', $request->por_atencion_id)->first();
                                            $valor_codigo_eauxiliar->estado_pago = 'Pagado';
                                            $valor_codigo_eauxiliar->save(); 

                                            $codigo_auxil_slug = $valor_codigo_eauxiliar->nro_solicitud;
                                        }
                                    // Fin del codigo de la atencion

                                    if($request->input('medio_pago') != 'Efectivo'){
                                        $cuentas = Cuentabancaria::where('nro_cuenta',$request->input('ingreso'))->first();
                                        if($cuentas){
                                            $cuentas->apertura_cuenta = $cuentas->apertura_cuenta+$recibido[$key];
                                            $cuentas->save();
                        
                                            $cuenta_banco_total = DB::table('cuentasbancos')->select(DB::raw('sum(apertura_cuenta) as cuenta_t'))->where('nro_cuenta',$request->input('ingreso'))->first();
                                            $caja = Caja::where('sede_id',Auth::user()->persona->sede_id)->first();
                                            $caja->total_cuenta_banco = $cuenta_banco_total->cuenta_t;
                                            $caja->total = $caja->total_efectivo+$caja->total_cuenta_banco;
                                            $caja->save();
                    
                                            $registro = Registrocaja::latest('id')->where('sede_id',Auth::user()->persona->sede_id)->first();
                                            $registro->saldo_ingreso = $registro->saldo_ingreso+$recibido[$key];
                                            $registro->save();
                    
                                            $now = Carbon::now();
                                            $mov_caja = Movimientocaja::orderBy('id','desc')->first();
                                            $nubRow =$mov_caja?$mov_caja->id+1:1;
                                            $codigo = 'MOVCAJA-'.$now->format('Ymd').'-'.$nubRow;
                    
                                            $movimiento_caja = new Movimientocaja();
                                            $movimiento_caja->codigo = $codigo;
                                            $movimiento_caja->slug = Str::slug($codigo);
                                            $movimiento_caja->motivo = 'E.AUXILIAR';
                                            $movimiento_caja->asunto = $espec_val_name->name;
                                            $movimiento_caja->paciente = $request->input('asunto');
                                            $movimiento_caja->metodo = $request->input('medio_pago');
                                            $movimiento_caja->total = $recibido[$key];
                                            $movimiento_caja->registrocaja_id = $registro->id;
                                            $movimiento_caja->operaciones = 'COBRO';
                                            $movimiento_caja->cuenta = $request->input('ingreso');
                                            $movimiento_caja->save();
                                        }
                                    }
                    
                                    if($request->input('medio_pago') == 'Efectivo'){
                                        $caja = Caja::where('sede_id',Auth::user()->persona->sede_id)->first();
                                        $caja->total_efectivo = $caja->total_efectivo+$recibido[$key];
                                        $caja->total = $caja->total_efectivo+$caja->total_cuenta_banco;
                                        $caja->save();
                    
                                        $registro = Registrocaja::latest('id')->where('sede_id',Auth::user()->persona->sede_id)->first();
                                        $registro->saldo_ingreso = $registro->saldo_ingreso+$recibido[$key];
                                        $registro->save();
                    
                                        $now = Carbon::now();
                                        $mov_caja = Movimientocaja::orderBy('id','desc')->first();
                                        $nubRow =$mov_caja?$mov_caja->id+1:1;
                                        $codigo = 'MOVCAJA-'.$now->format('Ymd').'-'.$nubRow;
                    
                                        $movimiento_caja = new Movimientocaja();
                                        $movimiento_caja->codigo = $codigo;
                                        $movimiento_caja->slug = Str::slug($codigo);
                                        $movimiento_caja->motivo = 'E.AUXILIAR';
                                        $movimiento_caja->asunto = $espec_val_name->name;
                                        $movimiento_caja->paciente = $request->input('asunto');
                                        $movimiento_caja->metodo = $request->input('medio_pago');
                                        $movimiento_caja->total = $recibido[$key];
                                        $movimiento_caja->registrocaja_id = $registro->id;
                                        $movimiento_caja->operaciones = 'COBRO';
                                        $movimiento_caja->cuenta = $request->input('ingreso');
                                        $movimiento_caja->save();
                                    }
        
                                }
                            // }
                        }if($request->input('tipo_transaccion') == 'MEDICAMENTOS'){
                            if($request->input('tipo_receta') == 'Receta'){
                                if($recibido[$key] || $recibido[$key] == '0'){
                                    $espec_val_name = Especialidad::where('id', $request->input('value_especial')[$key])->first();

                                    $detallecobro = new Detallecobro();
                                    $detallecobro->cobro_id = $cobros->id;
                                    $detallecobro->codigo_venta = $codigo_venta[$key];
                                    $detallecobro->concepto = 'R:'.$concepto[$key].' - '.$espec_val_name->name;
                                    $detallecobro->total = $total[$key];
                                    $detallecobro->cobrado = $recibido[$key];
                                    $detallecobro->por_cobrar = $por_cobrar[$key]-$recibido[$key];
                                    $detallecobro->monto_recibido = $recibido[$key];
                                    $detallecobro->save();

                                    $update_estado_receta = Receta::where('nro_solicitud',$concepto[$key])->where('atencion_id', $request->input('atencion_id_val')[$key])->first();
                                    if($update_estado_receta){
                                        $update_estado_receta->estado_pago = 'Pagado';
                                        $update_estado_receta->save();
                    
                                    }
                    
                                    if($request->input('medio_pago') != 'Efectivo'){
                                        $cuentas = Cuentabancaria::where('nro_cuenta',$request->input('ingreso'))->first();
                                        if($cuentas){
                                            $cuentas->apertura_cuenta = $cuentas->apertura_cuenta+$recibido[$key];
                                            $cuentas->save();
                        
                                            $cuenta_banco_total = DB::table('cuentasbancos')->select(DB::raw('sum(apertura_cuenta) as cuenta_t'))->where('nro_cuenta',$request->input('ingreso'))->first();
                                            $caja = Caja::where('sede_id',Auth::user()->persona->sede_id)->first();
                                            $caja->total_cuenta_banco = $cuenta_banco_total->cuenta_t;
                                            $caja->total = $caja->total_efectivo+$caja->total_cuenta_banco;
                                            $caja->save();
                    
                                            $registro = Registrocaja::latest('id')->where('sede_id',Auth::user()->persona->sede_id)->first();
                                            $registro->saldo_ingreso = $registro->saldo_ingreso+$recibido[$key];
                                            $registro->save();
                    
                                            $now = Carbon::now();
                                            $mov_caja = Movimientocaja::orderBy('id','desc')->first();
                                            $nubRow =$mov_caja?$mov_caja->id+1:1;
                                            $codigo = 'MOVCAJA-'.$now->format('Ymd').'-'.$nubRow;
                    
                                            $movimiento_caja = new Movimientocaja();
                                            $movimiento_caja->codigo = $codigo;
                                            $movimiento_caja->slug = Str::slug($codigo);
                                            $movimiento_caja->motivo = 'MEDICAMENTO POR RECETA';
                                            $movimiento_caja->asunto = $espec_val_name->name;
                                            $movimiento_caja->paciente = $request->input('asunto');
                                            $movimiento_caja->metodo = $request->input('medio_pago');
                                            $movimiento_caja->total = $recibido[$key];
                                            $movimiento_caja->registrocaja_id = $registro->id;
                                            $movimiento_caja->operaciones = 'COBRO';
                                            $movimiento_caja->cuenta = $request->input('ingreso');
                                            $movimiento_caja->save();
                                        }
                                    }
                    
                                    if($request->input('medio_pago') == 'Efectivo'){
                                        $caja = Caja::where('sede_id',Auth::user()->persona->sede_id)->first();
                                        $caja->total_efectivo = $caja->total_efectivo+$recibido[$key];
                                        $caja->total = $caja->total_efectivo+$caja->total_cuenta_banco;
                                        $caja->save();
                    
                                        $registro = Registrocaja::latest('id')->where('sede_id',Auth::user()->persona->sede_id)->first();
                                        $registro->saldo_ingreso = $registro->saldo_ingreso+$recibido[$key];
                                        $registro->save();
                    
                                        $now = Carbon::now();
                                        $mov_caja = Movimientocaja::orderBy('id','desc')->first();
                                        $nubRow =$mov_caja?$mov_caja->id+1:1;
                                        $codigo = 'MOVCAJA-'.$now->format('Ymd').'-'.$nubRow;
                    
                                        $movimiento_caja = new Movimientocaja();
                                        $movimiento_caja->codigo = $codigo;
                                        $movimiento_caja->slug = Str::slug($codigo);
                                        $movimiento_caja->motivo = 'MEDICAMENTO POR RECETA';
                                        $movimiento_caja->asunto = $espec_val_name->name;
                                        $movimiento_caja->paciente = $request->input('asunto');
                                        $movimiento_caja->metodo = $request->input('medio_pago');
                                        $movimiento_caja->total = $recibido[$key];
                                        $movimiento_caja->registrocaja_id = $registro->id;
                                        $movimiento_caja->operaciones = 'COBRO';
                                        $movimiento_caja->cuenta = $request->input('ingreso');
                                        $movimiento_caja->save();
                                    }
        
                                }
                            }else{

                                $detallecobro = new Detallecobro();
                                $detallecobro->cobro_id = $cobros->id;
                                $detallecobro->codigo_venta = 'RL: '.$concepto[$key];
                                $detallecobro->concepto = 'RL: '.$concepto[$key];
                                $detallecobro->valor = $valor[$key];
                                $detallecobro->igv = $impuesto;
                                $detallecobro->cantidad = $cantidad[$key];
                                $detallecobro->observaciones = $observaciones[$key];
                                $detallecobro->save();
                                
                                $subtotal = ($detallecobro->valor*$detallecobro->cantidad);

                                $prod_val = Producto::where('name',$concepto[$key])->first();
                                // $prod_val->cantidad = $prod_val->cantidad - $cantidad[$key];
                                // $prod_val->save();

                                $dtllefarmacia = new Detallefarmacia();
                                $dtllefarmacia->id_medicamento = $prod_val->id;
                                $dtllefarmacia->codigo = $prod_val->codigo;
                                $dtllefarmacia->medicamento = $prod_val->name;
                                $dtllefarmacia->umedida = $prod_val->unidad_medida;
                                $dtllefarmacia->cantidad = $cantidad[$key];
                                $dtllefarmacia->precio = $prod_val->precio_venta;
                                $dtllefarmacia->subtotal = $cantidad[$key]*$prod_val->precio_venta;
                                $dtllefarmacia->farmacia_id = $farmaciass->id;
                                $dtllefarmacia->save();

                                if($request->input('medio_pago') != 'Efectivo'){
                                    $cuentas = Cuentabancaria::where('nro_cuenta',$request->input('ingreso'))->first();
                                    if($cuentas){
                                        $cuentas->apertura_cuenta = $cuentas->apertura_cuenta+$subtotal;
                                        $cuentas->save();
                    
                                        $cuenta_banco_total = DB::table('cuentasbancos')->select(DB::raw('sum(apertura_cuenta) as cuenta_t'))->where('nro_cuenta',$request->input('ingreso'))->first();
                                        $caja = Caja::where('sede_id',Auth::user()->persona->sede_id)->first();
                                        $caja->total_cuenta_banco = $cuenta_banco_total->cuenta_t;
                                        $caja->total = $caja->total_efectivo+$caja->total_cuenta_banco;
                                        $caja->save();
                
                                        $registro = Registrocaja::latest('id')->where('sede_id',Auth::user()->persona->sede_id)->first();
                                        $registro->saldo_ingreso = $registro->saldo_ingreso+$subtotal;
                                        $registro->save();
                
                                        $now = Carbon::now();
                                        $mov_caja = Movimientocaja::orderBy('id','desc')->first();
                                        $nubRow =$mov_caja?$mov_caja->id+1:1;
                                        $codigo = 'MOVCAJA-'.$now->format('Ymd').'-'.$nubRow;
                
                                        $movimiento_caja = new Movimientocaja();
                                        $movimiento_caja->codigo = $codigo;
                                        $movimiento_caja->slug = Str::slug($codigo);
                                        $movimiento_caja->motivo = 'MEDICAMENTO DE VENTA LIBRE';
                                        $movimiento_caja->asunto = $concepto[$key];
                                        $movimiento_caja->paciente = 'GENERAL';
                                        $movimiento_caja->metodo = $request->input('medio_pago');
                                        $movimiento_caja->total = $subtotal;
                                        $movimiento_caja->registrocaja_id = $registro->id;
                                        $movimiento_caja->operaciones = 'COBRO';
                                        $movimiento_caja->cuenta = $request->input('ingreso');
                                        $movimiento_caja->save();
                                    }
                                }
                
                                if($request->input('medio_pago') == 'Efectivo'){
                                    $caja = Caja::where('sede_id',Auth::user()->persona->sede_id)->first();
                                    $caja->total_efectivo = $caja->total_efectivo+$subtotal;
                                    $caja->total = $caja->total_efectivo+$caja->total_cuenta_banco;
                                    $caja->save();
                
                                    $registro = Registrocaja::latest('id')->where('sede_id',Auth::user()->persona->sede_id)->first();
                                    $registro->saldo_ingreso = $registro->saldo_ingreso+$subtotal;
                                    $registro->save();
                
                                    $now = Carbon::now();
                                    $mov_caja = Movimientocaja::orderBy('id','desc')->first();
                                    $nubRow =$mov_caja?$mov_caja->id+1:1;
                                    $codigo = 'MOVCAJA-'.$now->format('Ymd').'-'.$nubRow;
                
                                    $movimiento_caja = new Movimientocaja();
                                    $movimiento_caja->codigo = $codigo;
                                    $movimiento_caja->slug = Str::slug($codigo);
                                    $movimiento_caja->motivo = 'MEDICAMENTO DE VENTA LIBRE';
                                    $movimiento_caja->asunto = $concepto[$key];
                                    $movimiento_caja->paciente = 'GENERAL';
                                    $movimiento_caja->metodo = $request->input('medio_pago');
                                    $movimiento_caja->total = $subtotal;
                                    $movimiento_caja->registrocaja_id = $registro->id;
                                    $movimiento_caja->operaciones = 'COBRO';
                                    $movimiento_caja->cuenta = $request->input('ingreso');
                                    $movimiento_caja->save();
                                }
                            }
                        }if($request->input('tipo_transaccion') == 'PROCEDIMIENTOS'){
                                $now = Carbon::now();
                                $dtc = Detallecobro::orderBy('id','desc')->where('total','')->first();
                                $nubRowv =$dtc?$dtc->id+1:1;
                                $codidc = 'PR-'.$now->format('Ymd').'-'.$nubRowv;

                                // $subtotal = ($valor[$key]*$cantidad[$key])+(($valor[$key]*$cantidad[$key])*0.18);
                                

                                $detallecobro = new Detallecobro();
                                $detallecobro->cobro_id = $cobros->id;
                                $detallecobro->codigo_venta = $codidc;
                                $detallecobro->concepto = $concepto[$key];
                                $detallecobro->valor = $valor[$key];
                                $detallecobro->igv = $impuesto;
                                $detallecobro->cantidad = $cantidad[$key];
                                $detallecobro->observaciones = $observaciones[$key];
                                $detallecobro->save();

                                $subtotal = ($detallecobro->valor*$detallecobro->cantidad);

                                // Creacion del registro de farmacia por estado pendiente
                                    $fecha_image_actualizada = Carbon::now();
                            
                                    $imagenologi = Imagenologia::orderBy('id','desc')->first();
                                    if($imagenologi){
                                        if($imagenologi->created_at->format('m') == $now->format('m')){
                                            $nubRow =$imagenologi?$imagenologi->nro_solicitud+1:1;
                                            //$nubRow ='2964';
                                            $correlativo_prog = sprintf('%04d', trim($nubRow,'"'));
                                            $codigo_imagenologi_slug = $correlativo_prog;
                                        }else{
                                            $nubRow =$imagenologi?1:1;
                                            //$nubRow ='2964';
                                            $correlativo_prog = sprintf('%04d', trim($nubRow,'"'));
                                            $codigo_imagenologi_slug = $now->format('Y')[2].''.$now->format('Y')[3].''.$now->format('m').''.$correlativo_prog;
                                        }
                                    }else{
                                        $nubRow =$imagenologi?1:1;
                                        //$nubRow ='2964';
                                        $correlativo_prog = sprintf('%04d', trim($nubRow,'"'));
                                        $codigo_imagenologi_slug = $now->format('Y')[2].''.$now->format('Y')[3].''.$now->format('m').''.$correlativo_prog;
                                    }

                                    if($request->input('tipo_transaccion') == 'PROCEDIMIENTOS'){
                                        $info_imagenologia = new Imagenologia();
                                        $info_imagenologia->nro_solicitud = $codigo_imagenologi_slug;
                                        $info_imagenologia->slug = Str::slug('IM'.$codigo_imagenologi_slug);
                                        $info_imagenologia->motivo = $concepto[$key];
                                        $info_imagenologia->fecha_imagenologia = $fecha_image_actualizada->format('Y-m-d');
                                        $info_imagenologia->id_paciente = $paciente_val->id;
                                        $info_imagenologia->paciente = $cobros->cliente;
                                        $info_imagenologia->save();
                                    }

                                // fin de la creacion de la farmacia

                                if($request->input('medio_pago') != 'Efectivo'){
                                    $cuentas = Cuentabancaria::where('nro_cuenta',$request->input('ingreso'))->first();
                                    if($cuentas){
                                        $cuentas->apertura_cuenta = $cuentas->apertura_cuenta+$subtotal;
                                        $cuentas->save();
                    
                                        $cuenta_banco_total = DB::table('cuentasbancos')->select(DB::raw('sum(apertura_cuenta) as cuenta_t'))->where('nro_cuenta',$request->input('ingreso'))->first();
                                        $caja = Caja::where('sede_id',Auth::user()->persona->sede_id)->first();
                                        $caja->total_cuenta_banco = $cuenta_banco_total->cuenta_t;
                                        $caja->total = $caja->total_efectivo+$caja->total_cuenta_banco;
                                        $caja->save();
                
                                        $registro = Registrocaja::latest('id')->where('sede_id',Auth::user()->persona->sede_id)->first();
                                        $registro->saldo_ingreso = $registro->saldo_ingreso+$subtotal;
                                        $registro->save();
                
                                        $now = Carbon::now();
                                        $mov_caja = Movimientocaja::orderBy('id','desc')->first();
                                        $nubRow =$mov_caja?$mov_caja->id+1:1;
                                        $codigo = 'MOVCAJA-'.$now->format('Ymd').'-'.$nubRow;
                
                                        $movimiento_caja = new Movimientocaja();
                                        $movimiento_caja->codigo = $codigo;
                                        $movimiento_caja->slug = Str::slug($codigo);
                                        $movimiento_caja->motivo = 'PROCEDIMIENTO AMBULATORIO';
                                        $movimiento_caja->asunto = $concepto[$key];
                                        $movimiento_caja->paciente = 'GENERAL';
                                        $movimiento_caja->metodo = $request->input('medio_pago');
                                        $movimiento_caja->total = $subtotal;
                                        $movimiento_caja->registrocaja_id = $registro->id;
                                        $movimiento_caja->operaciones = 'COBRO';
                                        $movimiento_caja->cuenta = $request->input('ingreso');
                                        $movimiento_caja->save();
                                    }
                                }
                
                                if($request->input('medio_pago') == 'Efectivo'){
                                    $caja = Caja::where('sede_id',Auth::user()->persona->sede_id)->first();
                                    $caja->total_efectivo = $caja->total_efectivo+$subtotal;
                                    $caja->total = $caja->total_efectivo+$caja->total_cuenta_banco;
                                    $caja->save();
                
                                    $registro = Registrocaja::latest('id')->where('sede_id',Auth::user()->persona->sede_id)->first();
                                    $registro->saldo_ingreso = $registro->saldo_ingreso+$subtotal;
                                    $registro->save();
                
                                    $now = Carbon::now();
                                    $mov_caja = Movimientocaja::orderBy('id','desc')->first();
                                    $nubRow =$mov_caja?$mov_caja->id+1:1;
                                    $codigo = 'MOVCAJA-'.$now->format('Ymd').'-'.$nubRow;
                
                                    $movimiento_caja = new Movimientocaja();
                                    $movimiento_caja->codigo = $codigo;
                                    $movimiento_caja->slug = Str::slug($codigo);
                                    $movimiento_caja->motivo = 'PROCEDIMIENTO AMBULATORIO';
                                    $movimiento_caja->asunto = $concepto[$key];
                                    $movimiento_caja->paciente = 'GENERAL';
                                    $movimiento_caja->metodo = $request->input('medio_pago');
                                    $movimiento_caja->total = $subtotal;
                                    $movimiento_caja->registrocaja_id = $registro->id;
                                    $movimiento_caja->operaciones = 'COBRO';
                                    $movimiento_caja->cuenta = $request->input('ingreso');
                                    $movimiento_caja->save();
                                }
    
                        }if($request->input('tipo_transaccion') == 'OTROS'){
                                $now = Carbon::now();
                                $dtc = Detallecobro::orderBy('id','desc')->where('total','')->first();
                                $nubRowv =$dtc?$dtc->id+1:1;
                                $codidc = 'PA-'.$now->format('Ymd').'-'.$nubRowv;

                                // $subtotal = ($valor[$key]*$cantidad[$key])+(($valor[$key]*$cantidad[$key])*0.18);
                                

                                $detallecobro = new Detallecobro();
                                $detallecobro->cobro_id = $cobros->id;
                                $detallecobro->codigo_venta = $codidc;
                                $detallecobro->concepto = $concepto[$key];
                                $detallecobro->valor = $valor[$key];
                                $detallecobro->igv = $impuesto;
                                $detallecobro->cantidad = $cantidad[$key];
                                $detallecobro->observaciones = $observaciones[$key];
                                $detallecobro->save();

                                $subtotal = ($detallecobro->valor*$detallecobro->cantidad);

                                $producto_val = Producto::where('id',$request->input('producto_id')[$key])->first();
                                $producto_val->cantidad = $producto_val->cantidad - $cantidad[$key];
                                $producto_val->save();

                                if($request->input('medio_pago') != 'Efectivo'){
                                    $cuentas = Cuentabancaria::where('nro_cuenta',$request->input('ingreso'))->first();
                                    if($cuentas){
                                        $cuentas->apertura_cuenta = $cuentas->apertura_cuenta+$subtotal;
                                        $cuentas->save();
                    
                                        $cuenta_banco_total = DB::table('cuentasbancos')->select(DB::raw('sum(apertura_cuenta) as cuenta_t'))->where('nro_cuenta',$request->input('ingreso'))->first();
                                        $caja = Caja::where('sede_id',Auth::user()->persona->sede_id)->first();
                                        $caja->total_cuenta_banco = $cuenta_banco_total->cuenta_t;
                                        $caja->total = $caja->total_efectivo+$caja->total_cuenta_banco;
                                        $caja->save();
                
                                        $registro = Registrocaja::latest('id')->where('sede_id',Auth::user()->persona->sede_id)->first();
                                        $registro->saldo_ingreso = $registro->saldo_ingreso+$subtotal;
                                        $registro->save();
                
                                        $now = Carbon::now();
                                        $mov_caja = Movimientocaja::orderBy('id','desc')->first();
                                        $nubRow =$mov_caja?$mov_caja->id+1:1;
                                        $codigo = 'MOVCAJA-'.$now->format('Ymd').'-'.$nubRow;
                
                                        $movimiento_caja = new Movimientocaja();
                                        $movimiento_caja->codigo = $codigo;
                                        $movimiento_caja->slug = Str::slug($codigo);
                                        $movimiento_caja->motivo = 'PRODUCTO DE VENTA LIBRE';
                                        $movimiento_caja->asunto = $concepto[$key];
                                        $movimiento_caja->paciente = 'GENERAL';
                                        $movimiento_caja->metodo = $request->input('medio_pago');
                                        $movimiento_caja->total = $subtotal;
                                        $movimiento_caja->registrocaja_id = $registro->id;
                                        $movimiento_caja->operaciones = 'COBRO';
                                        $movimiento_caja->cuenta = $request->input('ingreso');
                                        $movimiento_caja->save();
                                    }
                                }
                
                                if($request->input('medio_pago') == 'Efectivo'){
                                    $caja = Caja::where('sede_id',Auth::user()->persona->sede_id)->first();
                                    $caja->total_efectivo = $caja->total_efectivo+$subtotal;
                                    $caja->total = $caja->total_efectivo+$caja->total_cuenta_banco;
                                    $caja->save();
                
                                    $registro = Registrocaja::latest('id')->where('sede_id',Auth::user()->persona->sede_id)->first();
                                    $registro->saldo_ingreso = $registro->saldo_ingreso+$subtotal;
                                    $registro->save();
                
                                    $now = Carbon::now();
                                    $mov_caja = Movimientocaja::orderBy('id','desc')->first();
                                    $nubRow =$mov_caja?$mov_caja->id+1:1;
                                    $codigo = 'MOVCAJA-'.$now->format('Ymd').'-'.$nubRow;
                
                                    $movimiento_caja = new Movimientocaja();
                                    $movimiento_caja->codigo = $codigo;
                                    $movimiento_caja->slug = Str::slug($codigo);
                                    $movimiento_caja->motivo = 'PRODUCTO DE VENTA LIBRE';
                                    $movimiento_caja->asunto = $concepto[$key];
                                    $movimiento_caja->paciente = 'GENERAL';
                                    $movimiento_caja->metodo = $request->input('medio_pago');
                                    $movimiento_caja->total = $subtotal;
                                    $movimiento_caja->registrocaja_id = $registro->id;
                                    $movimiento_caja->operaciones = 'COBRO';
                                    $movimiento_caja->cuenta = $request->input('ingreso');
                                    $movimiento_caja->save();
                                }
    
                        }
                    }
                }
            return redirect()->route('admin-cobros.index')->with('addcobro', 'ok');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cobro $admin_cobro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //

    public function reportePrintExcel()
    {
        return Excel::download(new ExcelCobroExport, 'cobros.xlsx');
    }

    public function reporteCobroPrintExcelFechas(Request $request)
    {
        $fi = $request->fecha_ini. ' 00:00:00';
        $ff = $request->fecha_fin. ' 23:59:59';
        $fecha_asignada_value = $request->fecha_asignada;
        $fi_i = Carbon::parse($request->fecha_ini)->format('d-m-y');
        $ff_f = Carbon::parse($request->fecha_fin)->format('d-m-y');
        return Excel::download(new CobroExportFecha($fi, $ff, $fi_i, $ff_f, $fecha_asignada_value), 'CobrosFecha.xlsx');
    }

    public function reportePrintPdf()
    {
        $now = Carbon::now();
        $fi = NULL;
        $ff = NULL;
        $name_sede = NULL;
        $cobros = Cobro::all();
        $pdf = PDF::loadView('ADMINISTRADOR.REPORTES.COBROS.pdf.cobrosPDF', ['cobros'=>$cobros, 'fi'=>$fi, 'ff'=>$ff, 'name_sede'=>$name_sede, 'now'=>$now]);
        return $pdf->stream($now.'||Reporte-Cobro-PDF.pdf');
    }

    public function reporteCobrosPrintPdfSede(Request $request)
    {
        $now = Carbon::now();
        $sede = $request->sede_id;
        $fi = $request->fecha_ini. ' 00:00:00';
        $ff = $request->fecha_fin. ' 23:59:59';
        $name_sede = Sede::where('id', $sede)->first();
        $cobros = Cobro::whereBetween('created_at', [$fi, $ff])->where('sede_id', "=", $sede)->get();
        $pdf = PDF::loadView('ADMINISTRADOR.REPORTES.COBROS.pdf.cobrosPDF', ['cobros'=>$cobros, 'now'=>$now, 'fi'=>$fi, 'ff'=>$ff, 'name_sede'=>$name_sede, 'name_sede'=>$name_sede]);
        return $pdf->stream('COBROS-SEDE'.$sede.'.pdf');
    }

    public function getCobropdf(Cobro $admin_cobro)
    {
        $now = Carbon::now();
        $detalle_cobro = Detallecobro::where('cobro_id',$admin_cobro->id)->get();
        $formatter = new NumeroALetras();
        $pdf = PDF::loadView('ADMINISTRADOR.REPORTES.cobro.detalle_cobroPDF', ['admin_cobro'=>$admin_cobro, 'detalle_cobro'=>$detalle_cobro, 'formatter'=>$formatter, 'now'=>$now]);
        return $pdf->stream('DETALLE-COBRO-'.$admin_cobro->nro_operacion.'.pdf');
    }

}
