<?php

namespace App\Http\Controllers;

use App\Imports\AsociadosImport;
use App\Models\Asociado;
use Illuminate\Http\Request;
use App\Exports\AsociadosExport;
use Maatwebsite\Excel\Facades\Excel;

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

    public function asociado($asociado)
    {
        return Asociado::find($asociado);
    }

    public function entregar(Request $request, $asociado)
    {
        $asociado = Asociado::find($asociado);
        $asociado->fecha_entrega = \Carbon\Carbon::now();
        $asociado->observaciones = $request->observaciones;
        $asociado->save();
    }

    public function destroy($user)
    {
        Asociado::find($user)->delete();
    }

    public function export()
    {
        return Excel::download(new AsociadosExport, 'users.xlsx');
    }

    public function import(Request $request)
    {
        Excel::import(new AsociadosImport, request()->file('file'));
    }
}
