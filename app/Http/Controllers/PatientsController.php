<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\RegisterPatients;
use App\Models\RegisterAttentions;
use App\Models\RegisterAttentionsNoMetals;

class PatientsController extends Controller
{
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

    public function addPatient(Request $request) {
        $vaccine_covid = DB::table('dbo.COVID19') ->select('FECHA_VACUNACION') ->where('NUM_DOC', $request->input('document'))
                        ->value('FECHA_VACUNACION');

        $patients = new RegisterPatients($request->input());
        $patients->covid_vaccination = $vaccine_covid;
        $patients->save();
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
}
