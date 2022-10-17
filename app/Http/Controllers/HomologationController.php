<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\RegisterPatients;
use App\Models\RegisterAttentions;
use App\Models\RegisterAttentionsNoMetals;

use PDF;

class HomologationController extends Controller
{
    public function indexHomologation() {
        return view('Homologation/index');
    }

    // PARA PACIENTES
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

    // PARA ATENCION DE METALES
    public function searchXMonth(Request $request){
        $doc = $request->id; $month = $request->m; $year = $request->a;
        $get_data = RegisterAttentions::where('document', $doc) ->where('month_a', $month) ->where('year_a', $year) ->get();

        return response()->json($get_data);
    }

    public function addAttentions(Request $request) {
        $attentions = new RegisterAttentions($request->input());
        $attentions->period = $request->year_a . '-' . $request->month_a;
        $attentions->save();
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

    // PARA ATENCION NO METALES
    public function searchXMonthNoMetals(Request $request){
        $doc = $request->id; $month = $request->m; $year = $request->a;
        $get_data = RegisterAttentionsNoMetals::where('document', $doc) ->where('month_a', $month) ->where('year_a', $year) ->get();

        return response()->json($get_data);
    }

    public function updateAttentNoMetals(Request $request) {
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

    public function addAttenNoMetals(Request $request) {
        $attentionsNoMetals = new RegisterAttentionsNoMetals($request->input());
        $attentionsNoMetals->period = $request->year_a . '-' . $request->month_a;
        $attentionsNoMetals->save();
    }
}
