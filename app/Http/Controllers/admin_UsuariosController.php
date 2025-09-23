<?php

namespace App\Http\Controllers;

use App\Models\Identificacion;
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

class admin_UsuariosController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->role_id == '1'){
            $admin_usuarios = User::where('id', '!=', 1)->get();
            return view('ADMINISTRADOR.PRINCIPAL.configuraciones.usuarios.index', compact('admin_usuarios'));
        }else{
            abort(403);
        };
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::user()->role_id == '1'){
            $identificaciones = Identificacion::all();
            $profesiones = Profesion::all();
            $roles = Role::all();
            return view('ADMINISTRADOR.PRINCIPAL.configuraciones.usuarios.create', compact('identificaciones', 'profesiones', 'roles'));
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
        $persona->tipo_persona = 'Empleado';
        $persona->registrado_por = Auth::user()->persona->name.' '.Auth::user()->persona->surnames.' - '.Auth::user()->role->name;
        $persona->sede_id = Auth::user()->persona->sede_id;
        $persona->save();

        if ($request->input('credenciales')) {
            $usuario = new User();
            $usuario->email = $request->input('email');
            $usuario->password = Hash::make($request->input('password'));
            $usuario->role_id = $request->input('cargo_id');
            $usuario->estado = 'Activo';
            $usuario->persona_id = $persona->id;
            $usuario->save();
        }

        return redirect()->route('admin-usuarios.index')->with('addregister', 'ok');
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
    public function edit(Persona $admin_usuario)
    {
        if(Auth::user()->role_id == '1'){
            $admin_usuarioss = User::where('persona_id',$admin_usuario->id)->first();
            $identificaciones = Identificacion::all();
            $profesiones = Profesion::all();
            $roles = Role::all();
    
            return view('ADMINISTRADOR.PRINCIPAL.configuraciones.usuarios.edit', compact('identificaciones', 'profesiones', 'roles', 'admin_usuarioss'));
        }else{
            abort(403);
        };
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Persona $admin_usuario)
    {
        $admin_usuario['slug'] = Str::slug($request->input('nro_identificacion'));
        $admin_usuario->fill($request->except('imagen'));
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $imagen = time().$file->getClientOriginalName();
            if ($admin_usuario->imagen) {
                $file_path = public_path(). '/images/personas/'.$admin_usuario->imagen;
                File::delete($file_path);
                $admin_usuario->update([
                    $admin_usuario->imagen = $imagen,
                    $file->move(public_path().'/images/personas/', $imagen)
                ]);
            }else{
                $admin_usuario['imagen'] = $admin_usuario->imagen;
            }
        }
        $admin_usuario->save();


        $user = User::where('persona_id', $admin_usuario->id)->first();
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
                $usuario->role_id = $request->input('cargo_id');
                $usuario->estado = 'Activo';
                $usuario->persona_id = $admin_usuario->id;
                $usuario->save();
            }
        }

        return redirect()->route('admin-usuarios.index')->with('update', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function estado(Request $request, Persona $admin_usuario)
     {
        $user = User::where('persona_id', $admin_usuario->id)->first();
         
        if($user->estado == 'Activo'){
            $user->estado = 'Inactivo';
            $user->save();

        }else{
            $user->estado = 'Activo';
            $user->save();
           
        }
        return redirect()->back()->with('update', 'ok');
    }

    public function destroy(Persona $admin_usuario)
    {
        $file_path = public_path(). '/images/personas/'.$admin_usuario->imagen; 
        File::delete($file_path);
        $admin_usuario->delete();
        return redirect()->route('admin-usuarios.index')->with('delete', 'ok');
    }
}
