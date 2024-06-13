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
        $data = Playlist::with(["vidios", "kategori"])->where("id", $id)->get();
        $datas = [];
        $vidio = [];
        $rating_riview = 0;
        $count_penilaian = 0;
        $unlock_next = false; // variabel untuk mengatur unlock status video selanjutnya

        foreach ($data as $key => $value) {
            $count_vidio = Vidio::where("playlist_id", $value->id)->count();
            $get_vidio = Vidio::where("playlist_id", $value->id)->orderBy('created_at', 'asc')->get(); // Mengurutkan video berdasarkan created_at

            if (!is_null($get_vidio)) {
                foreach ($get_vidio as $key => $value2) {
                    $rating = RatingKomen::where("vidio_id", $value2->id)->get();
                    $rating_count = RatingKomen::where("vidio_id", $value2->id)->count();
                    $user_commented = RatingKomen::where("vidio_id", $value2->id)->where("user_id", $user)->exists(); // Mengecek apakah user sudah mengomentari video ini

                    if (!is_null($rating)) {
                        foreach ($rating as $key => $value3) {
                            $rating_riview += $value3->bintang;
                        }
                    }

                    if ($rating_riview == 0) {
                        $rating_riview = 0;
                        $count_penilaian = 0;
                    } else {
                        if ((!is_null($rating_riview) && !is_null($rating_count)) && ($rating_riview != 0 && $rating_count != 0)) {
                            $rating_riview = ($rating_riview / $rating_count);
                            $count_penilaian = $rating_count;
                        }
                    }

                    // Tentukan apakah video ini akan di-unlock
                    if ($key == 0 || $unlock_next) {
                        $unlock = true;
                        $unlock_next = $user_commented; // jika user telah mengomentari video ini, unlock video berikutnya
                    } else {
                        $unlock = false;
                    }

                    $vidio[] = (object)[
                        "id" => $value2->id,
                        "judul_vidio" => $value2->judul,
                        "time_vidio" => $value2->time,
                        "unlock" => $unlock, // menambahkan status unlock pada video
                    ];
                }
            }

            $datas[] = (object)[
                "id" => $value->id,
                "nama_playlist" => $value->nama_playlist,
                "thumbnail_playlist" => $value->thumbnail_playlist,
                "deskripsi_playlist" => $value->deskripsi_playlist,
                "kategori" => $value->kategori->nama_kategori,
                "total_vidio" => $count_vidio,
                "rating" => $rating_riview,
                "penilaian" => $count_penilaian,
                "vidio" => $vidio,
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
