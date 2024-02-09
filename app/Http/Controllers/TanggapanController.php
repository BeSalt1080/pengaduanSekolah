<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;


class TanggapanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'aspirasi_id'=>'required',
            'status'=>'required',
            'feedback'=>'required'
        ]);
        Tanggapan::create([
            'aspirasi_id'=>$request->aspirasi_id,
            'feedback'=>$request->feedback,
        ]);
        Aspirasi::find($request->aspirasi_id)->update([
            'status'=>$request->status,
        ]);
        return Redirect::route('aspirasi.index')->with('success','Aspirasi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) : Response
    {
        $aspirasi = Aspirasi::findOrFail($id);
        return Inertia::render("Tanggapan/Create", compact("aspirasi"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
