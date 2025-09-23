<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCuentabancoRequest;
use App\Models\Banco;
use App\Models\Caja;
use App\Models\Cuentabancaria;
use App\Models\Sede;
Use App\Models\Tipocuenta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class admin_CuentabancariaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->role_id == '1'){
            $sedes = Sede::where('estado','Activo')->get();
            $bancos = Banco::all()->where('estado', 'Activo');
            $tipo_cuentas = Tipocuenta::all()->where('estado', 'Activo');
            $admin_cuentas_bancarias = Cuentabancaria::all();
            return view('ADMINISTRADOR.PRINCIPAL.configuraciones.cuentas-bancarias.index', compact('admin_cuentas_bancarias', 'bancos', 'tipo_cuentas'));
        }if(Auth::user()->role_id == '4'){
            $bancos = Banco::all()->where('estado', 'Activo');
            $tipo_cuentas = Tipocuenta::all()->where('estado', 'Activo');
            $admin_cuentas_bancarias = Cuentabancaria::where('sede_id', Auth::user()->persona->sede_id)->get();
            return view('ADMINISTRADOR.PRINCIPAL.configuraciones.cuentas-bancarias.index', compact('admin_cuentas_bancarias', 'bancos', 'tipo_cuentas'));
        }else{
            abort(403);
        };
    }

    public function filtrar_cuentas_bancarias_sede(Request $request, Sede $admin_cuentas_bancarias_sede)
    {
        if(Auth::user()->role_id == '4'){
            $now = Carbon::now();
            $sedes = Sede::where('estado','Activo')->get();
            $bancos = Banco::all()->where('estado', 'Activo');
            $tipo_cuentas = Tipocuenta::all()->where('estado', 'Activo');
            $name_sede = Sede::where('id', $admin_cuentas_bancarias_sede->id)->first();
            $admin_cuentas_bancarias = Cuentabancaria::all()->where('sede_id',$admin_cuentas_bancarias_sede->id);
            return view('ADMINISTRADOR.PRINCIPAL.configuraciones.cuentas-bancarias.index', compact('admin_cuentas_bancarias', 'bancos', 'tipo_cuentas', 'sedes', 'name_sede'));
        }else{
            abort(403);
        };
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCuentabancoRequest $request)
    {
        $cuentas = new Cuentabancaria();
        $cuentas->name = $request->input('name');
        $cuentas->slug = Str::slug($request->input('name').'-'.Auth::user()->persona->sede_id);
        $cuentas->nro_cuenta = $request->input('nro_cuenta');
        $cuentas->nro_cuenta_cci = $request->input('nro_cuenta_cci');
        $cuentas->estado = 'Activo';
        $cuentas->registrado_por = Auth::user()->persona->name.' '.Auth::user()->persona->lastname_padre.' - '.Auth::user()->role->name;
        $cuentas->sede_id = Auth::user()->persona->sede_id;
        $cuentas->tipocuenta_id = $request->input('tipocuenta_id');
        $cuentas->banco_id = $request->input('banco_id');
        $cuentas->apertura_cuenta = $request->input('apertura_cuenta');
        $cuentas->save();

        $caja = Caja::where('sede_id', Auth::user()->persona->sede_id)->first();
        $caja->total_cuenta_banco = $caja->total_cuenta_banco+$request->input('apertura_cuenta');
        $caja->total = $caja->total_efectivo+$caja->total_cuenta_banco;
        $caja->save();

        return redirect()->route('admin-cuentas-bancarias.index')->with('addcuenta', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function estado(Request $request, Cuentabancaria $admin_cuentas_bancaria)
     {
         // $categoria = Categoria::where('id',$id)->where('slug',$admin_categoria->slug)->first();
         if($admin_cuentas_bancaria->estado == 'Activo'){
             $admin_cuentas_bancaria->update([
                 'estado' => 'Inactivo',
             ]);
             $admin_cuentas_bancaria->save();
             return redirect()->back()->with('update', 'ok');
         }else{
             $admin_cuentas_bancaria->update([
                 'estado' => 'Activo',
             ]);
             $admin_cuentas_bancaria->save();
             return redirect()->back()->with('update', 'ok');
         }
     }

    public function update(StoreCuentabancoRequest $request, Cuentabancaria $admin_cuentas_bancaria)
    {
        
        $admin_cuentas_bancaria['slug'] = Str::slug($request->input('name'));
        $admin_cuentas_bancaria->fill($request->except('imagen', 'slug'));
        $admin_cuentas_bancaria->save();
        
        $suma_cuentas_bancarias=0;
        $admin_cta_bancaria = Cuentabancaria::where('sede_id', Auth::user()->persona->sede_id)->get();
        foreach($admin_cta_bancaria as $admin_cta_bancarias){
            $suma_cuentas_bancarias+=$admin_cta_bancarias->apertura_cuenta;
        }
        
        $caja = Caja::where('sede_id', Auth::user()->persona->sede_id)->first();
        $caja->total_cuenta_banco = $suma_cuentas_bancarias;
        $caja->total = $caja->total_efectivo+$caja->total_cuenta_banco;
        $caja->save();

        return redirect()->route('admin-cuentas-bancarias.index')->with('update', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuentabancaria $admin_cuentas_bancaria)
    {
        $admin_cuentas_bancaria->delete();
        
        $suma_cuentas_bancarias=0;
        $admin_cta_bancaria = Cuentabancaria::all();
        foreach($admin_cta_bancaria as $admin_cta_bancarias){
            $suma_cuentas_bancarias+=$admin_cta_bancarias->apertura_cuenta;
        }
        
        $caja = Caja::where('sede_id', Auth::user()->persona->sede_id)->first();
        $caja->total_cuenta_banco = $suma_cuentas_bancarias;
        $caja->total = $caja->total_efectivo+$caja->total_cuenta_banco;
        $caja->save();
        
        return redirect()->route('admin-cuentas-bancarias.index')->with('delete', 'ok');
    }
}
