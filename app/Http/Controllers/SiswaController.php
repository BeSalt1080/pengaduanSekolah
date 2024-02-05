<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::latest()->get();
        return Inertia::render("Siswa/Index", compact("siswa"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required',
            'kelas' => 'required'
        ]);
        Siswa::create([
            'nis' => $request->get('nis'),
            'kelas' => $request->get('kelas'),
        ]);
        return Redirect::route('siswa.index')->with('success','Siswa berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        return Inertia::render('Siswa/Edit', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nis' => 'required',
            'kelas' => 'required'
        ]);

        $siswa = Siswa::find($id)->update([
            'nis' => $request->nis,
            'kelas' => $request->kelas
        ]);
        return Redirect::route('siswa.index')->with('success','Siswa berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Siswa::destroy($id);
        return Redirect::route('siswa.index')->with('success','Siswa Berhasil dihapus');
    }
}
