<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Playlist;
use App\Models\Vidio;

class DashboardController extends Controller
{
    public function index()
    {
        $qtyUser = User::join('role', 'users.role_id', '=', 'role.id')
                    ->where('role.nama_role', 'pengguna')
                    ->count();
        $qtyVidio = Vidio::where('is_active',1)->count();
        $qtyPlaylist = Playlist::count();
        $qtyKategori = Kategori::count();
        return view('Dashboard.Dashboard.index',[
            'qtyUser' => $qtyUser,
            'qtyVidio' => $qtyVidio,
            'qtyPlaylist' => $qtyPlaylist,
            'qtyKategori' => $qtyKategori,
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
    public function store(Request $request)
    {
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
      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }
}
