<?php

namespace App\Exports;

use App\Models\RegisterAttentions;
use App\Models\RegisterPatients;
use App\Models\RegisterAttentionsNoMetals;
// use Maatwebsite\Excel\Concerns\FromCollection;
use App\Invoice;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;

class ReportMetalsNoMetals implements FromView, ShouldAutoSize
{
    protected $red;
    protected $district;
    protected $year;
    protected $type;

    public function __construct($n2, $n3, $n4, $n5)
    {
        $this->red=$n2;
        $this->district=$n3;
        $this->year=$n4;
        $this->type=$n5;
    }

    public function view(): View {

        $n2 = $this->red;
        $n3 = $this->district;
        $n4 = $this->year;

        $metals = RegisterAttentions::select(DB::raw("CONCAT(document, '-', [period]) AS PERIODO_DOC")) ->get();
        $data = [];
        foreach ($metals as $user) { $data[] = $user->PERIODO_DOC; }

        if($n2 == 'TODOS'){
            $first = DB::table('RegisterPatients as a') -> select('a.document_type', 'a.document as doc', 'a.names', 'a.gender', 'a.birth_date',
                    'a.age', 'a.clinic_history', 'a.document_type_authorized', 'a.document_authorized', 'a.names_authorized',
                    'a.cellphone_authorized', 'a.pn_registration_date', 'a.case_type', 'a.cellphone', 'a.pseudonym_code',
                    'a.region_current', 'a.province_current', 'a.district_current', 'a.sure_type', 'a.category',
                    'a.region_register', 'a.province_register', 'a.district_register', 'a.establishment_register', 'a.direction_current',
                    'a.covid_vaccination', 'e.*', (DB::raw("'OTRAS ESTRATEGIAS' AS TIPO")))
                    ->leftjoin('RegisterAttentionsNoMetals as e', 'a.document', '=', 'e.document')
                    ->where('e.year_a', $n4) ->where('a.region_register', 'PASCO') ->whereNotIn(DB::raw("CONCAT(e.document, '-', e.period)"), $data);

            $nominal = DB::table('RegisterPatients as a') -> select('a.document_type', 'a.document as doc', 'a.names', 'a.gender', 'a.birth_date',
                        'a.age', 'a.clinic_history', 'a.document_type_authorized', 'a.document_authorized', 'a.names_authorized',
                        'a.cellphone_authorized', 'a.pn_registration_date', 'a.case_type', 'a.cellphone', 'a.pseudonym_code',
                        'a.region_current', 'a.province_current', 'a.district_current', 'a.sure_type', 'a.category',
                        'a.region_register', 'a.province_register', 'a.district_register', 'a.establishment_register', 'a.direction_current',
                        'a.covid_vaccination', 'b.*', (DB::raw("'ESTRATEGIA METALES' AS TIPO")))
                        ->leftjoin('RegisterAttentions as b', 'a.document', '=', 'b.document')
                        ->where('b.year_a', $n4) ->where('a.region_register', 'PASCO') ->union($first) ->get();
        }
        else if($n2 != 'TODOS' && $n3 == 'TODOS'){
            $first = DB::table('RegisterPatients as a') -> select('a.document_type', 'a.document as doc', 'a.names', 'a.gender', 'a.birth_date',
                    'a.age', 'a.clinic_history', 'a.document_type_authorized', 'a.document_authorized', 'a.names_authorized',
                    'a.cellphone_authorized', 'a.pn_registration_date', 'a.case_type', 'a.cellphone', 'a.pseudonym_code',
                    'a.region_current', 'a.province_current', 'a.district_current', 'a.sure_type', 'a.category',
                    'a.region_register', 'a.province_register', 'a.district_register', 'a.establishment_register', 'a.direction_current',
                    'a.covid_vaccination', 'e.*', (DB::raw("'OTRAS ESTRATEGIAS' AS TIPO")))
                    ->leftjoin('RegisterAttentionsNoMetals as e', 'a.document', '=', 'e.document')
                    ->where('e.year_a', $n4) ->where('a.province_register', $n2) ->whereNotIn(DB::raw("CONCAT(e.document, '-', e.period)"), $data);

            $nominal = DB::table('RegisterPatients as a') -> select('a.document_type', 'a.document as doc', 'a.names', 'a.gender', 'a.birth_date',
                        'a.age', 'a.clinic_history', 'a.document_type_authorized', 'a.document_authorized', 'a.names_authorized',
                        'a.cellphone_authorized', 'a.pn_registration_date', 'a.case_type', 'a.cellphone', 'a.pseudonym_code',
                        'a.region_current', 'a.province_current', 'a.district_current', 'a.sure_type', 'a.category',
                        'a.region_register', 'a.province_register', 'a.district_register', 'a.establishment_register', 'a.direction_current',
                        'a.covid_vaccination', 'b.*', (DB::raw("'ESTRATEGIA METALES' AS TIPO")))
                        ->leftjoin('RegisterAttentions as b', 'a.document', '=', 'b.document')
                        ->where('b.year_a', $n4) ->where('a.province_register', $n2) ->union($first) ->get();
        }
        else if($n3 != 'TODOS'){
            $first = DB::table('RegisterPatients as a') -> select('a.document_type', 'a.document as doc', 'a.names', 'a.gender', 'a.birth_date',
                    'a.age', 'a.clinic_history', 'a.document_type_authorized', 'a.document_authorized', 'a.names_authorized',
                    'a.cellphone_authorized', 'a.pn_registration_date', 'a.case_type', 'a.cellphone', 'a.pseudonym_code',
                    'a.region_current', 'a.province_current', 'a.district_current', 'a.sure_type', 'a.category',
                    'a.region_register', 'a.province_register', 'a.district_register', 'a.establishment_register', 'a.direction_current',
                    'a.covid_vaccination', 'e.*', (DB::raw("'OTRAS ESTRATEGIAS' AS TIPO")))
                    ->leftjoin('RegisterAttentionsNoMetals as e', 'a.document', '=', 'e.document')
                    ->where('e.year_a', $n4) ->where('a.district_register', $n3) ->whereNotIn(DB::raw("CONCAT(e.document, '-', e.period)"), $data);

            $nominal = DB::table('RegisterPatients as a') -> select('a.document_type', 'a.document as doc', 'a.names', 'a.gender', 'a.birth_date',
                        'a.age', 'a.clinic_history', 'a.document_type_authorized', 'a.document_authorized', 'a.names_authorized',
                        'a.cellphone_authorized', 'a.pn_registration_date', 'a.case_type', 'a.cellphone', 'a.pseudonym_code',
                        'a.region_current', 'a.province_current', 'a.district_current', 'a.sure_type', 'a.category',
                        'a.region_register', 'a.province_register', 'a.district_register', 'a.establishment_register', 'a.direction_current',
                        'a.covid_vaccination', 'b.*', (DB::raw("'ESTRATEGIA METALES' AS TIPO")))
                        ->leftjoin('RegisterAttentions as b', 'a.document', '=', 'b.document')
                        ->where('b.year_a', $n4) ->where('a.district_register', $n3) ->union($first) ->get();
        }

        return view('HeavyMetals.printAll2', [
            'list' => $nominal
        ]);
    }
}