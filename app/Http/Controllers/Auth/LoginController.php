<?php

namespace App\Http\Controllers\Auth;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('Auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            "email.required" => "Emailtidak boleh kosong!",
            "email.email" => "Email tidak valid!",
            "password.required" => "Password tidak boleh kosong!",
        ]);

        if ($credentials->fails()) {
            return response()->json(['error' => $credentials->errors()->all()]);
        }

        if (Auth::attempt([
            "email" => $request->email,
            "password" => $request->password,
        ])) {
            $userRole = Auth::user()->role->nama_role;
            $request->session()->regenerate();
            // dd($userRole);
            if ($userRole == 'admin') {
                return response()->json(
                    [
                        'success' => true,
                        'isi' => "Berhasil login !",
                        'redirect_url' => route('dashboard.index')
                    ]);
            } elseif ($userRole == 'pengguna') {
                return response()->json(['success' => true,'isi' => "Berhasil login !", 'redirect_url' => url('/')]);
            }
        }

        return response()->json(['error_is_email' => "Email belum terdaftar !"]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
