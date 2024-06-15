<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Vidio;
use App\Models\Playlist;
use App\Models\RatingKomen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Yaza\LaravelGoogleDriveStorage\Gdrive;


class KomentarVidio extends Controller
{
    /**
     * Display a listing of the resource.
     */
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


        return view('Dashboard.KomentarVidio.index',[
            "datas" => $datas,
        ]);
    }

    public function get_detail_playlist($id){
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
                    "deskripsi" => $vidio->deskripsi,
                    "thumbnail_vidio" => $vidio->thumbnail_vidio,
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

        return view('Dashboard.KomentarVidio.detail_playlist', [
            "datas" => $datas
        ]);
    }

    public function get_detail_vidio_playlist($id){
        Carbon::setLocale('id');
        // dd($id);
        $data = Vidio::with(["ratingKomens","playlist"])->where("id",$id)->get();
        $user = Auth::user();
        $ratings = [];
        foreach ($data as $key => $value) {
            $data_ratting = RatingKomen::with(["user","vidio"])->where("vidio_id",$value->id)->latest()->get();
            foreach ($data_ratting as $key => $value2) {
                $edit = false;
                if($user->id == $value2->user_id){
                    $edit = true;
                }
                $ratings[] = (object)[
                    "id" => $value2->id,
                    "bintang" => $value2->bintang,
                    "isi" => $value2->isi,
                    "user_id" => $value2->user->id,
                    "foto" => $value2->user->foto,
                    "nama_user" => $value2->user->username,
                    "time_ago" => Carbon::parse($value2->created_at)->diffForHumans(),
                    "edit" => $edit,
                ];
            }
        }

        // dd($ratings);

        return view('Dashboard.KomentarVidio.detail_vidio_playlist',[
            "datas" => $ratings,
            "vidio_id" =>$id,
        ]);
    }

    public function loadVidio($link) {
        $cacheKey = 'video_' . md5($link);
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $data = Gdrive::get($link);
        $base64_image = base64_encode($data->file);
        $url = 'data:' . $data->ext . ';base64,' . $base64_image;

        // Simpan dalam cache selama 1 jam
        Cache::put($cacheKey, $url, now()->addHour());

        return $url;
    }



    public function get_vidio_playlist($id){
        $data = Vidio::with(["ratingKomens","playlist"])->where("id",$id)->get();
        $datas = [];
        $url_link = '';
        foreach ($data as $key => $value) {
            $url_link = $value->link;
            $datas[] = (object)[
                "id" => $value->id,
                "judul" => $value->judul,
                "deskripsi" => $value->deskripsi,
                "kategori" => $value->playlist->kategori->nama_kategori,
                "time" => $value->time,
                "tanggal_upload" => $value->tanggal_upload,
                "thumbnail_vidio" => $value->thumbnail_vidio,
                "link" => $value->link,
                "type_vidio" => $value->type_vidio,
            ];
        }
        $link_new = $this->loadVidio($url_link);
        return response()->json([
            "data" => $datas,
            'video_link' => $link_new,
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
