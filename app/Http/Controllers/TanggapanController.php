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
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'aspirasi_id' => 'required',
            'feedback' => 'required'
        ]);

        Tanggapan::create([
            'aspirasi_id'=>$request->aspirasi_id,
            'feedback'=>$request->feedback,
        ]);
        return Redirect::route('aspirasi.index')->with('success', 'Aspirasi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
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
        $request->validate([
            'aspirasi_id' => 'required',
            'feedback' => 'required',
        ]);
        Tanggapan::findOrFail($id)->update([
            'aspirasi_id' => $request->aspirasi_id,
            'feedback' => $request->feedback,
        ]);
        return Redirect::route('aspirasi.index')->with('success', 'Aspirasi berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Tanggapan::destroy($id);
        return Redirect::route('aspirasi.index')->with('success', 'Aspirasi berhasil ditambahkan');
    }
}
