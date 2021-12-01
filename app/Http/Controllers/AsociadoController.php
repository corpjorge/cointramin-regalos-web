<?php

namespace App\Http\Controllers;

use App\Models\Asociado;
use Illuminate\Http\Request;

class AsociadoController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function buscar(Request $request)
    {
        return Asociado::where('cedula', $request->cedula)->get();
    }

    public function asociado(Asociado $asociado)
    {
        return $asociado;
    }

    public function entregar(Asociado $asociado, Request $request)
    {
        $asociado->fecha_entrega = \Carbon\Carbon::now();
        $asociado->observaciones = $request->observaciones;
        $asociado->save();
    }
}
