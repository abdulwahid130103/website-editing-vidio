<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Vidio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class VidioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vidio = Vidio::with(['ratingKomens','playlist'])->latest()->get();

        if (request()->ajax()) {
            // dd($role);
            return datatables()->of($vidio)
                ->addIndexColumn()
                ->addColumn('playlist_id', function ($model){
                    return $model->playlist->nama_playlist;
                }) 
                ->addColumn('action', 'Dashboard.vidio.action')
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('Dashboard.Vidio.index');
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
            'judul' => 'required',
            'link' => 'required',
            'deskripsi' => 'required',
            'is_active' => 'required',
            'playlist_id' => 'required|integer|exists:playlist,id'
        ],[
            'judul.required' => "Judul vidio tidak boleh kosong !!",
            'link.required' => "link vidio tidak boleh kosong !!",
            'deskripsi.required' => "Deskripsi vidio tidak boleh kosong !!",
            'is_active.required' => "Status vidio tidak boleh kosong !!",
            'playlist_id.required' => "Playlist tidak boleh kosong !!",
            'playlist_id.integer' => "Playlist tidak boleh kosong.",
            'playlist_id.exists' => "Playlist tidak valid."
        ]);

        if($validasi->fails()){
            return response()->json(['status' => 0 ,'error'=> $validasi->errors()->all()]);
        }else{
            $filename = null;
            $name =  "VD".date('dmy') . time();
            if ($request->hasFile('thumbnail_vidio')) {
                $gambar = $request->file('thumbnail_vidio');
                $directory = public_path('storage/vidio/');
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }
                $filename = $name. '.' . $gambar->getClientOriginalExtension();
                $path = $directory . $filename;
                Image::make($gambar)->save($path);
                Vidio::create([
                    'judul' => $request->judul,
                    'link' => $request->link,
                    'deskripsi' => $request->deskripsi,
                    'is_active' => (int)$request->is_active,
                    'tanggal_upload' =>date('Y-m-d'),
                    'playlist_id' => (int)$request->playlist_id,
                    'thumbnail_vidio' => $filename
                ]);

            }else{
                return response()->json(['errorgambar'=> "Thumbnail tidak boleh kosong !"]);
            }
    
        }
                       
        return response()->json(["success" => "Berhasil menyimpan data vidio"]);
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
        $data = Vidio::where('id', $id)->first();
        $playlist = getPlaylist();
        return response()->json([
            'data' => $data,
            'playlist' => $playlist
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = Validator::make($request->all(),[
            'judul' => 'required',
            'link' => 'required',
            'deskripsi' => 'required',
            'is_active' => 'required',
            'playlist_id' => 'required|integer|exists:playlist,id'
        ],[
            'judul.required' => "Judul vidio tidak boleh kosong !!",
            'link.required' => "link vidio tidak boleh kosong !!",
            'deskripsi.required' => "Deskripsi vidio tidak boleh kosong !!",
            'is_active.required' => "Status vidio tidak boleh kosong !!",
            'playlist_id.required' => "Playlist tidak boleh kosong !!",
            'playlist_id.integer' => "Playlist tidak boleh kosong.",
            'playlist_id.exists' => "Playlist tidak valid."
        ]);

        if($validasi->fails()){
            return response()->json(['status' => 0 ,'error'=> $validasi->errors()]);
        }else{
            if (!empty($request->file('thumbnail_vidio'))) {
    
                if($request->input('thumbnail_vidio_lama')){
                    $old_picture_path = public_path('storage/vidio/'.$request->input('thumbnail_vidio_lama'));
                    if (file_exists($old_picture_path)) {
                        unlink($old_picture_path);
                    }   
                }
                $gambar = $request->file('thumbnail_vidio');
                $nama_gambar =  "VD".date('dmy') . time(). '.' . $gambar->getClientOriginalExtension();
                $path = public_path('storage/vidio/') . $nama_gambar;
                Image::make($gambar)->save($path);
                
                $newdata = [
                    'judul' => $request->judul,
                    'link' => $request->link,
                    'deskripsi' => $request->deskripsi,
                    'is_active' => (int)$request->is_active,
                    'playlist_id' => (int)$request->playlist_id,
                    'thumbnail_vidio' => $nama_gambar
                ];
            }else{
                $newdata = [
                    'judul' => $request->judul,
                    'link' => $request->link,
                    'deskripsi' => $request->deskripsi,
                    'is_active' => (int)$request->is_active,
                    'playlist_id' => (int)$request->playlist_id,
                    'thumbnail_vidio' => $request->thumbnail_vidio_lama
                ];
            }
            Vidio::where('id', $id)->update($newdata);
            return response()->json(["success" => "Berhasil update data vidio"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vidio = Vidio::findOrFail($id);
        
        if($vidio->thumbnail_vidio != null){
            $gambar_path = public_path("storage/vidio/{$vidio->thumbnail_vidio}");
            if (file_exists($gambar_path)) {
                unlink($gambar_path);
            }
        }
    
        $vidio->delete();
        return response()->json(['success' => "berhasil menghapus data vidio"]);
    }
}
