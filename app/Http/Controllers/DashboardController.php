<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{ 
    public function index() {
        return view('dashboard');
    }

    public function totalPatients(){
        $nominalPatient = DB::table('RegisterPatients') ->get();
        return response()->json($nominalPatient);
    }

    public function contCategory(){
        $contCategory = DB::table('RegisterPatients') ->select(
                            (DB::raw("SUM(CASE WHEN category = 'C-I' THEN 1 ELSE 0 END) 'Cat1'")),
                            (DB::raw("SUM(CASE WHEN category = 'C-II' THEN 1 ELSE 0 END) 'Cat2'")),
                            (DB::raw("SUM(CASE WHEN category = 'C-III' THEN 1 ELSE 0 END) 'Cat3'")),
                            (DB::raw("SUM(CASE WHEN category = 'C-IV' THEN 1 ELSE 0 END) 'Cat4'"))) ->get();

        return response()->json($contCategory);
    }

    public function contGroupAge(){
        $contAge = DB::table('RegisterPatients') ->select(
                            (DB::raw("SUM(CASE WHEN (age between 1 and 4) THEN 1 ELSE 0 END) 'oneFour'")),
                            (DB::raw("SUM(CASE WHEN (age between 5 and 11) THEN 1 ELSE 0 END) 'fiveEleven'")),
                            (DB::raw("SUM(CASE WHEN (age between 12 and 17) THEN 1 ELSE 0 END) 'twelveSeventeen'")),
                            (DB::raw("SUM(CASE WHEN (age between 18 and 29) THEN 1 ELSE 0 END) 'eighteenTwentynine'")),
                            (DB::raw("SUM(CASE WHEN (age between 30 and 59) THEN 1 ELSE 0 END) 'thirtyFiftynine'")),
                            (DB::raw("SUM(CASE WHEN (age >= 60) THEN 1 ELSE 0 END) 'sixty'"))) ->get();

        return response()->json($contAge);
    }
}