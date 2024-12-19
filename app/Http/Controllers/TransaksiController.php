<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    // Menampilkan semua transaksi
    public function index()
    {
        $transaksi = Transaksi::with('pesanan')->get();
        return response()->json($transaksi);
    }

    // Menampilkan detail transaksi berdasarkan ID
    public function show($id)
    {
        $transaksi = Transaksi::with('pesanan')->findOrFail($id);
        return response()->json($transaksi);
    }

    // Menyimpan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'id_pesanan' => 'required|integer',
            'jumlah' => 'required|numeric',
            'metode_pembayaran' => 'required|string|max:50',
            'kode_pembayaran' => 'nullable|string|max:50',
            'status' => 'required|in:Menunggu,Berhasil,Gagal',
        ]);

        $transaksi = Transaksi::create([
            'id_pesanan' => $request->id_pesanan,
            'jumlah' => $request->jumlah,
            'metode_pembayaran' => $request->metode_pembayaran,
            'kode_pembayaran' => $request->kode_pembayaran,
            'status' => $request->status,
            'tanggal_transaksi' => now(),
        ]);

        return response()->json([
            'message' => 'Transaksi berhasil dibuat',
            'data' => $transaksi,
        ], 201);
    }

    // Mengupdate transaksi berdasarkan ID
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_pesanan' => 'nullable|integer',
            'jumlah' => 'nullable|numeric',
            'metode_pembayaran' => 'nullable|string|max:50',
            'kode_pembayaran' => 'nullable|string|max:50',
            'status' => 'nullable|in:Menunggu,Berhasil,Gagal',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update($request->all());

        return response()->json([
            'message' => 'Transaksi berhasil diperbarui',
            'data' => $transaksi,
        ]);
    }

    // Menghapus transaksi berdasarkan ID
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return response()->json([
            'message' => 'Transaksi berhasil dihapus',
        ]);
    }
}
