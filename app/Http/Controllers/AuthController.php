<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function __construct()
    {
        //'guest' memastikan pengguna belum login (pengunjung)
        $this->middleware('guest')->except('logout');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function registerSave(Request $request)
    {
        Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed',

        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah pernah dipakai sebelumnya.',
            'password.required' => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',

        ])->validate();

        // Membuat user baru jika validasi berhasil
        User::create([ 
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => "0"
        ]);

        // Redirect ke halaman yang sesuai
        return redirect()->route('login')->with('success', 'Registrasi Berhasil !');
        
    }

    public function login()
    {

        return view('auth.login');
    }

    public function loginAction(Request $request)
    {
        //validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //mencoba melakukan autentikasi berdasarkan email dan password
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            return redirect()->back()->with('error', 'Login gagal, silakan periksa kembali email dan password yang anda masukkan.');
        }

        $request->session()->regenerate();
        //cek tipe pengguna setelah login
        if (auth()->user()->type == 'admin') {
            return redirect()->route('homeadmin');
        } else {
            return redirect()->route('homeuser');
        }
    }

    public function logout(Request $request)
    {
        //mengakhiri sesi login pengguna
        Auth::guard('web')->logout();
 
        $request->session()->invalidate();
 
        return redirect('/homeuser');
    }

    public function syaratketentuan()
    {
        return view('syaratketentuan');
    }

    public function lupapassword()
    {
        return view('auth.lupapassword');
    }
    
    // Mengirimkan link reset password ke email
    public function kirimlinkresetemail(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email'
        ], [
            'email.required' => 'Alamat email diperlukan.',
            'email.email' => 'Format alamat email tidak valid.',
        ]);

        // Mengirimkan link reset password
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Menampilkan pesan berdasarkan status
        return $status === Password::RESET_LINK_SENT
                    ? back()->with('status', 'Kami telah mengirimkan link reset password ke email Anda!')
                    : back()->withErrors(['email' => 'Email yang Anda masukkan belum terdaftar.']);
    }

    // Menampilkan halaman untuk reset password
    public function aturulangpw($token)
    {
        return view('auth.resetpw', ['token' => $token]);
    }

    // Memperbarui password
    public function updatePassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ], [
            'token.required' => 'Token reset password diperlukan.',
            'email.required' => 'Alamat email diperlukan.',
            'email.email' => 'Format alamat email tidak valid.',
            'password.required' => 'Password diperlukan.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);

        // Mengatur ulang password
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        // Menampilkan pesan berdasarkan status
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('success', 'Password Anda telah berhasil direset!')
                    : back()->withErrors(['email' => 'Token reset password ini tidak valid.']);
    }

}
