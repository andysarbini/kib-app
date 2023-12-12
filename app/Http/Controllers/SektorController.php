<?php

namespace App\Http\Controllers;

use App\Models\Sektor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SektorController extends Controller
{
    protected $paginate = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sektor = Sektor::orderBy('name')
            ->when($request->has('q') && $request->q != "", function ($query) use ($request) {
                $query->where('name', 'LIKE', '%'. $request->q .'%');
            })
            ->paginate($request->rows ?? $this->paginate)
            ->appends($request->only('rows', 'q'));

        return view('sektor.index', compact('sektor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sektor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:sektor_ukm,name'
        ]);

        $data = $request->only('name');
        $data['slug'] = Str::slug($request->name);

        Sektor::create($data);

        return redirect()->route('sektor.index')
            ->with([
                'message' => 'Sektor berhasil ditambahkan',
                'success' => true,
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sektor  $sektor
     * @return \Illuminate\Http\Response
     */
    public function show(Sektor $sektor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sektor  $sektor
     * @return \Illuminate\Http\Response
     */
    public function edit(Sektor $sektor)
    {
        return view('sektor.edit', compact('sektor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sektor  $sektor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sektor $sektor)
    {
        $this->validate($request, [
            'name' => 'required|unique:sektor_ukm,name,'. $sektor->id
        ]);

        $data = $request->only('name');
        $data['slug'] = Str::slug($request->name);

        $sektor->update($data);

        return redirect()->route('sektor.index')
            ->with([
                'message' => 'Sektor berhasil diperbarui',
                'success' => true,
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sektor  $sektor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sektor $sektor)
    {
        $sektor->delete();

        return redirect()->route('sektor.index')
            ->with([
                'message' => 'Sektor berhasil dihapus',
                'success' => true,
            ]);
    }


}
