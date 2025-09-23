<?php

namespace App\Http\Controllers;

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

class admin_PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin_perfil = Persona::where('id', Auth::user()->persona_id)->first();
        return view('ADMINISTRADOR.PRINCIPAL.configuraciones.perfil.index', compact('admin_perfil'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Persona $admin_perfil)
    {
        $identificaciones = Identificacion::all();
        $profesiones = Profesion::all();
        $roles = Role::all()->where('id', '!=', '3');
        return view('ADMINISTRADOR.PRINCIPAL.configuraciones.perfil.edit', compact('identificaciones', 'profesiones', 'roles', 'admin_perfil'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Persona $admin_perfil)
    {
        $admin_perfil['slug'] = Str::slug($request->input('nro_identificacion'));
        $admin_perfil->fill($request->except('imagen','password'));
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $imagen = time().$file->getClientOriginalName();
            if ($admin_perfil->imagen) {
                $file_path = public_path(). '/images/personas/'.$admin_perfil->imagen;
                File::delete($file_path);
                $admin_perfil->update([
                    $admin_perfil->imagen = $imagen,
                    $file->move(public_path().'/images/personas/', $imagen)
                ]);
            }else{
                $admin_perfil['imagen'] = $admin_perfil->imagen;
            }
        }
        $admin_perfil->save();

        if(Auth::user()->role_id == '2'){
            $medico = Medico::where('persona_id',$admin_perfil->id)->first();
            $medico->fill($request->except('persona_id', 'estado'));
            $medico->save();
        }

        $user = User::where('persona_id', $admin_perfil->id)->first();
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
                $usuario->save();
            }
        }

        if(Auth::user()->role_id == '2'){
            return redirect()->route('admin-pacientes.index')->with('perfiles', 'ok');
        }else{
            return redirect()->route('admin-perfil.index')->with('update', 'ok');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
