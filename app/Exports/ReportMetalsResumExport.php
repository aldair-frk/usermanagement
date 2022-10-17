<?php

namespace App\Exports;

use App\Models\User;
// use Maatwebsite\Excel\Concerns\FromCollection;
use App\Invoice;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportMetalsResumExport implements FromView, ShouldAutoSize
{
    protected $nominal;
    protected $anio;

    public function __construct($nominal_f=null, $anio)
    {
        $this->nominal=$nominal_f;
        $this->anio=$anio;
    }

    public function view(): View {
        $nominal_f = $this->nominal;
        $anio = $this->anio;
        // return view("facturas.ajax-product",compact("nominal_factura"));
        return view('HeavyMetals.printResum', [ 'list' => $nominal_f , 'year' => $anio ]);
    }
}