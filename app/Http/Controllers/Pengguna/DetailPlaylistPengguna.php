<?php

namespace App\Http\Controllers\Pengguna;

use App\Models\Vidio;
use App\Models\Playlist;
use App\Models\RatingKomen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DetailPlaylistPengguna extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $user = Auth::user()->id;
        // dd($user->username);
        $data = Playlist::with(["vidios", "kategori"])->where("id", $id)->get();
        $datas = [];

        foreach ($data as $playlist) {
            $vidios = $playlist->vidios()->orderBy('created_at', 'asc')->get(); // Mengurutkan video berdasarkan created_at
            $count_vidio = $vidios->count();
            $id_vidio_awal = 0;

            $total_bintang = 0;
            $total_rating_count = 0;
            $vidio_data = [];
            $unlock_next = false; // variabel untuk mengatur unlock status video selanjutnya

            foreach ($vidios as $key => $vidio) {
                if($key == 0){
                    $id_vidio_awal= $vidio->id;
                }
                $ratings = RatingKomen::where("vidio_id", $vidio->id)->get();
                $rating_count = $ratings->count();
                $user_commented = RatingKomen::where("vidio_id", $vidio->id)->where("user_id", $user)->exists(); // Mengecek apakah user sudah mengomentari video ini

                foreach ($ratings as $rating) {
                    $total_bintang += $rating->bintang;
                }

                $total_rating_count += $rating_count;

                // Tentukan apakah video ini akan di-unlock
                if ($key == 0 || $unlock_next) {
                    $unlock = true;
                    $unlock_next = $user_commented; // jika user telah mengomentari video ini, unlock video berikutnya
                } else {
                    $unlock = false;
                }

                $vidio_data[] = (object)[
                    "id" => $vidio->id,
                    "judul_vidio" => $vidio->judul,
                    "time_vidio" => $vidio->time,
                    "unlock" => $unlock, // menambahkan status unlock pada video
                ];
            }

            // Menghitung rata-rata rating
            if ($total_rating_count > 0) {
                $rating_riview = $total_bintang / $total_rating_count;
            } else {
                $rating_riview = 0;
            }

            $datas[] = (object)[
                "id" => $playlist->id,
                "nama_playlist" => $playlist->nama_playlist,
                "thumbnail_playlist" => $playlist->thumbnail_playlist,
                "deskripsi_playlist" => $playlist->deskripsi_playlist,
                "kategori" => $playlist->kategori->nama_kategori,
                "total_vidio" => $count_vidio,
                "rating" => round($rating_riview,2),
                "id_vidio_awal" => $id_vidio_awal,
                "penilaian" => $total_rating_count,
                "vidio" => $vidio_data,
            ];
        }

        return view('Main.DetailPlaylist.index', [
            "datas" => $datas
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
