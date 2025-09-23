<?php

namespace App\Http\Controllers;

use App\Models\Antecedentepatologico;
use App\Models\Atencion;
use App\Models\Habitonocivo;
use App\Models\Identificacion;
use App\Models\Image;
use App\Models\Paciente;
use App\Models\Persona;
use App\Models\Profesion;
use App\Models\Recursoterapeutico;
use App\Models\Role;
use App\Models\User;
use App\Models\Imagenologia;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PDF;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class admin_PacientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->role_id == '1'){
            $admin_pacientes = Persona::where('tipo_persona', 'Paciente')->get();
            return view('ADMINISTRADOR.PRINCIPAL.pacientes.index', compact('admin_pacientes'));
        }if(Auth::user()->role_id == '2' || Auth::user()->role_id == '4'|| Auth::user()->role_id == '6'){
            $admin_pacientes = Persona::where('tipo_persona', 'Paciente')->where('sede_id',Auth::user()->persona->sede_id)->get();
            return view('ADMINISTRADOR.PRINCIPAL.pacientes.index', compact('admin_pacientes'));
        }else{
            abort(403);
        };
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::user()->role_id == '1' || Auth::user()->role_id == '2' || Auth::user()->role_id == '4' || Auth::user()->role_id == '6'){
            $identificaciones = Identificacion::all();
            $profesiones = Profesion::all();
            $roles = Role::all()->where('id', '2');
            return view('ADMINISTRADOR.PRINCIPAL.pacientes.create', compact('identificaciones', 'profesiones', 'roles'));
        }else{
            abort(403);
        };
    }

    public function getBusquedaReniec(Request $request){
        if($request->ajax()){
            if($request->tipo_reniecs == 'RUC'){
                //PRIMERA CONSULTA
                    // $token = 'apis-token-3424.nv5xBhBhD89mPVhDig9lVAEPinVo1OU4';
                        // $dni = $request->buscando;
            
                        // // Iniciar llamada a API
                        // $curl = curl_init();
            
                        // // Buscar ruc sunat
                        // curl_setopt_array($curl, array(
                        // //api 1
                        // // CURLOPT_URL => 'https://dniruc.apisperu.com/api/v1/ruc/'.$dni.'?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im1lZGljLmNlc2FyLmN0N0BnbWFpbC5jb20ifQ.0YU-1E5BnPDUcA0-ZCLdQiZ4Za5X_RJxq8085JiF03E',
                        // //api 2
                        // CURLOPT_URL => 'https://api.apis.net.pe/v1/ruc?numero=' . $dni,
                        // CURLOPT_RETURNTRANSFER => true,
                        // CURLOPT_ENCODING => '',
                        // CURLOPT_MAXREDIRS => 10,
                        // CURLOPT_TIMEOUT => 0,
                        // CURLOPT_FOLLOWLOCATION => true,
                        // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        // CURLOPT_CUSTOMREQUEST => 'GET',
                        // CURLOPT_HTTPHEADER => array(
                        //     'Referer: http://apis.net.pe/api-ruc',
                        //     'Authorization: Bearer ' . $token
                        // ),
                        // ));
            
                        // $response = curl_exec($curl);
                        // return response()->json(['reniec' => $response]);
                        // // curl_close($curl);
                        // // // Datos de empresas según padron reducido
                        // // $empresa = json_decode($response);
                    // // var_dump($empresa);
                //FIN DE PRIMERA CONSULTA

                //SEGUNDA CONSULTA
                $dni = $request->buscando;
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://apiperu.dev/api/ruc/$dni?api_token=23f4b2195b6d582e496d1346157aa08bc61ff8b14a56a1ef32697913cfe465bc",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_SSL_VERIFYPEER => false
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                return response()->json(['reniec' => $response]);

                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    echo $response;
                }
                //FIN DE SEGUNDA CONSULTA
            }else{

                //PRIMERA CONSULTA
                    // $token = 'apis-token-3424.nv5xBhBhD89mPVhDig9lVAEPinVo1OU4';
                    // $dni = $request->buscando;

                    // // Iniciar llamada a API
                    // $curl = curl_init();

                    // // Buscar dni
                    // curl_setopt_array($curl, array(
                    // // CURLOPT_URL => 'https://dniruc.apisperu.com/api/v1/dni/'.$dni.'?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im1lZGljLmNlc2FyLmN0N0BnbWFpbC5jb20ifQ.0YU-1E5BnPDUcA0-ZCLdQiZ4Za5X_RJxq8085JiF03E',
                    // //api 2
                    // CURLOPT_URL => 'https://api.apis.net.pe/v1/dni?numero=' . $dni,
                    // CURLOPT_RETURNTRANSFER => true,
                    // CURLOPT_ENCODING => '',
                    // CURLOPT_MAXREDIRS => 2,
                    // CURLOPT_TIMEOUT => 0,
                    // CURLOPT_FOLLOWLOCATION => true,
                    // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    // CURLOPT_CUSTOMREQUEST => 'GET',
                    // CURLOPT_HTTPHEADER => array(
                    //     'Referer: https://apis.net.pe/consulta-dni-api',
                    //     'Authorization: Bearer ' . $token
                    // ),
                    // ));

                    // $response = curl_exec($curl);
                    // return response()->json(['reniec' => $response]);

                    // // curl_close($curl);
                    // // // Datos listos para usar
                    // // $persona = json_decode($response);
                    // // var_dump($persona);
                //Fin de PRIMERA CONSULTA
                $dni = $request->buscando;            
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://apiperu.dev/api/dni/$dni?api_token=23f4b2195b6d582e496d1346157aa08bc61ff8b14a56a1ef32697913cfe465bc",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_SSL_VERIFYPEER => false
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                return response()->json(['reniec' => $response]);
                
                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    echo $response;
                }
            }
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->hasFile('imagen')){
            $file = $request->file('imagen');
            $img_persona = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/personas/', $img_persona);
        }else{
            $img_persona = "NULL";
        }

        $persona = new Persona();
        $persona->name = $request->input('name');
        $persona->surnames = $request->input('surnames');
        $persona->slug = Str::slug($request->input('nro_identificacion'));
        $persona->imagen = $img_persona;
        $persona->nro_contacto = $request->input('nro_contacto');
        $persona->identificacion = $request->input('identificacion');
        $persona->nro_identificacion = $request->input('nro_identificacion');
        $persona->fecha_nacimiento = $request->input('fecha_nacimiento');
        $persona->sexo = $request->input('sexo');
        $persona->estado_civil = $request->input('estado_civil');
        $persona->direccion = $request->input('direccion');
        $persona->referencia = $request->input('referencia');
        $persona->tipo_persona = 'Paciente';
        $persona->registrado_por = Auth::user()->persona->name.' '.Auth::user()->persona->surnames.' - '.Auth::user()->role->name;
        $persona->sede_id = Auth::user()->persona->sede_id;
        $persona->save();

        $paciente = new Paciente();
        $paciente->persona_id = $persona->id;
        $paciente->ocupacion = $request->input('ocupacion');
        $paciente->responsable = $request->input('responsable');
        $paciente->historia_clinica = $request->input('historia_clinica');
        $paciente->estado = 'Activo';
        $paciente->save();

        // if ($request->input('credenciales')) {
        //     $usuario = new User();
        //     $usuario->email = $request->input('email');
        //     $usuario->password = Hash::make($request->input('password'));
        //     $usuario->role_id = '3';
        //     $usuario->estado = 'Activo';
        //     $usuario->paciente_id = $paciente->id;
        //     $usuario->save();
        // }

        return redirect()->route('admin-pacientes.index')->with('addregister', 'ok');
    }

    /**
     * Display the specified resource.
     */
    public function show(Persona $admin_paciente)
    {
        if(Auth::user()->role_id == '1' || Auth::user()->role_id == '2' || Auth::user()->role_id == '4' || Auth::user()->role_id == '6'){
            $paciente_list = Paciente::where('persona_id',$admin_paciente->id)->first();
            $atenciones_list = Atencion::where('paciente_id',$paciente_list->id)->get();
            $fecha_actual = Carbon::now()->format('Y-m-d');
            $antecede_patologicos = Antecedentepatologico::where('estado', 'Activo')->get();
            $recursos_terapeuticos = Recursoterapeutico::where('estado', 'Activo')->get();
            $habitos_nocivos = Habitonocivo::where('estado', 'Activo')->get();
            $edad = Carbon::parse($admin_paciente->fecha_nacimiento)->age;
            return view('ADMINISTRADOR.PRINCIPAL.pacientes.show', compact('admin_paciente','atenciones_list','fecha_actual','antecede_patologicos','recursos_terapeuticos','habitos_nocivos','edad'));
        }else{
            abort(403);
        };
    }

    public function getshowimagenologia(Request $request, Imagenologia $admin_imagenologia)
    {
        if(Auth::user()->role_id == '1' || Auth::user()->role_id == '2' || Auth::user()->role_id == '4' || Auth::user()->role_id == '6'){
            $fecha_actual = Carbon::now()->format('Y-m-d');
            return view('ADMINISTRADOR.PRINCIPAL.pacientes.show_imagenologia', compact('admin_imagenologia','fecha_actual'));
        }else{
            abort(403);
        };
    }
    
    public function getbusqueda_solicitud_imagenologia (Request $request){
        if($request->ajax()){
            $now = Carbon::now();
            $imageno = Imagenologia::orderBy('id','desc')->first();

            if(Imagenologia::where('id', $request->valor_imagenologia_id)->exists()){
                $valor_codigo_rx = Imagenologia::where('id', $request->valor_imagenologia_id)->first();

                $ArrayList[1] = [$valor_codigo_rx->nro_solicitud,'codigo_existente'];
                return response()->json($ArrayList);
            }else{
                if($imageno){
                    if($imageno->created_at->format('m') == $now->format('m')){
                        $nubRow =$imageno?$imageno->nro_solicitud+1:1;
                        //$nubRow ='2964';
                        $correlativo_prog = sprintf('%08d', trim($nubRow,'"'));
                        $codigo_imageno_slug = $correlativo_prog;
                    }else{
                        $nubRow =$imageno?1:1;
                        //$nubRow ='2964';
                        $correlativo_prog = sprintf('%08d', trim($nubRow,'"'));
                        $codigo_imageno_slug = $now->format('Y')[2].''.$now->format('Y')[3].''.$now->format('m').''.$correlativo_prog;
                    }
                }else{
                    $nubRow =$imageno?1:1;
                    //$nubRow ='2964';
                    $correlativo_prog = sprintf('%08d', trim($nubRow,'"'));
                    $codigo_imageno_slug = $now->format('Y')[2].''.$now->format('Y')[3].''.$now->format('m').''.$correlativo_prog;
                }
                
                    $ArrayList[1] = [$correlativo_prog];
                    return response()->json($ArrayList);

            }
        }
    }

    public function update_imagenologia(Request $request, Imagenologia $admin_imagenologia){

        $now = Carbon::now();
        if(Imagenologia::where('id',$admin_imagenologia->id)->exists()){

            // condicion para guardar el nombre de las imagenes opcionales
            $urlimagenes = [];
            if ($request->hasFile('images_opcional')){
                $imagenes = $request->file('images_opcional');
                foreach ($imagenes as $imagen) {
                    $nombre = time().'_'.$imagen->getClientOriginalName();
                    $imagen->move($_SERVER['DOCUMENT_ROOT'] .'/images/imagenologia-opcional/', $nombre);
                    $urlimagenes[]['url']='/images/imagenologia-opcional/'.$nombre;
                }
            }

            $admin_imagenologia->nro_solicitud = $request->input('nro_solicitud');
            $admin_imagenologia->slug = Str::slug('im'.$request->input('nro_solicitud'));
            $admin_imagenologia->fecha_imagenologia = $request->input('fecha');
            $admin_imagenologia->descripcion_imagenologia = $request->input('descripcion_imagenologia');
            $admin_imagenologia->paciente = $request->input('paciente');
            $admin_imagenologia->persona_id = Auth::user()->persona->id;
            $admin_imagenologia->responsable = Auth::user()->persona->name.' '.Auth::user()->persona->surnames;
            $admin_imagenologia->save();

            // guardar las imagenes opcionales
            
                $admin_imagenologia->images()->createMany($urlimagenes);
            
            return redirect()->back()->with('success', 'ok_imagenologia');

        }

    }

    public function getImagenologiaPdf(Request $request, Imagenologia $admin_imagenologia)
    {
        $pasc = Paciente::where('id', $admin_imagenologia->id_paciente)->first();
        $person = Persona::where('id', $pasc->persona_id)->first();
        $now = Carbon::now();
        if($person->fecha_nacimiento != null){
            $edad = Carbon::parse($person->fecha_nacimiento)->age;
        }else{
            $edad = '';
        }
        $pdf = PDF::loadView('ADMINISTRADOR.REPORTES.imagenologia.pdf_imagenologia', ['admin_imagenologia'=>$admin_imagenologia,  'now'=>$now, 'edad'=>$edad]);
        return $pdf->stream('IMAGENOLOGIA-'.$admin_imagenologia->nro_solicitud.'.pdf');

    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Persona $admin_paciente)
    {
        if(Auth::user()->role_id == '1' || Auth::user()->role_id == '2' || Auth::user()->role_id == '4' || Auth::user()->role_id == '6'){
            $identificaciones = Identificacion::all();
            $profesiones = Profesion::all();
            $roles = Role::all()->where('id', '2');
            return view('ADMINISTRADOR.PRINCIPAL.pacientes.edit', compact('identificaciones', 'profesiones', 'roles', 'admin_paciente'));
        }else{
            abort(403);
        };
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Persona $admin_paciente)
    {
        $admin_paciente['slug'] = Str::slug($request->input('nro_identificacion'));
        $admin_paciente->fill($request->except('imagen'));
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $imagen = time().$file->getClientOriginalName();
            if ($admin_paciente->imagen) {
                $file_path = public_path(). '/images/personas/'.$admin_paciente->imagen;
                File::delete($file_path);
                $admin_paciente->update([
                    $admin_paciente->imagen = $imagen,
                    $file->move(public_path().'/images/personas/', $imagen)
                ]);
            }else{
                $admin_paciente['imagen'] = $admin_paciente->imagen;
            }
        }
        $admin_paciente->save();

        $paciente = Paciente::where('persona_id',$admin_paciente->id)->first();
        $paciente->fill($request->except('persona_id', 'estado'));
        $paciente->save();

        // $user = User::where('persona_id', $admin_paciente->paciente->id)->first();
        // if ($user) {
        //     $user->fill($request->except('password', 'persona_id', 'estado'));
        //     if ($request->input('password')) {
        //         $user->password = Hash::make($request->password);
        //     }
        //     $user->save();
        // } else {
        //     if ($request->input('credenciales')) {
        //         $usuario = new User();
        //         $usuario->email = $request->input('email');
        //         $usuario->password = Hash::make($request->input('password'));
        //         $usuario->role_id = '2';
        //         $usuario->estado = 'Activo';
        //         $usuario->persona_id = $persona->id;
        //         $usuario->save();
        //     }
        // }

        return redirect()->route('admin-pacientes.index')->with('update', 'ok');
    }

    public function estado(Request $request, Persona $admin_paciente)
     {
        $paciente = paciente::where('persona_id', $admin_paciente->id)->first();
        // $user = User::where('persona_id', $paciente->id)->first();
         
        if($paciente->estado == 'Activo'){
            $paciente->estado = 'Inactivo';
            $paciente->save();

            // if ($user) {
            //     $user->estado = 'Inactivo';
            //     $user->save();
            // }
            
        }else{
            $paciente->estado = 'Activo';
            $paciente->save();

            // if ($user) {
            //     $user->estado = 'Activo';
            //     $user->save();
            // }
           
        }
        return redirect()->back()->with('update', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Persona $admin_paciente)
    {
        $pacientes_value = Paciente::where('persona_id',$admin_paciente->id)->first();
        if(Atencion::where('paciente_id',$pacientes_value->id)->exists()){
            return redirect()->route('admin-medicos.index')->with('error', 'ok');
        }else{
            $file_path = public_path(). '/images/personas/'.$admin_paciente->imagen; 
            File::delete($file_path);
            $admin_paciente->delete();
            return redirect()->route('admin-pacientes.index')->with('delete', 'ok');
        }
    }
}
