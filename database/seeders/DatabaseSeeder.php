<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('role')->insert([
            'nama_role' => "admin",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'username' => "admin",
            'email' => "admin@gmail.com",
            'password' => Hash::make('admin123'),
            'role_id' => 1,
            'nama_lengkap' => "admin",
            'foto' => "admin.png",
            'no_telfon' => "1111111",
            'alamat' => "kediri",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
