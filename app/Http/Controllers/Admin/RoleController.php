<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = Role::all();

        if (request()->ajax()) {
            // dd($role);
            return datatables()->of($role)
                ->addIndexColumn()
                ->addColumn('action', 'Dashboard.Role.action')
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('Dashboard.Role.index');
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
        $validator = Validator::make($request->all(), [
            'nama_role' => 'required',
        ], [
            "nama_role.required" => "Data role tidak boleh kosong!",
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        Role::create([
            "nama_role" => $request->nama_role
        ]);
        return response()->json([
            "success" => "Data role berhasil ditambahkan !"
        ]);
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
        $data = Role::find($id);
        return response()->json([
            "data" => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_role' => 'required',
        ], [
            "nama_role.required" => "Data role tidak boleh kosong!",
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }
      
        Role::where('id',$id)->update([
            'nama_role' => $request->nama_role,
        ]);
        return response()->json([
            "success" => "Data role berhasil diupdate !"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::where('id',$id)->delete();
        return response()->json([ "success" => "Data role berhasil dihapus !"]);
    }
}
