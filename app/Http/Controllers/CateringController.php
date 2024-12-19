<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catering;
use Illuminate\Support\Facades\DB;

class CateringController extends Controller
{
    // Menampilkan daftar catering
    public function index()
    {
        $catering = Catering::orderBy('nama', 'asc')->get(); 
        return view('catering', compact('catering'));
    }

    // Menampilkan form tambah catering
    public function create()
    {
        return view('catering.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'detail_menu' => 'required|string',
            'durasi' => 'required|integer|min:1',
        ]);
    
        try {
            DB::beginTransaction();

            $catering = new Catering();
            $catering->nama = $request->nama;
            $catering->deskripsi = $request->deskripsi;
            $catering->detail_menu = $request->detail_menu;
            $catering->durasi = $request->durasi;
            $catering->save();

            DB::commit();
            return redirect()->route('catering.index')->with('success', 'Data catering berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $catering = Catering::findOrFail($id);
        return view('catering.edit', compact('catering'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'detail_menu' => 'required|string',
            'durasi' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            $catering = Catering::findOrFail($id);
            $catering->nama = $request->nama;
            $catering->deskripsi = $request->deskripsi;
            $catering->detail_menu = $request->detail_menu;
            $catering->durasi = $request->durasi;
            $catering->save();

            DB::commit();
            return redirect()->route('catering.index')->with('success', 'Data catering berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $catering = Catering::findOrFail($id);
            $catering->delete();

            DB::commit();
            return redirect()->route('catering.index')->with('success', 'Data catering berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function showCateringDetail($id)
    {
    $catering = Catering::findOrFail($id);

    $catering->harga = 500000;

    return view('Cateringdetail', ['catering' => $catering]);
    }

    public function processPayment(Request $request)
    {
        // Ambil catering_id dari request
        $cateringId = $request->input('catering_id');
        
        // Cari catering berdasarkan ID
        $catering = Catering::findOrFail($cateringId);

        // Update status pembayaran menjadi 'Lunas'
        $catering->status_pembayaran = 'Lunas';
        $catering->save();

        // Redirect ke halaman catering.index dengan pesan sukses
        return redirect()->route('catering.index')->with('success', 'Pembayaran berhasil diproses!');
    }

    public function showPembayaran($id)
    {
        // Ambil data paket catering berdasarkan ID
        $paketKatering = Catering::findOrFail($id);
    
        // Tambahkan harga default jika belum ada
        $paketKatering->harga = $paketKatering->harga ?? 500000;
    
        // Arahkan ke halaman pembayaran dengan data paket
        return view('pembayaran', ['paketKatering' => $paketKatering]);
    }

    public function showBuktiPembayaran(Request $request)
    {
        // Ambil data dari form pembayaran
        $paketKatering = [
            'nama' => $request->input('nama'),
            'harga' => $request->input('harga'),
            'metode_pembayaran' => $request->input('payment-method'),
            'id_pemesanan' => rand(100000, 999999), // Simulasi ID Pemesanan
            'tanggal_pemesanan' => now()->format('d F Y')
        ];
    
        // Arahkan ke halaman bukti pemesanan dengan data
        return view('buktiPemesanan', ['paketKatering' => $paketKatering]);
    }    

}