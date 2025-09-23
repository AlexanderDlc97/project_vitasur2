<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use App\Models\Profesion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class admin_ProfesionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->role_id == '1'){
            $admin_profesiones = Profesion::all();
            return view('ADMINISTRADOR.PRINCIPAL.configuraciones.profesiones.index', compact('admin_profesiones'));
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
            if(Profesion::where('name', $request->input('name'))->exists()){
                return redirect()->route('admin-profesiones.index')->with('exists', 'ok');
            }else{
                $profesion = new Profesion();
                $profesion->name = $request->input('name');
                $profesion->slug = Str::slug($request->input('name'));
                $profesion->estado = 'Activo';
                $profesion->save();
                return redirect()->route('admin-profesiones.index')->with('addregister', 'ok');
            }
        }else{
            abort(403);
        };
    }

    /**
     * Display the specified resource.
     */
    public function show(Profesion $admin_profesione)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profesion $admin_profesione)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profesion $admin_profesione)
    {
        if ($request->input('name') == $admin_profesione->name) {
            $admin_profesione->fill($request->all());
            $admin_profesione->save();
            return redirect()->route('admin-profesiones.index')->with('update', 'ok');
        }else{
            if(Profesion::where('name', $request->input('name'))->exists()){
                return redirect()->route('admin-profesiones.index')->with('exists', 'ok');
            }else{
                $admin_profesione['name'] = $request->input('name');
                $admin_profesione['slug'] = Str::slug($request->input('name'));
                $admin_profesione->fill($request->all());
                $admin_profesione->save();
                return redirect()->route('admin-profesiones.index')->with('update', 'ok');
            }
        }
    }

    public function estado(Request $request, Profesion $admin_profesione)
     {         
        if($admin_profesione->estado == 'Activo'){
            $admin_profesione->estado = 'Inactivo';
            $admin_profesione->save();
        }else{
            $admin_profesione->estado = 'Activo';
            $admin_profesione->save();
        }
        return redirect()->back()->with('update', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profesion $admin_profesione)
    {
        if(Medico::where('profesion_id',$admin_profesione->id)->exists()){
            return redirect()->route('admin-profesiones.index')->with('error', 'ok');
        }else{
            $admin_profesione->delete();
            return redirect()->route('admin-profesiones.index')->with('delete', 'ok');
        }
    }
}
