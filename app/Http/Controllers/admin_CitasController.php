<?php

namespace App\Http\Controllers;

use App\Models\Atencion;
use App\Models\Cita;
use App\Models\Especialidad;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\Profesion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class admin_CitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->role_id == '1'){
            $admin_citas = Cita::all();
            return view('ADMINISTRADOR.CLINICA.citas.index', compact('admin_citas'));
        }if(Auth::user()->role_id == '4'){
            $admin_citas = Cita::where('sede_id',Auth::user()->persona->sede_id)->get();
            return view('ADMINISTRADOR.CLINICA.citas.index', compact('admin_citas'));
        }else{
            abort(403);
        };
    }

    public function getindex_cita(Request $request)
    {   $valor_fecha_inicial = $request->input('fec_ini');
        $valor_fecha_final = $request->input('fec_fin');

        if(Auth::user()->role_id == '1'){
            $admin_citas = Cita::whereBetween('fecha', [$valor_fecha_inicial,$valor_fecha_final])->get();
            return view('ADMINISTRADOR.CLINICA.citas.index', compact('admin_citas'));
        }if(Auth::user()->role_id == '4'){
            $admin_citas = Cita::whereBetween('fecha', [$valor_fecha_inicial,$valor_fecha_final])->where('sede_id',Auth::user()->persona->sede_id)->get();
            return view('ADMINISTRADOR.CLINICA.citas.index', compact('admin_citas'));
        }else{
            abort(403);
        };
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::user()->role_id == '1' || Auth::user()->role_id == '4'){
            $especialidades = Especialidad::all()->where('estado', 'Activo');
            $medicos = Medico::all()->where('estado', 'Activo')->where('id', '!=', 1);
            $pacientes = Paciente::all()->where('estado', 'Activo');

            $now = Carbon::now();
            $cit = Cita::orderBy('id','desc')->first();
            if($cit){
                if($cit->created_at->format('m') == $now->format('m')){
                    $nubRow =$cit?$cit->codigo+1:1;
                    //$nubRow ='2964';
                    $correlativo_prog = sprintf('%04d', trim($nubRow,'"'));
                    $codigo_cit_slug = $correlativo_prog;
                }else{
                    $nubRow =$cit?1:1;
                    //$nubRow ='2964';
                    $correlativo_prog = sprintf('%04d', trim($nubRow,'"'));
                    $codigo_cit_slug = $now->format('Y')[2].''.$now->format('Y')[3].''.$now->format('m').''.$correlativo_prog;
                }
            }else{
                $nubRow =$cit?1:1;
                //$nubRow ='2964';
                $correlativo_prog = sprintf('%04d', trim($nubRow,'"'));
                $codigo_cit_slug = $now->format('Y')[2].''.$now->format('Y')[3].''.$now->format('m').''.$correlativo_prog;
            }

            return view('ADMINISTRADOR.CLINICA.citas.create', compact('especialidades', 'medicos', 'pacientes','codigo_cit_slug','now'));
        }else{
            abort(403);
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
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Cita::where('codigo', $request->input('codigo'))->exists()){
            return redirect()->route('admin-citas.index')->with('exists', 'ok');
        }else{
            $cita = new Cita();
            $cita->codigo = $request->input('codigo');
            $cita->slug = Str::slug('C'.$request->input('codigo'));
            $cita->fecha = $request->input('fecha');
            $cita->hora = $request->input('hora');
            $cita->duracion = $request->input('duracion');
            $cita->paciente_id = $request->input('paciente_id');
            $cita->especialidad_id = $request->input('especialidad_id');
            $cita->medico_id = $request->input('medico_id');
            $cita->descripcion = $request->input('descripcion');
            $cita->registrado_por = Auth::user()->persona->name.' '.Auth::user()->persona->surnames.' - '.Auth::user()->role->name;
            $cita->estado = 'Activo';
            $cita->sede_id = Auth::user()->persona->sede_id;
            $cita->save();
            return redirect()->route('admin-citas.index')->with('addregister', 'ok');
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
    public function edit(Cita $admin_cita)
    {
        if(Auth::user()->role_id == '1' || Auth::user()->role_id == '4'){
            $especialidades = Especialidad::all()->where('estado', 'Activo');
            $medicos = Medico::all()->where('estado', 'Activo')->where('id', '!=', 1);
            $pacientes = Paciente::all()->where('estado', 'Activo');
            return view('ADMINISTRADOR.CLINICA.citas.edit', compact('especialidades', 'medicos', 'pacientes', 'admin_cita'));
        }else{
            abort(403);
        };
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cita $admin_cita)
    {
        if ($request->input('codigo') == $admin_cita->codigo) {
            $admin_cita->fill($request->all());
            $admin_cita->save();
            return redirect()->route('admin-citas.index')->with('update', 'ok');
        }else{
            if(Cita::where('codigo', $request->input('codigo'))->exists()){
                return redirect()->route('admin-citas.index')->with('exists', 'ok');
            }else{
                $admin_cita->fill($request->except('codigo'));
                $admin_cita->save();
                return redirect()->route('admin-citas.index')->with('update', 'ok');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cita $admin_cita)
    {
        if(Atencion::where('cita_id',$admin_cita->id)->exists()){
            return redirect()->route('admin-citas.index')->with('error', 'ok');
        }else{
            $admin_cita->delete();
            return redirect()->route('admin-citas.index')->with('delete', 'ok');
        }
    }
}
