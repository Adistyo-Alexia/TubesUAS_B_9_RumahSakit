<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Dokter;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function showDetailDokter($id)
    {
        $dokter = Dokter::with('pengguna')->findOrFail($id);
        
        $doctor = [
            'id' => $dokter->id,
            'name' => $dokter->pengguna->nama,
            'specialization' => $dokter->spesialisasi,
            'specialization_detail' => $dokter->deskripsi ?? 'Tidak ada deskripsi',
            'available_today' => $dokter->status == 'Tersedia',
            'photo' => $dokter->pengguna->url_foto ?? 'image/default-avatar.jpg'
        ];
        
        return view('detailDokter', ['doctor' => $doctor]);
    }

    public function store(Request $request)
    {
        // Debugging
        \Log::info('Pesanan data:', $request->all());
    
        $request->validate([
            'doctor_id' => 'required|exists:dokter,id',
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => 'required',
            'notes' => 'nullable|string'
        ]);
    
        try {
            DB::beginTransaction();
    
            // Ambil layanan dokter panggilan
            $layanan = Layanan::where('kategori', 'Dokter Panggilan')
                             ->where('status', 'Aktif')
                             ->first();
    
            \Log::info('Layanan:', ['layanan' => $layanan]);
    
            if (!$layanan) {
                throw new \Exception('Layanan tidak tersedia');
            }
    
            // Buat pesanan baru
            $pesanan = new Pesanan();
            $pesanan->id_pengguna = session('user_id');
            $pesanan->id_layanan = $layanan->id;
            $pesanan->id_dokter = $request->doctor_id;
            $pesanan->tanggal_pesanan = now();
            $pesanan->waktu_janji = $request->appointment_date . ' ' . $request->appointment_time;
            $pesanan->total_biaya = $request->service_price;
            $pesanan->status = 'Menunggu';
            $pesanan->status_pembayaran = 'Belum Dibayar';
            
            \Log::info('Akan menyimpan pesanan:', $pesanan->toArray());
            
            $pesanan->save();
    
            DB::commit();
    
            return redirect()->route('bayar.dokter', ['id' => $pesanan->id]);

    
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Error creating pesanan:', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function showBayarDokter($id)
    {
        $pesanan = Pesanan::with('dokter.pengguna')->findOrFail($id);
    
        $doctor = [
            'id' => $pesanan->id_dokter,
            'name' => $pesanan->dokter->pengguna->nama,
            'specialization' => $pesanan->dokter->spesialisasi,
            'specialization_detail' => $pesanan->dokter->deskripsi ?? 'Tidak ada deskripsi',
            'photo' => $pesanan->dokter->pengguna->url_foto ?? 'image/default-avatar.jpg',
            'available_today' => true, // Sesuaikan jika ada logika status
        ];
    
        return view('bayarDokter', ['doctor' => $doctor]);
    }
    
}