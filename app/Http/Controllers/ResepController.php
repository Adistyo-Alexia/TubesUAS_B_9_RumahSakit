<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use App\Models\DetailResep;
use App\Models\Obat;
use App\Models\Konsultasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResepController extends Controller
{
    public function create($konsultasi_id = null)
    {
        if($konsultasi_id) {
            // Validasi apakah konsultasi ada
            $konsultasi = Konsultasi::findOrFail($konsultasi_id);
            session(['konsultasi_id' => $konsultasi_id]);
        }
        
        return view('resep', [
            'konsultasi_id' => $konsultasi_id,
            'konsultasi' => $konsultasi ?? null
        ]);
    }    

    public function store(Request $request)
    {
        \Log::info('Data Resep:', $request->all());

        try {
            DB::beginTransaction();

            $resep = new Resep();
            $resep->id_konsultasi = $request->konsultasi_id;
            $resep->tanggal_resep = $request->tanggal;
            $resep->catatan = $request->catatan;
            $resep->status = 'Aktif';
            $resep->save();

            \Log::info('Resep created:', $resep->toArray());

            // Proses obat-obat
            for($i = 1; $i <= $request->jumlah_obat; $i++) {
                $obat = Obat::firstOrCreate(
                    ['nama' => $request->input("nama_obat_$i")],
                    [
                        'deskripsi' => null,
                        'satuan' => null,
                    ]
                );

                DetailResep::create([
                    'id_resep' => $resep->id,
                    'id_obat' => $obat->id,
                    'dosis' => $request->input("dosis_obat_$i"),
                    'jumlah' => 1
                ]);
            }

            DB::commit();
            return redirect()->route('konsultasi')
                            ->with('success', 'Resep berhasil ditambahkan');

        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Error creating resep:', ['error' => $e->getMessage()]);
            return back()
                    ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                    ->withInput();
        }
    }
    // Method untuk mengambil data resep dengan detail
    public function show($id)
    {
        $resep = Resep::with(['detailResep.obat'])->findOrFail($id);
        return view('detail_resep', compact('resep'));
    }
    
    // Method untuk mengambil daftar obat (untuk autocomplete)
    public function getObat(Request $request)
    {
        $search = $request->get('search');
        $obat = Obat::where('nama', 'like', "%$search%")->get();
        return response()->json($obat);
    }

    // Method untuk mencari resep berdasarkan ID
    public function cariResep(Request $request)
    {
        $id = $request->input('id_resep');
        $resep = Resep::with(['detailResep.obat'])->find($id);

        if ($resep) {
            return response()->json([
                'status' => 'success',
                'data' => [
                    'tanggal' => $resep->tanggal_resep,
                    'jumlah_obat' => $resep->detailResep->count(),
                    'daftar_obat' => $resep->detailResep->map(function ($detail) {
                        return "Nama Obat: {$detail->obat->nama} - Dosis: {$detail->dosis}";
                    }),
                    'catatan' => $resep->catatan ?? 'Tidak ada catatan',
                ]
            ]);
        }

        return response()->json(['status' => 'error', 'message' => 'Resep tidak ditemukan.']);
    }    
}