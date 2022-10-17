<?php

namespace App\Exports;

use App\Models\RegisterAttentions;
use App\Models\RegisterPatients;
// use Maatwebsite\Excel\Concerns\FromCollection;
use App\Invoice;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use PhpParser\Node\Stmt\Else_;

class ReportCategoryExport implements FromView, ShouldAutoSize
{
    protected $category;

    public function __construct($n1)
    {
        $this->category=$n1;
    }

    public function view(): View {

        $n1 = $this->category;
        if($n1 == 'TODOS'){
            $nominal = RegisterPatients::select('RegisterPatients.document as doc', '*')
                    ->leftjoin('RegisterAttentions', 'RegisterPatients.document', '=', 'RegisterAttentions.document')
                    ->get();
        }else{
            $nominal = RegisterPatients::select('RegisterPatients.document as doc', '*')
                        ->leftjoin('RegisterAttentions', 'RegisterPatients.document', '=', 'RegisterAttentions.document')
                        ->where('RegisterPatients.category', $n1)
                        ->get();
        }

        return view('HeavyMetals.printAll', [
            'list' => $nominal
        ]);
    }
}