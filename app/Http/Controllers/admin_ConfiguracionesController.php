<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class admin_ConfiguracionesController extends Controller
{
    public function index()
    {
        if(Auth::user()->role_id != '2'){
            return view('ADMINISTRADOR.PRINCIPAL.configuraciones.index');
        }else{
            abort(403);
        };
    }
}
