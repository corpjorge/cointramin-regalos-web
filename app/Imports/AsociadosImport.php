<?php

namespace App\Imports;

use App\Models\Asociado;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class AsociadosImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return Asociado|null
     */
    public function model(array $row)
    {
        return new Asociado([
            'cedula' => $row[0],
            'nombre' => $row[1],
            'oficina'=> $row[2],
            'tipo'   => $row[3]
        ]);
    }
}
