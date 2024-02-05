<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AspirasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render("Aspirasi/Index", ["aspirasis"=> Aspirasi::with('kategori')->get()]);
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'nis' => 'required',
            'kategori_id' => 'required',
            'lokasi' => 'required',
            'keterangan' => 'required',
            'foto' => 'required|mimes:png,jpg,jpeg'
        ]);

        $foto = $request->file('foto');
        $name = time() . '.' . $foto->getClientOriginalExtension();
        $destinationPath = public_path('/image');
        $foto->move($destinationPath, $name);

        $siswa = Siswa::where('nis', $request->nis)->get();
        if (count($siswa) > 0) {
            Aspirasi::create([
                'nis' => $request->nis,
                'kategori_id' => $request->kategori_id,
                'lokasi' => $request->lokasi,
                'keterangan' => $request->keterangan,
                'foto' => $name
            ]);
            return redirect()->back()->with('Data berhasil ditambahkan');
        }
        return redirect()->back()->with('NIS belum terdaftar');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Inertia::render('Aspirasi/Detail', ["aspirasi"=>Aspirasi::find($id)]);
    }

    public function profil()
    {
        $aspirasis = Aspirasi::latest()->get();
        if(app('request')->input('q') != "")
        {
            $aspirasis = Aspirasi::where('nis', 'like', '%' . app('request')->input('q') . '%')
            ->orWhere('lokasi', 'like', '%' . app('request')->input('q') . '%')
            ->orWhere('keterangan', 'like', '%' . app('request')->input('q') . '%')->get();

        }
        return Inertia::render('Apsirasi/Profil', [compact('aspirasis')]);
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
