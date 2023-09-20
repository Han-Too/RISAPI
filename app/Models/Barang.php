<?php

namespace App\Models;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        "foto_barang",
        "nama_barang",
        "harga_barang",
        "merk_barang",
        "berat_barang",
        "produsen_barang",
        "deskripsi_barang",
        "stok_barang",
        "kategori_id",
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

}