<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function getPenggunaByPhone($phone)
    {
        return Pengguna::where('no_telepon', $phone)->first();
    }

    public function createPengguna($data)
    {
        return Pengguna::create([
            'nama'          => $data['username'], // Diisi sama dengan username
            'nama_pengguna' => $data['username'],
            'no_telepon'    => $data['phone'],
            'email'         => $data['email'],
            'kata_sandi'    => password_hash($data['password'], PASSWORD_DEFAULT),
            'peran'         => 'pengguna'
        ]);
    }
    

    public function index()
    {
        $pengguna = Pengguna::where('peran', 'pengguna')->get();
        
        $users = $pengguna->map(function($user) {
            return [
                'name' => $user->nama,
                'phone' => $user->no_telepon,
                'birthdate' => $user->tanggal_lahir,
                'gender' => $user->jenis_kelamin,
                'address' => $user->alamat,
                'photo' => $user->url_foto
            ];
        });
        
        return view('admin_dashboard', ['users' => $users]);
    }

    public function edit(Request $request)
    {
        $userId = session('user_id'); // Ambil user ID dari session
        $user = Pengguna::findOrFail($userId);
    
        return view('editProfile', ['user' => $user]);
    }
    
    public function update(Request $request)
    {
        $userId = session('user_id'); // Ambil user ID dari session
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric|digits_between:10,15',
            'email' => 'required|email',
            'address' => 'nullable|string',
            'gender' => 'required|string',
            'birthdate' => 'required|date'
        ]);
    
        $user = Pengguna::findOrFail($userId);
        $user->nama = $request->input('name');
        $user->no_telepon = $request->input('phone');
        $user->email = $request->input('email');
        $user->alamat = $request->input('address');
        $user->jenis_kelamin = $request->input('gender');
        $user->tanggal_lahir = $request->input('birthdate');
        $user->save();
    
        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui!');
    }

    public function profile()
    {
        // Ambil user ID dari session
        $userId = session('user_id'); 
    
        // Cari data pengguna
        $user = Pengguna::findOrFail($userId);
    
        // Kirim data ke view
        return view('profile', ['user' => $user]);
    }
  
    
    
}