<?php

namespace App\Http\Controllers\Pengguna;

use Carbon\Carbon;
use App\Models\Vidio;
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
        $sudah_rating = RatingKomen::where("user_id",$id_user)->where("vidio_id",$id)->count();
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
                // "sudah_rating" => $sudah_rating,
                "type_vidio" => $value->type_vidio,
            ];
        }
        return view('Main.DetailVidio.index',[
            "data" => $datas,
        ]);
    }


    public function get_rating_komen($id)
    {
        Carbon::setLocale('id');
        $data = Vidio::with(["ratingKomens","playlist"])->where("id",$id)->get();
        $ratings = [];
        foreach ($data as $key => $value) {
            $data_ratting = RatingKomen::with(["user","vidio"])->where("vidio_id",$value->id)->latest()->get();
            foreach ($data_ratting as $key => $value2) {
                $ratings[] = (object)[
                    "id" => $value2->id,
                    "bintang" => $value2->bintang,
                    "isi" => $value2->isi,
                    "foto" => $value2->user->foto,
                    "nama_user" => $value2->user->username,
                    "time_ago" => Carbon::parse($value2->created_at)->diffForHumans(),
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
