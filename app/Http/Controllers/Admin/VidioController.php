<?php

namespace App\Http\Controllers\Admin;

// use ___PHPSTORM_HELPERS\object;
use Throwable;
use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;
use App\Models\Vidio;
use Illuminate\Http\Request;
use FFMpeg\Format\Video\X264;
use FFMpeg\Coordinate\Dimension;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;
use FFMpeg\Filters\Video\ResizeFilter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class VidioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vidio = Vidio::with(['ratingKomens','playlist'])->latest()->get();
        // $this->convertVideo();
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

    public function convertVideo(){
        $filePath = public_path("video/done_so.mp4");

        $formats = $this->getVideoFormats($filePath);
        foreach ($formats as $value) {
            $result = $this->convertToResolution($filePath,$value);
        }

        return response()->json(["message" => "Video berhasil di convert !"]);
    }

    public function getVideoFormats($filePath){
        $ffprobe = FFProbe::create();

        $resolution = $ffprobe->streams($filePath)->videos()->first()->get('width').'x'.$ffprobe->streams($filePath)->videos()->first()->get('height');
        if($resolution ==  '1920x1080'){
            $formats = [
                ['rate' => '4096','resolution'=>'1080p','format'=> new X264('aac','libx264','mp4'),'dimension'=> new Dimension(1920,1080),'dim1'=>1920,'dim1'=>1080],
                ['rate' => '2048','resolution'=>'720p','format'=> new X264('aac','libx264','mp4'),'dimension'=> new Dimension(1280,720),'dim1'=>1280,'dim1'=>720],
                ['rate' => '750','resolution'=>'480','format'=> new X264('aac','libx264','mp4'),'dimension'=> new Dimension(854,480),'dim1'=>854,'dim1'=>480],
                ['rate' => '276','resolution'=>'360','format'=> new X264('aac','libx264','mp4'),'dimension'=> new Dimension(480,360),'dim1'=>480,'dim1'=>360],
            ];
        }elseif($resolution == '1280x720'){
            $formats = [
                ['rate' => '2048','resolution'=>'720p','format'=> new X264('aac','libx264','mp4'),'dimension'=> new Dimension(1280,720),'dim1'=>1280,'dim1'=>720],
                ['rate' => '750','resolution'=>'480','format'=> new X264('aac','libx264','mp4'),'dimension'=> new Dimension(854,480),'dim1'=>854,'dim1'=>480],
                ['rate' => '276','resolution'=>'360','format'=> new X264('aac','libx264','mp4'),'dimension'=> new Dimension(480,360),'dim1'=>480,'dim1'=>360],
            ];
        }elseif($resolution == '854x480'){
            $formats = [
                ['rate' => '750','resolution'=>'480','format'=> new X264('aac','libx264','mp4'),'dimension'=> new Dimension(854,480),'dim1'=>854,'dim1'=>480],
                ['rate' => '276','resolution'=>'360','format'=> new X264('aac','libx264','mp4'),'dimension'=> new Dimension(480,360),'dim1'=>480,'dim1'=>360],
            ];
        }else{
            $formats = [];
        }

        return $formats;
    }

    public function convertToResolution($filePath,$format){
        $uuid = uniqid();
        $randomVideoName = "$uuid -".$format['resolution'].".mp4";

        if(! \File::exists(public_path('encode/'))){
            $path = public_path('encode/');
            \File::makeDirectory($path,0777,true,true);
        }

        $output = public_path('encode/'.$randomVideoName);

        $resizeFilter = new ResizeFilter($format['dimension'],['-crf','23']);
        $ffmpeg = FFMpeg::create();
        $video = $ffmpeg->open($filePath);

        $formats = new X264('libmp3lame','libx264');
        $formats->setKiloBitrate($format['rate']);

        $video->addFilter($resizeFilter)->save($formats,$output);

        return (object)['success' => true,'convertedVideoName' => $randomVideoName];
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
            'deskripsi' => 'required',
            'type_vidio' => 'required',
            'is_active' => 'required',
            'time' => 'required',
            'playlist_id' => 'required|integer|exists:playlist,id'
        ],[
            'judul.required' => "Judul vidio tidak boleh kosong !!",
            'type_vidio.required' => "Type vidio vidio tidak boleh kosong !!",
            'deskripsi.required' => "Deskripsi vidio tidak boleh kosong !!",
            'is_active.required' => "Status vidio tidak boleh kosong !!",
            'time.required' => "Durasi vidio tidak boleh kosong !!",
            'playlist_id.required' => "Playlist tidak boleh kosong !!",
            'playlist_id.integer' => "Playlist tidak boleh kosong.",
            'playlist_id.exists' => "Playlist tidak valid."
        ]);

        if($validasi->fails()){
            return response()->json(['status' => 0 ,'error'=> $validasi->errors()->all()]);
        }else{
            // dd($request);
            if (!$request->hasFile('upload_vidio') && is_null($request->link)){
                return response()->json(['status' => 0 ,'error_file'=> "Link / upload tidak boleh kosong !"]);
            }
            if (!$request->hasFile('thumbnail_vidio')) {
                return response()->json(['errorgambar'=> "Thumbnail tidak boleh kosong !"]);
            }
            $filename = null;
            $filename2 = null;
            $name =  "VDO".date('dmy') . time();
            if ($request->hasFile('upload_vidio')) {
                $gambar = $request->file('upload_vidio');
                $filename2 = $name. '.' . $gambar->getClientOriginalExtension();
                Storage::disk('google')->put($filename2, file_get_contents($gambar));
            }

            if(!is_null($request->link)){
                if(preg_match('/https:\/\/(www\.)?youtube\.com\/embed|youtu\.be/', $request->link)){
                    $filename2 = $request->link;
                } else {
                    return response()->json(['status' => 0 ,'error_file'=> "Link hanya bisa vidio youtube !"]);
                }
            }

            // dd("tidak");
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
                    'link' => $filename2,
                    'deskripsi' => (string)$request->deskripsi,
                    'time' => $request->time,
                    'type_vidio' => $request->type_vidio,
                    'is_active' => (int)$request->is_active,
                    'tanggal_upload' =>date('Y-m-d'),
                    'playlist_id' => (int)$request->playlist_id,
                    'thumbnail_vidio' => $filename,
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

    // public function loadVidio($link) {
    //     $data = Gdrive::get($link);

    //     $base64_image = base64_encode($data->file);
    //     $url = 'data:' . $data->ext . ';base64,' . $base64_image;
    //     return $url;
    // }
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
    public function edit(string $id)
    {
        $data = Vidio::where('id', $id)->first();
        $playlist = getPlaylist();

        $Link = $this->loadVidio($data->link);

        return response()->json([
            'data' => $data,
            'playlist' => $playlist,
            'video_link' => $Link,
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */

    public function cekVidioLinkSama($id,$value){
        $data = Vidio::where('id', $id)->where('link',$value)->count();
        if($data >= 1){
            return true;
        }else{
            return false;
        }
    }

    public function getVidioLama($id){
        $data = Vidio::where('id', $id)->first();
        if($data){
            return $data->link;
        }else{
            return null;
        }
    }
    public function update(Request $request, string $id)
    {
        $validasi = Validator::make($request->all(),[
            'judul' => 'required',
            'deskripsi' => 'required',
            'is_active' => 'required',
            'time' => 'required',
            'playlist_id' => 'required|integer|exists:playlist,id'
        ],[
            'judul.required' => "Judul vidio tidak boleh kosong !!",
            'deskripsi.required' => "Deskripsi vidio tidak boleh kosong !!",
            'is_active.required' => "Status vidio tidak boleh kosong !!",
            'time.required' => "Durasi vidio tidak boleh kosong !!",
            'playlist_id.required' => "Playlist tidak boleh kosong !!",
            'playlist_id.integer' => "Playlist tidak boleh kosong.",
            'playlist_id.exists' => "Playlist tidak valid."
        ]);

        if($validasi->fails()){
            return response()->json(['status' => 0 ,'errors'=> $validasi->errors()->all()]);
        }else{
            $filename_vidio = null;
            $filename_thumbnail = null;
            if($request->type_vidio == "upload"){
                if(!empty($request->file('upload'))){
                    $cekNameVidio = $this->getVidioLama($id);
                    if($cekNameVidio != null){
                        Gdrive::delete($cekNameVidio);
                        $name =  "VDO".date('dmy') . time();
                        $gambar = $request->file('upload');
                        $filename_vidio = $name. '.' . $gambar->getClientOriginalExtension();
                        Storage::disk('google')->put($filename_vidio, file_get_contents($gambar));
                    }else{
                        return response()->json(['status' => 0 ,'error_file'=> "Vidio tidak ada !"]);
                    }
                }
            }else{
                if(is_null($request->link)){
                    return response()->json(['status' => 0 ,'error_file'=> "Link tidak boleh kosong !"]);
                }
                if(!is_null($request->link)){
                    if(preg_match('/https:\/\/(www\.)?youtube\.com\/embed|youtu\.be/', $request->link)){
                        if(!$this->cekVidioLinkSama($id,$request->link)){
                            $filename_vidio = $request->link;
                        }
                    } else {
                        return response()->json(['status' => 0 ,'error_file'=> "Link hanya bisa vidio youtube !"]);
                    }
                }
            }


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

                if($filename_vidio != null){
                    $newdata = [
                        'judul' => $request->judul,
                        'link' => $filename_vidio,
                        'type_vidio' => $request->type_vidio,
                        'time' => $request->time,
                        'deskripsi' => $request->deskripsi,
                        'is_active' => (int)$request->is_active,
                        'playlist_id' => (int)$request->playlist_id,
                        'thumbnail_vidio' => $nama_gambar
                    ];
                }else{
                    $newdata = [
                        'judul' => $request->judul,
                        'type_vidio' => $request->type_vidio,
                        'time' => $request->time,
                        'deskripsi' => $request->deskripsi,
                        'is_active' => (int)$request->is_active,
                        'playlist_id' => (int)$request->playlist_id,
                        'thumbnail_vidio' => $nama_gambar
                    ];
                }
            }else{
                if($filename_vidio != null){
                    $newdata = [
                        'judul' => $request->judul,
                        'link' => $filename_vidio,
                        'type_vidio' => $request->type_vidio,
                        'time' => $request->time,
                        'deskripsi' => $request->deskripsi,
                        'is_active' => (int)$request->is_active,
                        'playlist_id' => (int)$request->playlist_id,
                        'thumbnail_vidio' => $request->thumbnail_vidio_lama
                    ];
                }else{
                    $newdata = [
                        'judul' => $request->judul,
                        'type_vidio' => $request->type_vidio,
                        'time' => $request->time,
                        'deskripsi' => $request->deskripsi,
                        'is_active' => (int)$request->is_active,
                        'playlist_id' => (int)$request->playlist_id,
                        'thumbnail_vidio' => $request->thumbnail_vidio_lama
                    ];
                }
            }

            // dd($newdata);
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

        if($vidio->type_vidio == "upload"){
            Gdrive::delete($vidio->link);
        }

        $vidio->delete();
        return response()->json(['success' => "berhasil menghapus data vidio"]);
    }
}
