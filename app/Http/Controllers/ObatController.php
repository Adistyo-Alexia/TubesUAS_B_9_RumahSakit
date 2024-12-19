<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Obat;

class ObatController extends Controller
{
    public function index()
    {
        $obat = Obat::all();
        return view('obat.index', compact('obat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:obat,nama',
            'satuan' => 'nullable',
            'deskripsi' => 'nullable'
        ]);

        Obat::create($request->all());
        return redirect()->route('obat.index')->with('success', 'Obat berhasil ditambahkan');
    }

    // Method lain seperti edit, update, delete jika diperlukan
}
