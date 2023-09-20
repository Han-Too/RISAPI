<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;
use App\Http\Resources\KategoriResource;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Kategori::all();
        return response()->json([
            'status' => true,
            'message' => 'Berhasil Mendapatkan Data',
            // 'data' => KategoriResource::collection($data)
            'data' => KategoriResource::collection($data)
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
    public function store(StoreKategoriRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Kategori::where('id',$id)->get();
        // dd($data);
        if(empty($data)){
            return response()->json([
                'status' => true,
                'message' => 'Tidak Ada Kategori Dengan ID '.$id
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Berhasil Mendapatkan Data',
                'data' => KategoriResource::collection($data)
            ]);
        }
    }

    public function showbarang($id)
    {
        $data = Kategori::where('id',$id)->get();
        $barang = Barang::where('kategori_id',$id)->get();
        
        $data->makeHidden(['created_at','updated_at']);
        $barang->makeHidden(['created_at','updated_at']);
        // dd($data);
        if(empty($data)){
            return response()->json([
                'status' => true,
                'message' => 'Tidak Ada Kategori Dengan ID '.$id
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Berhasil Mendapatkan Data',
                'data' => json_decode(trim($data, '[]')),
                'barang' => $barang
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKategoriRequest $request, Kategori $kategori)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        //
    }
}
