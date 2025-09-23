<?php

namespace App\Http\Controllers;

use App\Exports\PagoExportFecha;
use App\Http\Requests\StorePagoRequest;
use App\Models\Caja;
use App\Models\Cuentabancaria;
use App\Models\Detallepago;
use App\Models\Movimientocaja;
use App\Models\Pago;
use App\Models\Registrocaja;
use App\Models\Sede;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Luecano\NumeroALetras\NumeroALetras;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class admin_PagosController extends Controller
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
            $sedes = Sede::all()->where('estado', 'Activo')->first();
            $formatter = new NumeroALetras();
            $registro_caja = Registrocaja::latest('id')->where('estado','APERTURADA')->first();
            $pagos = Pago::all();
            return view('ADMINISTRADOR.TESORERIA.pagos.index', compact('pagos','registro_caja', 'now', 'sedes', 'formatter'));
        }if(Auth::user()->role_id == '4'){
            $now = Carbon::now();
            $sedes = Sede::all()->where('estado', 'Activo')->first();
            $formatter = new NumeroALetras();
            $registro_caja = Registrocaja::latest('id')->where('estado','APERTURADA')->first();
            $pagos = Pago::where('sede_id', Auth::user()->persona->sede_id)->get();
            return view('ADMINISTRADOR.TESORERIA.pagos.index', compact('pagos','registro_caja', 'now', 'sedes', 'formatter'));
        }else{
            abort(403);
        };
    }

    public function getindex_pago(Request $request)
    {   $valor_fecha_inicial = $request->input('fec_ini'). ' 00:00:00';
        $valor_fecha_final = $request->input('fec_fin'). ' 23:59:59';

        if(Auth::user()->role_id == '1'){
            $now = Carbon::now();
            $sedes = Sede::all()->where('estado', 'Activo')->first();
            $formatter = new NumeroALetras();
            $registro_caja = Registrocaja::latest('id')->where('estado','APERTURADA')->first();
            $pagos = Pago::whereBetween('fecha', [$valor_fecha_inicial,$valor_fecha_final])->get();
            return view('ADMINISTRADOR.TESORERIA.pagos.index', compact('pagos','registro_caja', 'now', 'sedes', 'formatter'));
        }if(Auth::user()->role_id == '4'){
            $now = Carbon::now();
            $sedes = Sede::all()->where('estado', 'Activo')->first();
            $formatter = new NumeroALetras();
            $registro_caja = Registrocaja::latest('id')->where('estado','APERTURADA')->first();
            $pagos = Pago::whereBetween('fecha', [$valor_fecha_inicial,$valor_fecha_final])->where('sede_id', Auth::user()->persona->sede_id)->get();
            return view('ADMINISTRADOR.TESORERIA.pagos.index', compact('pagos','registro_caja', 'now', 'sedes', 'formatter'));
        }else{
            abort(403);
        };
    }

    public function filtrar_pagos_sede(Request $request, Sede $admin_pagos_sede)
    {
        // if(Gate::allows('gerencia',Auth()->user())){
        if(Auth::user()){
            $now = Carbon::now();
            $sedes = Sede::all()->where('estado', 'Activo');
            $name_sede = Sede::where('id', $admin_pagos_sede->id)->first();
            $formatter = new NumeroALetras();
            $registro_caja = Registrocaja::latest('id')->where('estado','APERTURADA')->first();
            $pagos = Pago::all()->where('sede_id', "=", $admin_pagos_sede->id);
            return view('ADMINISTRADOR.TESORERIA.pagos.index', compact('pagos','registro_caja', 'now', 'sedes', 'formatter', 'name_sede'));
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
        // if(Gate::allows('gerencia',Auth()->user()) || Gate::allows('administracion',Auth()->user()) || Gate::allows('tesoreria',Auth()->user())){
        if(Auth::user()->role_id == '1' || Auth::user()->role_id == '4'){
            $now = Carbon::now();
            $fecha_actual = Carbon::now()->format('Y-m-d');
    
            $pago = Pago::orderBy('id','desc')->first();
            $nubRowv =$pago?$pago->id+1:1;
            $codigP = 'PAG-'.$now->format('Ymd').'-'.$nubRowv;
            $bancos = Cuentabancaria::where('estado','Activo')->where('sede_id', Auth::user()->persona->sede_id)->get();
            $cuentas = Cuentabancaria::all();
            return view('ADMINISTRADOR.TESORERIA.pagos.create', compact('cuentas','fecha_actual','codigP','bancos'));
        }else{
            abort(403);
        };
    }

    public function getTrans_pagos_medic(Request $request){
        if($request->ajax()){
                $transc_libre = DB::table('personas as per')->select('per.id','per.name','per.surnames')->select('per.id','per.name', 'per.surnames')->groupby('per.id','per.name', 'per.surnames')->where('per.sede_id', Auth::user()->persona->sede_id)->whereIn('per.tipo_persona',['Empleado','Médico'])->get();
                    foreach($transc_libre as $transc_libres){
                        $ArrayVenta[$transc_libres->id] = [$transc_libres->name.' '.$transc_libres->surnames];
                    }                   
                    return response()->json($ArrayVenta);
        }
    }
    public function getTrans_compra(Request $request){
        if($request->ajax()){
            if($request->aplicacion == 'Vendedor'){
                $compra = DB::table('personas as per')->join('users as us','us.persona_id','=','per.id')->select('per.id','per.name')->where('us.estado','Activo')->where('per.sede_id', Auth::user()->persona->sede_id)->where('us.role_id', '13')->where('per.bonificacion_vendedor','!=','0')->get();
                
                foreach($compra as $compras){
                    $ArrayCompra[$compras->id] = [$compras->name];
                }                   
                return response()->json($ArrayCompra);

            }if($request->aplicacion == 'Empleado'){
                $compra = DB::table('personas as per')->join('users as us','us.persona_id','=','per.id')->select('per.id','per.name','per.lastname_padre','per.lastname_madre')->where('us.estado','Activo')->where('per.sede_id', Auth::user()->persona->sede_id)->where('per.tipo_persona','Empleados')->get();
                
                foreach($compra as $compras){
                    $ArrayCompra[$compras->id] = [$compras->name,$compras->lastname_padre,$compras->lastname_madre];
                }                   
                return response()->json($ArrayCompra);
            }if($request->aplicacion == 'Servicio'){
                $serviciosordenes = DB::table('ordenservicios as ords')->select('ords.proveedor')->where('ords.total_pago','!=','0')->groupby('ords.proveedor')->where('ords.sede_id', Auth::user()->persona->sede_id)->exists();
                if($serviciosordenes){
                    $serviciosorden = DB::table('ordenservicios as ords')->select('ords.proveedor')->where('ords.total_pago','!=','0')->groupby('ords.proveedor')->where('ords.sede_id', Auth::user()->persona->sede_id)->get();
                    foreach($serviciosorden as $serviciosordens){
                        $ArrayCompra[$serviciosordens->id] = [$serviciosordens->proveedor,'ingreso'];
                    }                   
                    return response()->json($ArrayCompra);
                }else{
                    $ArrayCompra[1] = ['vacio'];
                    
                    return response()->json($ArrayCompra);
                }
            }else{
                if($request->transacciones == 'COMPRA'){
                    $compra = DB::table('ordenescompras as ord')->join('detallecompras as dtcom','dtcom.ordencompra_id','=','ord.id')->select('dtcom.proveedor')->where('ord.total_pago','!=','0')->groupby('dtcom.proveedor')->where('ord.sede_id', Auth::user()->persona->sede_id)->get();
                    foreach($compra as $compras){
                        $com = Detallecompra::where('proveedor',$compras->proveedor)->first();
                        $ArrayCompra[$com->id] = [$compras->proveedor];
                    }                   
                    return response()->json($ArrayCompra);
                }else{
                    $compra = DB::table('personas as per')->join('proveedors as prov','prov.persona_id','=','per.id')->select('per.id','per.name')->where('prov.estado','Activo')->where('per.sede_id', Auth::user()->persona->sede_id)->get();
                    foreach($compra as $compras){
                        $ArrayCompra[$compras->id] = [$compras->name];
                    }                   
                    return response()->json($ArrayCompra);
                }
            }
        }
    }
    
    public function gettrans_filtro_pdf(Request $request){
        if($request->ajax()){
            if($request->aplicacion == 'Vendedor'){
                $compra = DB::table('personas as per')->join('users as us','us.persona_id','=','per.id')->select('per.id','per.name')->where('us.estado','Activo')->where('per.sede_id', Auth::user()->persona->sede_id)->where('us.role_id', '13')->where('per.bonificacion_vendedor','!=','0')->get();
                
                foreach($compra as $compras){
                    $ArrayCompra[$compras->id] = [$compras->name];
                }                   
                return response()->json($ArrayCompra);

            }if($request->aplicacion == 'Empleado'){
                $compra = DB::table('personas as per')->join('users as us','us.persona_id','=','per.id')->select('per.id','per.name','per.lastname_padre','per.lastname_madre')->where('us.estado','Activo')->where('per.sede_id', Auth::user()->persona->sede_id)->where('per.tipo_persona','Empleados')->get();
                
                foreach($compra as $compras){
                    $ArrayCompra[$compras->id] = [$compras->name,$compras->lastname_padre,$compras->lastname_madre];
                }                   
                return response()->json($ArrayCompra);
            }if($request->aplicacion == 'Servicio'){
                $serviciosordenes = DB::table('ordenservicios as ords')->select('ords.proveedor')->where('ords.total_pago','!=','0')->groupby('ords.proveedor')->where('ords.sede_id', Auth::user()->persona->sede_id)->exists();
                if($serviciosordenes){
                    $serviciosorden = DB::table('ordenservicios as ords')->select('ords.proveedor')->where('ords.total_pago','!=','0')->groupby('ords.proveedor')->where('ords.sede_id', Auth::user()->persona->sede_id)->get();
                    foreach($serviciosorden as $serviciosordens){
                        $ArrayCompra[$serviciosordens->id] = [$serviciosordens->proveedor,'ingreso'];
                    }                   
                    return response()->json($ArrayCompra);
                }else{
                    $ArrayCompra[1] = ['vacio'];
                    
                    return response()->json($ArrayCompra);
                }
            }else{
                if($request->transacciones == 'COMPRA'){
                    $compra = DB::table('ordenescompras as ord')->join('detallecompras as dtcom','dtcom.ordencompra_id','=','ord.id')->select('dtcom.proveedor')->where('ord.total_pago','!=','0')->groupby('dtcom.proveedor')->where('ord.sede_id', Auth::user()->persona->sede_id)->get();
                    foreach($compra as $compras){
                        $com = Detallecompra::where('proveedor',$compras->proveedor)->first();
                        $ArrayCompra[$com->id] = [$compras->proveedor];
                    }                   
                    return response()->json($ArrayCompra);
                }else{
                    $compra = DB::table('personas as per')->join('proveedors as prov','prov.persona_id','=','per.id')->select('per.id','per.name')->where('prov.estado','Activo')->where('per.sede_id', Auth::user()->persona->sede_id)->get();
                    foreach($compra as $compras){
                        $ArrayCompra[$compras->id] = [$compras->name];
                    }                   
                    return response()->json($ArrayCompra);
                }
            }
        }
    }

    public function getDt_compras(Request $request){
        if($request->ajax()){
                $compra = DB::table('ordenescompras as ord')->join('detallecompras as dtc','dtc.ordencompra_id','=','ord.id')->select('ord.*')->where('dtc.proveedor',$request->operac_proveedor)->where('ord.sede_id', Auth::user()->persona->sede_id)->where('ord.total_pago','!=','0')->where('ord.comprobante','!=','')->where('ord.nro_comprobante','!=','')->get();
                foreach($compra as $compras){
                    $ArrayVenta[$compras->id] = [$compras->comprobante,$compras->nro_comprobante,'', $compras->total, $compras->total_pago, $compras->codigo];
                }                   
                return response()->json($ArrayVenta);
        }
    }
    
    public function getDt_servicios(Request $request){
        if($request->ajax()){
                $compra = DB::table('ordenservicios as ord')->select('ord.*')->where('dtc.proveedor',$request->operac_proveedor)->where('ord.sede_id', Auth::user()->persona->sede_id)->where('ord.total_pago','!=','0')->where('ord.comprobante','!=','')->where('ord.nro_comprobante','!=','')->get();
                foreach($compra as $compras){
                    $ArrayVenta[$compras->id] = [$compras->comprobante,$compras->nro_comprobante,'', $compras->total, $compras->total_pago, $compras->codigo];
                }                   
                return response()->json($ArrayVenta);
        }
    }

    public function getDt_ventas_vendedor(Request $request){
        if($request->ajax()){
                $compra = Persona::where('id',$request->operac_proveedor)->where('sede_id', Auth::user()->persona->sede_id)->where('bonificacion_vendedor','!=','0')->get();
                foreach($compra as $compras){
                    $ArrayVenta[$compras->id] = ['Cobro','por Bonificacion','', $compras->bonificacion_vendedor,$compras->bonificacion_control];
                }                   
                return response()->json($ArrayVenta);
        }
    }

    public function filtrar_fecha(Request $request){
        if($request->ajax()){
            if($request->autenticado == 'TODOS'){
                $venta = Pago::all();
                foreach($venta as $ventas){
                    $dtlle_pago = Detallepago::where('pago_id',$ventas->id)->get();
                        foreach($dtlle_pago as $dtlle_pagos){
                            $comprobante = $dtlle_pagos->concepto;
                        }
                    $Arraylist[$ventas->id] = [$ventas->nro_operacion,$ventas->proveedor, $ventas == 'COMPRA'?'Pago a comprobantes: '.$comprobante:'Bajo otro concepto: '.$comprobante,$ventas->slug,'TODOS',$ventas->fecha,$ventas->total_pagado];
                }

                return response()->json($Arraylist);
                
            }else{
                if($venta = Pago::where('sede_id', $request->autenticado)->where('fecha',$request->fecha)->exists()){
                    $venta = Pago::where('sede_id', $request->autenticado)->where('fecha',$request->fecha)->get();
                    
                    foreach($venta as $ventas){
                        $dtlle_pago = Detallepago::where('pago_id',$ventas->id)->get();
                        foreach($dtlle_pago as $dtlle_pagos){
                            $comprobante = $dtlle_pagos->concepto;
                        }
                        $Arraylist[$ventas->id] = [$ventas->nro_operacion,$ventas->proveedor, $ventas == 'COMPRA'?'Pago a comprobantes: '.$comprobante:'Bajo otro concepto: '.$comprobante,$ventas->slug,$ventas->sede->name,$ventas->fecha,$ventas->total_pagado];
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
    public function store(StorePagoRequest $request)
    {
        // $update_venta = Persona::where('id',$request->input('proveedorid'))->first();
        // echo '<pre>';
        // var_dump($request->input('proveedorid'));
        // die();
        // echo '<pre>';
        if(Cuentabancaria::where('nro_cuenta',$request->input('egreso'))->exists()){
            $valor_cuenta_id = Cuentabancaria::where('nro_cuenta',$request->input('egreso'))->first();
        }

        if($request->input('destinado') > $request->input('por_cobrar')){
            return redirect()->back()->with('montoElevado', 'ok');
        }else{
            $pagos = new Pago();
            $pagos->nro_operacion = $request->input('nro_operacion');
            $pagos->slug = Str::slug($request->input('nro_operacion').'-'.Auth::user()->persona->sede_id);
            $pagos->tipo_transaccion = $request->input('tipo_transaccion');
            $pagos->fecha = $request->input('fecha');
            $pagos->tipo_moneda = $request->input('tipo_moneda');
            $pagos->proveedor = $request->input('medico__id_value')?$request->input('medico__id_value'):'SERVICIO';
            $pagos->egreso = $request->input('egreso');
            if($request->input('egreso') != 'Efectivo'){
                $pagos->id_egreso = $valor_cuenta_id?$valor_cuenta_id->id:0;
            }
            $pagos->medio_pago = $request->input('medio_pago');
            $pagos->subtotal = $request->input('subtotal');
            $pagos->total_pagado = $request->input('total_pagado');
            $pagos->descripcion = $request->input('descripcion')?$request->input('descripcion'):'';
            $pagos->registrado_por = Auth::user()->persona->name.' '.Auth::user()->persona->lastname_padre.' - '.Auth::user()->role->name;
            $pagos->sede_id = Auth::user()->persona->sede_id;
            $pagos->save();
    
    
            $contador = $request->input('contador');
            $concepto = $request->input('concepto');
            $total = $request->input('total');
            $cobrado = $request->input('cobrado');
            $por_cobrar = $request->input('por_cobrar');
            $destinado = $request->input('destinado');
            $codigo_compra = $request->input('codigo_compra');

            $valor = $request->input('valor');
            $impuesto = $request->input('impuesto');
            $cantidad = $request->input('cantidad');
            $observaciones = $request->input('observaciones');
            $proveedorid = $request->input('proveedorid');
            
                if(isset($contador)){
                    foreach ($contador as $key => $name) {
                        if($request->input('tipo_transaccion') == 'AMORTIZACION'){
                            if($valor[$key]){
                                $now = Carbon::now();
                                $recet = Detallepago::orderBy('id','desc')->first();

                                if($recet){
                                    if($recet->created_at->format('m') == $now->format('m')){
                                        $nubRow =$recet?$recet->nro_solicitud+1:1;
                                        //$nubRow ='2964';
                                        $correlativo_prog = sprintf('%05d', trim($nubRow,'"'));
                                        $codigo_recet_slug = $correlativo_prog;
                                    }else{
                                        $nubRow =$recet?1:1;
                                        //$nubRow ='2964';
                                        $correlativo_prog = sprintf('%05d', trim($nubRow,'"'));
                                        $codigo_recet_slug = $now->format('Y')[2].''.$now->format('Y')[3].''.$now->format('m').''.$correlativo_prog;
                                    }
                                }else{
                                    $nubRow =$recet?1:1;
                                    //$nubRow ='2964';
                                    $correlativo_prog = sprintf('%05d', trim($nubRow,'"'));
                                    $codigo_recet_slug = $now->format('Y')[2].''.$now->format('Y')[3].''.$now->format('m').''.$correlativo_prog;
                                }

                                $detallecobro = new Detallepago();
                                $detallecobro->pago_id = $pagos->id;
                                $detallecobro->codigo_compra = $correlativo_prog;
                                $detallecobro->concepto = $concepto[$key];
                                $detallecobro->valor = $valor[$key];
                                $detallecobro->igv = $impuesto;
                                $detallecobro->cantidad = $cantidad[$key];
                                $detallecobro->observaciones = $observaciones[$key];
                                $detallecobro->save();

                                $subtotal = ($detallecobro->valor*$detallecobro->cantidad);
                
                                if($request->input('medio_pago') != 'Efectivo'){
                                    $cuentas = Cuentabancaria::where('nro_cuenta',$request->input('egreso'))->first();
                                    if($cuentas){
                                        $cuentas->apertura_cuenta = $cuentas->apertura_cuenta-$subtotal;
                                        $cuentas->save();
                    
                                        $cuenta_banco_total = DB::table('cuentasbancos')->select(DB::raw('sum(apertura_cuenta) as cuenta_t'))->where('nro_cuenta',$request->input('egreso'))->first();
                                        $caja = Caja::where('sede_id',Auth::user()->persona->sede_id)->first();
                                        $caja->total_cuenta_banco = $cuenta_banco_total->cuenta_t;
                                        $caja->total = $caja->total_efectivo+$caja->total_cuenta_banco;
                                        $caja->save();
                
                                        $registro = Registrocaja::latest('id')->where('sede_id',Auth::user()->persona->sede_id)->first();
                                        $registro->saldo_egreso = $registro->saldo_egreso+$subtotal;
                                        $registro->save();
                
                                        $now = Carbon::now();
                                        $mov_caja = Movimientocaja::orderBy('id','desc')->first();
                                        $nubRow =$mov_caja?$mov_caja->id+1:1;
                                        $codigo = 'MOVCAJA-'.$now->format('Ymd').'-'.$nubRow;
                
                                        $movimiento_caja = new Movimientocaja();
                                        $movimiento_caja->codigo = $codigo;
                                        $movimiento_caja->slug = Str::slug($codigo).'-'.Auth::user()->persona->sede_id;
                                        $movimiento_caja->motivo = 'AMORTIZACION POR '.$request->input('aplicado_a');
                                        $movimiento_caja->metodo = $request->input('medio_pago');
                                        $movimiento_caja->asunto = $concepto[$key];
                                        $movimiento_caja->total = $subtotal;
                                        $movimiento_caja->registrocaja_id = $registro->id;
                                        $movimiento_caja->operaciones = 'PAGO';
                                        $movimiento_caja->cuenta = $request->input('egreso');
                                        $movimiento_caja->save();
                                    }
                                }
                
                                if($request->input('medio_pago') == 'Efectivo'){
                                    $caja = Caja::where('sede_id',Auth::user()->persona->sede_id)->first();
                                    $caja->total_efectivo = $caja->total_efectivo-$subtotal;
                                    $caja->total = $caja->total_efectivo+$caja->total_cuenta_banco;
                                    $caja->save();
                
                                    $registro = Registrocaja::latest('id')->where('sede_id',Auth::user()->persona->sede_id)->first();
                                    $registro->saldo_egreso = $registro->saldo_egreso+$subtotal;
                                    $registro->save();
                
                                    $now = Carbon::now();
                                    $mov_caja = Movimientocaja::orderBy('id','desc')->first();
                                    $nubRow =$mov_caja?$mov_caja->id+1:1;
                                    $codigo = 'MOVCAJA-'.$now->format('Ymd').'-'.$nubRow;
                
                                    $movimiento_caja = new Movimientocaja();
                                    $movimiento_caja->codigo = $codigo;
                                    $movimiento_caja->slug = Str::slug($codigo);
                                    $movimiento_caja->motivo = 'AMORTIZACION POR '.$request->input('aplicado_a');
                                    $movimiento_caja->metodo = $request->input('medio_pago');
                                    $movimiento_caja->asunto = $concepto[$key];
                                    $movimiento_caja->total = $subtotal;
                                    $movimiento_caja->registrocaja_id = $registro->id;
                                    $movimiento_caja->operaciones = 'PAGO';
                                    $movimiento_caja->cuenta = $request->input('egreso');
                                    $movimiento_caja->save();
                                }

                            }
                        }
                    }
                }
            return redirect()->route('admin-pagos.index')->with('addpago', 'ok');
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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

    public function reportePagosPrintExcelSede(Request $request)
    {
        $fi = $request->fecha_ini. ' 00:00:00';
        $ff = $request->fecha_fin. ' 23:59:59';
        $tipo_concetos = $request->id_concepto_pdf;
        $sede = $request->sede_id;
        $proveedor = $request->proveedor_name;
        $name_sede = Sede::where('id', $sede)->first();
        return Excel::download(new ExcelPagoFechaExport($fi, $ff, $tipo_concetos, $sede, $proveedor,$name_sede), 'PagosFecha.xlsx');
    }

    public function reportePagoPrintExcelFechas(Request $request)
    {
        $fi = $request->fecha_ini. ' 00:00:00';
        $ff = $request->fecha_fin. ' 23:59:59';
        $fecha_asignada_value = $request->fecha_asignada;
        $fi_i = Carbon::parse($request->fecha_ini)->format('d-m-y');
        $ff_f = Carbon::parse($request->fecha_fin)->format('d-m-y');
        return Excel::download(new PagoExportFecha($fi, $ff, $fi_i, $ff_f, $fecha_asignada_value), 'PagosFecha.xlsx');
    }

    public function reportePagosPrintExcelFechas(Request $request)
    {
        $fi = $request->fecha_ini. ' 00:00:00';
        $ff = $request->fecha_fin. ' 23:59:59';
        $tipo_concetos = $request->id_concepto_pdf;
        $sede = $request->sede_id;
        $proveedor = $request->proveedor_name;
        $name_sede = Sede::where('id', $sede)->first();
        
        return Excel::download(new ExcelPagoFechaExport($fi, $ff, $tipo_concetos, $sede, $proveedor,$name_sede), 'PagosFecha.xlsx');
    }

    public function reportePrintPdf()
    {
        $now = Carbon::now();
        $fi = NULL;
        $ff = NULL;
        $name_sede = NULL;
        $pagos = Pago::all();
        $pdf = PDF::loadView('ADMINISTRADOR.REPORTES.PAGOS.pdf.pagosPDF', ['pagos'=>$pagos, 'fi'=>$fi, 'ff'=>$ff, 'name_sede'=>$name_sede, 'now'=>$now]);
        return $pdf->stream($now.'||Reporte-Pago-PDF.pdf');
    }

    public function reportePagosPrintPdfSede(Request $request)
    {
        $now = Carbon::now();
        $sede = $request->sede_id;
        $fi = $request->fecha_ini. ' 00:00:00';
        $ff = $request->fecha_fin. ' 23:59:59';
        $tipo_concetos = $request->id_concepto_pdf;
        $name_sede = Sede::where('id', $sede)->first();
  
            
            $pagos = DB::table('detallepagos as dtpa')->join('pagos as pa','dtpa.pago_id','=','pa.id')->select('pa.*','dtpa.*')->whereBetween('pa.created_at', [$fi, $ff])->where('pa.tipo_transaccion',$tipo_concetos)->where('pa.sede_id', "=", $sede)->where('pa.proveedor',$request->proveedor_name)->get();
        
        //$pagos = Pago::whereBetween('created_at', [$fi, $ff])->where('sede_id', "=", $sede)->get();
        $formatter = new NumeroALetras();
        $pdf = PDF::loadView('ADMINISTRADOR.REPORTES.PAGOS.pdf.pagosPDF', ['proveedor_pagos' => $request->proveedor_name ,'pagos'=>$pagos, 'now'=>$now, 'fi'=>$fi, 'ff'=>$ff, 'name_sede'=>$name_sede,'formatter'=>$formatter, 'name_sede'=>$name_sede]);
        return $pdf->stream('PAGOS-SEDE'.$sede.'.pdf');
    }

    public function getPagopdf(Pago $admin_pago)
    {
        $now = Carbon::now();
        $detalle_pago = Detallepago::where('pago_id',$admin_pago->id)->get();
        $formatter = new NumeroALetras();
        $pdf = PDF::loadView('ADMINISTRADOR.REPORTES.pago.detalle_pagoPDF', ['admin_pago'=>$admin_pago, 'detalle_pago'=>$detalle_pago, 'formatter'=>$formatter, 'now'=>$now]);
        return $pdf->stream('DETALLE-PAGO-'.$admin_pago->nro_operacion.'.pdf');
    }
}