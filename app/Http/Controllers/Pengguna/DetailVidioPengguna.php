<?php

namespace App\Http\Controllers\Pengguna;

use Carbon\Carbon;
use App\Models\Vidio;
use App\Models\Playlist;
use App\Models\RatingKomen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DetailVidioPengguna extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        // dd($id);
        $id_user = Auth::user()->id;
        $data = Vidio::with(["ratingKomens","playlist"])->where("id",$id)->get();
        $datas = [];
        foreach ($data as $key => $value) {
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
        return view('Main.DetailVidio.index',[
            "data" => $datas,
        ]);
    }

    public function get_list_vidio($id){
        $user = Auth::user()->id;
        $vd = Vidio::with(["ratingKomens", "playlist"])->where("id", $id)->first();
        $data = Playlist::with(["vidios", "kategori"])->where("id", $vd->playlist_id)->get();
        $datas = [];
        $video_order = null; // Menyimpan urutan video

        foreach ($data as $playlist) {
            $vidios = $playlist->vidios()->orderBy('created_at', 'asc')->get(); // Mengurutkan video berdasarkan created_at
            $count_vidio = $vidios->count();

            $total_bintang = 0;
            $total_rating_count = 0;
            $vidio_data = [];
            $unlock_next = false; // variabel untuk mengatur unlock status video selanjutnya

            foreach ($vidios as $key => $vidio) {
                if ($vidio->id == $id) {
                    $video_order = $key + 1; // Menyimpan urutan video (index + 1)
                }

                $ratings = RatingKomen::where("vidio_id", $vidio->id)->get();
                $rating_count = $ratings->count();
                $user_commented = RatingKomen::where("vidio_id", $vidio->id)->where("user_id", $user)->exists(); // Mengecek apakah user sudah mengomentari video ini

                foreach ($ratings as $rating) {
                    $total_bintang += $rating->bintang;
                }

                $total_rating_count += $rating_count;

                if ($key == 0 || $unlock_next) {
                    $unlock = true;
                    $unlock_next = $user_commented;
                } else {
                    $unlock = false;
                }

                $vidio_data[] = (object)[
                    "id" => $vidio->id,
                    "thumbnail_vidio" => $vidio->thumbnail_vidio,
                    "judul_vidio" => $vidio->judul,
                    "time_vidio" => $vidio->time,
                    "unlock" => $unlock,
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
                "rating" => $rating_riview,
                "penilaian" => $total_rating_count,
                "vidio" => $vidio_data,
            ];
        }

        // dd($video_order);

        return response()->json([
            "data" => $datas,
            "order_of_video" => $video_order
        ]);
    }


    public function get_detail_vidio($id){
        $id_user = Auth::user()->id;
        $data = Vidio::with(["ratingKomens","playlist"])->where("id",$id)->get();
        $datas = [];
        foreach ($data as $key => $value) {
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
        return response()->json([
            "data" => $datas,
        ]);
    }

    public function get_input_comment($id){
        $user = Auth::user();
        $sudah_rating = RatingKomen::where("user_id",$user->id)->where("vidio_id",$id)->count();
        return response()->json([
            "data" => $sudah_rating,
            "foto" => $user->foto,
        ]);
    }

    public function edit_input_comment($id){
        $user = Auth::user();
        $data = RatingKomen::where("id",$id)->first();
        return response()->json([
            "data" => $data,
            "foto" => $user->foto,
        ]);
    }

    public function get_rating_komen($id)
    {
        Carbon::setLocale('id');
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
        return response()->json([
            "ratings" => $ratings
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
    public function store_comment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'required',
            'rating' => 'required|integer|min:1',
        ], [
            "comment.required" => "Comment tidak boleh kosong!",
            "rating.required" => "Rating tidak boleh kosong!",
            'rating.min' => 'Rating tidak boleh 0!',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $id_user = Auth::user()->id;

        RatingKomen::create([
            "isi" => $request->comment,
            "bintang" => $request->rating,
            "vidio_id" => $request->vidio_id,
            "user_id" => $id_user,
        ]);
        return response()->json([
            "success" => "Terima kasih sudah memberikan rating dan comment !"
        ]);
    }
    public function update_comment(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'required',
            'rating' => 'required|integer|min:1',
        ], [
            "comment.required" => "Comment tidak boleh kosong!",
            "rating.required" => "Rating tidak boleh kosong!",
            'rating.min' => 'Rating tidak boleh 0!',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        RatingKomen::where("id", $id)->update([
            "isi" => $request->comment,
            "bintang" => $request->rating,
        ]);
        return response()->json([
            "success" => "Berhasil update comment anda !"
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
