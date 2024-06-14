<?php

namespace App\Http\Controllers\Pengguna;

use App\Models\Playlist;
use App\Models\RatingKomen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kategori;

class VidioPenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return view('Main.Vidio.index');
    }

    public function get_list_vidio_main(Request $request){
        $query = Playlist::with(["vidios", "kategori"]);
        if($request->data == "kategori"){
            $query->where("kategori_id",$request->kategori_id);
        }
        if($request->filter){
            if($request->isi_filter == "terbaru"){
                $query->latest();
            }elseif($request->isi_filter == "terlama"){
                $query->oldest();
            }
        }


        $data = $query->get();
        $datas = [];

        foreach ($data as $playlist) {
            $vidios = $playlist->vidios;
            $count_vidio = $vidios->count();

            $total_bintang = 0;
            $total_rating_count = 0;

            foreach ($vidios as $vidio) {
                $ratings = RatingKomen::where("vidio_id", $vidio->id)->get();
                $rating_count = $ratings->count();

                $total_rating_count += $rating_count;
                foreach ($ratings as $rating) {
                    $total_bintang += $rating->bintang;
                }
            }

            if ($total_rating_count > 0) {
                $rating_riview = $total_bintang / $total_rating_count;
            } else {
                $rating_riview = 0;
            }

            $datas[] = (object)[
                "id" => $playlist->id,
                "nama_playlist" => $playlist->nama_playlist,
                "thumbnail_playlist" => $playlist->thumbnail_playlist,
                "kategori" => $playlist->kategori->nama_kategori,
                "total_vidio" => $count_vidio,
                "rating" => round($rating_riview,2),
            ];
        }
        return response()->json([
            "data" => $datas
        ]);
    }


    public function get_list_kategori(){
        $data = Kategori::with("playlists")->latest()->get();
        return response()->json([
            "data" => $data
        ]);
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
        //
    }
}
