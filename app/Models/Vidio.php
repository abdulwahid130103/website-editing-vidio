<?php

namespace App\Models;

use App\Models\Playlist;
use App\Models\RatingKomen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vidio extends Model
{
    use HasFactory;
    public $table = "vidio";
    protected $primaryKey = "id";
    protected $fillable = [
        'judul',
        'deskripsi',
        'playlist_id',
        'durasi',
        'tanggal_upload'
    ];
    public function ratingKomens()
    {
        return $this->hasMany(RatingKomen::class, 'vidio_id');
    }

    public function playlist()
    {
        return $this->belongsTo(Playlist::class, 'playlist_id');
    }
   
}
