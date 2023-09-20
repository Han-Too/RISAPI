<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use App\Http\Resources\BarangResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Barang::all();
        // dd($data->Kategori);
        if (!empty($data)) {
            return response()
                ->json(
                    [
                        'status' => true,
                        'message' => 'Berhasil Mendapatkan Data',
                        'data' => BarangResource::collection($data)
                    ]
                );
        } else {
            return response()
                ->json(
                    [
                        'status' => false,
                        'message' => 'Data Barang Masih Kosong'
                    ]
                    ,
                    404
                );
        }
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
        $validator = Validator::make($request->all(), [
            "foto_barang" => "required|image|mimes:jpg,jpeg,png,svg|max:5120",
            "nama_barang" => "required|string|max:255",
            "harga_barang" => "required|integer",
            "merk_barang" => "required|string|max:255",
            "berat_barang" => "required|integer",
            "produsen_barang" => "required|string",
            "deskripsi_barang" => "required|string",
            "stok_barang" => "required|integer",
            'kategori_id' => "required|string",
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $check = Barang::where('nama_barang', $request->nama_barang)->exists();

        // Storage::putFile('BarangUpload',  $request->file);

        if (!$check) {

            $filename = $request->file('foto_barang')->getClientOriginalName();
            $filesize = $request->file('foto_barang')->getSize();
            // $extension = $request->file('foto_barang')->getClientOriginalExtension();

            if (Storage::exists("public/images/barangupload/".$filename)); {
                    $filename = rand(1, 9999).$filename;
            }

            $request->file('foto_barang')->storeAs('public/images/barangupload', $filename);

            Barang::create([
                "foto_barang" => $filename,
                "nama_barang" => $request->nama_barang,
                "harga_barang" => $request->harga_barang,
                "merk_barang" => $request->merk_barang,
                "berat_barang" => $request->berat_barang,
                "produsen_barang" => $request->produsen_barang,
                "deskripsi_barang" => $request->deskripsi_barang,
                "stok_barang" => $request->stok_barang,
                "kategori_id" => $request->kategori_id,
            ]);

            return response()
                ->json(
                    [
                        'status' => true,
                        'message' => 'Berhasil Menyimpan Data'
                    ]
                );
        } else {
            return response()
                ->json(
                    [
                        'status' => false,
                        'message' => 'Nama Barang Ini Sudah Ada'
                    ]
                    ,
                    401
                );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "foto_barang" => "required|image|mimes:jpg,jpeg,png,svg|max:5120",
            "nama_barang" => "required|string|max:255",
            "harga_barang" => "required|integer",
            "merk_barang" => "required|string|max:255",
            "berat_barang" => "required|integer",
            "produsen_barang" => "required|string",
            "deskripsi_barang" => "required|string",
            "stok_barang" => "required|integer",
            'kategori_id' => "required|string",
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $data = Barang::where('id', $id)->first();
        $check = Barang::where('nama_barang', $request->nama_barang)->exists();
        if (!empty($data)) {
            if ($check) {

                Storage::delete("public/images/barangupload/" . $data->foto_barang);

                $filename = $request->file('foto_barang')->getClientOriginalName();
                $filesize = $request->file('foto_barang')->getSize();
                if (Storage::exists("public/images/barangupload/".$filename)); {
                    $filename = rand(1, 9999).$filename;
                }
                $request->file('foto_barang')->storeAs('public/images/barangupload', $filename);

                Barang::where('id', $id)->update([
                    "foto_barang" => $filename,
                    "nama_barang" => $request->nama_barang,
                    "harga_barang" => $request->harga_barang,
                    "merk_barang" => $request->merk_barang,
                    "berat_barang" => $request->berat_barang,
                    "produsen_barang" => $request->produsen_barang,
                    "deskripsi_barang" => $request->deskripsi_barang,
                    "stok_barang" => $request->stok_barang,
                    "kategori_id" => $request->kategori_id,
                ]);

                return response()
                    ->json(
                        [
                            'status' => true,
                            'message' => 'Berhasil Merubah Data'
                        ]
                    );
            } else {
                return response()
                    ->json(
                        [
                            'status' => false,
                            'message' => 'Barang Ini Sudah Ada'
                        ]
                        ,
                        401
                    );
            }
        } else {
            return response()
                ->json(
                    [
                        'status' => false,
                        'message' => 'Barang dengan id ' . $id . ' Tidak Ada'
                    ]
                    ,
                    401
                );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Barang::where('id', $id)->get();

        if(empty($data)){
            return response()
                ->json(
                    [
                        'status' => false,
                        'message' => 'Barang dengan id ' . $id . ' Tidak Ada'
                    ]
                    ,
                    401
                );
        } else {
            Barang::where('id', $id)->delete();
            return response()
                ->json(
                    [
                        'status' => false,
                        'message' => 'Berhasil Menghapus Data'
                    ],
                );
        }
    }

    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}