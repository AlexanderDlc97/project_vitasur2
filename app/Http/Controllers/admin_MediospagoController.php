<?php

namespace App\Http\Controllers;

use App\Models\Mediopago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class admin_MediospagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // if(Gate::allows('gerencia',Auth()->user()) || Gate::allows('administracion',Auth()->user()) || Gate::allows('secretaria',Auth()->user()) || Gate::allows('farmaceutico',Auth()->user())){
        if(Auth::user()->role_id == '1' || Auth::user()->role_id == '4'){
            $admin_medios_pagos = Mediopago::all();
            return view('ADMINISTRADOR.PRINCIPAL.configuraciones.medios-pagos.index', compact('admin_medios_pagos'));
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
