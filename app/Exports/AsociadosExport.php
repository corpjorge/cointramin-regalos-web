<?php

namespace App\Exports;

use App\Models\Asociado;
use Maatwebsite\Excel\Concerns\FromCollection;

class AsociadosExport implements FromCollection
{
    public function collection()
    {
        return Asociado::all('cedula', 'nombre', 'oficina', 'tipo', 'fecha_entrega', 'observaciones');
    }
}
