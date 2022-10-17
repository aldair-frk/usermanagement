<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromView;
use App\Exports\ReportMetlsXProvExport;
use App\Exports\ReportMetlsXDniExport;
use App\Exports\HomologationExport;
use App\Exports\ReportMetalsResumExport;
use App\Models\RegisterPatients;
use App\Models\RegisterAttentions;
use App\Models\RegisterAttentionsNoMetals;
use App\Exports\ReportCategoryExport;

use PDF;

class TracingController extends Controller
{
    public function index() {
        return view('index');
    }

    public function indexHeavyMetals() {
        return view('HeavyMetals/index');
    }

    public function listHeavyMetals(Request $request){
        $dep = $request->department;
        $red = $request->red;
        $dist = $request->distrito;
        if($dep == 'TODOS'){
            $nominal = RegisterPatients::all();
        }else if($dep != 'TODOS' && $red == 'TODOS'){
            $nominal = RegisterPatients::where('region_current', $dep) ->get();
        }else if($red != 'TODOS' && $dist == 'TODOS'){
            $nominal = RegisterPatients::where('province_current', $red) ->get();
        }else if($dist != 'TODOS'){
            $nominal = RegisterPatients::where('district_current', $dist) ->get();
        }

        return response()->json($nominal);
    }

    public function listAttentionUser(Request $request){
        $doc = $request->doc; $anio = $request->anio; $type = $request->type;
        if($type == 'METALES'){
            $nominal = RegisterAttentions::where('document', $doc) -> where('year_a', $anio)->orderBy('month_a', 'ASC') ->get();
        }else{
            $nominal = RegisterAttentionsNoMetals::where('document', $doc) -> where('year_a', $anio)->orderBy('month_a', 'ASC') ->get();
        }
        return response()->json($nominal);
    }

    public function listHeavyMetalsDni(Request $request){
        $doc = $request->doc;
        $nominal = RegisterPatients::where('document', $doc) ->get();

        return response()->json($nominal);
    }

    public function listHeavyMetalsCategory(Request $request){
        $cat = $request->category;

        if($cat == 'TODOS'){
            $nominal = RegisterPatients::all();
        }else{
            $nominal = RegisterPatients::where('category', $cat) ->get();
        }

        return response()->json($nominal);
    }

    public function listHeavyMetalsAtenInt(Request $request){
        $dep = $request->department1;
        $red = $request->red1;
        $dist = $request->distrito1;
        $anio = $request->anio1;

        if($dep == 'TODOS'){
            $nominal = RegisterPatients::select('RegisterAttentions.month_a', 'RegisterPatients.region_current', 'RegisterPatients.province_current', 'RegisterPatients.district_current',
                        (DB::raw('COUNT(RegisterAttentions.medicine_attention) AS MEDICINE, COUNT(RegisterAttentions.nursing_attention) AS NURSE,
                        COUNT(RegisterAttentions.obstetrics_attention) AS OBSTE, COUNT(RegisterAttentions.psychology_attention) AS PSYCOLOGY, COUNT(RegisterAttentions.cred_attention) AS CRED,
                        COUNT(RegisterAttentions.odontology_attention) AS ODONTOLOGY, COUNT(RegisterAttentions.telemedicine_attention) AS TELEMEDICINE, COUNT(RegisterAttentions.vaccine_attention) AS VACUNA')))
                        ->join('RegisterAttentions', 'RegisterAttentions.document', '=', 'RegisterPatients.document')
                        ->where('RegisterAttentions.year_a', $anio)
                        ->groupBy('RegisterAttentions.month_a') ->groupBy('RegisterPatients.region_current')
                        ->groupBy('RegisterPatients.province_current') ->groupBy('RegisterPatients.district_current')
                        ->get();
        }
        else if($dep != 'TODOS' && $red == 'TODOS'){
            $nominal = RegisterPatients::select('RegisterAttentions.month_a', 'RegisterPatients.region_current', 'RegisterPatients.province_current', 'RegisterPatients.district_current',
                        (DB::raw('COUNT(RegisterAttentions.medicine_attention) AS MEDICINE, COUNT(RegisterAttentions.nursing_attention) AS NURSE,
                        COUNT(RegisterAttentions.obstetrics_attention) AS OBSTE, COUNT(RegisterAttentions.psychology_attention) AS PSYCOLOGY, COUNT(RegisterAttentions.cred_attention) AS CRED,
                        COUNT(RegisterAttentions.odontology_attention) AS ODONTOLOGY, COUNT(RegisterAttentions.telemedicine_attention)  AS TELEMEDICINE, COUNT(RegisterAttentions.vaccine_attention) AS VACUNA')))
                        ->join('RegisterAttentions', 'RegisterAttentions.document', '=', 'RegisterPatients.document')
                        ->where('RegisterPatients.region_current', $dep) ->where('RegisterAttentions.year_a', $anio)
                        ->groupBy('RegisterAttentions.month_a') ->groupBy('RegisterPatients.region_current')
                        ->groupBy('RegisterPatients.province_current') ->groupBy('RegisterPatients.district_current')
                        ->get();
        }
        else if($red != 'TODOS' && $dist == 'TODOS'){
            $nominal = RegisterPatients::select('RegisterAttentions.month_a', 'RegisterPatients.region_current', 'RegisterPatients.province_current', 'RegisterPatients.district_current',
                        (DB::raw('COUNT(RegisterAttentions.medicine_attention) AS MEDICINE, COUNT(RegisterAttentions.nursing_attention) AS NURSE,
                        COUNT(RegisterAttentions.obstetrics_attention) AS OBSTE, COUNT(RegisterAttentions.psychology_attention) AS PSYCOLOGY, COUNT(RegisterAttentions.cred_attention) AS CRED,
                        COUNT(RegisterAttentions.odontology_attention) AS ODONTOLOGY, COUNT(RegisterAttentions.telemedicine_attention)  AS TELEMEDICINE, COUNT(RegisterAttentions.vaccine_attention) AS VACUNA')))
                        ->join('RegisterAttentions', 'RegisterAttentions.document', '=', 'RegisterPatients.document')
                        ->where('RegisterPatients.province_current', $red) ->where('RegisterAttentions.year_a', $anio)
                        ->groupBy('RegisterAttentions.month_a') ->groupBy('RegisterPatients.region_current')
                        ->groupBy('RegisterPatients.province_current') ->groupBy('RegisterPatients.district_current')
                        ->get();
        }
        else if($dist != 'TODOS'){
            $nominal = RegisterPatients::select('RegisterAttentions.month_a', 'RegisterPatients.region_current', 'RegisterPatients.province_current', 'RegisterPatients.district_current',
                        (DB::raw('COUNT(RegisterAttentions.medicine_attention) AS MEDICINE, COUNT(RegisterAttentions.nursing_attention) AS NURSE,
                        COUNT(RegisterAttentions.obstetrics_attention) AS OBSTE, COUNT(RegisterAttentions.psychology_attention) AS PSYCOLOGY, COUNT(RegisterAttentions.cred_attention) AS CRED,
                        COUNT(RegisterAttentions.odontology_attention) AS ODONTOLOGY, COUNT(RegisterAttentions.telemedicine_attention)  AS TELEMEDICINE, COUNT(RegisterAttentions.vaccine_attention) AS VACUNA')))
                        ->join('RegisterAttentions', 'RegisterAttentions.document', '=', 'RegisterPatients.document')
                        ->where('RegisterPatients.district_current', $dist) ->where('RegisterAttentions.year_a', $anio)
                        ->groupBy('RegisterAttentions.month_a') ->groupBy('RegisterPatients.region_current')
                        ->groupBy('RegisterPatients.province_current') ->groupBy('RegisterPatients.district_current')
                        ->get();
        }

        return response()->json($nominal);
    }

    public function printHeavyMetals(Request $request){
        $dep = $request->d; $red = $request->r; $dist = $request->ds; $anio = $request->a; $type = $request->t;
        return Excel::download(new ReportMetlsXProvExport($dep, $red, $dist, $anio, $type), 'DEIT_PASCO RELACIÓN DE PACIENTES CON METALES PESADOS.xlsx');
    }

    public function printHeavyMetalsCategory(Request $request){
        $category = $request->c;
        return Excel::download(new ReportCategoryExport($category), 'DEIT_PASCO RELACIÓN DE PACIENTES CON METALES PESADOS POR CATEGORIA.xlsx');
    }

    public function printHeavyMetalsDni(Request $request){
        $doc = $request->d; $anio = $request->a;
        return Excel::download(new ReportMetlsXDniExport($doc, $anio), 'DEIT_PASCO PACIENTE CON METALES PESADOS.xlsx');
    }

    public function printMetalsResume(Request $request){
        $dep = $request->d; $red = $request->r; $dist = $request->ds;
        if($dep == 'TODOS'){
            $nominal = RegisterPatients::select('RegisterAttentions.month_a', 'RegisterPatients.region_current', 'RegisterPatients.province_current', 'RegisterPatients.district_current',
                        (DB::raw('COUNT(RegisterAttentions.medicine_attention) AS MEDICINE, COUNT(RegisterAttentions.nursing_attention) AS NURSE,
                        COUNT(RegisterAttentions.obstetrics_attention) AS OBSTE, COUNT(RegisterAttentions.psychology_attention) AS PSYCOLOGY, COUNT(RegisterAttentions.cred_attention) AS CRED,
                        COUNT(RegisterAttentions.odontology_attention) AS ODONTOLOGY, COUNT(RegisterAttentions.telemedicine_attention)  AS TELEMEDICINE, COUNT(RegisterAttentions.vaccine_attention) AS VACUNA')))
                        ->join('RegisterAttentions', 'RegisterAttentions.document', '=', 'RegisterPatients.document')
                        ->groupBy('RegisterAttentions.month_a') ->groupBy('RegisterPatients.region_current')
                        ->groupBy('RegisterPatients.province_current') ->groupBy('RegisterPatients.district_current')
                        ->get();
        }
        else if($dep != 'TODOS' && $red == 'TODOS'){
            $nominal = RegisterPatients::select('RegisterAttentions.month_a', 'RegisterPatients.region_current', 'RegisterPatients.province_current', 'RegisterPatients.district_current',
                        (DB::raw('COUNT(RegisterAttentions.medicine_attention) AS MEDICINE, COUNT(RegisterAttentions.nursing_attention) AS NURSE,
                        COUNT(RegisterAttentions.obstetrics_attention) AS OBSTE, COUNT(RegisterAttentions.psychology_attention) AS PSYCOLOGY, COUNT(RegisterAttentions.cred_attention) AS CRED,
                        COUNT(RegisterAttentions.odontology_attention) AS ODONTOLOGY, COUNT(RegisterAttentions.telemedicine_attention)  AS TELEMEDICINE, COUNT(RegisterAttentions.vaccine_attention) AS VACUNA')))
                        ->join('RegisterAttentions', 'RegisterAttentions.document', '=', 'RegisterPatients.document')
                        ->where('RegisterPatients.region_current', $dep)
                        ->groupBy('RegisterAttentions.month_a') ->groupBy('RegisterPatients.region_current')
                        ->groupBy('RegisterPatients.province_current') ->groupBy('RegisterPatients.district_current')
                        ->get();
        }
        else if($red != 'TODOS' && $dist == 'TODOS'){
            $nominal = RegisterPatients::select('RegisterAttentions.month_a', 'RegisterPatients.region_current', 'RegisterPatients.province_current', 'RegisterPatients.district_current',
                        (DB::raw('COUNT(RegisterAttentions.medicine_attention) AS MEDICINE, COUNT(RegisterAttentions.nursing_attention) AS NURSE,
                        COUNT(RegisterAttentions.obstetrics_attention) AS OBSTE, COUNT(RegisterAttentions.psychology_attention) AS PSYCOLOGY, COUNT(RegisterAttentions.cred_attention) AS CRED,
                        COUNT(RegisterAttentions.odontology_attention) AS ODONTOLOGY, COUNT(RegisterAttentions.telemedicine_attention)  AS TELEMEDICINE, COUNT(RegisterAttentions.vaccine_attention) AS VACUNA')))
                        ->join('RegisterAttentions', 'RegisterAttentions.document', '=', 'RegisterPatients.document')
                        ->where('RegisterPatients.province_current', $red)
                        ->groupBy('RegisterAttentions.month_a') ->groupBy('RegisterPatients.region_current')
                        ->groupBy('RegisterPatients.province_current') ->groupBy('RegisterPatients.district_current')
                        ->get();
        }
        else if($dist != 'TODOS'){
            $nominal = RegisterPatients::select('RegisterAttentions.month_a', 'RegisterPatients.region_current', 'RegisterPatients.province_current', 'RegisterPatients.district_current',
                        (DB::raw('COUNT(RegisterAttentions.medicine_attention) AS MEDICINE, COUNT(RegisterAttentions.nursing_attention) AS NURSE,
                        COUNT(RegisterAttentions.obstetrics_attention) AS OBSTE, COUNT(RegisterAttentions.psychology_attention) AS PSYCOLOGY, COUNT(RegisterAttentions.cred_attention) AS CRED,
                        COUNT(RegisterAttentions.odontology_attention) AS ODONTOLOGY, COUNT(RegisterAttentions.telemedicine_attention)  AS TELEMEDICINE, COUNT(RegisterAttentions.vaccine_attention) AS VACUNA')))
                        ->join('RegisterAttentions', 'RegisterAttentions.document', '=', 'RegisterPatients.document')
                        ->where('RegisterPatients.district_current', $dist)
                        ->groupBy('RegisterAttentions.month_a') ->groupBy('RegisterPatients.region_current')
                        ->groupBy('RegisterPatients.province_current') ->groupBy('RegisterPatients.district_current')
                        ->get();
        }

        return Excel::download(new ReportMetalsResumExport($nominal, $request->a), 'DEIT_PASCO ATENCION INTEGRAL - METALES PESADOS.xlsx');
    }

    public function indexHomologation() {
        return view('Homologation/index');
    }

    public function searchXMonth(Request $request){
        $doc = $request->id; $month = $request->m; $year = $request->a;
        $get_data = RegisterAttentions::where('document', $doc) ->where('month_a', $month) ->where('year_a', $year) ->get();

        return response()->json($get_data);
    }

    public function updatePatient(Request $request) {
        $id = $request->input('id');
        $patients = RegisterPatients::find($id);
        $patients->ethnicity = $request->input('ethnicity');
        $patients->mother_tongue = $request->input('mother_tongue');
        $patients->cellphone = $request->input('cellphone');
        $patients->pseudonym_code = $request->input('pseudonym_code');
        $patients->state = $request->input('state');
        $patients->region_register = $request->input('region_register');
        $patients->province_register = $request->input('province_register');
        $patients->district_register = $request->input('district_register');
        $patients->establishment_register = $request->input('establishment_register');
        $patients->region_current = $request->input('region_current');
        $patients->province_current = $request->input('province_current');
        $patients->district_current = $request->input('district_current');
        $patients->direction_current = $request->input('direction_current');
        $patients->document_type_authorized = $request->input('document_type_authorized');
        $patients->document_authorized = $request->input('document_authorized');
        $patients->names_authorized = $request->input('names_authorized');
        $patients->cellphone_authorized = $request->input('cellphone_authorized');
        $patients->save();
    }

    public function addPatient(Request $request) {
        $vaccine_covid = DB::table('dbo.COVID19') ->select('FECHA_VACUNACION') ->where('NUM_DOC', $request->input('document'))
                        ->value('FECHA_VACUNACION');

        $patients = new RegisterPatients($request->input());
        $patients->covid_vaccination = $vaccine_covid;
        $patients->save();
    }

    public function addAttentions(Request $request) {
        $attentions = new RegisterAttentions($request->input());
        $attentions->period = $request->year_a . '-' . $request->month_a;
        $attentions->save();
    }

    public function addAttentionsUser(Request $request) {
        $doc = $request->doc;
        $metals = DB::table('dbo.ATENCION_METALES') ->select('PERIODO') ->where('NUMERO_DOCUMENTO_PACIENTE', $doc) ->get();
        $data = [];
        foreach ($metals as $user) { $data[] = $user->PERIODO; }
        $nominalMetals = DB::table('dbo.ATENCION_METALES') ->select('*') ->where('NUMERO_DOCUMENTO_PACIENTE', $doc) ->get();

        $nominalNoMetals = DB::table('dbo.ATENCION_NO_METALES') ->select('*') ->where('NUMERO_DOCUMENTO_PACIENTE', $doc)
                            ->whereNotIn('PERIODO', $data) ->get();

        foreach ($nominalMetals as $req){
            $attentions = new RegisterAttentions;
            $attentions->document = $req->NUMERO_DOCUMENTO_PACIENTE;
            $attentions->year_a = $req->anio;
            $attentions->month_a = $req->mes;
            $attentions->period = $req->PERIODO;
            $attentions->obstetrics_attention = $req->GESTANTE;
            $attentions->medicine_attention = $req->MEDICINA;
            $attentions->psychology_attention = $req->PSICOLOGIA;
            $attentions->odontology_attention = $req->ODONTOLOGIA_GENERAL;
            $attentions->cred_attention = $req->CRED;
            $attentions->telemedicine_attention = $req->TELEMEDICINA;
            $attentions->vaccine_attention = $req->VACUNA;
            $attentions->patient_id = $request->id;
            $attentions->save();
        }

        foreach ($nominalNoMetals as $req2){
            $attentions = new RegisterAttentionsNoMetals();
            $attentions->document = $req2->NUMERO_DOCUMENTO_PACIENTE;
            $attentions->year_a = $req2->anio;
            $attentions->month_a = $req2->mes;
            $attentions->obstetrics_attention = $req2->GESTANTE;
            $attentions->medicine_attention = $req2->MEDICINA;
            $attentions->psychology_attention = $req2->PSICOLOGIA;
            $attentions->odontology_attention = $req2->ODONTOLOGIA_GENERAL;
            $attentions->cred_attention = $req2->CRED;
            $attentions->telemedicine_attention = $req2->TELEMEDICINA;
            $attentions->patient_id = $request->id;
            $attentions->save();
        }
    }

    public function updateAttentions(Request $request) {
        $id = $request->input('id');
        $attentions = RegisterAttentions::find($id);
        $attentions->solicitude_medic = $request->input('solicitude_medic');
        $attentions->reference = $request->input('reference');
        $request->input('reference') == 'NO' ? $attentions->reference_place = '' : $attentions->reference_place = $request->input('reference_place');
        $attentions->against_reference = $request->input('against_reference');
        $request->input('against_reference') == 'NO' ? $attentions->against_reference_place = '' : $attentions->against_reference_place = $request->input('against_reference_place');
        $attentions->integral_attention = $request->input('integral_attention');
        $attentions->hemoglobin = $request->input('hemoglobin');
        $attentions->urine = $request->input('urine');
        $attentions->liver_profile = $request->input('liver_profile');
        $attentions->hematocrit = $request->input('hematocrit');
        $attentions->lipidic_profile = $request->input('lipidic_profile');
        $attentions->telemedicine = $request->input('telemedicine');
        $attentions->specialized_attention = $request->input('specialized_attention');
        $attentions->specialized_attention_detail = $request->input('specialized_attention_detail');
        $attentions->type_intervention = $request->input('type_intervention');
        $attentions->pb_attention = $request->input('pb_attention');
        $attentions->as_attention = $request->input('as_attention');
        $attentions->cd_attention = $request->input('cd_attention');
        $attentions->hg_attention = $request->input('hg_attention');
        $attentions->telemedicine = $request->input('telemedicine');
        $attentions->other_attention = $request->input('other_attention');
        $attentions->ipress_attention = $request->input('ipress_attention');
        $attentions->service_attention = $request->input('service_attention');
        $attentions->date_attention = $request->input('date_attention');
        $attentions->results_attention = $request->input('results_attention');
        $attentions->observations_attention = $request->input('observations_attention');
        $attentions->save();
    }

    public function downloadPdf(Request $request){
        $doc = $request->doc;
        $nominal = DB::table('dbo.PADRON_METALES_PESADOS2')
                    ->select('*') ->where('NUMERO_DOCUMENTO', $doc)
                    ->get();

        $data = [
                        'title' => 'Welcome to Web-Tuts.com',
                        'date' => date('m/d/Y'),
                        'users' => $nominal
        ];

        view()->share('Homologation.pdf', ($data));

        $pdf = PDF::loadView('Homologation.pdf', $data);

        return $pdf->download('Homologation.pdf');
    }

    public function downloaExcel(Request $request){
        $doc = $request->d;
        $query = DB::statement("SELECT TOP 1 * 
                                INTO BD_METALES_PESADOS.DBO.DATA_PATIENT
                                    FROM PADRON_METALES_PESADOS2
                                    WHERE NUMERO_DOCUMENTO='".$doc."'");

        $nominal = DB::table('dbo.DATA_PATIENT')
                    ->select('*')
                    ->get();

        $nominal2 = DB::table('dbo.PADRON_METALES_PESADOS2')
                    ->select('*') ->where('NUMERO_DOCUMENTO', $doc)
                    ->get();

        $query2 = DB::statement("DROP TABLE BD_METALES_PESADOS.DBO.DATA_PATIENT");

        return Excel::download(new HomologationExport($nominal, $nominal2), 'DEIT_PASCO SEGUIMIENTO DE METALES PESADOS.xlsx');
    }

    public function indexNewUser() {
        return view('UserNew/index');
    }

    public function searchUsers(Request $request){
        $doc = $request->doc;
        $data_patient = RegisterPatients::where('document', $doc) ->count();

        if($data_patient == 0){
            $data_his = DB::connection('BDHIS_MINSA') ->table('MAESTRO_PACIENTE_NOMINAL2 as A') ->select('A.Id_Tipo_Documento_Paciente')
                        ->leftJoin('MAESTRO_HIS_UBIGEO_INEI_RENIEC AS B', 'A.Ubigeo_Reniec', '=', 'B.Id_Ubigueo_Reniec')
                        ->where('A.Numero_Documento_Paciente', $doc)
                        ->count();

            if($data_his == 0){
                $data_his = 'h0';
            }else{
                $data_his = DB::connection('BDHIS_MINSA') ->table('MAESTRO_PACIENTE_NOMINAL2 as A')
                            ->select('A.Id_Tipo_Documento_Paciente AS document_type','A.Numero_Documento_Paciente AS document',
                            (DB::raw("CONCAT(A.Apellido_Paterno_Paciente,' ', A.Apellido_Materno_Paciente, ' ', A.Nombres_Paciente) AS names")),
                            'A.Fecha_Nacimiento_Paciente as birth_date', 'A.Genero AS gender', 'A.Ubigeo_Reniec', 'B.Departamento AS region_before',
                            'B.Provincia AS province_before', 'B.Distrito AS district_before', 'A.Domicilio_Reniec AS direction_before')
                            ->leftJoin('MAESTRO_HIS_UBIGEO_INEI_RENIEC AS B', 'A.Ubigeo_Reniec', '=', 'B.Id_Ubigueo_Reniec')
                            ->where('A.Numero_Documento_Paciente', $doc)
                            ->get();
            }
        }else{
            $data_his = 'exist';
        }

        return response()->json($data_his);
    }

    // PARA NO METALES
    public function searchXMonthNoMetals(Request $request){
        $doc = $request->id; $month = $request->m; $year = $request->a;
        $get_data = RegisterAttentionsNoMetals::where('document', $doc) ->where('month_a', $month) ->where('year_a', $year) ->get();

        return response()->json($get_data);
    }

    public function updateAttentionsNoMetals(Request $request) {
        $id = $request->input('id');
        $attentions = RegisterAttentionsNoMetals::find($id);
        $attentions->solicitude_medic = $request->input('solicitude_medic');
        $attentions->reference = $request->input('reference');
        $request->input('reference') == 'NO' ? $attentions->reference_place = '' : $attentions->reference_place = $request->input('reference_place');
        $attentions->against_reference = $request->input('against_reference');
        $request->input('against_reference') == 'NO' ? $attentions->against_reference_place = '' : $attentions->against_reference_place = $request->input('against_reference_place');
        $attentions->integral_attention = $request->input('integral_attention');
        $attentions->hemoglobin = $request->input('hemoglobin');
        $attentions->urine = $request->input('urine');
        $attentions->liver_profile = $request->input('liver_profile');
        $attentions->hematocrit = $request->input('hematocrit');
        $attentions->lipidic_profile = $request->input('lipidic_profile');
        $attentions->telemedicine = $request->input('telemedicine');
        $attentions->specialized_attention = $request->input('specialized_attention');
        $attentions->specialized_attention_detail = $request->input('specialized_attention_detail');
        $attentions->type_intervention = $request->input('type_intervention');
        $attentions->pb_attention = $request->input('pb_attention');
        $attentions->as_attention = $request->input('as_attention');
        $attentions->cd_attention = $request->input('cd_attention');
        $attentions->hg_attention = $request->input('hg_attention');
        $attentions->telemedicine = $request->input('telemedicine');
        $attentions->other_attention = $request->input('other_attention');
        $attentions->ipress_attention = $request->input('ipress_attention');
        $attentions->service_attention = $request->input('service_attention');
        $attentions->date_attention = $request->input('date_attention');
        $attentions->results_attention = $request->input('results_attention');
        $attentions->observations_attention = $request->input('observations_attention');
        $attentions->save();
    }

    public function addAttentionsNoMetals(Request $request) {
        $attentionsNoMetals = new RegisterAttentionsNoMetals($request->input());
        $attentionsNoMetals->period = $request->year_a . '-' . $request->month_a;
        $attentionsNoMetals->save();
    }
}