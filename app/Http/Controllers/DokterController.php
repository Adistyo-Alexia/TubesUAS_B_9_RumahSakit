<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pengguna;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class DokterController extends Controller
{
    public function index()
    {
        $dokter = Dokter::with('pengguna')->get();
        
        $doctors = $dokter->map(function($dok) {
            return [
                'id' => $dok->id,
                'name' => $dok->pengguna->nama,
                'specialization' => $dok->spesialisasi,
                'phone' => $dok->pengguna->no_telepon,
                'email' => $dok->pengguna->email,
                'gender' => $dok->pengguna->jenis_kelamin,
                'address' => $dok->pengguna->alamat,
                'photo' => $dok->pengguna->url_foto
            ];
        });
        
        return view('doctors_admin', ['doctors' => $doctors]);
    }

    public function create()
    {
        return view('tambah_dokter');
    }

    public function store(Request $request)
    {
        $photoPath = null; // Inisialisasi variabel
        try {
            // Log: Masuk ke fungsi store
            \Log::info('Masuk ke metode store');
    
            // Validasi form
            $validated = $request->validate([
                'name' => 'required',
                'specialization' => 'required',
                'phone' => 'required|unique:pengguna,no_telepon',
                'email' => 'required|email|unique:pengguna,email',
                'gender' => 'required',
                'address' => 'required',
                'photo' => 'image|mimes:jpeg,png,jpg|max:2048'
            ]);
            \Log::info('Validasi sukses', $validated);
    
            \DB::beginTransaction();
    
            // Upload foto jika ada
            if ($request->hasFile('photo')) {
                $photoPath = 'storage/' . $request->file('photo')->store('dokter-photos', 'public');
                \Log::info('Foto berhasil diunggah', ['path' => $photoPath]);
            } else {
                \Log::info('Tidak ada file foto yang diunggah');
            }
    
            // Generate username dari nama
            $username = strtolower(str_replace(' ', '', $request->name)) . rand(100, 999);
            \Log::info('Username berhasil dibuat', ['username' => $username]);
    
            // Simpan ke tabel pengguna
            $pengguna = new Pengguna();
            $pengguna->nama = $request->name;
            $pengguna->nama_pengguna = $username;
            $pengguna->no_telepon = $request->phone;
            $pengguna->email = $request->email;
            $pengguna->kata_sandi = bcrypt('dokterpassword');
            $pengguna->jenis_kelamin = $request->gender;
            $pengguna->alamat = $request->address;
            $pengguna->url_foto = $photoPath;
            $pengguna->peran = 'dokter';
            $pengguna->save();
            \Log::info('Data pengguna berhasil disimpan', ['id' => $pengguna->id]);
    
            // Simpan ke tabel dokter
            $dokter = new Dokter();
            $dokter->id_pengguna = $pengguna->id;
            $dokter->spesialisasi = $request->specialization;
            $dokter->deskripsi = $request->description;
            $dokter->status = 'Tersedia';
            $dokter->save();
            \Log::info('Data dokter berhasil disimpan', ['id' => $dokter->id]);
    
            \DB::commit();
            \Log::info('Transaksi berhasil disimpan');
    
            return redirect('/doctors-admin')->with('success', 'Dokter berhasil ditambahkan!');
        } catch (\Exception $e) {
            \DB::rollback();
    
            // Log error
            \Log::error('Error saat menambah dokter:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
    
            // Hapus file foto jika ada
            if ($photoPath && Storage::disk('public')->exists($photoPath)) {
                Storage::disk('public')->delete($photoPath);
                \Log::info('File foto dihapus karena error', ['path' => $photoPath]);
            }
    
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }
    
    public function edit($id)
    {
        // Ambil data dokter dan data pengguna terkait
        $dokter = Dokter::with('pengguna')->findOrFail($id);
        
        // Transform data untuk ditampilkan di form
        $doctor = [
            'id' => $dokter->id,
            'name' => $dokter->pengguna->nama,
            'specialization' => $dokter->spesialisasi,
            'description' => $dokter->deskripsi,
            'phone' => $dokter->pengguna->no_telepon,
            'email' => $dokter->pengguna->email,
            'gender' => $dokter->pengguna->jenis_kelamin,
            'address' => $dokter->pengguna->alamat,
            'photo' => $dokter->pengguna->url_foto
        ];
        
        return view('edit_dokter', ['doctor' => $doctor]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'specialization' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'gender' => 'required',
            'address' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            DB::beginTransaction();

            $dokter = Dokter::findOrFail($id);
            
            // Upload foto baru jika ada
            if ($request->hasFile('photo')) {
                // Hapus foto lama jika ada
                if ($dokter->pengguna->url_foto) {
                    $oldPath = str_replace('storage/', '', $dokter->pengguna->url_foto);
                    if (Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }
                $photoPath = 'storage/' . $request->file('photo')->store('dokter-photos', 'public');
            }
            // Update data pengguna
            $pengguna = $dokter->pengguna;
            $pengguna->nama = $request->name;
            $pengguna->no_telepon = $request->phone;
            $pengguna->email = $request->email;
            $pengguna->jenis_kelamin = $request->gender;
            $pengguna->alamat = $request->address;
            if (isset($photoPath)) {
                $pengguna->url_foto = $photoPath;
            }
            $pengguna->save();

            // Update data dokter
            $dokter->spesialisasi = $request->specialization;
            $dokter->deskripsi = $request->description;
            $dokter->save();

            DB::commit();

            return redirect('/doctors-admin')->with('success', 'Data dokter berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $dokter = Dokter::findOrFail($id);
            $pengguna = $dokter->pengguna;

            // Hapus foto jika ada
            if ($pengguna->url_foto) {
                $oldPath = str_replace('storage/', '', $pengguna->url_foto);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            // Hapus data dokter dulu karena memiliki foreign key ke pengguna
            $dokter->delete();
            // Lalu hapus data pengguna
            $pengguna->delete();

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Dokter berhasil dihapus']);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function showDokterHome()
    {
        $dokter = Dokter::with('pengguna')->get();
    
        // Format data dokter agar sesuai dengan kebutuhan view
        $doctors = $dokter->map(function ($dok) {
            return [
                'id' => $dok->id,
                'name' => $dok->pengguna->nama,
                'specialization' => $dok->spesialisasi,
                'specialization_detail' => $dok->deskripsi ?? 'Tidak ada deskripsi',
                'available_today' => $dok->status == 'Tersedia',
                'photo' => $dok->pengguna->url_foto ?? 'image/default-avatar.jpg'
            ];
        });
    
        // Kirim data ke view
        return view('dokterHome', ['doctors' => $doctors]);
    }

    public function showBayarDokter($id)
    {
        // Ambil data dokter berdasarkan ID
        $dokter = Dokter::with('pengguna')->findOrFail($id);
    
        // Format data dokter agar sesuai kebutuhan view
        $doctor = [
            'id' => $dokter->id,
            'name' => $dokter->pengguna->nama,
            'specialization' => $dokter->spesialisasi,
            'specialization_detail' => $dokter->deskripsi ?? 'Tidak ada deskripsi',
            'available_today' => $dokter->status == 'Tersedia',
            'photo' => $dokter->pengguna->url_foto ?? 'image/default-avatar.jpg'
        ];
    
        // Kirim data dokter ke view bayarDokter
        return view('bayarDokter', ['doctor' => $doctor]);
    }

    public function showBuktiPemesananDokter(Request $request)
    {
        // Ambil data yang dikirimkan dari bayarDokter
        $doctor = [
            'id' => $request->input('id'),
            'name' => $request->input('name'),
            'specialization' => $request->input('specialization'),
            'specialization_detail' => $request->input('specialization_detail'),
            'photo' => $request->input('photo'),
            'payment_method' => $request->input('payment_method'),
            'appointment_time' => $request->input('appointment_time'),
        ];
    
        return view('buktiPemesananDokter', ['doctor' => $doctor]);
    }
    
        
        
      
}