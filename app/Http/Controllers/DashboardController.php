<?php

namespace App\Http\Controllers;

use App\Models\StagingUkm;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jum_ukm = StagingUkm::count();
        $jum_sektor = DB::table('stg_ukm')->distinct('sektor_usaha')->count('sektor_usaha');

        $sektor_ukm = DB::table('stg_ukm')
             ->select('sektor_usaha', DB::raw('count(distinct(nik)) as jumlah'))
             ->groupBy('sektor_usaha')
             ->get();

        $list_sektor = [];

        foreach ($sektor_ukm as $item)
        {
            $list_sektor[] = $item->sektor_usaha;
            $list_jumlah[] = $item->jumlah;
        }

        return view('dashboard', compact(
            'jum_ukm',
            'jum_sektor',
            'sektor_ukm',
            'list_sektor',
            'list_jumlah'
        ));
    }
}
