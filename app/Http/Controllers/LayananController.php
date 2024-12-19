<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class LayananController extends Controller
{
    public function index()
    {
        $services = Layanan::all()->map(function($service) {
            return [
                'id' => $service->id,
                'name' => $service->nama,
                'description' => $service->deskripsi,
                'price' => $service->harga,
                'category' => $service->kategori,
                'image' => $service->url_gambar,
                'status' => $service->status
            ];
        });

        return view('layanan_admin', ['services' => $services]);
    }

    public function create()
    {
        return view('tambah_layanan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category' => 'required|in:Dokter Panggilan,Paket Katering',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'paket_nama' => 'required_if:category,Paket Katering',
            'detail_menu' => 'required_if:category,Paket Katering',
            'durasi' => 'required_if:category,Paket Katering|numeric|nullable'
        ]);
    
        try {
            DB::beginTransaction();
    
            // Upload gambar jika ada
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = 'storage/' . $request->file('image')->store('layanan-photos', 'public');
            }
    
            // Simpan layanan
            $layanan = Layanan::create([
                'nama' => $request->name,
                'deskripsi' => $request->description,
                'harga' => $request->price,
                'kategori' => $request->category,
                'url_gambar' => $imagePath,
                'status' => 'Aktif'
            ]);
    
            // Jika kategori adalah Paket Katering, simpan detail paketnya
            if ($request->category === 'Paket Katering') {
                DB::table('paket_katering')->insert([
                    'id_layanan' => $layanan->id,
                    'nama' => $request->paket_nama,
                    'deskripsi' => $request->description,
                    'detail_menu' => $request->detail_menu,
                    'durasi' => $request->durasi
                ]);
            }
    
            DB::commit();
            return redirect('/layanan-admin')->with('success', 'Layanan berhasil ditambahkan!');
    
        } catch (\Exception $e) {
            DB::rollback();
            if (isset($imagePath)) {
                Storage::disk('public')->delete(str_replace('storage/', '', $imagePath));
            }
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $layanan = Layanan::findOrFail($id);
        
        $service = [
            'id' => $layanan->id,
            'name' => $layanan->nama,
            'description' => $layanan->deskripsi,
            'price' => $layanan->harga,
            'category' => $layanan->kategori,
            'image' => $layanan->url_gambar,
            'status' => $layanan->status
        ];
        
        return view('edit_layanan', ['service' => $service]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category' => 'required|in:Dokter Panggilan,Paket Katering',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            DB::beginTransaction();

            $layanan = Layanan::findOrFail($id);

            if ($request->hasFile('image')) {
                // Hapus gambar lama
                if ($layanan->url_gambar) {
                    $oldPath = str_replace('storage/', '', $layanan->url_gambar);
                    if (Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }
                // Upload gambar baru
                $imagePath = 'storage/' . $request->file('image')->store('layanan-photos', 'public');
                $layanan->url_gambar = $imagePath;
            }

            if ($request->category === 'Paket Katering') {
                DB::table('paket_katering')->updateOrInsert(
                    ['id_layanan' => $layanan->id],
                    [
                        'nama' => $request->paket_nama,
                        'deskripsi' => $request->description,
                        'detail_menu' => $request->detail_menu,
                        'durasi' => $request->durasi
                    ]
                );
            } else {
                // Hapus data paket katering jika kategori bukan Paket Katering
                DB::table('paket_katering')->where('id_layanan', $layanan->id)->delete();
            }

            $layanan->nama = $request->name;
            $layanan->deskripsi = $request->description;
            $layanan->harga = $request->price;
            $layanan->kategori = $request->category;
            $layanan->save();

            DB::commit();
            return redirect('/layanan-admin')->with('success', 'Layanan berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $layanan = Layanan::findOrFail($id);

            // Hapus gambar jika ada
            if ($layanan->url_gambar) {
                $imagePath = str_replace('storage/', '', $layanan->url_gambar);
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }

            $layanan->delete();

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Layanan berhasil dihapus']);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function show($id)
    {
        // Retrieve the specific package by ID
        $paketKatering = Layanan::findOrFail($id);
    
        // Check for Paket Katering details
        $detailMenu = DB::table('paket_katering')
            ->where('id_layanan', $id)
            ->first();
    
        // Pass package data and details to the view
        return view('Cateringdetail', [
            'paketKatering' => $paketKatering,
            'detailMenu' => $detailMenu
        ]);
    }

}