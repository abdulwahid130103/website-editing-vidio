<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::with(['ratingKomens','role'])->latest()->get();

        if (request()->ajax()) {
            // dd($role);
            return datatables()->of($user)
                ->addIndexColumn()
                ->addColumn('role_id', function ($model){
                    return $model->role->nama_role;
                }) 
                ->addColumn('action', 'Dashboard.user.action')
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('Dashboard.User.index');
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
        $validasi = Validator::make($request->all(),[
            'nama_lengkap' => 'required',
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
            'role_id' => 'required|integer|exists:role,id',
            'no_telfon' => 'required|integer',
            'alamat' => 'required'
        ],[
            'nama_lengkap.required' => "Nama lengkap tidak boleh kosong !!",
            'username.required' => "username tidak boleh kosong !!",
            'password.required' => "password tidak boleh kosong !!",
            'email.required' => "email tidak boleh kosong !!",
            'role_id.required' => "role tidak boleh kosong !!",
            'role_id.integer' => "role tidak boleh kosong.",
            'role_id.exists' => "role tidak valid.",
            'no_telfon.required' => "telfon tidak boleh kosong !!",
            'no_telfon.integer' => "telfon harus angka !!",
            'alamat.required' => "alamat tidak boleh kosong !!"
        ]);

        if($validasi->fails()){
            return response()->json(['status' => 0 ,'error'=> $validasi->errors()->all()]);
        }else{
            $filename = null;
            $name =  "Usr".date('dmy') . time();
            if ($request->hasFile('foto')) {
                $gambar = $request->file('foto');
                $directory = public_path('storage/user/');
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }
                $filename = $name. '.' . $gambar->getClientOriginalExtension();
                $path = $directory . $filename;
                Image::make($gambar)->save($path);
                User::create([
                    'nama_lengkap' => $request->nama_lengkap,
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'email' => $request->email,
                    'role_id' => $request->role_id,
                    'no_telfon' => $request->no_telfon,
                    'alamat' => $request->alamat,
                    'foto' => $filename
                ]);

            }else{
                return response()->json(['status' => 0 ,'errorgambar'=> "Foto tidak boleh kosong !"]);
            }
    
            return response()->json(["success" => "Berhasil menyimpan data user"]);
        }
    }

    public function ganti_password(Request $request){
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
            User::where('id', $request->id)->update($newdata);
            return response()->json(["success" => "Berhasil update password user"]);
        }
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = User::where('id', $id)->first();
        $role = getRole();
        return response()->json([
            'data' => $data,
            'role' => $role
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        
        if($user->foto != null){
            $gambar_path = public_path("storage/user/{$user->foto}");
            if (file_exists($gambar_path)) {
                unlink($gambar_path);
            }
        }
    
        $user->delete();
        return response()->json(['success' => "berhasil menghapus data user"]);
    }
}
