<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromView;
use App\Exports\ReportMetlsXProvExport;
use App\Exports\ReportMetalsNoMetals;
use App\Exports\ReportMetlsXDniExport;
use App\Exports\ReportMetalsResumExport;
use App\Exports\ReportCategoryExport;
use App\Models\RegisterPatients;
use App\Models\RegisterAttentions;
use App\Models\RegisterAttentionsNoMetals;

use PDF;

class ReportsController extends Controller
{

    public function indexHeavyMetals() {
        return view('HeavyMetals/index');
    }

    public function listPatients(Request $request){
        $red = $request->red;
        $dist = $request->distrito;
        if($red == 'TODOS'){
            $nominal = RegisterPatients::where('region_register', 'PASCO') ->get();
        }else if($red != 'TODOS' && $dist == 'TODOS'){
            $nominal = RegisterPatients::where('province_register', $red) ->get();
        }else if($dist != 'TODOS'){
            $nominal = RegisterPatients::where('district_register', $dist) ->get();
        }

        return response()->json($nominal);
    }

    public function printListMetals(Request $request){
        $red = $request->r; $dist = $request->ds; $anio = $request->a; $type = $request->t;
        return Excel::download(new ReportMetlsXProvExport($red, $dist, $anio, $type), 'DEIT_PASCO RELACIÓN DE PACIENTES CON METALES PESADOS.xlsx');
    }

    public function printAllMetals(Request $request){
        $red = $request->r; $dist = $request->ds; $anio = $request->a; $type = $request->t;
        return Excel::download(new ReportMetalsNoMetals($red, $dist, $anio, $type), 'DEIT_PASCO RELACIÓN DE PACIENTES CON Y SIN METALES PESADOS.xlsx');
    }

    public function listAttentions(Request $request){
        $doc = $request->doc; $anio = $request->anio; $type = $request->type;
        if($type == 'METALES'){
            $nominal = RegisterAttentions::where('document', $doc) -> where('year_a', $anio)->orderBy('month_a', 'ASC') ->get();
        }else{
            $nominal = RegisterAttentionsNoMetals::where('document', $doc) -> where('year_a', $anio)->orderBy('month_a', 'ASC') ->get();
        }
        return response()->json($nominal);
    }

    public function listPatientsXDni(Request $request){
        $doc = $request->doc;
        $nominal = RegisterPatients::where('document', $doc) ->get();
        return response()->json($nominal);
    }

    public function printMetalsXDni(Request $request){
        $doc = $request->d; $anio = $request->a;
        return Excel::download(new ReportMetlsXDniExport($doc, $anio), 'DEIT_PASCO PACIENTE CON METALES PESADOS.xlsx');
    }

    public function listPatientsXCategory(Request $request){
        $cat = $request->category;
        $cat == 'TODOS' ? $nominal = RegisterPatients::all() : $nominal = RegisterPatients::where('category', $cat) ->get();
        return response()->json($nominal);
    }

    public function printMetalsXCategory(Request $request){
        $category = $request->c;
        return Excel::download(new ReportCategoryExport($category), 'DEIT_PASCO RELACIÓN DE PACIENTES CON METALES PESADOS POR CATEGORIA.xlsx');
    }

    public function listAtentionsInt(Request $request){
        $dep = $request->department1;
        $red = $request->red1;
        $dist = $request->distrito1;
        $anio = $request->anio1;

        if($dep == 'TODOS'){
            $nominal = RegisterPatients::select('RegisterAttentions.month_a', 'RegisterPatients.region_register', 'RegisterPatients.province_register', 'RegisterPatients.district_register',
                        (DB::raw('COUNT(RegisterAttentions.medicine_attention) AS MEDICINE, COUNT(RegisterAttentions.nursing_attention) AS NURSE,
                        COUNT(RegisterAttentions.obstetrics_attention) AS OBSTE, COUNT(RegisterAttentions.psychology_attention) AS PSYCOLOGY, COUNT(RegisterAttentions.cred_attention) AS CRED,
                        COUNT(RegisterAttentions.odontology_attention) AS ODONTOLOGY, COUNT(RegisterAttentions.telemedicine_attention) AS TELEMEDICINE, COUNT(RegisterAttentions.vaccine_attention) AS VACUNA')))
                        ->join('RegisterAttentions', 'RegisterAttentions.document', '=', 'RegisterPatients.document')
                        ->where('RegisterAttentions.year_a', $anio)
                        ->groupBy('RegisterAttentions.month_a') ->groupBy('RegisterPatients.region_register')
                        ->groupBy('RegisterPatients.province_register') ->groupBy('RegisterPatients.district_register')
                        ->get();
        }
        else if($dep != 'TODOS' && $red == 'TODOS'){
            $nominal = RegisterPatients::select('RegisterAttentions.month_a', 'RegisterPatients.region_register', 'RegisterPatients.province_register', 'RegisterPatients.district_register',
                        (DB::raw('COUNT(RegisterAttentions.medicine_attention) AS MEDICINE, COUNT(RegisterAttentions.nursing_attention) AS NURSE,
                        COUNT(RegisterAttentions.obstetrics_attention) AS OBSTE, COUNT(RegisterAttentions.psychology_attention) AS PSYCOLOGY, COUNT(RegisterAttentions.cred_attention) AS CRED,
                        COUNT(RegisterAttentions.odontology_attention) AS ODONTOLOGY, COUNT(RegisterAttentions.telemedicine_attention)  AS TELEMEDICINE, COUNT(RegisterAttentions.vaccine_attention) AS VACUNA')))
                        ->join('RegisterAttentions', 'RegisterAttentions.document', '=', 'RegisterPatients.document')
                        ->where('RegisterPatients.region_register', $dep) ->where('RegisterAttentions.year_a', $anio)
                        ->groupBy('RegisterAttentions.month_a') ->groupBy('RegisterPatients.region_register')
                        ->groupBy('RegisterPatients.province_register') ->groupBy('RegisterPatients.district_register')
                        ->get();
        }
        else if($red != 'TODOS' && $dist == 'TODOS'){
            $nominal = RegisterPatients::select('RegisterAttentions.month_a', 'RegisterPatients.region_register', 'RegisterPatients.province_register', 'RegisterPatients.district_register',
                        (DB::raw('COUNT(RegisterAttentions.medicine_attention) AS MEDICINE, COUNT(RegisterAttentions.nursing_attention) AS NURSE,
                        COUNT(RegisterAttentions.obstetrics_attention) AS OBSTE, COUNT(RegisterAttentions.psychology_attention) AS PSYCOLOGY, COUNT(RegisterAttentions.cred_attention) AS CRED,
                        COUNT(RegisterAttentions.odontology_attention) AS ODONTOLOGY, COUNT(RegisterAttentions.telemedicine_attention)  AS TELEMEDICINE, COUNT(RegisterAttentions.vaccine_attention) AS VACUNA')))
                        ->join('RegisterAttentions', 'RegisterAttentions.document', '=', 'RegisterPatients.document')
                        ->where('RegisterPatients.province_register', $red) ->where('RegisterAttentions.year_a', $anio)
                        ->groupBy('RegisterAttentions.month_a') ->groupBy('RegisterPatients.region_register')
                        ->groupBy('RegisterPatients.province_register') ->groupBy('RegisterPatients.district_register')
                        ->get();
        }
        else if($dist != 'TODOS'){
            $nominal = RegisterPatients::select('RegisterAttentions.month_a', 'RegisterPatients.region_register', 'RegisterPatients.province_register', 'RegisterPatients.district_register',
                        (DB::raw('COUNT(RegisterAttentions.medicine_attention) AS MEDICINE, COUNT(RegisterAttentions.nursing_attention) AS NURSE,
                        COUNT(RegisterAttentions.obstetrics_attention) AS OBSTE, COUNT(RegisterAttentions.psychology_attention) AS PSYCOLOGY, COUNT(RegisterAttentions.cred_attention) AS CRED,
                        COUNT(RegisterAttentions.odontology_attention) AS ODONTOLOGY, COUNT(RegisterAttentions.telemedicine_attention)  AS TELEMEDICINE, COUNT(RegisterAttentions.vaccine_attention) AS VACUNA')))
                        ->join('RegisterAttentions', 'RegisterAttentions.document', '=', 'RegisterPatients.document')
                        ->where('RegisterPatients.district_register', $dist) ->where('RegisterAttentions.year_a', $anio)
                        ->groupBy('RegisterAttentions.month_a') ->groupBy('RegisterPatients.region_register')
                        ->groupBy('RegisterPatients.province_register') ->groupBy('RegisterPatients.district_register')
                        ->get();
        }

        return response()->json($nominal);
    }

    public function printAtentionsInt(Request $request){
        $dep = $request->d; $red = $request->r; $dist = $request->ds;
        if($dep == 'TODOS'){
            $nominal = RegisterPatients::select('RegisterAttentions.month_a', 'RegisterPatients.region_register', 'RegisterPatients.province_register', 'RegisterPatients.district_register',
                        (DB::raw('COUNT(RegisterAttentions.medicine_attention) AS MEDICINE, COUNT(RegisterAttentions.nursing_attention) AS NURSE,
                        COUNT(RegisterAttentions.obstetrics_attention) AS OBSTE, COUNT(RegisterAttentions.psychology_attention) AS PSYCOLOGY, COUNT(RegisterAttentions.cred_attention) AS CRED,
                        COUNT(RegisterAttentions.odontology_attention) AS ODONTOLOGY, COUNT(RegisterAttentions.telemedicine_attention)  AS TELEMEDICINE, COUNT(RegisterAttentions.vaccine_attention) AS VACUNA')))
                        ->join('RegisterAttentions', 'RegisterAttentions.document', '=', 'RegisterPatients.document')
                        ->groupBy('RegisterAttentions.month_a') ->groupBy('RegisterPatients.region_register')
                        ->groupBy('RegisterPatients.province_register') ->groupBy('RegisterPatients.district_register')
                        ->get();
        }
        else if($dep != 'TODOS' && $red == 'TODOS'){
            $nominal = RegisterPatients::select('RegisterAttentions.month_a', 'RegisterPatients.region_register', 'RegisterPatients.province_register', 'RegisterPatients.district_register',
                        (DB::raw('COUNT(RegisterAttentions.medicine_attention) AS MEDICINE, COUNT(RegisterAttentions.nursing_attention) AS NURSE,
                        COUNT(RegisterAttentions.obstetrics_attention) AS OBSTE, COUNT(RegisterAttentions.psychology_attention) AS PSYCOLOGY, COUNT(RegisterAttentions.cred_attention) AS CRED,
                        COUNT(RegisterAttentions.odontology_attention) AS ODONTOLOGY, COUNT(RegisterAttentions.telemedicine_attention)  AS TELEMEDICINE, COUNT(RegisterAttentions.vaccine_attention) AS VACUNA')))
                        ->join('RegisterAttentions', 'RegisterAttentions.document', '=', 'RegisterPatients.document')
                        ->where('RegisterPatients.region_register', $dep)
                        ->groupBy('RegisterAttentions.month_a') ->groupBy('RegisterPatients.region_register')
                        ->groupBy('RegisterPatients.province_register') ->groupBy('RegisterPatients.district_register')
                        ->get();
        }
        else if($red != 'TODOS' && $dist == 'TODOS'){
            $nominal = RegisterPatients::select('RegisterAttentions.month_a', 'RegisterPatients.region_register', 'RegisterPatients.province_register', 'RegisterPatients.district_register',
                        (DB::raw('COUNT(RegisterAttentions.medicine_attention) AS MEDICINE, COUNT(RegisterAttentions.nursing_attention) AS NURSE,
                        COUNT(RegisterAttentions.obstetrics_attention) AS OBSTE, COUNT(RegisterAttentions.psychology_attention) AS PSYCOLOGY, COUNT(RegisterAttentions.cred_attention) AS CRED,
                        COUNT(RegisterAttentions.odontology_attention) AS ODONTOLOGY, COUNT(RegisterAttentions.telemedicine_attention)  AS TELEMEDICINE, COUNT(RegisterAttentions.vaccine_attention) AS VACUNA')))
                        ->join('RegisterAttentions', 'RegisterAttentions.document', '=', 'RegisterPatients.document')
                        ->where('RegisterPatients.province_register', $red)
                        ->groupBy('RegisterAttentions.month_a') ->groupBy('RegisterPatients.region_register')
                        ->groupBy('RegisterPatients.province_register') ->groupBy('RegisterPatients.district_register')
                        ->get();
        }
        else if($dist != 'TODOS'){
            $nominal = RegisterPatients::select('RegisterAttentions.month_a', 'RegisterPatients.region_register', 'RegisterPatients.province_register', 'RegisterPatients.district_register',
                        (DB::raw('COUNT(RegisterAttentions.medicine_attention) AS MEDICINE, COUNT(RegisterAttentions.nursing_attention) AS NURSE,
                        COUNT(RegisterAttentions.obstetrics_attention) AS OBSTE, COUNT(RegisterAttentions.psychology_attention) AS PSYCOLOGY, COUNT(RegisterAttentions.cred_attention) AS CRED,
                        COUNT(RegisterAttentions.odontology_attention) AS ODONTOLOGY, COUNT(RegisterAttentions.telemedicine_attention)  AS TELEMEDICINE, COUNT(RegisterAttentions.vaccine_attention) AS VACUNA')))
                        ->join('RegisterAttentions', 'RegisterAttentions.document', '=', 'RegisterPatients.document')
                        ->where('RegisterPatients.district_register', $dist)
                        ->groupBy('RegisterAttentions.month_a') ->groupBy('RegisterPatients.region_register')
                        ->groupBy('RegisterPatients.province_register') ->groupBy('RegisterPatients.district_register')
                        ->get();
        }

        return Excel::download(new ReportMetalsResumExport($nominal, $request->a), 'DEIT_PASCO ATENCION INTEGRAL - METALES PESADOS.xlsx');
    }
}