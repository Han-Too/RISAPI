<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BarangResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "foto_barang" => $this->foto_barang,
            "nama_barang" => $this->nama_barang,
            "harga_barang" => $this->harga_barang,
            "merk_barang" => $this->merk_barang,
            "berat_barang" => $this->berat_barang,
            "produsen_barang" => $this->produsen_barang,
            "deskripsi_barang" => $this->deskripsi_barang,
            "stok_barang" => $this->stok_barang,
            "kategori_id" => $this->kategori_barang,
        ];
    }
}