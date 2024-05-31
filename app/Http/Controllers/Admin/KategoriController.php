<?php

namespace App\Http\Controllers\Admin;

use Log;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

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
        // $filename = 'blog-1.jpg';
        // $filePath = public_path('assets/img/blog/'.$filename);
        // if (File::exists($filePath)) {
        //     $fileData = File::get($filePath);
        //     Storage::disk('google')->put($filename, $fileData);
        //     return response()->json([
        //         "success" => "Data kategori berhasil ditambah !"
        //     ]);
        // } else {
        //     return response()->json(['error' => 'File not found at path: ' . $filePath], 404);
        // }
        // $filename = 'blog-1.jpg';
        // // Gdrive::put('blog-1.jpg', public_path('assets/img/blog/'.$filename));
        // $data = Gdrive::get($filename);

        // $base64_image = base64_encode($data->file);
        // $url = 'data:' . $data->ext . ';base64,' . $base64_image;

        // return response()->json(['success' => $url], 200);
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
            "success" => "Data kategori berhasil ditambahkan !"
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
