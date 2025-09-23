<?php

namespace App\Http\Controllers;

use App\Models\Atencion;
use App\Models\Identificacion;
use App\Models\Medico;
use App\Models\Persona;
use App\Models\Profesion;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class admin_MedicosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->role_id == '1'){
            $admin_medicos = Persona::where('tipo_persona', 'Médico')->get();
            return view('ADMINISTRADOR.PRINCIPAL.medicos.index', compact('admin_medicos'));
        }if(Auth::user()->role_id == '2' || Auth::user()->role_id == '4'){
            $admin_medicos = Persona::where('tipo_persona', 'Médico')->where('sede_id',Auth::user()->persona->sede_id)->get();
            return view('ADMINISTRADOR.PRINCIPAL.medicos.index', compact('admin_medicos'));
        }else{
            abort(403);
        };
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::user()->role_id == '1' || Auth::user()->role_id == '2' || Auth::user()->role_id == '4'){
            $identificaciones = Identificacion::all();
            $profesiones = Profesion::all();
            $roles = Role::all()->where('id', '!=', '3');
            return view('ADMINISTRADOR.PRINCIPAL.medicos.create', compact('identificaciones', 'profesiones', 'roles'));
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
        $persona->tipo_persona = 'Médico';
        $persona->registrado_por = Auth::user()->persona->name.' '.Auth::user()->persona->surnames.' - '.Auth::user()->role->name;
        $persona->sede_id = Auth::user()->persona->sede_id;
        $persona->save();

        $medico = new Medico();
        $medico->persona_id = $persona->id;
        $medico->profesion_id = $request->input('profesion_id');
        $medico->cmp = $request->input('cmp');
        $medico->estado = 'Activo';
        $medico->save();

        if ($request->input('credenciales')) {
            $usuario = new User();
            $usuario->email = $request->input('email');
            $usuario->password = Hash::make($request->input('password'));
            $usuario->role_id = $request->input('role_id');
            $usuario->estado = 'Activo';
            $usuario->persona_id = $persona->id;
            $usuario->save();
        }

        return redirect()->route('admin-medicos.index')->with('addregister', 'ok');
    }

    /**
     * Display the specified resource.
     */
    public function show(Persona $admin_medico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Persona $admin_medico)
    {
        if(Auth::user()->role_id == '1' || Auth::user()->role_id == '2'){
            $identificaciones = Identificacion::all();
            $profesiones = Profesion::all();
            $roles = Role::all()->where('id', '!=', '3');
            return view('ADMINISTRADOR.PRINCIPAL.medicos.edit', compact('identificaciones', 'profesiones', 'roles', 'admin_medico'));
        }else{
            abort(403);
        };
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Persona $admin_medico)
    {
        $admin_medico['slug'] = Str::slug($request->input('nro_identificacion'));
        $admin_medico->fill($request->except('imagen'));
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $imagen = time().$file->getClientOriginalName();
            if ($admin_medico->imagen) {
                $file_path = public_path(). '/images/personas/'.$admin_medico->imagen;
                File::delete($file_path);
                $admin_medico->update([
                    $admin_medico->imagen = $imagen,
                    $file->move(public_path().'/images/personas/', $imagen)
                ]);
            }else{
                $admin_medico['imagen'] = $admin_medico->imagen;
            }
        }
        $admin_medico->save();

        $medico = Medico::where('persona_id',$admin_medico->id)->first();
        $medico->fill($request->except('persona_id', 'estado'));
        $medico->save();

        $user = User::where('persona_id', $admin_medico->id)->first();
        if ($user) {
            $user->fill($request->except('password', 'medico_id', 'estado'));
            if ($request->input('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
        } else {
            if ($request->input('credenciales')) {
                $usuario = new User();
                $usuario->email = $request->input('email');
                $usuario->password = Hash::make($request->input('password'));
                $usuario->role_id = $request->input('role_id');
                $usuario->estado = 'Activo';
                $usuario->persona_id = $admin_medico->id;
                $usuario->save();
            }
        }

        return redirect()->route('admin-medicos.index')->with('update', 'ok');
    }

    public function estado(Request $request, Persona $admin_medico)
     {
        $medico = Medico::where('persona_id', $admin_medico->id)->first();
        $user = User::where('persona_id', $medico->persona_id)->first();
         
        if($medico->estado == 'Activo'){
            $medico->estado = 'Inactivo';
            $medico->save();

            if ($user) {
                $user->estado = 'Inactivo';
                $user->save();
            }
            
        }else{
            $medico->estado = 'Activo';
            $medico->save();

            if ($user) {
                $user->estado = 'Activo';
                $user->save();
            }
           
        }
        return redirect()->back()->with('update', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Persona $admin_medico)
    {
        $medicos_value = Medico::where('persona_id',$admin_medico->id)->first();
        if(Atencion::where('medico_id',$medicos_value->id)->exists()){
            return redirect()->route('admin-medicos.index')->with('error', 'ok');
        }else{
            $file_path = public_path(). '/images/personas/'.$admin_medico->imagen; 
            File::delete($file_path);
            $admin_medico->delete();
            return redirect()->route('admin-medicos.index')->with('delete', 'ok');
        }
    }
}
