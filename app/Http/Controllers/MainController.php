<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Echo_;

class MainController extends Controller
{
    public function department() {
        $dep = DB::connection('BDHIS_MINSA')->table('MAESTRO_HIS_ESTABLECIMIENTO')
                    ->select('Departamento')
                    ->groupBy('Departamento')
                    ->orderBy('Departamento', 'ASC')
                    ->get();

        return response()->json($dep, 200);
    }

    public function province(Request $request) {
        $prov = $request->id;
        $provinces_all = DB::connection('BDHIS_MINSA')->table('MAESTRO_HIS_ESTABLECIMIENTO')
                    ->select('Departamento', 'Provincia') ->where('Departamento', $prov)
                    ->groupBy('Departamento') ->groupBy('Provincia')
                    ->orderBy('Departamento', 'ASC') ->orderBy('Provincia', 'ASC')
                    ->get();

        return response()->json($provinces_all, 200);
    }

    public function district(Request $request) {
        $dist = $request->id;
        $distritcs_all = DB::connection('BDHIS_MINSA')->table('MAESTRO_HIS_ESTABLECIMIENTO')
                    ->select('Departamento', 'Provincia', 'Distrito') ->where('Provincia', $dist)
                    ->groupBy('Departamento') ->groupBy('Provincia') ->groupBy('Distrito')
                    ->orderBy('Departamento', 'ASC') ->orderBy('Provincia', 'ASC') ->orderBy('Distrito', 'ASC')
                    ->get();

        return response()->json($distritcs_all, 200);
    }

    public function stablishment(Request $request) {
        $id = $request->id;
        $estab = DB::connection('BDHIS_MINSA')->table('MAESTRO_HIS_ESTABLECIMIENTO')
                    ->select('Nombre_Establecimiento') ->where('Distrito', $id)
                    ->orderBy('Nombre_Establecimiento', 'ASC')
                    ->get();

        return response()->json($estab, 200);
    }

    public function stablishmentXSector(Request $request) {
        $id = $request->id;
        $estabXSector = DB::connection('BDHIS_MINSA')->table('MAESTRO_HIS_ESTABLECIMIENTO')
                    ->select('Nombre_Establecimiento') ->where('Descripcion_Sector', '=', $id)
                    ->groupBy('Nombre_Establecimiento') ->orderBy('Nombre_Establecimiento', 'ASC')
                    ->get();

        return response()->json($estabXSector, 200);
    }

    public function stablishmentAll() {
        $estab = DB::connection('BDHIS_MINSA')->table('MAESTRO_HIS_ESTABLECIMIENTO')
                    ->select('Id_Establecimiento', 'Nombre_Establecimiento')
                    ->where('Descripcion_Sector', '=', 'GOBIERNO REGIONAL')
                    ->groupBy('Id_Establecimiento') ->groupBy('Nombre_Establecimiento')
                    ->orderBy('Id_Establecimiento', 'ASC')
                    ->get();

        return response()->json($estab, 200);
    }
}