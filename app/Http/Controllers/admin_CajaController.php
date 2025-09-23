<?php

namespace App\Http\Controllers;

use App\Exports\ExcelcajaExport;
use App\Exports\ExceldetallecajaExport;
use App\Exports\ReporteBancosExport;
use App\Models\Caja;
use App\Models\Cuentabancaria;
use App\Models\Cuentasbanco;
use Carbon\Carbon;
use App\Models\Movcuentabanco;
use App\Models\Movimientocaja;
use App\Models\Registrocaja;
use App\Models\Sede;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PDF;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class admin_CajaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->role_id == '1'){
            $sedes = Sede::all()->where('estado', 'Activo');
            $cajas = Caja::all();
            return view('ADMINISTRADOR.TESORERIA.cajas.index', compact('cajas', 'sedes'));
        }if(Auth::user()->role_id == '4'){
            $sedes = Sede::all()->where('estado', 'Activo');
            $cajas = Caja::where('sede_id', Auth::user()->persona->sede_id)->get();
            return view('ADMINISTRADOR.TESORERIA.cajas.index', compact('cajas', 'sedes'));
        }else{
            abort(403);
        };
    }

    public function filtrar_fecha(Request $request){
        if($request->ajax()){
            if($request->autenticado == 'TODOS'){
                $registrocaja = Registrocaja::all();
                $cuentas = Cuentabancaria::all();
                $cajas_afectivo = Caja::latest('id')->first();
                foreach($registrocaja as $registrocajas){
                    $Arraylist[$registrocajas->id] = [$registrocajas->codigo,$registrocajas->store->name, $registrocajas->motivo->name,$registrocajas->slug,'TODOS',$registrocajas->fecha,$registrocajas->total_product];
                }

                return response()->json($Arraylist);
                
            }else{
                $cuentas = Cuentabancaria::where('sede_id', $request->autenticado)->get();
                if($registrocaja = Registrocaja::where('sede_id', $request->autenticado)->where('fecha_apertura',$request->fecha)->exists()){
                    $registrocaja = Registrocaja::where('sede_id', $request->autenticado)->where('fecha_apertura',$request->fecha)->get();
                    
                    foreach($registrocaja as $registrocajas){
                        $Arraylist[$registrocajas->id] = [$registrocajas->fecha_apertura,$registrocajas->fecha_cierre?$registrocajas->fecha_cierre:'/', $registrocajas->saldo_inicial,$registrocajas->slug,$registrocajas->saldo_ingreso,$registrocajas->saldo_egreso,(($registrocajas->saldo_inicial+$registrocajas->saldo_ingreso)-$registrocajas->salgo_egreso),$registrocajas->estado, $registrocajas->sede->name];
                    }

                    foreach($cuentas as $cuenta){
                        $cajas_afectivo = Caja::latest('id')->where('sede_id', $cuenta->sede_id)->first();
                        $ArraylistB[$cuenta->id] = [$cuenta->banco->imagen,$cuenta->apertura_cuenta,$cajas_afectivo->sede->name,$cajas_afectivo->total, $cajas_afectivo->total_efectivo];
                    }
    
                    return response()->json(['Arraylist' => $Arraylist, 'ArraylistB' => $ArraylistB]);
                }else{
                    $Arraylist[1] = ['vacio'];
                    return response()->json(['Arraylist' => $Arraylist]);
                }
            }
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $now = Carbon::now();
        $registroc = Registrocaja::orderBy('id','desc')->first();
        $nubRow =$registroc?$registroc->id+1:1;
        $codigo = 'CAJA1-'.$now->format('Ymd').'-'.$nubRow;
        
        $caja_principal = Caja::where('sede_id', $request->input('sede_id'))->first();
        $caja_principal->total_efectivo = $request->input('total_efectivo');
        $caja_principal->total = $caja_principal->total_efectivo+$caja_principal->total_cuenta_banco;
        $caja_principal->estado = 'APERTURADA';
        $caja_principal->save();
        
        $caja = new Registrocaja();
        $caja->codigo = $codigo;
        $caja->slug = Str::slug($codigo);
        $caja->fecha_apertura = $request->input('fecha_apertura');
        $caja->hora_apertura = $request->input('hora');
        $caja->saldo_inicial = $request->input('saldo_inicial')+$request->input('total_efectivo');
        $caja->registrado_por = Auth::user()->persona->name.' '.Auth::user()->persona->lastname_padre.' - '.Auth::user()->role->name;
        $caja->sede_id = $request->input('sede_id');
        $caja->caja_id = $caja_principal->id;
        $caja->save();

        // $movcuentab = new Movcuentabanco();


        // event(new CajaaperturaEvent($caja));

        return redirect()->back()->with('addcaja', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Caja $admin_caja)
    {
        // if(Gate::allows('gerencia',Auth()->user()) || Gate::allows('administracion',Auth()->user()) || Gate::allows('tesoreria',Auth()->user())){
        if(Auth::user()->role_id == '1' || Auth::user()->role_id == '4'){
            $sedes = Sede::all()->where('estado', 'Activo');
            $registrocaja = Registrocaja::where('caja_id', $admin_caja->id)->get();
            $registcaja = Registrocaja::where('caja_id', $admin_caja->id)->latest('id')->first();
            $fecha = Carbon::now()->format('Y-m-d');
            $hora = Carbon::now()->toTimeString();
            $cuentas = Cuentabancaria::where('sede_id', $admin_caja->sede->id)->get();
            return view('ADMINISTRADOR.TESORERIA.cajas.registro_caja.index', compact('admin_caja', 'cuentas', 'registrocaja','registcaja', 'fecha', 'hora', 'sedes'));
        }else{
            abort(403);
        };
    }

    public function getindex_caja(Request $request)
    {   $valor_fecha_inicial = $request->input('fec_ini');
        $valor_fecha_final = $request->input('fec_fin');
        $valor_caja_id = $request->input('valor_caja');
        $admin_caja = Caja::where('id',$valor_caja_id)->first();
        if(Auth::user()->role_id == '1' || Auth::user()->role_id == '4'){
            $sedes = Sede::all()->where('estado', 'Activo');
            $registrocaja = Registrocaja::whereBetween('fecha_apertura', [$valor_fecha_inicial,$valor_fecha_final])->where('caja_id', $valor_caja_id)->get();
            $registcaja = Registrocaja::whereBetween('fecha_apertura', [$valor_fecha_inicial,$valor_fecha_final])->where('caja_id', $valor_caja_id)->latest('id')->first();
            $fecha = Carbon::now()->format('Y-m-d');
            $hora = Carbon::now()->toTimeString();
            $cuentas = Cuentabancaria::where('sede_id', $admin_caja->sede->id)->get();
            return view('ADMINISTRADOR.TESORERIA.cajas.registro_caja.index', compact('admin_caja', 'cuentas', 'registrocaja','registcaja', 'fecha', 'hora', 'sedes'));
        }else{
            abort(403);
        };
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
    public function update(Request $request, Registrocaja $admin_caja)
    {
        $fecha = Carbon::now()->format('Y-m-d');
        $hora = Carbon::now()->toTimeString();
        $admin_caja->estado = 'CERRADA';
        $admin_caja->fecha_cierre = $fecha;
        $admin_caja->hora_cierre = $hora;
        $admin_caja->save();

        // event(new CajacierreEvent($admin_caja));

        $caja = Caja::where('id',$admin_caja->caja_id)->latest('id')->first();
        $caja->estado = 'CERRADA';
        $caja->save();


        return redirect()->back()->with('cerrar_caja', 'ok');
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

    public function Movcajaexcel(Request $request)
    {
        $fi = $request->fecha_ini. ' 00:00:00';
        $ff = $request->fecha_fin. ' 23:59:59';
        return Excel::download(new ExcelcajaExport($fi, $ff), 'Mov_caja_general.xlsx');
    }

    public function getRegistroCajaexcel(Request $request, Registrocaja $registro)
    {
        return Excel::download(new ExceldetallecajaExport($registro), 'Mov_caja_general.xlsx');
    }
    
    public function reportePrintPdf(Caja $admin_caja)
    {
        $now = Carbon::now();
        $fi = NULL;
        $ff = NULL;
        $registrocaja = Registrocaja::where('caja_id', $admin_caja->id)->get();
        $pdf = PDF::loadView('ADMINISTRADOR.REPORTES.caja.pdf.registros_cajaPDF', ['admin_caja'=>$admin_caja, 'fi'=>$fi, 'ff'=>$ff, 'registrocaja'=>$registrocaja, 'now'=>$now]);
        return $pdf->stream($now.'||Reporte-caja'.$admin_caja->name_caja.'.pdf');
    }

    public function reporteCajaPrintPdfFechas(Request $request)
    {
        $now = Carbon::now();
        $caja = $request->caja_id;
        $fi = $request->fecha_ini. ' 00:00:00';
        $ff = $request->fecha_fin. ' 23:59:59';
        $admin_caja = Caja::where('id', $caja)->first();
        $registrocaja = Registrocaja::whereBetween('created_at', [$fi, $ff])->where('caja_id', "=", $admin_caja->id)->get();
        $pdf = PDF::loadView('ADMINISTRADOR.REPORTES.caja.pdf.registros_cajaPDF', ['registrocaja'=>$registrocaja, 'now'=>$now, 'fi'=>$fi, 'ff'=>$ff, 'admin_caja'=>$admin_caja]);
        return $pdf->stream('REPORTE-CAJA'.$admin_caja->name_caja.'.pdf');
    }

    public function getRegistroCajapdf(Registrocaja $registro)
    {
        $now = Carbon::now();
        $mov_registro_caja = Movimientocaja::where('registrocaja_id',$registro->id)->get();
        $pdf = PDF::loadView('ADMINISTRADOR.REPORTES.caja.pdf.detalle_movcajaPDF', ['registro'=>$registro, 'mov_registro_caja'=>$mov_registro_caja, 'now'=>$now]);
        return $pdf->stream('DETALLE-MOVIMIENTO-CAJA-'.$registro->codigo.'.pdf');
    }

    public function reporteCajaPrintExcelFechas(Request $request)
    {
        $fi = $request->fecha_ini. ' 00:00:00';
        $ff = $request->fecha_ini. ' 23:59:59';

        $fi_i = Carbon::parse($request->fecha_ini)->format('d-m-y');
        return Excel::download(new ReporteBancosExport($fi, $ff, $fi_i), 'REPORTE BANCOS '.$fi_i.'.xlsx');
    }
}
