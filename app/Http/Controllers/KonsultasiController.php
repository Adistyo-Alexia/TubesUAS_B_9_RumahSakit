<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Konsultasi;
use App\Models\Pengguna;
use App\Models\Dokter;
use Illuminate\Support\Facades\DB;

class KonsultasiController extends Controller
{
    // Menampilkan daftar konsultasi
    public function index()
    {
        $konsultasi = Konsultasi::with(['pasien', 'dokter.pengguna'])
            ->orderBy('tanggal_konsultasi', 'desc')
            ->get();
            
        return view('konsultasi', ['konsultasi' => $konsultasi]);
    }

    // Menampilkan form tambah konsultasi
    public function create()
    {
        $pasien = Pengguna::where('peran', 'pengguna')->get();
        $dokter = Dokter::with('pengguna')->get();
        // Ambil pesanan yang belum memiliki konsultasi dan status Dikonfirmasi
        $pesanan = DB::table('pesanan')
            ->leftJoin('konsultasi', 'pesanan.id', '=', 'konsultasi.id_pesanan')
            ->whereNull('konsultasi.id')
            ->where('pesanan.status', 'Dikonfirmasi')
            ->select('pesanan.*')
            ->get();
        
        return view('tambah_konsultasi', compact('pasien', 'dokter', 'pesanan'));
    }    
    
    public function store(Request $request)
    {
        \Log::info('Data request:', $request->all());
        \Log::info('Session user_id:', [session('user_id')]);
    
        $request->validate([
            'jenis_konsultasi' => 'required|in:Terjadwal,Darurat',
            'pesanan' => 'required_if:jenis_konsultasi,Terjadwal',            
            'dokter' => 'required',
            'pasien' => 'required',
            'tanggal' => 'required|date',
            'keluhan' => 'required',
            'diagnosa' => 'required'
        ]);
    
        try {
            DB::beginTransaction();

            \Log::info('Nilai request dokter:', ['dokter_id' => $request->dokter]);
    
            $konsultasi = new Konsultasi();
            $konsultasi->id_pesanan = $request->jenis_konsultasi === 'Terjadwal' ? $request->pesanan : null;            
            $konsultasi->id_dokter = $request->dokter;
            $konsultasi->id_pasien = $request->pasien;
            $konsultasi->id_pesanan = null;
            $konsultasi->tanggal_konsultasi = $request->tanggal;
            $konsultasi->keluhan = $request->keluhan;
            $konsultasi->diagnosa = $request->diagnosa;
            $konsultasi->catatan = $request->catatan;
            $konsultasi->status = 'Terjadwal';
            $konsultasi->save();

            if ($request->jenis_konsultasi === 'Terjadwal') {
                DB::table('pesanan')
                    ->where('id', $request->pesanan)
                    ->update(['status' => 'Selesai']);
            }    
    
            \Log::info('Konsultasi created:', $konsultasi->toArray());
    
            DB::commit();
    
            return redirect()->route('konsultasi')
                            ->with('success', 'Data konsultasi berhasil ditambahkan');
    
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Error creating konsultasi:', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    // Menampilkan form tambah resep
    public function createResep()
    {
        return view('resep');
    }

    // Menyimpan data resep
    public function storeResep(Request $request)
    {
        // Validasi input resep
        $request->validate([
            'tanggal' => 'required|date',
            'jumlah_obat' => 'required|numeric',
            'nama_obat.*' => 'required',
            'dosis_obat.*' => 'required'
        ]);

        try {
            DB::beginTransaction();
            
            // Logika penyimpanan resep akan ditambahkan nanti
            
            DB::commit();
            return redirect('/konsultasi')->with('success', 'Data resep berhasil ditambahkan');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $konsultasi = Konsultasi::findOrFail($id);
        $pasien = Pengguna::where('peran', 'pengguna')->get();
        $dokter = Dokter::with('pengguna')->get();
        
        return view('edit_konsultasi', compact('konsultasi', 'pasien', 'dokter'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'dokter' => 'required',
            'pasien' => 'required',
            'tanggal' => 'required|date',
            'keluhan' => 'required',
            'diagnosa' => 'required'
        ]);

        try {
            DB::beginTransaction();

            $konsultasi = Konsultasi::findOrFail($id);
            $konsultasi->id_dokter = $request->dokter;
            $konsultasi->id_pasien = $request->pasien;
            $konsultasi->tanggal_konsultasi = $request->tanggal;
            $konsultasi->keluhan = $request->keluhan;
            $konsultasi->diagnosa = $request->diagnosa;
            $konsultasi->catatan = $request->catatan;
            $konsultasi->save();

            DB::commit();

            return redirect()->route('konsultasi')
                            ->with('success', 'Data konsultasi berhasil diperbarui');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $konsultasi = Konsultasi::findOrFail($id);
            
            // Hapus resep terkait jika ada
            if ($konsultasi->resep) {
                $konsultasi->resep->detailResep()->delete();
                $konsultasi->resep->delete();
            }
            
            $konsultasi->delete();

            DB::commit();
            return redirect()->route('konsultasi')
                            ->with('success', 'Konsultasi berhasil dihapus');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}