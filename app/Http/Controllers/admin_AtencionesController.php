<?php

namespace App\Http\Controllers;

use App\Exports\ATExportFecha;
use App\Models\Antecedentepatologico;
use App\Models\Atencion;
use App\Models\Category;
use App\Models\Cita;
use App\Models\Consulta;
use App\Models\Detalleeauxiliar;
use App\Models\Diagnostico;
use App\Models\Diagnosticoprocedimiento;
use App\Models\Eauxiliar;
use App\Models\Especialidad;
use App\Models\Habitonocivo;
use App\Models\Medicamentoreceta;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\Persona;
use App\Models\Procedimiento;
use App\Models\Producto;
use App\Models\Receta;
use App\Models\Recursoterapeutico;
use App\Models\Rx;
use App\Models\Image;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use PDF;
use Maatwebsite\Excel\Facades\Excel;

class admin_AtencionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fecha_actual = Carbon::now()->format('Y-m-d');
        if(Auth::user()->role_id == '1'){
            $admin_atenciones = Atencion::all();
            return view('ADMINISTRADOR.CLINICA.atenciones.index', compact('admin_atenciones'));
        }if(Auth::user()->role_id == '2'){
            $admin_atenciones = Atencion::where('medico_id',Auth::user()->persona->medico->id)->where('sede_id',Auth::user()->persona->sede_id)->where('fecha',$fecha_actual)->get();
            return view('ADMINISTRADOR.CLINICA.atenciones.index', compact('admin_atenciones'));
        }if(Auth::user()->role_id == '6'){
            $admin_atenciones = Atencion::where('estado','En atención')->where('sede_id',Auth::user()->persona->sede_id)->get();
            return view('ADMINISTRADOR.CLINICA.atenciones.index', compact('admin_atenciones'));
        }else{
            abort(403);
        };
    }

    public function getindex_atencione(Request $request)
    {   $valor_fecha_inicial = $request->input('fec_ini');
        $valor_fecha_final = $request->input('fec_fin');

        if(Auth::user()->role_id == '1'){
            $admin_atenciones = Atencion::whereBetween('fecha', [$valor_fecha_inicial,$valor_fecha_final])->get();
            return view('ADMINISTRADOR.CLINICA.atenciones.index', compact('admin_atenciones'));
        }if(Auth::user()->role_id == '2'){
            $admin_atenciones = Atencion::whereBetween('fecha', [$valor_fecha_inicial,$valor_fecha_final])->where('medico_id',Auth::user()->persona->medico->id)->where('sede_id',Auth::user()->persona->sede_id)->get();
            return view('ADMINISTRADOR.CLINICA.atenciones.index', compact('admin_atenciones'));
        }if(Auth::user()->role_id == '6'){
            $admin_atenciones = Atencion::whereBetween('fecha', [$valor_fecha_inicial,$valor_fecha_final])->where('estado','En atención')->where('sede_id',Auth::user()->persona->sede_id)->get();
            return view('ADMINISTRADOR.CLINICA.atenciones.index', compact('admin_atenciones'));
        }else{
            abort(403);
        };
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::user()->role_id == '1' || Auth::user()->role_id == '2' || Auth::user()->role_id == '6'){
            $especialidades = Especialidad::where('estado', 'Activo')->get();
            $medicos = Medico::where('estado', 'Activo')->where('id', '!=', 1)->get();
            $pacientes = Paciente::where('estado', 'Activo')->get();

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

            return view('ADMINISTRADOR.CLINICA.atenciones.create', compact('especialidades', 'medicos', 'pacientes','codigo_atenc_slug','now'));
        }else{
            abort(403);
        };
    }

    public function getbusqueda_tipo_citas(Request $request){
        if($request->ajax()){
            if($request->value_tipo == 'Cita programada'){
                $carbon = Carbon::now()->format('Y-m-d');
                $admin_cita = Cita::where('fecha',$carbon)->get();
    
                foreach($admin_cita as $admin_citas){
                    $paciente = DB::table('personas as per')->join('pacientes as pac','pac.persona_id','=','per.id')->select('pac.id','per.name','per.surnames')->where('pac.id',$admin_citas->paciente_id)->first();

                    $espcialid = Especialidad::where('id',$admin_citas->especialidad_id)->first();

                    $admin_profesionale = DB::table('personas as per')->join('medicos as med','med.persona_id','=','per.id')->select('med.id','per.name','per.surnames')->where('med.id',$admin_citas->medico_id)->first();

                    $ArrayList[$admin_citas->id] = ['citas_programadas',$admin_citas->codigo, $admin_citas->fecha, $admin_citas->hora, $admin_citas->duracion,$paciente->id,$paciente->name.' '.$paciente->surnames, $espcialid->id, $espcialid->name, $admin_profesionale->id, $admin_profesionale->name.' '.$admin_profesionale->surnames, $admin_citas->descripcion?$admin_citas->descripcion:''];
                }
            }else{
                $pacientes = Paciente::where('estado', 'Activo')->get();

                foreach($pacientes as $paciente){
                    $ArrayList[$paciente->id] = [$paciente->persona->name.' '.$paciente->persona->surnames];
                }
            }

            return response()->json($ArrayList);
        }
    }

    
    public function getbusqueda_pacientes (Request $request){
        if($request->ajax()){
            $admin_pacientes = DB::table('personas as per')->join('pacientes as pac','pac.persona_id','=','per.id')->select('pac.id','per.name','per.surnames')->get();
            // $admin_pacientes = Persona::all()->where('tipo_persona', 'Paciente');
            
            foreach($admin_pacientes as $admin_paciente){
                $ArrayList[$admin_paciente->id] = [$admin_paciente->name.''.$admin_paciente->surnames];
            }
            return response()->json($ArrayList);
        }
    }

    public function getbusqueda_especialidades (Request $request){
        if($request->ajax()){
            $especialidades = Especialidad::all()->where('estado', 'Activo');
            
            foreach($especialidades as $especialidadess){
                $ArrayList[$especialidadess->id] = [$especialidadess->name];
            }
            return response()->json($ArrayList);
        }
    }

    public function getbusqueda_categoria_diagnos (Request $request){
        if($request->ajax()){
            $diagnostico_value = Diagnostico::where('estado', 'Activo')->where('category_id',$request->value_categoria)->get();
            
            foreach($diagnostico_value as $diagnostico_values){
                $ArrayList[$diagnostico_values->id] = [$diagnostico_values->name, $diagnostico_values->codigo];
            }
            return response()->json($ArrayList);
        }
    }

    public function getbusqueda_solicitud_receta (Request $request){
        if($request->ajax()){
            $now = Carbon::now();
            $recet = Receta::orderBy('id','desc')->first();

            if(Receta::where('atencion_id', $request->valor_atencion_id)->exists()){
                $valor_codigo_receta = Receta::where('atencion_id', $request->valor_atencion_id)->first();

                $ArrayList[1] = [$valor_codigo_receta->nro_solicitud,'codigo_existente'];
                return response()->json($ArrayList);
            }else{
                if($recet){
                    if($recet->created_at->format('m') == $now->format('m')){
                        $nubRow =$recet?$recet->nro_solicitud+1:1;
                        //$nubRow ='2964';
                        $correlativo_prog = sprintf('%07d', trim($nubRow,'"'));
                        $codigo_recet_slug = $correlativo_prog;
                    }else{
                        $nubRow =$recet?1:1;
                        //$nubRow ='2964';
                        $correlativo_prog = sprintf('%07d', trim($nubRow,'"'));
                        $codigo_recet_slug = $now->format('Y')[2].''.$now->format('Y')[3].''.$now->format('m').''.$correlativo_prog;
                    }
                }else{
                    $nubRow =$recet?1:1;
                    //$nubRow ='2964';
                    $correlativo_prog = sprintf('%07d', trim($nubRow,'"'));
                    $codigo_recet_slug = $now->format('Y')[2].''.$now->format('Y')[3].''.$now->format('m').''.$correlativo_prog;
                }
                
                    $ArrayList[1] = [$correlativo_prog];
                    return response()->json($ArrayList);

            }
        }
    }

    public function getbusqueda_solicitud_eauxiliar (Request $request){
        if($request->ajax()){
            $now = Carbon::now();
            $auxil = Eauxiliar::orderBy('id','desc')->first();

            if(Eauxiliar::where('atencion_id', $request->valor_atencion_id)->exists()){
                $valor_codigo_eauxiliar = Eauxiliar::where('atencion_id', $request->valor_atencion_id)->first();

                $ArrayList[1] = [$valor_codigo_eauxiliar->nro_solicitud,'codigo_existente'];
                return response()->json($ArrayList);
            }else{
                if($auxil){
                    if($auxil->created_at->format('m') == $now->format('m')){
                        $nubRow =$auxil?$auxil->nro_solicitud+1:1;
                        //$nubRow ='2964';
                        $correlativo_prog = sprintf('%07d', trim($nubRow,'"'));
                        $codigo_auxil_slug = $correlativo_prog;
                    }else{
                        $nubRow =$auxil?1:1;
                        //$nubRow ='2964';
                        $correlativo_prog = sprintf('%07d', trim($nubRow,'"'));
                        $codigo_auxil_slug = $now->format('Y')[2].''.$now->format('Y')[3].''.$now->format('m').''.$correlativo_prog;
                    }
                }else{
                    $nubRow =$auxil?1:1;
                    //$nubRow ='2964';
                    $correlativo_prog = sprintf('%07d', trim($nubRow,'"'));
                    $codigo_auxil_slug = $now->format('Y')[2].''.$now->format('Y')[3].''.$now->format('m').''.$correlativo_prog;
                }
                
                    $ArrayList[1] = [$correlativo_prog];
                    return response()->json($ArrayList);

            }
        }
    }
    
    public function getbusqueda_solicitud_rx (Request $request){
        if($request->ajax()){
            $now = Carbon::now();
            $recet = Rx::orderBy('id','desc')->first();

            if(Rx::where('atencion_id', $request->valor_atencion_id)->exists()){
                $valor_codigo_rx = Rx::where('atencion_id', $request->valor_atencion_id)->first();

                $ArrayList[1] = [$valor_codigo_rx->nro_solicitud,'codigo_existente'];
                return response()->json($ArrayList);
            }else{
                if($recet){
                    if($recet->created_at->format('m') == $now->format('m')){
                        $nubRow =$recet?$recet->nro_solicitud+1:1;
                        //$nubRow ='2964';
                        $correlativo_prog = sprintf('%07d', trim($nubRow,'"'));
                        $codigo_recet_slug = $correlativo_prog;
                    }else{
                        $nubRow =$recet?1:1;
                        //$nubRow ='2964';
                        $correlativo_prog = sprintf('%07d', trim($nubRow,'"'));
                        $codigo_recet_slug = $now->format('Y')[2].''.$now->format('Y')[3].''.$now->format('m').''.$correlativo_prog;
                    }
                }else{
                    $nubRow =$recet?1:1;
                    //$nubRow ='2964';
                    $correlativo_prog = sprintf('%07d', trim($nubRow,'"'));
                    $codigo_recet_slug = $now->format('Y')[2].''.$now->format('Y')[3].''.$now->format('m').''.$correlativo_prog;
                }
                
                    $ArrayList[1] = [$correlativo_prog];
                    return response()->json($ArrayList);

            }
        }
    }

    public function getguardar_consulta (Request $request){
        if($request->ajax()){
            if($request->tipo_consulta == 'generar'){
                if(Consulta::where('atencion_id',$request->valor_atencion_id)->exists()){
                    $admin_consulta = Consulta::where('atencion_id',$request->valor_atencion_id)->first();
                    
                    $now = Carbon::now();
    
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
    
                    // $admin_consulta = new Consulta();
                    // $admin_consulta->nro_solicitud = $codigo_consult_slug;
                    // $admin_consulta->slug = Str::slug('CO'.$codigo_consult_slug);
                    $admin_consulta->gestando = $request->gestante;
                    $admin_consulta->otros = $request->otras_patologias;
                    $admin_consulta->antecedentes = $request->antecedentes;
                    $admin_consulta->anamnesis = $request->anamnesis;
                    $admin_consulta->presion_arterial_uno = $request->presion_arterial_uno;
                    $admin_consulta->presion_arterial_dos = $request->presion_arterial_dos;
                    $admin_consulta->frecuencia_cardiaca = $request->frecuencia_cardiaca;
                    $admin_consulta->temperatura_corporal = $request->temperatura_corporal;
                    $admin_consulta->presion_venosa_central = $request->presion_venosa_central;
                    $admin_consulta->Frecuencia_respiratoria = $request->Frecuencia_respiratoria;
                    $admin_consulta->sat_o2 = $request->sat_o2;
                    $admin_consulta->peso = $request->peso;
                    $admin_consulta->talla = $request->talla;
                    $admin_consulta->imc = $request->imc;
                    $admin_consulta->perimetro_abdominal = $request->perimetro_abdominal;
                    $admin_consulta->tratamiento = $request->tratamiento;
                    $admin_consulta->interconsulta = $request->interconsulta;
                    $admin_consulta->motivo_interconsulta = $request->motivo_interconsulta;
                    $admin_consulta->solicitud_interconsulta = $request->solicitud_interconsulta;
                    $admin_consulta->sesiones_programadas = $request->sesiones_programadas;
                    $admin_consulta->frecuencia_sesiones = $request->frecuencia_sesiones;
                    $admin_consulta->pulsos_perifericos = $request->pulsos_perifericos;
                    $admin_consulta->aparato_respiratorio = $request->aparato_respiratorio;
                    $admin_consulta->abdomen = $request->abdomen;
                    $admin_consulta->extremidades = $request->extremidades;
                    $admin_consulta->electro_cardiograma = $request->electro_cardiograma;
                    $admin_consulta->riesgo_quirurgico = $request->riesgo_quirurgico;
                    $admin_consulta->atencion_id = $request->valor_atencion_id;
                    $admin_consulta->save();

                    if($request->antecedentes_multiple){
                        $admin_consulta->antecedentes_patologicos()->detach();
                        $admin_consulta->antecedentes_patologicos()->attach($request->antecedentes_multiple);
                    }
                    if($request->habitosnocivos_multiple){
                        $admin_consulta->habitos_nocivos()->detach();
                        $admin_consulta->habitos_nocivos()->attach($request->habitosnocivos_multiple);
                    }
                    if($request->recursosterapeuticos_multiple){
                        $admin_consulta->recursos_terapeuticos()->detach();
                        $admin_consulta->recursos_terapeuticos()->attach($request->recursosterapeuticos_multiple);
                    }
                    
                    // 
                    $arralist[1] = ['consulta_generada',$admin_consulta->gestando,$admin_consulta->anamnesis,$admin_consulta->presion_arterial_uno,$admin_consulta->presion_arterial_dos,$admin_consulta->frecuencia_cardiaca,$admin_consulta->temperatura_corporal,$admin_consulta->presion_venosa_central,$admin_consulta->Frecuencia_respiratoria,$admin_consulta->sat_o2,$admin_consulta->peso,$admin_consulta->talla,$admin_consulta->imc,$admin_consulta->perimetro_abdominal,$admin_consulta->otros,$admin_consulta->antecedentes,$admin_consulta->tratamiento, $admin_consulta->interconsulta, $admin_consulta->motivo_interconsulta, $admin_consulta->solicitud_interconsulta, $admin_consulta->sesiones_programadas, $admin_consulta->frecuencia_sesiones,$admin_consulta->pulsos_perifericos,$admin_consulta->aparato_respiratorio,$admin_consulta->abdomen,$admin_consulta->extremidades,$admin_consulta->electro_cardiograma,$admin_consulta->riesgo_quirurgico];
    
                    return response()->json($arralist);
                }else{
                    $now = Carbon::now();
    
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
    
                    $admin_consulta = new Consulta();
                    $admin_consulta->nro_solicitud = $codigo_consult_slug;
                    $admin_consulta->slug = Str::slug('CO'.$codigo_consult_slug);
                    $admin_consulta->gestando = $request->gestante;
                    $admin_consulta->otros = $request->otras_patologias;
                    $admin_consulta->antecedentes = $request->antecedentes;
                    $admin_consulta->anamnesis = $request->anamnesis;
                    $admin_consulta->presion_arterial_uno = $request->presion_arterial_uno;
                    $admin_consulta->presion_arterial_dos = $request->presion_arterial_dos;
                    $admin_consulta->frecuencia_cardiaca = $request->frecuencia_cardiaca;
                    $admin_consulta->temperatura_corporal = $request->temperatura_corporal;
                    $admin_consulta->presion_venosa_central = $request->presion_venosa_central;
                    $admin_consulta->Frecuencia_respiratoria = $request->Frecuencia_respiratoria;
                    $admin_consulta->sat_o2 = $request->sat_o2;
                    $admin_consulta->peso = $request->peso;
                    $admin_consulta->talla = $request->talla;
                    $admin_consulta->imc = $request->imc;
                    $admin_consulta->perimetro_abdominal = $request->perimetro_abdominal;
                    $admin_consulta->tratamiento = $request->tratamiento;
                    $admin_consulta->interconsulta = $request->interconsulta;
                    $admin_consulta->motivo_interconsulta = $request->motivo_interconsulta;
                    $admin_consulta->solicitud_interconsulta = $request->solicitud_interconsulta;
                    $admin_consulta->sesiones_programadas = $request->sesiones_programadas;
                    $admin_consulta->frecuencia_sesiones = $request->frecuencia_sesiones;
                    $admin_consulta->pulsos_perifericos = $request->pulsos_perifericos;
                    $admin_consulta->aparato_respiratorio = $request->aparato_respiratorio;
                    $admin_consulta->abdomen = $request->abdomen;
                    $admin_consulta->extremidades = $request->extremidades;
                    $admin_consulta->electro_cardiograma = $request->electro_cardiograma;
                    $admin_consulta->riesgo_quirurgico = $request->riesgo_quirurgico;
                    $admin_consulta->atencion_id = $request->valor_atencion_id;
                    $admin_consulta->save();

                    if($request->antecedentes_multiple){
                        $admin_consulta->antecedentes_patologicos()->attach($request->antecedentes_multiple);
                    }
                    if($request->habitosnocivos_multiple){
                        $admin_consulta->habitos_nocivos()->attach($request->habitosnocivos_multiple);
                    }
                    if($request->recursosterapeuticos_multiple){
                        $admin_consulta->recursos_terapeuticos()->attach($request->recursosterapeuticos_multiple);
                    }
    
                    $arralist[1] = ['consulta_generada',$admin_consulta->gestando,$admin_consulta->anamnesis,$admin_consulta->presion_arterial_uno,$admin_consulta->presion_arterial_dos,$admin_consulta->frecuencia_cardiaca,$admin_consulta->temperatura_corporal,$admin_consulta->presion_venosa_central,$admin_consulta->Frecuencia_respiratoria,$admin_consulta->sat_o2,$admin_consulta->peso,$admin_consulta->talla,$admin_consulta->imc,$admin_consulta->perimetro_abdominal,$admin_consulta->otros,$admin_consulta->antecedentes,$admin_consulta->tratamiento, $admin_consulta->interconsulta, $admin_consulta->motivo_interconsulta, $admin_consulta->solicitud_interconsulta,$admin_consulta->sesiones_programadas,$admin_consulta->frecuencia_sesiones,$admin_consulta->pulsos_perifericos,$admin_consulta->aparato_respiratorio,$admin_consulta->abdomen,$admin_consulta->extremidades,$admin_consulta->electro_cardiograma,$admin_consulta->riesgo_quirurgico];
    
                    return response()->json($arralist);
                }

            }else if($request->tipo_consulta == 'cargar'){
                if(Consulta::where('atencion_id',$request->valor_atencion_id)->exists()){
                    $cargar_consulta = Consulta::where('atencion_id',$request->valor_atencion_id)->first();

                    $arralist[1] = ['consulta_generada',$cargar_consulta->gestando,$cargar_consulta->anamnesis,$cargar_consulta->presion_arterial_uno,$cargar_consulta->presion_arterial_dos,$cargar_consulta->frecuencia_cardiaca,$cargar_consulta->temperatura_corporal,$cargar_consulta->presion_venosa_central,$cargar_consulta->Frecuencia_respiratoria,$cargar_consulta->sat_o2,$cargar_consulta->peso,$cargar_consulta->talla,$cargar_consulta->imc,$cargar_consulta->perimetro_abdominal,$cargar_consulta->otros,$cargar_consulta->antecedentes,$cargar_consulta->tratamiento, $cargar_consulta->interconsulta, $cargar_consulta->motivo_interconsulta, $cargar_consulta->solicitud_interconsulta,$cargar_consulta->sesiones_programadas,$cargar_consulta->frecuencia_sesiones,$cargar_consulta->pulsos_perifericos,$cargar_consulta->aparato_respiratorio,$cargar_consulta->abdomen,$cargar_consulta->extremidades,$cargar_consulta->electro_cardiograma,$cargar_consulta->riesgo_quirurgico];

                    return response()->json($arralist);
                }

            }

        }
    }

    public function getguardar_selectmultiple (Request $request){
        if(Consulta::where('atencion_id',$request->valor_atencion_id)->exists()){
            $valor_consulta = Consulta::where('atencion_id',$request->valor_atencion_id)->first();
            if($request->tipo_consulta == 'cargar_antec'){
                if(DB::table('antecedentepatologico_consulta')->where('consulta_id',$valor_consulta->id)->exists()){
                    $cargar_consulta_select = DB::table('antecedentes_patologicos as antpat')->join('antecedentepatologico_consulta as apatocon','apatocon.antecedentepatologico_id','=','antpat.id')->select('apatocon.id','antpat.id as id_antecedente','antpat.name')->where('apatocon.consulta_id',$valor_consulta->id)->get();
                    
                    foreach($cargar_consulta_select as $cargar_consulta_selects){
                        $arralist[$cargar_consulta_selects->id] = [$cargar_consulta_selects->id_antecedente,$cargar_consulta_selects->name];
                    }
        
                    return response()->json($arralist);
                }
            }
            if($request->tipo_consulta == 'cargar_habnoc'){
                if(DB::table('consulta_habitonocivo')->where('consulta_id',$valor_consulta->id)->exists()){
                    $cargar_habnoc_select = DB::table('habitos_nocivos as habnoc')->join('consulta_habitonocivo as habicons','habicons.habitonocivo_id','=','habnoc.id')->select('habicons.id','habnoc.id as id_habito','habnoc.name')->where('habicons.consulta_id',$valor_consulta->id)->get();
                    
                    foreach($cargar_habnoc_select as $cargar_habnoc_selects){
                        $arralist[$cargar_habnoc_selects->id] = [$cargar_habnoc_selects->id_habito,$cargar_habnoc_selects->name];
                    }
        
                    return response()->json($arralist);
                }
            }
            if($request->tipo_consulta == 'cargar_recuter'){
                if(DB::table('consulta_recursoterapeutico')->where('consulta_id',$valor_consulta->id)->exists()){
                    $cargar_recurst_select = DB::table('recursos_terapeuticos as rectera')->join('consulta_recursoterapeutico as consrecu','consrecu.recursoterapeutico_id','=','rectera.id')->select('consrecu.id','rectera.id as id_recursot','rectera.name')->where('consrecu.consulta_id',$valor_consulta->id)->get();
                    
                    foreach($cargar_recurst_select as $cargar_recurst_selects){
                        $arralist[$cargar_recurst_selects->id] = [$cargar_recurst_selects->id_recursot,$cargar_recurst_selects->name];
                    }
        
                    return response()->json($arralist);
                }
            }
        }
        
    }
    public function getguardar_procedimiento (Request $request){
            if(Procedimiento::where('atencion_id',$request->input('atenciones_id'))->exists()){
                Procedimiento::where('atencion_id',$request->input('atenciones_id'))->delete();
                
                $now = Carbon::now();

                $proced = Procedimiento::orderBy('id','desc')->first();
                if($proced){
                    if($proced->created_at->format('m') == $now->format('m')){
                        $nubRow =$proced?$proced->nro_solicitud+1:1;
                        //$nubRow ='2964';
                        $correlativo_prog = sprintf('%04d', trim($nubRow,'"'));
                        $codigo_proced_slug = $correlativo_prog;
                    }else{
                        $nubRow =$proced?1:1;
                        //$nubRow ='2964';
                        $correlativo_prog = sprintf('%04d', trim($nubRow,'"'));
                        $codigo_proced_slug = $now->format('Y')[2].''.$now->format('Y')[3].''.$now->format('m').''.$correlativo_prog;
                    }
                }else{
                    $nubRow =$proced?1:1;
                    //$nubRow ='2964';
                    $correlativo_prog = sprintf('%04d', trim($nubRow,'"'));
                    $codigo_proced_slug = $now->format('Y')[2].''.$now->format('Y')[3].''.$now->format('m').''.$correlativo_prog;
                }

                $admin_procedimiento = new Procedimiento();
                $admin_procedimiento->nro_solicitud = $codigo_proced_slug;
                $admin_procedimiento->slug = Str::slug('P'.$codigo_proced_slug);
                $admin_procedimiento->registro_dolor = $request->input('registro_dolor');
                $admin_procedimiento->detalle_registro_dolor = $request->input('detalle_registro_dolor');
                $admin_procedimiento->plan_trabajo = $request->input('plan_trabajo');
                $admin_procedimiento->informacion_adicional = $request->input('informacion_adicional');
                $admin_procedimiento->resultado_atencion = $request->input('resultado_atencion');
                $admin_procedimiento->atencion_id = $request->input('atenciones_id');
                $admin_procedimiento->save();
                
                $tipo_procedimiento = $request->input('tipo_procedimiento');
                $caso_procedimiento = $request->input('caso_procedimiento');
                $alta_procedimiento = $request->input('alta_procedimiento');
                $diagnostico_procedimiento = $request->input('diagnostico_procedimiento');

                if(isset($diagnostico_procedimiento)){
                    foreach ($diagnostico_procedimiento as $key => $item) {

                        $dtlleprocedimiento = new Diagnosticoprocedimiento();
                        $dtlleprocedimiento->diagnostico_id = $diagnostico_procedimiento[$key];
                        $dtlleprocedimiento->procedimiento_id = $admin_procedimiento->id;
                        $dtlleprocedimiento->tipo = $tipo_procedimiento[$key];
                        $dtlleprocedimiento->caso = $caso_procedimiento[$key];
                        $dtlleprocedimiento->alta = $alta_procedimiento[$key];
                        $dtlleprocedimiento->save();
                    }
                }

                return redirect()->back()->with('success', 'ok');
            }else{
                $now = Carbon::now();

                $proced = Procedimiento::orderBy('id','desc')->first();
                if($proced){
                    if($proced->created_at->format('m') == $now->format('m')){
                        $nubRow =$proced?$proced->nro_solicitud+1:1;
                        //$nubRow ='2964';
                        $correlativo_prog = sprintf('%04d', trim($nubRow,'"'));
                        $codigo_proced_slug = $correlativo_prog;
                    }else{
                        $nubRow =$proced?1:1;
                        //$nubRow ='2964';
                        $correlativo_prog = sprintf('%04d', trim($nubRow,'"'));
                        $codigo_proced_slug = $now->format('Y')[2].''.$now->format('Y')[3].''.$now->format('m').''.$correlativo_prog;
                    }
                }else{
                    $nubRow =$proced?1:1;
                    //$nubRow ='2964';
                    $correlativo_prog = sprintf('%04d', trim($nubRow,'"'));
                    $codigo_proced_slug = $now->format('Y')[2].''.$now->format('Y')[3].''.$now->format('m').''.$correlativo_prog;
                }

                $admin_procedimiento = new Procedimiento();
                $admin_procedimiento->nro_solicitud = $codigo_proced_slug;
                $admin_procedimiento->slug = Str::slug('P'.$codigo_proced_slug);
                $admin_procedimiento->registro_dolor = $request->input('registro_dolor');
                $admin_procedimiento->detalle_registro_dolor = $request->input('detalle_registro_dolor');
                $admin_procedimiento->plan_trabajo = $request->input('plan_trabajo');
                $admin_procedimiento->informacion_adicional = $request->input('informacion_adicional');
                $admin_procedimiento->resultado_atencion = $request->input('resultado_atencion');
                $admin_procedimiento->atencion_id = $request->input('atenciones_id');
                $admin_procedimiento->save();
                
                $tipo_procedimiento = $request->input('tipo_procedimiento');
                $caso_procedimiento = $request->input('caso_procedimiento');
                $alta_procedimiento = $request->input('alta_procedimiento');
                $diagnostico_procedimiento = $request->input('diagnostico_procedimiento');

                if(isset($diagnostico_procedimiento)){
                    foreach ($diagnostico_procedimiento as $key => $item) {

                        $dtlleprocedimiento = new Diagnosticoprocedimiento();
                        $dtlleprocedimiento->diagnostico_id = $diagnostico_procedimiento[$key];
                        $dtlleprocedimiento->procedimiento_id = $admin_procedimiento->id;
                        $dtlleprocedimiento->tipo = $tipo_procedimiento[$key];
                        $dtlleprocedimiento->caso = $caso_procedimiento[$key];
                        $dtlleprocedimiento->alta = $alta_procedimiento[$key];
                        $dtlleprocedimiento->save();
                    }
                }
                
                return redirect()->back()->with('success', 'ok');
            }

            // else if($request->tipo_consulta == 'cargar'){
            //     if(Procedimiento::where('atencion_id',$request->valor_atencion_id)->exists()){
            //         $cargar_procedimiento = Procedimiento::where('atencion_id',$request->valor_atencion_id)->first();

            //         $arralist[1] = ['procedimiento_generado',$cargar_procedimiento->registro_dolor,$cargar_procedimiento->detalle_registro_dolor,$cargar_procedimiento->detalle_registro_dolor,$cargar_procedimiento->plan_trabajo,$cargar_procedimiento->informacion_adicional,$cargar_procedimiento->resultado_atencion];

            //         return response()->json($arralist);
            //     }
    }
    
    public function getcargar_procedimiento (Request $request){
        if($request->ajax()){
            if($request->tipo_consulta == 'cargar'){
                if(Procedimiento::where('atencion_id',$request->valor_atencion_id)->exists()){
                    $cargar_procidimi = Procedimiento::where('atencion_id',$request->valor_atencion_id)->first();

                    $arralist[1] = ['consulta_generada',$cargar_procidimi->registro_dolor,$cargar_procidimi->detalle_registro_dolor,$cargar_procidimi->plan_trabajo,$cargar_procidimi->informacion_adicional,$cargar_procidimi->resultado_atencion];

                    return response()->json($arralist);
                }
            }

        }
    }

    public function getcargar_dtlleprocedimiento (Request $request){
        if($request->ajax()){
            if($request->tipo_consulta == 'cargar'){
                if(Procedimiento::where('atencion_id',$request->valor_atencion_id)->exists()){
                    $cargar_procidimi = Procedimiento::where('atencion_id',$request->valor_atencion_id)->first();

                    $dtllediagnostico = Diagnosticoprocedimiento::where('procedimiento_id',$cargar_procidimi->id)->get();

                    foreach($dtllediagnostico as $dtllediagnosticos){
                        $diagnosti = Diagnostico::where('id',$dtllediagnosticos->diagnostico_id)->first();

                        $arralist[$dtllediagnosticos->id] = [$diagnosti->codigo, $diagnosti->name,$dtllediagnosticos->diagnostico_id,$dtllediagnosticos->procedimiento_id,$dtllediagnosticos->tipo,$dtllediagnosticos->caso,$dtllediagnosticos->alta];
                    }
                    return response()->json($arralist);

                }
            }

        }
    }

    public function getguardar_receta (Request $request){
        if(Receta::where('atencion_id',$request->input('atenciones_id_receta'))->exists()){
            Receta::where('atencion_id',$request->input('atenciones_id_receta'))->delete();


                $admin_receta = new Receta();
                $admin_receta->nro_solicitud = $request->input('nro_solicitud');
                $admin_receta->slug = Str::slug('P'.$request->input('nro_solicitud'));
                $admin_receta->fecha = $request->input('fecha');
                $admin_receta->atencion_id = $request->input('atenciones_id_receta');
                $admin_receta->informacion_adicionales = $request->input('informacion_adicionales');
                $admin_receta->save();
                
                $medicamento_id = $request->input('medicamento_id');
                $via = $request->input('via');
                $cantidad = $request->input('cantidad');
                $indicaciones = $request->input('indicaciones');

                if(isset($medicamento_id)){
                    foreach ($medicamento_id as $key => $item) {

                        $dtllemedicreceta = new Medicamentoreceta();
                        $dtllemedicreceta->producto_id = $medicamento_id[$key];
                        $dtllemedicreceta->receta_id = $admin_receta->id;
                        $dtllemedicreceta->via = $via[$key];
                        $dtllemedicreceta->cantidad = $cantidad[$key];
                        $dtllemedicreceta->indicaciones = $indicaciones[$key];
                        $dtllemedicreceta->save();
                    }
                }

                return redirect()->back()->with('success', 'ok');
        }else{
                $admin_receta = new Receta();
                $admin_receta->nro_solicitud = $request->input('nro_solicitud');
                $admin_receta->slug = Str::slug('P'.$request->input('nro_solicitud'));
                $admin_receta->fecha = $request->input('fecha');
                $admin_receta->atencion_id = $request->input('atenciones_id_receta');
                $admin_receta->informacion_adicionales = $request->input('informacion_adicionales');
                $admin_receta->save();
                
                $medicamento_id = $request->input('medicamento_id');
                $via = $request->input('via');
                $cantidad = $request->input('cantidad');
                $indicaciones = $request->input('indicaciones');

                if(isset($medicamento_id)){
                    foreach ($medicamento_id as $key => $item) {

                        $dtllemedicreceta = new Medicamentoreceta();
                        $dtllemedicreceta->producto_id = $medicamento_id[$key];
                        $dtllemedicreceta->receta_id = $admin_receta->id;
                        $dtllemedicreceta->via = $via[$key];
                        $dtllemedicreceta->cantidad = $cantidad[$key];
                        $dtllemedicreceta->indicaciones = $indicaciones[$key];
                        $dtllemedicreceta->save();
                    }
                }

                return redirect()->back()->with('success', 'ok');
        }
    }

    public function getcargar_receta (Request $request){
        if($request->ajax()){
            if($request->tipo_consulta == 'cargar'){
                if(Receta::where('atencion_id',$request->valor_atencion_id)->exists()){
                    $cargar_receta = Receta::where('atencion_id',$request->valor_atencion_id)->first();

                    $arralist[1] = ['consulta_generada',$cargar_receta->informacion_adicionales];

                    return response()->json($arralist);
                }
            }

        }
    }

    public function getcargar_dtllemedica_receta (Request $request){
        if($request->ajax()){
            if($request->tipo_consulta == 'cargar'){
                if(Receta::where('atencion_id',$request->valor_atencion_id)->exists()){
                    $cargar_receta = Receta::where('atencion_id',$request->valor_atencion_id)->first();

                    $dtllemedica_receta = Medicamentoreceta::where('receta_id',$cargar_receta->id)->get();

                    foreach($dtllemedica_receta as $dtllemedica_recetas){
                        $medicam_ = Producto::where('id',$dtllemedica_recetas->producto_id)->first();

                        $arralist[$dtllemedica_recetas->id] = [$medicam_->codigo, $medicam_->name,$medicam_->unidad_medida,$dtllemedica_recetas->producto_id,$dtllemedica_recetas->receta_id,$dtllemedica_recetas->via,$dtllemedica_recetas->cantidad,$dtllemedica_recetas->indicaciones?$dtllemedica_recetas->indicaciones:''];
                    }
                    return response()->json($arralist);

                }
            }

        }
    }


    public function getguardar_eauxiliar (Request $request){
        if(Eauxiliar::where('atencion_id',$request->input('atenciones_id_eauxiliar'))->exists()){
            Eauxiliar::where('atencion_id',$request->input('atenciones_id_eauxiliar'))->delete();


                $admin_eauxiliar = new Eauxiliar();
                $admin_eauxiliar->nro_solicitud = $request->input('nro_solicitud');
                $admin_eauxiliar->slug = Str::slug('P'.$request->input('nro_solicitud'));
                $admin_eauxiliar->fecha_auxiliar = $request->input('fecha_auxiliar');
                $admin_eauxiliar->vfecha_auxiliar = Carbon::now()->parse($admin_eauxiliar->fecha_auxiliar)->addDays(3)->format('Y-m-d');
                $admin_eauxiliar->atencion_id = $request->input('atenciones_id_eauxiliar');
                $admin_eauxiliar->save();
                
                $analisis = $request->input('analisis');
                $tipo_analisis = $request->input('tipo_analisis');

                if(isset($analisis)){
                    foreach ($analisis as $key => $item) {

                        $dtlleeauxiliar = new Detalleeauxiliar();
                        $dtlleeauxiliar->analisis = $analisis[$key];
                        $dtlleeauxiliar->t_analisis = $tipo_analisis[$key];
                        $dtlleeauxiliar->eauxiliares_id = $admin_eauxiliar->id;
                        $dtlleeauxiliar->save();
                    }
                }

                return redirect()->back()->with('success', 'ok');
        }else{
                $admin_eauxiliar = new Eauxiliar();
                $admin_eauxiliar->nro_solicitud = $request->input('nro_solicitud');
                $admin_eauxiliar->slug = Str::slug('P'.$request->input('nro_solicitud'));
                $admin_eauxiliar->fecha_auxiliar = $request->input('fecha_auxiliar');
                $admin_eauxiliar->vfecha_auxiliar = Carbon::now()->parse($admin_eauxiliar->fecha_auxiliar)->addDays(3)->format('Y-m-d');
                $admin_eauxiliar->atencion_id = $request->input('atenciones_id_eauxiliar');
                $admin_eauxiliar->save();
                
                $analisis = $request->input('analisis');
                $tipo_analisis = $request->input('tipo_analisis');

                if(isset($analisis)){
                    foreach ($analisis as $key => $item) {

                        $dtlleeauxiliar = new Detalleeauxiliar();
                        $dtlleeauxiliar->analisis = $analisis[$key];
                        $dtlleeauxiliar->t_analisis = $tipo_analisis[$key];
                        $dtlleeauxiliar->eauxiliares_id = $admin_eauxiliar->id;
                        $dtlleeauxiliar->save();
                    }
                }

                return redirect()->back()->with('success', 'ok');
        }
    }

    public function getcargar_dtllemedica_eauxiliar (Request $request){
        if($request->ajax()){
            if($request->tipo_consulta == 'cargar'){
                if(Eauxiliar::where('atencion_id',$request->valor_atencion_id)->exists()){
                    $cargar_eauxiliar = Eauxiliar::where('atencion_id',$request->valor_atencion_id)->first();

                    $dtlleeauxiliar = Detalleeauxiliar::where('eauxiliares_id',$cargar_eauxiliar->id)->get();

                    foreach($dtlleeauxiliar as $dtlleeauxiliars){

                        $arralist[$dtlleeauxiliars->id] = [$dtlleeauxiliars->analisis, $dtlleeauxiliars->t_analisis,$dtlleeauxiliars->eauxiliar_id];
                    }
                    return response()->json($arralist);

                }
            }

        }
    }

    public function getguardar_rx (Request $request){
        $now = Carbon::now();
        if(Rx::where('atencion_id',$request->input('atenciones_id_rx'))->exists()){
            Rx::where('atencion_id',$request->input('atenciones_id_rx'))->delete();

            // condicion para guardar el nombre de las imagenes opcionales
            $urlimagenes = [];
            if ($request->hasFile('images_opcional')){
                $imagenes = $request->file('images_opcional');
                foreach ($imagenes as $imagen) {
                    $nombre = time().'_'.$imagen->getClientOriginalName();
                    $imagen->move(public_path().'/images/rx-opcional/', $nombre);
                    $urlimagenes[]['url']='/images/rx-opcional/'.$nombre;
                }
            }

            $admin_rx = new Rx();
            $admin_rx->nro_solicitud = $request->input('nro_solicitud');
            $admin_rx->slug = Str::slug('RX'.$request->input('nro_solicitud'));
            $admin_rx->fecha_rx = $request->input('nro_solicitud');
            $admin_rx->descripcion_rx = $request->input('descripcion_rx');
            $admin_rx->atencion_id = $request->input('atenciones_id_rx');
            $admin_rx->save();

            // guardar las imagenes opcionales
                $admin_rx->images()->createMany($urlimagenes);
            
            return redirect()->back()->with('success', 'ok_rx');

        }else{
            // condicion para guardar el nombre de las imagenes opcionales
            $urlimagenes = [];
            if ($request->hasFile('images_opcional')){
                $imagenes = $request->file('images_opcional');
                foreach ($imagenes as $imagen) {
                    $nombre = time().'_'.$imagen->getClientOriginalName();
                    $imagen->move(public_path().'/images/rx-opcional/', $nombre);
                    $urlimagenes[]['url']='/images/rx-opcional/'.$nombre;
                }
            }

            $admin_rx = new Rx();
            $admin_rx->nro_solicitud = $request->input('nro_solicitud');
            $admin_rx->slug = Str::slug('RX'.$request->input('nro_solicitud'));
            $admin_rx->fecha_rx = $request->input('fecha');
            $admin_rx->descripcion_rx = $request->input('descripcion_rx');
            $admin_rx->atencion_id = $request->input('atenciones_id_rx');
            $admin_rx->save();

            // guardar las imagenes opcionales
                $admin_rx->images()->createMany($urlimagenes);
            
            return redirect()->back()->with('success', 'ok_rx');
        }
    
    }

    public function deleteImage($id)
    {
        $image = Image::find($id);
        $file_path = public_path(). $image->url; 
        File::delete($file_path);
        $image->delete();
        return redirect()->back();
    }

    public function getcargar_rx (Request $request){
        if($request->ajax()){
            if(Rx::where('atencion_id',$request->valor_atencion_id)->exists()){
                $admin_rx = Rx::where('atencion_id',$request->valor_atencion_id)->first();
                $Array_list[1] = [$admin_rx->descripcion_rx];

                return response()->json($Array_list);
            }
        }
    }
    
    public function getfinalizar_atencion (Request $request){
        if($request->ajax()){
            if(Atencion::where('id',$request->valor_atencion_id)->exists()){
                $admin_atencion = Atencion::where('id',$request->valor_atencion_id)->first();
                $admin_atencion->estado = 'Completado';
                $admin_atencion->save();
                    
                $Array_list[1] = ['consulta_generada'];
                
                return response()->json($Array_list);
            }
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Atencion::where('codigo', $request->input('codigo'))->exists()){
            return redirect()->route('admin-atenciones.index')->with('exists', 'ok');
        }else{
            if(Cita::where('id', $request->input('cita_id'))->exists()){
                $update_cita = Cita::where('id', $request->input('cita_id'))->first();
                $update_cita->estado = 'Completado';
                $update_cita->save();
            }

            $admin_atencione = new Atencion();
            $admin_atencione->codigo = $request->input('codigo');
            $admin_atencione->slug = Str::slug('AT'.$request->input('codigo'));
            $admin_atencione->tipo = $request->input('tipo');
            $admin_atencione->cita_id = $request->input('cita_id');
            $admin_atencione->fecha = $request->input('fecha');
            $admin_atencione->hora = $request->input('hora');
            $admin_atencione->duracion = $request->input('duracion');
            $admin_atencione->paciente_id = $request->input('paciente_id');
            $admin_atencione->especialidad_id = $request->input('especialidad_id');
            $admin_atencione->medico_id = $request->input('medico_id');
            $admin_atencione->descripcion = $request->input('descripcion');
            $admin_atencione->registrado_por = Auth::user()->persona->name.' '.Auth::user()->persona->surnames.' - '.Auth::user()->role->name;
            $admin_atencione->estado = 'En atención';
            $admin_atencione->sede_id = Auth::user()->persona->sede_id;
            $admin_atencione->save();

            return redirect()->route('admin-atenciones.show', $admin_atencione->slug);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Atencion $admin_atencione)
    {
        if(Auth::user()->role_id == '1' || Auth::user()->role_id == '2' || Auth::user()->role_id == '6'){
            $categories = Category::where('estado','Activo')->get();
            $admin_medicamento = Producto::where('estado', 'Activo')->where('cantidad','>','0')->get();
            $fecha_actual = Carbon::now()->format('Y-m-d');
            $especialidades = Especialidad::where('estado', 'Activo')->get();
            $antecede_patologicos = Antecedentepatologico::where('estado', 'Activo')->get();
            $recursos_terapeuticos = Recursoterapeutico::where('estado', 'Activo')->get();
            $habitos_nocivos = Habitonocivo::where('estado', 'Activo')->get();
            $edad = Carbon::parse($admin_atencione->paciente->persona->fecha_nacimiento)->age;
            
            return view('ADMINISTRADOR.CLINICA.atenciones.show', compact('admin_atencione','categories','admin_medicamento','fecha_actual','especialidades','antecede_patologicos','recursos_terapeuticos','habitos_nocivos','edad'));
        }else{
            abort(403);
        };
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Atencion $admin_atencione)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Atencion $admin_atencione)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Atencion $admin_atencione)
    {
        //
    }


    public function getAtencionPdf(Atencion $admin_atencione)
    {
        $now = Carbon::now();
        $edad = Carbon::parse($admin_atencione->paciente->persona->fecha_nacimiento)->age;
        $pdf = PDF::loadView('ADMINISTRADOR.REPORTES.atenciones.pdf_atencion', ['admin_atencione'=>$admin_atencione, 'now'=>$now, 'edad'=>$edad]);
        return $pdf->stream('ATENCIÓN-'.$admin_atencione->codigo.'.pdf');

    }

    public function getRecetaPdf(Atencion $admin_atencione)
    {
        $receta = Receta::where('atencion_id', $admin_atencione->id)->first();
        $now = Carbon::now();
        $edad = Carbon::parse($admin_atencione->paciente->persona->fecha_nacimiento)->age;
        $pdf = PDF::setPaper('a4')->loadView('ADMINISTRADOR.REPORTES.atenciones.pdf_receta', ['admin_atencione'=>$admin_atencione, 'receta'=>$receta, 'now'=>$now, 'edad'=>$edad]);
        return $pdf->stream('RECETA-'.$receta->nro_solicitud.'.pdf');

    }
    
    public function getInterconsultaPdf(Atencion $admin_atencione)
    {
        $interconsulta = Atencion::where('id', $admin_atencione->id)->first();
        $now = Carbon::now();
        $edad = Carbon::parse($admin_atencione->paciente->persona->fecha_nacimiento)->age;
        $pdf = PDF::setPaper('a4')->loadView('ADMINISTRADOR.REPORTES.atenciones.pdf_interconsulta', ['admin_atencione'=>$admin_atencione, 'interconsulta'=>$interconsulta, 'now'=>$now, 'edad'=>$edad]);
        return $pdf->stream('INTERCONSULTA-'.$interconsulta->nro_solicitud.'.pdf');

    }

    public function getEauxiliarPdf(Atencion $admin_atencione)
    {
        $eauxiliar = Eauxiliar::where('atencion_id', $admin_atencione->id)->first();
        $now = Carbon::now();
        $edad = Carbon::parse($admin_atencione->paciente->persona->fecha_nacimiento)->age;
        $pdf = PDF::setPaper('a4')->loadView('ADMINISTRADOR.REPORTES.atenciones.pdf_eauxiliar', ['admin_atencione'=>$admin_atencione, 'eauxiliar'=>$eauxiliar, 'now'=>$now, 'edad'=>$edad]);
        return $pdf->stream('EAUXILIAR-'.$eauxiliar->nro_solicitud.'.pdf');

    }

    public function getRxPdf(Atencion $admin_atencione)
    {
        $rx = Rx::where('atencion_id', $admin_atencione->id)->first();
        $now = Carbon::now();
        $edad = Carbon::parse($admin_atencione->paciente->persona->fecha_nacimiento)->age;
        $pdf = PDF::loadView('ADMINISTRADOR.REPORTES.rx.pdf_rx', ['admin_atencione'=>$admin_atencione, 'rx'=>$rx, 'now'=>$now, 'edad'=>$edad]);
        return $pdf->stream('RX-'.$rx->nro_solicitud.'.pdf');

    }

    public function getcalcular_vigencia_eauxiliar()
    {
        if(Eauxiliar::exists()){
            $fecha_actual = Carbon::now()->format('Y-m-d');
            $vigencia_eauxiliar = Eauxiliar::all();
            foreach($vigencia_eauxiliar as $vigencia_eauxiliares){
                if($fecha_actual > $vigencia_eauxiliares->vfecha_auxiliar){
                    if($vigencia_eauxiliares->estado_pago == 'Pagado'){
                        $vigencia_eauxiliares->estado_pago = 'Pagado';
                        $vigencia_eauxiliares->save();
                    }if($vigencia_eauxiliares->estado_pago == 'Pendiente'){
                        $vigencia_eauxiliares->estado_pago = 'Anulado';
                        $vigencia_eauxiliares->save();
                    }
                }if($fecha_actual < $vigencia_eauxiliares->vfecha_auxiliar){
                    if($vigencia_eauxiliares->estado_pago == 'Pagado'){
                        $vigencia_eauxiliares->estado_pago = 'Pagado';
                        $vigencia_eauxiliares->save();
                    }if($vigencia_eauxiliares->estado_pago == 'Pendiente'){
                        $vigencia_eauxiliares->estado_pago = 'Pendiente';
                        $vigencia_eauxiliares->save();
                    }
                }
                $arralist[1] = ['Exito'];
            }

            return response()->json($arralist);
        }
    }

    public function reporteAtencionesPrintExcelFechas(Request $request)
    {
        $fi = $request->fecha_ini. ' 00:00:00';
        $ff = $request->fecha_fin. ' 23:59:59';

        $fi_i = Carbon::parse($request->fecha_ini)->format('d-m-y');
        $ff_f = Carbon::parse($request->fecha_fin)->format('d-m-y');
        return Excel::download(new ATExportFecha($fi, $ff, $fi_i, $ff_f), 'ATENCIONES '.$fi_i.' AL '.$ff_f.'.xlsx');
    }
}
