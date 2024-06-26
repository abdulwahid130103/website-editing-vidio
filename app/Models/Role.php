<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;
    public $table = "role";
    protected $primaryKey = "id";
    protected $fillable = [
        'nama_role'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
