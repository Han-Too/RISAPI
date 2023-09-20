<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert([
            [
                "username" => "admin",
                "nama" => "admin",
                "telepon" => "080000",
                "alamat" => "admin",
                "email" => "admin@admin.com",
                "password" => bcrypt("admin")
            ],
            [
                "username" => "user",
                "nama" => "user",
                "telepon" => "081111",
                "alamat" => "user",
                "email" => "user@user.com",
                "password" => bcrypt("user")
            ]
        ]);

        DB::table('kategoris')->insert([
            [
                'nama_kategori' => "Pakaian"
            ],
            [
                'nama_kategori' => "Celana"
            ],
            [
                'nama_kategori' => "Elektronik"
            ],
            [
                'nama_kategori' => "Sepatu"
            ],
            [
                'nama_kategori' => "Tas"
            ],
            [
                'nama_kategori' => "Aksesoris"
            ],
            [
                'nama_kategori' => "Komputer"
            ],
            [
                'nama_kategori' => "Handphone"
            ],
            [
                'nama_kategori' => "Perlengkapan Rumah"
            ],
            [
                'nama_kategori' => "Kesehatan"
            ],
        ]);

        
    }
}