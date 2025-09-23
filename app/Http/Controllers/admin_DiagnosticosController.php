<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Diagnostico;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class admin_DiagnosticosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->role_id == '1'){
            $admin_diagnosticos = Category::all();
            return view('ADMINISTRADOR.PRINCIPAL.configuraciones.diagnosticos.index', compact('admin_diagnosticos'));
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
        $admin_diag = new Category();
        $admin_diag->codigo = $request->input('codigo_p');
        $admin_diag->slug = Str::slug($request->input('codigo_p'));
        $admin_diag->name = $request->input('diag_p');
        $admin_diag->estado = 'Activo';
        $admin_diag->save();
        
        $contadores = $request->input('contadores');
        
        if(isset($contadores)){
            foreach ($contadores as $key => $name) {
                $admin_diag_s = new Diagnostico();
                $admin_diag_s->codigo = $request->input('valor_codigo_s')[$key];
                $admin_diag_s->slug = Str::slug($request->input('valor_codigo_s')[$key]);
                $admin_diag_s->name = $request->input('valor_diag_s')[$key];
                $admin_diag_s->category_id = $admin_diag->id;
                $admin_diag_s->estado = 'Activo';
                $admin_diag_s->save();
            }
        }
        
        return redirect()->route('admin-diagnosticos.index')->with('adddiagnos', 'ok');
    }

    /**
     * Display the specified resource.
     */
    public function show(Diagnostico $admin_diagnostico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Diagnostico $admin_diagnostico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Diagnostico $admin_diagnostico)
    {
        //
    }

    public function estado(Request $request, Category $admin_diagnostico)
     {         
        if($admin_diagnostico->estado == 'Activo'){
            $admin_diagnostico->estado = 'Inactivo';
            $admin_diagnostico->save();
        }else{
            $admin_diagnostico->estado = 'Activo';
            $admin_diagnostico->save();
        }
        return redirect()->back()->with('update', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Diagnostico $admin_diagnostico)
    {
        //
    }
}
