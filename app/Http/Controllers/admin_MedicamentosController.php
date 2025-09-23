<?php

namespace App\Http\Controllers;

use App\Exports\BienExportFecha;
use App\Models\Clasificacion;
use App\Models\Detallefarmacia;
use App\Models\Medicamentoreceta;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class admin_MedicamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->role_id == '1'){
            $admin_medicamentos = Producto::all();
            return view('ADMINISTRADOR.PRINCIPAL.configuraciones.medicamentos.index', compact('admin_medicamentos'));
        }if(Auth::user()->role_id == '4'){
            $admin_medicamentos = Producto::where('sede_id',Auth::user()->persona->sede_id)->get();
            return view('ADMINISTRADOR.PRINCIPAL.configuraciones.medicamentos.index', compact('admin_medicamentos'));
        }if(Auth::user()->role_id == '5'){
            $admin_medicamentos = Producto::where('tipo_producto','Medicamento')->where('sede_id',Auth::user()->persona->sede_id)->get();
            return view('ADMINISTRADOR.PRINCIPAL.configuraciones.medicamentos.index', compact('admin_medicamentos'));
        }else{
            abort(403);
        };
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::user()->role_id == '1' || Auth::user()->role_id == '4' || Auth::user()->role_id == '5'){
            $clasificaciones = Clasificacion::all();
            return view('ADMINISTRADOR.PRINCIPAL.configuraciones.medicamentos.create', compact('clasificaciones'));
        }else{
            abort(403);
        };
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->hasFile('imagen')){
            $file = $request->file('imagen');
            $img_medicamento = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/medicamentos/', $img_medicamento);
        }else{
            $img_medicamento = "NULL";
        }

        $medicamento = new Producto();
        $medicamento->codigo = $request->input('codigo');
        $medicamento->name = $request->input('name');
        $medicamento->slug = Str::slug($request->input('codigo'));
        $medicamento->imagen = $img_medicamento;
        $medicamento->precio_venta = $request->input('precio_venta');
        $medicamento->marca = $request->input('marca');
        $medicamento->cantidad = $request->input('cantidad');
        $medicamento->descripcion = $request->input('descripcion');
        $medicamento->unidad_medida = "NIU";
        $medicamento->estado = "Activo";
        $medicamento->clasificacion_id = $request->input('clasificacion_id');
        $medicamento->registrado_por = Auth::user()->persona->name.' '.Auth::user()->persona->surnames.' - '.Auth::user()->role->name;
        $medicamento->tipo_producto = $request->input('tipo_producto');
        $medicamento->sede_id = Auth::user()->persona->sede_id;
        $medicamento->save();

        return redirect()->route('admin-medicamentos.index')->with('addregister', 'ok');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $admin_medicamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $admin_medicamento)
    {
        if(Auth::user()->role_id == '1' || Auth::user()->role_id == '4' || Auth::user()->role_id == '5'){
            $clasificaciones = Clasificacion::all();
            return view('ADMINISTRADOR.PRINCIPAL.configuraciones.medicamentos.edit', compact('clasificaciones', 'admin_medicamento'));
        }else{
            abort(403);
        };
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $admin_medicamento)
    {
        $admin_medicamento->fill($request->except('imagen', 'codigo'));
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $imagen = time().$file->getClientOriginalName();
            if ($admin_medicamento->imagen) {
                $file_path = public_path(). '/images/medicamentos/'.$admin_medicamento->imagen;
                File::delete($file_path);
                $admin_medicamento->update([
                    $admin_medicamento->imagen = $imagen,
                    $file->move(public_path().'/images/medicamentos/', $imagen)
                ]);
            }else{
                $admin_medicamento['imagen'] = $admin_medicamento->imagen;
            }
        }

        if ($request->input('codigo') == $admin_medicamento->codigo) {
            $admin_medicamento->save();
            return redirect()->route('admin-medicamentos.index')->with('update', 'ok');
        }else{
            if(Producto::where('codigo', $request->input('codigo'))->exists()){
                return redirect()->route('admin-medicamentos.index')->with('exists', 'ok');
            }else{
                $admin_medicamento['codigo'] = $request->input('codigo');
                $admin_medicamento['slug'] = Str::slug($request->input('codigo'));
                $admin_medicamento->save();
                return redirect()->route('admin-medicamentos.index')->with('update', 'ok');
            }
        }
    }

    public function estado(Request $request, Producto $admin_medicamento)
     {         
        if($admin_medicamento->estado == 'Activo'){
            $admin_medicamento->estado = 'Inactivo';
            $admin_medicamento->save();
        }else{
            $admin_medicamento->estado = 'Activo';
            $admin_medicamento->save();
        }
        return redirect()->back()->with('update', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $admin_medicamento)
    {
        if(Detallefarmacia::where('id_medicamento',$admin_medicamento->id)->exists() || Medicamentoreceta::where('producto_id',$admin_medicamento->id)->exists()){
            return redirect()->route('admin-medicamentos.index')->with('error', 'ok');
        }else{
            $file_path = public_path(). '/images/medicamentos/'.$admin_medicamento->imagen; 
            File::delete($file_path);
            $admin_medicamento->delete();
            return redirect()->route('admin-medicamentos.index')->with('delete', 'ok');
        }
    }

    public function reporteMedicamentoPrintExcelFechas(Request $request)
    {
        $fi = $request->fecha_ini. ' 00:00:00';
        $ff = $request->fecha_fin. ' 23:59:59';

        $fi_i = Carbon::parse($request->fecha_ini)->format('d-m-y');
        $ff_f = Carbon::parse($request->fecha_fin)->format('d-m-y');
        return Excel::download(new BienExportFecha($fi, $ff, $fi_i, $ff_f), 'BIENES '.$fi_i.' AL '.$ff_f.'.xlsx');
    }
}
