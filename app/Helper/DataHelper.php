<?php

use App\Models\Kategori;
use App\Models\Role;

function getKategori() {
    $data = Kategori::all();
    
    return $data;
}

function getRole() {
    $data = Role::all();
    
    return $data;
}