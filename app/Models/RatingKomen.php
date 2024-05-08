<?php

namespace App\Models;

use App\Models\User;
use App\Models\Vidio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RatingKomen extends Model
{
    use HasFactory;

    public $table = "rating_komen";
    protected $primaryKey = "id";
    protected $fillable = [
        'bintang',
        'isi',
        'vidio_id',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function vidio()
    {
        return $this->belongsTo(Vidio::class, 'vidio_id');
    }
    

}
