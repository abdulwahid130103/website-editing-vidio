<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\RatingKomen;
use App\Models\Vidio;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = Playlist::with(["vidios","kategori"])->latest()->get();
        $datas = [];
        foreach ($data as $key => $value) {
            $count_vidio = Vidio::where("playlist_id",$value->id)->count();
            $get_vidio = Vidio::where("playlist_id",$value->id)->get();
            $rating_riview = 0;
            if(!is_null($get_vidio)){
                foreach ($get_vidio as $key => $value2) {
                    $rating = RatingKomen::where("vidio_id",$value2->id)->get();
                    $rating_count = RatingKomen::where("vidio_id",$value2->id)->count();
                    foreach ($rating as $key => $value3) {
                        $rating_riview += $value3->bintang;
                    }
                   if($rating_riview == 0){
                        $rating_riview = 0;
                   }else{
                        if((!is_null($rating_riview) && !is_null($rating_count)) && ($rating_riview != 0 && $rating_count != 0)){
                            $rating_riview = ($rating_riview / $rating_count);
                            $count_penilaian = $rating_count;
                        }
                   }
                }
            }
            $datas[] = (object)[
                "id" => $value->id,
                "nama_playlist" => $value->nama_playlist,
                "thumbnail_playlist" => $value->thumbnail_playlist,
                "kategori" => $value->kategori->nama_kategori,
                "total_vidio" => $count_vidio,
                "rating" => $rating_riview,
            ];

        }
        // dd($datas);
        return view('Main.home.index',["datas" => $datas]);
    }
}
