<?php

namespace App\Models;

use App\Models\Playlist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;
    public $table = "kategori";
    protected $primaryKey = "id";
    protected $fillable = [
        'nama_kategori'
    ];

    public function playlists()
    {
        return $this->hasMany(Playlist::class, 'kategori_id');
    }
}
