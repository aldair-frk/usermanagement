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

class ReportMetlsXProvExport implements FromView, ShouldAutoSize
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
        $n5 = $this->type;

        if($n2 == 'TODOS'){
            if($n5 == 'METALES'){
                $nominal = RegisterPatients::select('RegisterPatients.document as doc', '*')
                    ->leftjoin('RegisterAttentions', 'RegisterPatients.document', '=', 'RegisterAttentions.document')
                    ->where('RegisterPatients.region_register', 'PASCO') ->where('RegisterAttentions.year_a', $n4) ->get();
            }else{
                $nominal = RegisterPatients::select('RegisterPatients.document as doc', '*')
                    ->leftjoin('RegisterAttentionsNoMetals', 'RegisterPatients.document', '=', 'RegisterAttentionsNoMetals.document')
                    ->where('RegisterPatients.region_register', 'PASCO') ->where('RegisterAttentionsNoMetals.year_a', $n4) ->get();
            }
        }
        else if($n2 != 'TODOS' && $n3 == 'TODOS'){
            if($n5 == 'METALES'){
                $nominal = RegisterPatients::select('RegisterPatients.document as doc', '*')
                    ->leftjoin('RegisterAttentions', 'RegisterPatients.document', '=', 'RegisterAttentions.document')
                    ->where('RegisterPatients.province_register', $n2) ->where('RegisterAttentions.year_a', $n4) ->get();
            }else{
                $nominal = RegisterPatients::select('RegisterPatients.document as doc', '*')
                    ->leftjoin('RegisterAttentionsNoMetals', 'RegisterPatients.document', '=', 'RegisterAttentionsNoMetals.document')
                    ->where('RegisterPatients.province_register', $n2) ->where('RegisterAttentionsNoMetals.year_a', $n4) ->get();
            }
        }
        else if($n3 != 'TODOS'){
            if($n5 == 'METALES'){
                $nominal = RegisterPatients::select('RegisterPatients.document as doc', '*')
                    ->leftjoin('RegisterAttentions', 'RegisterPatients.document', '=', 'RegisterAttentions.document')
                    ->where('RegisterPatients.district_register', $n3) ->where('RegisterAttentions.year_a', $n4) ->get();
            }else{
                $nominal = RegisterPatients::select('RegisterPatients.document as doc', '*')
                    ->leftjoin('RegisterAttentionsNoMetals', 'RegisterPatients.document', '=', 'RegisterAttentionsNoMetals.document')
                    ->where('RegisterPatients.district_register', $n3) ->where('RegisterAttentionsNoMetals.year_a', $n4) ->get();
            }
        }

        return view('HeavyMetals.printAll', [
            'list' => $nominal
        ]);
    }
}