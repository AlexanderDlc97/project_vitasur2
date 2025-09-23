<?php

namespace App\Http\Controllers;

use App\Models\Atencion;
use App\Models\Especialidad;
use App\Models\Profesion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class admin_especialidadesController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->role_id == '1'){
            $admin_especialidades = Especialidad::all();
            $admin_profesione = Profesion::where('estado','Activo')->get();
            return view('ADMINISTRADOR.PRINCIPAL.configuraciones.especialidades.index', compact('admin_especialidades','admin_profesione'));
        }else{
            abort(403);
        };
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
        if(Auth::user()->role_id == '1'){
            if(Especialidad::where('name', $request->input('name'))->exists()){
                return redirect()->route('admin-especialidades.index')->with('exists', 'ok');
            }else{
                $especialidad = new Especialidad();
                $especialidad->name = $request->input('name');
                $especialidad->slug = Str::slug($request->input('name'));
                $especialidad->costo = $request->input('costo');
                $especialidad->estado = 'Activo';
                $especialidad->profesione_id = $request->input('profesione_id');
                $especialidad->save();
                return redirect()->route('admin-especialidades.index')->with('addregister', 'ok');
            }
        }else{
            abort(403);
        };
    }

    /**
     * Display the specified resource.
     */
    public function show(Especialidad $admin_especialidade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Especialidad $admin_especialidade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Especialidad $admin_especialidade)
    {
        if ($request->input('name') == $admin_especialidade->name) {
            $admin_especialidade->fill($request->all());
            $admin_especialidade->save();
            return redirect()->route('admin-especialidades.index')->with('update', 'ok');
        }else{
            if(Especialidad::where('name', $request->input('name'))->exists()){
                return redirect()->route('admin-especialidades.index')->with('exists', 'ok');
            }else{
                $admin_especialidade['name'] = $request->input('name');
                $admin_especialidade['slug'] = Str::slug($request->input('name'));
                $admin_especialidade->fill($request->all());
                $admin_especialidade->save();
                return redirect()->route('admin-especialidades.index')->with('update', 'ok');
            }
        }
    }

    public function estado(Request $request, Especialidad $admin_especialidade)
     {         
        if($admin_especialidade->estado == 'Activo'){
            $admin_especialidade->estado = 'Inactivo';
            $admin_especialidade->save();
        }else{
            $admin_especialidade->estado = 'Activo';
            $admin_especialidade->save();
        }
        return redirect()->back()->with('update', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Especialidad $admin_especialidade)
    {
        if(Atencion::where('especialidad_id',$admin_especialidade->id)->exists()){
            return redirect()->route('admin-especialidades.index')->with('error', 'ok');
        }else{
            $admin_especialidade->delete();
            return redirect()->route('admin-especialidades.index')->with('delete', 'ok');
        }
    }
}
