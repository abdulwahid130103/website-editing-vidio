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
        $data = Playlist::with(["vidios", "kategori"])->latest()->get();
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

        // dd($datas);
        return view('Main.home.index',["datas" => $datas]);
    }
}
