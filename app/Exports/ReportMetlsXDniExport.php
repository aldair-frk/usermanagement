<?php

namespace App\Exports;

use App\Models\RegisterPatients;
use App\Models\RegisterAttentions;
use App\Models\RegisterAttentionsNoMetals;
// use Maatwebsite\Excel\Concerns\FromCollection;
use App\Invoice;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
// use RegisterAttentionsNoMetals;

class ReportMetlsXDniExport implements FromView, ShouldAutoSize
{
    protected $doc;
    protected $dni;

    public function __construct($n1, $n2)
    {
        $this->doc=$n1;
        $this->dni=$n2;
    }

    public function view(): View {

        $n1 = $this->doc;
        $n2 = $this->dni;

        $nominal = RegisterPatients::where('document', $n1) ->get();
        $nominal2 = RegisterAttentions::where('document', $n1) ->where('year_a', $n2) ->orderBy('month_a') ->get();

        $metals = RegisterAttentions::select('period') ->where('document', $n1) ->get();
        $data = [];
        foreach ($metals as $user) { $data[] = $user->period; }

        $nominal3 = RegisterAttentionsNoMetals::where('document', $n1) ->where('year_a', $n2)
                    ->whereNotIn('period', $data) ->orderBy('month_a') ->get();

        return view('HeavyMetals.printDoc', [
            'list' => $nominal, 'list2' => $nominal2, 'list3' => $nominal3
        ]);
    }
}