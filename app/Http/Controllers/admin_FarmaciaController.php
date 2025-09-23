<?php

namespace App\Http\Controllers;

use App\Exports\FARMExportFecha;
use App\Models\Atencion;
use App\Models\Detallefarmacia;
use App\Models\Farmacia;
use App\Models\Producto;
use App\Models\Receta;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class admin_FarmaciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->role_id == '1'){
            $admin_farmaciaa = Farmacia::all();
            return view('ADMINISTRADOR.CLINICA.farmacia.index', compact('admin_farmaciaa'));
        }if(Auth::user()->role_id == '5'){
            $admin_farmaciaa = Farmacia::where('sede_id',Auth::user()->persona->sede_id)->get();
            return view('ADMINISTRADOR.CLINICA.farmacia.index', compact('admin_farmaciaa'));
        }else{
            abort(403);
        };
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::user()->role_id == '1' || Auth::user()->role_id == '5'){
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

            return view('ADMINISTRADOR.CLINICA.farmacia.create', compact('atenciones', 'now','codigo_farmac_slug'));
        }else{
            abort(403);
        };
    }

    public function getbusqueda_tipo_atencion (Request $request){
        if($request->ajax()){
            if($request->value_tipo == 'atencion_directa'){
                $admin_medicamento = Producto::where('estado', 'Activo')->where('tipo_producto','Medicamento')->where('cantidad','>','0')->get();
                
                foreach($admin_medicamento as $admin_medicamentos){
                    $ArrayList[$admin_medicamentos->id] = [$admin_medicamentos->name, $admin_medicamentos->precio_venta,$admin_medicamentos->unidad_medida, $admin_medicamentos->cantidad, $admin_medicamentos->codigo];
                }
                return response()->json($ArrayList);
            }else{
                $admin_atencion = DB::table('atencions as atnc')->join('recetas as rec','rec.atencion_id','=','atnc.id')->select('atnc.*')->where('rec.estado_pago', 'Pagado')->where('rec.estado_entrega', 'Pendiente')->get();
                // Atencion::where('estado', 'Completado')->get();
                foreach($admin_atencion as $admin_atencions){
                    $pacientes_value = DB::table('personas as per')->join('pacientes as pa','pa.persona_id','=','per.id')->select('per.name','per.surnames')->where('pa.id',$admin_atencions->paciente_id)->first();
                    
                    $ArrayList[$admin_atencions->id] = [$admin_atencions->codigo, $pacientes_value->name.' '. $pacientes_value->surnames, $admin_atencions->fecha];
                }
                return response()->json($ArrayList);
            }
        }
    }
    
    public function getbusqueda_tipo_atencion_medicamento (Request $request){
        if($request->ajax()){
            $admin_medicamento_value = DB::table('atencions as aten')->join('recetas as rec','rec.atencion_id','=','aten.id')->join('medicamento_receta as mere','mere.receta_id','=','rec.id')->select('mere.producto_id as id','mere.cantidad','mere.producto_id')->where('aten.codigo',$request->valor_codigo_atencion)->get();
                
            foreach($admin_medicamento_value as $admin_medicamento_values){

                $admin_medicamento = Producto::where('id', $admin_medicamento_values->producto_id)->first();

                $ArrayList[$admin_medicamento_values->id] = [$admin_medicamento->name, $admin_medicamento->precio_venta,$admin_medicamento->unidad_medida, $admin_medicamento_values->cantidad, $admin_medicamento->codigo];
            }
            return response()->json($ArrayList);
        }
    }

    // public function getbusqueda_tipo_medicamento (Request $request){
    //     if($request->ajax()){
    //         $admin_atencio = Atencion::where('estado', 'En atencion')->get();
            
    //         foreach($admin_atencio as $admin_atencios){
    //             $ArrayList[$admin_atencios->id] = [$admin_medicamentos->name, $admin_medicamentos->precio_venta,$admin_medicamentos->unidad_medida, $admin_medicamentos->cantidad];
    //         }
    //         return response()->json($ArrayList);
    //     }
    // }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Farmacia::where('codigo', $request->input('codigo'))->exists()){
            return redirect()->route('admin-farmacia.index')->with('exists', 'ok');
        }else{
            $farmaciass = new Farmacia();
            $farmaciass->codigo = $request->input('codigo');
            $farmaciass->slug = Str::slug('F'.$request->input('codigo'));
            $farmaciass->fecha = $request->input('fecha');
            $farmaciass->tipo_atencion = $request->input('tipo_atencion') == 'atencion_directa'? 'Atencion Directa':'Atencion Programada';
            $farmaciass->atencion = $request->input('atencion');
            $farmaciass->descripcion = $request->input('descripcion');
            $farmaciass->subtotal = $request->input('subtotal');
            $farmaciass->igv = $request->input('igv');
            $farmaciass->total = $request->input('total');
            $farmaciass->estado = 'Completado';
            $farmaciass->sede_id = Auth::user()->persona->sede_id;
            $farmaciass->save();
            
            if(Atencion::where('codigo',$farmaciass->atencion)->exists()){

                $valor_atencion = Atencion::where('codigo',$farmaciass->atencion)->first();
                $valor_receta = Receta::where('atencion_id',$valor_atencion->id)->first();
                $valor_receta->estado_entrega = 'Entregado';
                $valor_receta->save();
                
            }

            $medicamento_id = $request->input('medicamento_id');
            $cantidad = $request->input('cantidad');
            $precio = $request->input('precio');
            $subtotal_ = $request->input('subtotal_');

            if(isset($medicamento_id)){
                foreach ($medicamento_id as $key => $item) {
                    $medicamento_value = Producto::where('id',$medicamento_id[$key])->first();
                    $medicamento_value->cantidad = $medicamento_value->cantidad-$cantidad[$key];
                    $medicamento_value->save();
                    
                    $dtllefarmacia = new Detallefarmacia();
                    $dtllefarmacia->id_medicamento = $medicamento_id[$key];
                    $dtllefarmacia->codigo = $medicamento_value->codigo;
                    $dtllefarmacia->medicamento = $medicamento_value->name;
                    $dtllefarmacia->umedida = $medicamento_value->unidad_medida;
                    $dtllefarmacia->cantidad = $cantidad[$key];
                    $dtllefarmacia->precio = $precio[$key];
                    $dtllefarmacia->subtotal = $subtotal_[$key];
                    $dtllefarmacia->farmacia_id = $farmaciass->id;
                    $dtllefarmacia->save();


                }
            }


            return redirect()->route('admin-farmacia.index')->with('medicamento', 'ok');
        }
    }

    public function getEstadoentrega(Request $request, Farmacia $admin_farmacia)
    {
        if($admin_farmacia->estado == 'Pendiente'){
            $dtfarmacia = Detallefarmacia::where('farmacia_id',$admin_farmacia->id)->get();
            foreach($dtfarmacia as $dtfarmacias){
                $prod_val = Producto::where('id',$dtfarmacias->id_medicamento)->first();
                $prod_val->cantidad = $prod_val->cantidad - $dtfarmacias->cantidad;
                $prod_val->save();
            }
    
            $admin_farmacia->estado = 'Completado';
            $admin_farmacia->save();

            return redirect()->route('admin-farmacia.index')->with('update_estado_entrega', 'ok');
        }else{
            return redirect()->back();
        }

    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function reporteFarmaciaPrintExcelFechas(Request $request)
    {
        $fi = $request->fecha_ini. ' 00:00:00';
        $ff = $request->fecha_fin. ' 23:59:59';

        $fi_i = Carbon::parse($request->fecha_ini)->format('d-m-y');
        $ff_f = Carbon::parse($request->fecha_fin)->format('d-m-y');
        return Excel::download(new FARMExportFecha($fi, $ff, $fi_i, $ff_f), 'FARMACIA '.$fi_i.' AL '.$ff_f.'.xlsx');
    }
}
