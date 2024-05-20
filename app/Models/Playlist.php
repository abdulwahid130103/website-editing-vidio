<?php

namespace App\Models;

use App\Models\Vidio;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Playlist extends Model
{
    use HasFactory;

    public $table = "playlist";
    protected $primaryKey = "id";
    protected $fillable = [
        'nama_playlist',
        'deskripsi_playlist',
        'thumbnail_playlist',
        'kategori_id'
    ];

    public function vidios()
    {
        return $this->hasMany(Vidio::class, 'playlist_id');
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
