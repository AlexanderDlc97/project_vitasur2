<?php

namespace App\Http\Controllers;

use App\Models\Procedimientoclinico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class admin_ProcedimientosclinicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->role_id == '1'){
            $admin_procedimientosclinicos = Procedimientoclinico::all();
            return view('ADMINISTRADOR.PRINCIPAL.configuraciones.procedimientos-clinicos.index', compact('admin_procedimientosclinicos'));
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
            if(Procedimientoclinico::where('name', $request->input('name'))->exists()){
                return redirect()->route('admin-procedimientosclinicos.index')->with('exists', 'ok');
            }else{
                $especialidad = new Procedimientoclinico();
                $especialidad->name = $request->input('name');
                $especialidad->slug = Str::slug($request->input('name'));
                $especialidad->tipo = $request->input('tipo');
                $especialidad->costo = $request->input('costo');
                $especialidad->estado = 'Activo';
                $especialidad->save();
                return redirect()->route('admin-procedimientosclinicos.index')->with('addregister', 'ok');
            }
        }else{
            abort(403);
        };
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
    public function update(Request $request, Procedimientoclinico $admin_procedimientosclinico)
    {
        if ($request->input('name') == $admin_procedimientosclinico->name) {
            $admin_procedimientosclinico->fill($request->all());
            $admin_procedimientosclinico->save();
            return redirect()->route('admin-procedimientosclinicos.index')->with('update', 'ok');
        }else{
            if(Procedimientoclinico::where('name', $request->input('name'))->exists()){
                return redirect()->route('admin-procedimientosclinicos.index')->with('exists', 'ok');
            }else{
                $admin_procedimientosclinico['name'] = $request->input('name');
                $admin_procedimientosclinico['slug'] = Str::slug($request->input('name'));
                $admin_procedimientosclinico->fill($request->all());
                $admin_procedimientosclinico->save();
                return redirect()->route('admin-procedimientosclinicos.index')->with('update', 'ok');
            }
        }
    }

    public function estado(Request $request, Procedimientoclinico $admin_procedimientosclinico)
     {         
        if($admin_procedimientosclinico->estado == 'Activo'){
            $admin_procedimientosclinico->estado = 'Inactivo';
            $admin_procedimientosclinico->save();
        }else{
            $admin_procedimientosclinico->estado = 'Activo';
            $admin_procedimientosclinico->save();
        }
        return redirect()->back()->with('update', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Procedimientoclinico $admin_procedimientosclinico)
    {
        $admin_procedimientosclinico->delete();
        return redirect()->route('admin-procedimientosclinicos.index')->with('delete', 'ok');
    }
}
