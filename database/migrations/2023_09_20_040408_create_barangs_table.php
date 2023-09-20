<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('foto_barang');
            $table->string('nama_barang');
            $table->integer('harga_barang');
            $table->string('merk_barang');
            $table->integer('berat_barang');
            $table->string('produsen_barang');
            $table->string('deskripsi_barang');
            $table->integer('stok_barang');
            $table->foreignId('kategori_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
