<?php

use App\Models\Kategori;
use App\Models\Playlist;
use App\Models\Role;

function getKategori() {
    $data = Kategori::all();
    
    return $data;
}

function getRole() {
    $data = Role::all();
    
    return $data;
}
function getPlaylist() {
    $data = Playlist::all();
    
    return $data;
}