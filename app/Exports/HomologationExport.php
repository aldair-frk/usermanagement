<?php

namespace App\Exports;

use App\Models\User;
// use Maatwebsite\Excel\Concerns\FromCollection;
use App\Invoice;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class HomologationExport implements FromView, ShouldAutoSize
{
    protected $nominal;
    protected $nominal2;

    public function __construct($nominal_f=null, $nominal2_f=null)
    {
        $this->nominal=$nominal_f;
        $this->nominal2=$nominal2_f;
    }

    public function view(): View {
        $nominal_f = $this->nominal;
        $nominal2_f = $this->nominal2;
        // return view("facturas.ajax-product",compact("nominal_factura"));
        return view('Homologation.printExcel', [ 'list' => $nominal_f, 'list2' => $nominal2_f ]);
    }
}