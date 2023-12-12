<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StagingUkm extends Model
{
    use HasFactory;
    protected $table = 'stg_ukm';

    public function index()
    {
        return view('ukm.index');
    }

    public function data(Request $request)
    {
        $query = Campaign::when(auth()->user()->hasRole('donatur'), function ($query) {
            $query->donatur();
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

    return datatables($query)
    }
}
