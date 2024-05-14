<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class PlaylistController extends Controller
{
    public function index()
    {
        $playlist = Playlist::with(['vidios','kategori'])->latest()->get();

        if (request()->ajax()) {
            // dd($role);
            return datatables()->of($playlist)
                ->addIndexColumn()
                ->addColumn('kategori_id', function ($model){
                    return $model->kategori->nama_kategori;
                }) 
                ->addColumn('action', 'Dashboard.Playlist.action')
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('Dashboard.Playlist.index');
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
            'nama_playlist' => 'required',
            'kategori_id' => 'required|integer|exists:kategori,id'
        ],[
            'nama_playlist.required' => "Nama playlist tidak boleh kosong !!",
            'kategori_id.required' => "Kategori tidak boleh kosong !!",
            'kategori_id.integer' => "Kategori tidak boleh kosong.",
            'kategori_id.exists' => "Kategori tidak valid."
        ]);

        if($validasi->fails()){
            return response()->json(['status' => 0 ,'error'=> $validasi->errors()->all()]);
        }else{
            $filename = null;
            $name =  "PL".date('dmy') . time();
            if ($request->hasFile('thumbnail_playlist')) {
                $gambar = $request->file('thumbnail_playlist');
                $directory = public_path('storage/playlist/');
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }
                $filename = $name. '.' . $gambar->getClientOriginalExtension();
                $path = $directory . $filename;
                Image::make($gambar)->save($path);
                Playlist::create([
                    'nama_playlist' => $request->nama_playlist,
                    'kategori_id' => $request->kategori_id,
                    'thumbnail_playlist' => $filename
                ]);

            }else{
                return response()->json(['errorgambar'=> "Thumbnail tidak boleh kosong !"]);
            }
    
            return response()->json(["success" => "Berhasil menyimpan data playlist"]);
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
        $data = Playlist::where('id', $id)->first();
        $kategori = getKategori();
        return response()->json([
            'data' => $data,
            'kategori' => $kategori
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = Validator::make($request->all(),[
            'nama_playlist' => 'required',
            'kategori_id' => 'required'
        ],[
            'nama_playlist.required' => "Nama playlist tidak boleh kosong !!",
            'kategori_id.required' => "Kategori tidak boleh kosong !!"
        ]);

        if($validasi->fails()){
            return response()->json(['status' => 0 ,'error'=> $validasi->errors()]);
        }else{
            if (!empty($request->file('thumbnail_playlist'))) {
    
                if($request->input('thumbnail_playlist_lama')){
                    $old_picture_path = public_path('storage/playlist/'.$request->input('thumbnail_playlist_lama'));
                    if (file_exists($old_picture_path)) {
                        unlink($old_picture_path);
                    }   
                }
                $gambar = $request->file('thumbnail_playlist');
                $nama_gambar =  "PG".date('dmy') . time(). '.' . $gambar->getClientOriginalExtension();
                $path = public_path('storage/playlist/') . $nama_gambar;
                Image::make($gambar)->save($path);
                
                $newdata = [
                    'nama_playlist' => $request->nama_playlist,
                    'kategori_id' => $request->kategori_id,
                    'thumbnail_playlist' => $nama_gambar
                ];
            }else{
                $newdata = [
                    'nama_playlist' => $request->nama_playlist,
                    'kategori_id' => $request->kategori_id,
                    'thumbnail_playlist' => $request->thumbnail_playlist_lama
                ];
            }
            Playlist::where('id', $id)->update($newdata);
            return response()->json(["success" => "Berhasil update data playlist"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $playlist = Playlist::findOrFail($id);
        
        if($playlist->thumbnail_playlist != null){
            $gambar_path = public_path("storage/playlist/{$playlist->thumbnail_playlist}");
            if (file_exists($gambar_path)) {
                unlink($gambar_path);
            }
        }
    
        $playlist->delete();
        return response()->json(['success' => "berhasil menghapus data playlist"]);
    }
}
