<?php

namespace App\Http\Controllers\Pengguna;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class UpdatePasswordPengguna extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Main.UpdatePassword.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
