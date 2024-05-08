<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();

        if (request()->ajax()) {
            // dd($role);
            return datatables()->of($kategori)
                ->addIndexColumn()
                ->addColumn('action', 'Dashboard.Kategori.action')
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('Dashboard.Kategori.index');
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
            'nama_kategori' => 'required',
        ], [
            "nama_kategori.required" => "Data kategori tidak boleh kosong!",
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        Kategori::create([
            "nama_kategori" => $request->nama_kategori
        ]);
        return response()->json([
            "success" => "Data kategori berhasil ditambah !"
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
        $data = Kategori::find($id);
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
            'nama_kategori' => 'required',
        ], [
            "nama_kategori.required" => "Data kategori tidak boleh kosong!",
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }
      
        Kategori::where('id',$id)->update([
            'nama_kategori' => $request->nama_kategori,
        ]);
        return response()->json([
            "success" => "Data kategori berhasil diupdate !"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Kategori::where('id',$id)->delete();
        return response()->json([ "success" => "Data kategori berhasil dihapus !"]);
    }
}
