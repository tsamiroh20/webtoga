<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function userprofile($id)
    {
        //mengambil data dari model user dan profile berdasarkan id
        $user = User::with('profile')->findOrFail($id);
        return view('user.profile', compact('user'));
    }

    public function userprofileedit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit-profile', compact('user'));
    }

    public function userprofileupdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'bio' => 'nullable|string', 
            'kelamin' => 'nullable|string',
            'umur' => 'nullable|integer',
            'foto_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            // Pesan kesalahan kustom untuk email yang sudah terdaftar
            'email.unique' => 'Email yang Anda masukkan sudah terdaftar dalam sistem.',
        ]);
    
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        
        //untuk memeriksa dan mengupload foto profile
        if ($request->hasFile('foto_profile')) {
            $image = $request->file('foto_profile'); // Ambil file gambar dari request
            $name = time() . '.' . $image->getClientOriginalExtension(); // Beri nama file baru dengan timestamp dan ekstensi yg asli
            $destinationPath = public_path('/storage'); // folder tujuan menyimpan file
            $image->move($destinationPath, $name); // Pindahkan file ke folder tujuan dengan nama baru
            if ($user->profile) { // Cek apakah user memiliki data profil
                $user->profile->foto_profile = $name; // Simpan nama file di kolom 'foto_profile' di tabel profil
            }
        }
        
        $kelamin = $request->kelamin ?? '-';  // Menetapkan nilai default jika tidak diisi
        
        //untuk memperbarui profile yg sudah ada
        if ($user->profile) {
            $user->profile->bio = $request->bio;
            $user->profile->kelamin = $kelamin;
            $user->profile->umur = $request->umur;
            if (isset($name)) {
                $user->profile->foto_profile = $name;
            }
            $user->profile->save();
        // membuat profile baru jika blm ada
        } else {
            $user->profile()->create([
                'bio' => $request->bio,
                'kelamin' => $kelamin,
                'umur' => $request->umur,
                'foto_profile' => isset($name) ? $name : null,
            ]);
        }
    
        $user->save();
    
        return redirect()->route('user/profile', $id)->with('success', 'Profile Berhasil di Update !!!');
    }    

    public function adminprofile($id)
    { 
        //mengambil data dari model user dan profile berdasarkan id
        $user = User::with('profile')->findOrFail($id); 
        return view('admin.profile', compact('user'));
    }

    public function adminprofileedit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.editprofile', compact('user'));
    }

    public function adminprofileupdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'bio' => 'nullable|string',
            'kelamin' => 'nullable|string',
            'umur' => 'nullable|integer',
            'foto_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            // Pesan kesalahan kustom untuk email yang sudah terdaftar
            'email.unique' => 'Email yang Anda masukkan sudah terdaftar dalam sistem.',
        ]);
    
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        
        //untuk memeriksa dan mengupload foto profile
        if ($request->hasFile('foto_profile')) {
            $image = $request->file('foto_profile');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/storage');
            $image->move($destinationPath, $name);
            if ($user->profile) {
                $user->profile->foto_profile = $name;
            }
        }
    
        $kelamin = $request->kelamin ?? '-';  // Menetapkan nilai default jika tidak diisi
        
        //untuk memperbarui profile yg sudah ada
        if ($user->profile) {
            $user->profile->bio = $request->bio;
            $user->profile->kelamin = $kelamin;
            $user->profile->umur = $request->umur;
            if (isset($name)) {
                $user->profile->foto_profile = $name;
            }
            $user->profile->save();
        // membuat profile baru jika blm ada
        } else {
            $user->profile()->create([
                'bio' => $request->bio,
                'kelamin' => $kelamin,
                'umur' => $request->umur,
                'foto_profile' => isset($name) ? $name : null,
            ]);
        }
    
        $user->save();

        return redirect()->route('admin/profile', $id)->with('success', 'Profile Berhasil di Update !!!');
    }

}
