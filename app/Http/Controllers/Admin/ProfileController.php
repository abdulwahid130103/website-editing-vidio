<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::where('id', $id)->first();
        $role = getRole();
        return response()->json([
            'data' => $data,
            'role' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = Validator::make($request->all(),[
            'nama_lengkap' => 'required',
            'username' => 'required',
            'email' => 'required',
            'role_id' => 'required|integer|exists:role,id',
            'no_telfon' => 'required',
            'alamat' => 'required'
        ],[
            'nama_lengkap.required' => "Nama lengkap tidak boleh kosong !!",
            'username.required' => "username tidak boleh kosong !!",
            'email.required' => "email tidak boleh kosong !!",
            'role_id.required' => "role tidak boleh kosong !!",
            'role_id.integer' => "role tidak boleh kosong.",
            'role_id.exists' => "role tidak valid.",
            'no_telfon.required' => "telfon tidak boleh kosong !!",
            'alamat.required' => "alamat tidak boleh kosong !!"
        ]);

        if($validasi->fails()){
            return response()->json(['status' => 0 ,'error'=> $validasi->errors()]);
        }else{
            if (!empty($request->file('foto_profile'))) {

                if($request->input('foto_lama_profile')){
                    $old_picture_path = public_path('storage/user/'.$request->input('foto_lama_profile'));
                    if (file_exists($old_picture_path)) {
                        unlink($old_picture_path);
                    }
                }
                $gambar = $request->file('foto_profile');
                $nama_gambar =  "Usr".date('dmy') . time(). '.' . $gambar->getClientOriginalExtension();
                $path = public_path('storage/user/') . $nama_gambar;
                Image::make($gambar)->save($path);

                $newdata = [
                    'nama_lengkap' => $request->nama_lengkap,
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'email' => $request->email,
                    'role_id' => $request->role_id,
                    'no_telfon' => $request->no_telfon,
                    'alamat' => $request->alamat,
                    'foto' => $nama_gambar
                ];
            }else{
                $newdata = [
                    'nama_lengkap' => $request->nama_lengkap,
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'email' => $request->email,
                    'role_id' => $request->role_id,
                    'no_telfon' => $request->no_telfon,
                    'alamat' => $request->alamat,
                    'foto' => $request->foto_lama_profile
                ];
            }
            User::where('id', $id)->update($newdata);
            return response()->json(["success" => "Berhasil update profile !"]);
        }
    }

    public function ganti_password(Request $request){
        $user = Auth::user()->id;
        $validasi = Validator::make($request->all(),[
            'password' => 'required'
        ],[
            'password.required' => "password tidak boleh kosong !!"
        ]);

        if($validasi->fails()){
            return response()->json(['status' => 0 ,'error'=> $validasi->errors()->all()]);
        }else{
            $newdata = [
                'password' => Hash::make($request->password)
            ];
            User::where('id', $user)->update($newdata);
            return response()->json(["success" => "Berhasil update password user"]);
        }

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
