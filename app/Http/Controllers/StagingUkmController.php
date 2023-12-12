<?php

namespace App\Http\Controllers;

use App\Models\StagingUkm;

use Illuminate\Http\Request;

class StagingUkmController extends Controller
{

    public function index()
    {
        return view('ukm.index');
    }

    public function data(Request $request)
    {
        $query = StagingUkm::when(auth()->user()->hasRole('admin'), function ($query) {
            $query->admin();
        })
        ->when($request->has('status') && $request->status != "", function ($query) use ($request) {
            $query->where('status', $request->status);
        })
        ->when(
            $request->has('start_date') && 
            $request->start_date != "" && 
            $request->has('end_date') && 
            $request->end_date != "", 
            function ($query) use ($request) {
                $query->whereBetween('publish_date', $request->only('start_date', 'end_date'));
            }
        )
        ->orderBy('publish_date', 'desc');

    return datatables($query);
    }
    
}
