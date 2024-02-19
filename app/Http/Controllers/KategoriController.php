<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = Kategori::latest()->get();
        return Inertia::render("Kategori/Index", ["kategoris" => $kategoris]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|unique:kategoris,name",
        ]);
        Kategori::create([
            "name" => $request->name,
        ]);
        return Redirect::route("kategori.index")->with("success", "Kategori berhasil dibuat");
    }

    /**2
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
        $kategori = Kategori::findOrFail($id);
        return Inertia::render("Kategori/Edit", ["kategori" => $kategori]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => "required",
        ]);

        Kategori::findOrFail($id)->update([
            "name" => $request->name
        ]);

        return Redirect::route('kategori.index')->with("success", "Kategori berhasil diubah");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return Redirect::route("kategori.index")->with("success", "Kategori berhasil dihapus");
    }
}
