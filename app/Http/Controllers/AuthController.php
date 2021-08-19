<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class AuthController extends Controller
{
    //
    public function index(Request $request)
    {
    	// jika sudah login (memiliki session email) maka tidak boleh akses halaman login
    	if($request->session()->has('email')){
    		return redirect('/');
    	}

    	return view('auth/index');
    }

    public function login(Request $request)
    {
    	// jika sudah login (memiliki session email) maka tidak boleh akses halaman login
    	if($request->session()->has('email')){
    		return redirect('/');
    	}

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // cek apakah di databse sudah ada akun dengan email seperti yang diinputkna
        $user = User::all()->where('email', $request->email)->first();

        // jika akun user ditemukan maka buat session
        if($user) {
            if($request->password == $user->password) {
                $request->session()->put('email', $user->email);
                $request->session()->put('id_user', $user->id);
                $request->session()->put('role_id', $user->role_id);
                

                if($user->role_id == 1) {
                	// arahkan ke halaman apoteker jika role_id = 1 (apoteker/admin) 
                	return redirect('/apoteker');
                } elseif ($user->role_id == 2) {
                	// arahkan ke halaman beranda jika role_id = 2 (pelanggan/customer) 
                	return redirect('/');
                }
                
            } else {
                return redirect('/login')->with('error', 'Gagal! Password anda salah.');
            }
        } else {
            return redirect('/login')->with('error', 'Email belum terdaftar!');
        }
    }

    public function registrationPage(Request $request)
    {
    	// jika sudah login (memiliki session email) maka tidak boleh akses halaman login
    	if($request->session()->has('email')){
    		return redirect('/');
    	}

    	return view('auth/register');
    }

    public function registration(Request $request)
    {
    	// jika sudah login (memiliki session email) maka tidak boleh akses halaman login
    	if($request->session()->has('email')){
    		return redirect('/');
    	}

        $request->validate([
            'namaLengkap' => 'required',
            'email' => 'required|email|unique:users',
            'nohp' => 'required',
            'password' => 'required|min:3|confirmed',
            'password_confirmation' => 'required',
        ]);

        // insert menggunakan query builder
        DB::table('users')->insert([
            'name' => $request->namaLengkap, 
            'email' => $request->email, 
            'password' => $request->password, 
            'no_telp' => $request->nohp, 
            'role_id' => 2, 
        ]);


    	return redirect('/login')->with('success','Akun berhasil dibuat! Silahkan login.');
    }


    public function logout(Request $request)
    {
        $request->session()->forget(['email', 'role_id', 'id_user']);
        return redirect('/login')->with('success','Anda telah keluar.');
    }
}
