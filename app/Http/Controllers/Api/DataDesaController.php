<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ArrayHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\DataDesaRequest;
use App\Models\CountDataDesa;
use App\Models\DataDesa;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DataDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // contoh
        $test = DataDesa::all();

        return response()->json([
            'status' => 200,
            'message' => 'Data desa berhasil diambil',
            'data' => $test
        ], 200);
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
    public function store(DataDesaRequest $request)
    {
        try {
            $validatedData = $request->all();

            $validated_data_desa = [
                "nama_desa" => $validatedData['nama_desa'],
                "kode_desa" => $validatedData['kode_desa'],
                "kode_pos" => $validatedData['kode_pos'],
                "nama_kepala" => $validatedData['nama_kepala'],
                "nip_kepala" => $validatedData['nip_kepala'],
                "alamat" => $validatedData['alamat'],
                "kecamatan" => $validatedData['kecamatan'],
                "kode_kecamatan" => $validatedData['kode_kecamatan'],
                "kabupaten" => $validatedData['kabupaten'],
                "kode_kabupaten" => $validatedData['kode_kabupaten'],
                "kode_provinsi" => $validatedData['kode_provinsi'],
                "latitude" => $validatedData['latitude'] ?? null,
                "longitude" => $validatedData['longitude'] ?? null,
                "path" => $validatedData['path'] ?? null,
                "telepon" => $validatedData['telepon'] ?? null,
                "website" => $validatedData['website'] ?? null,
            ];

            $data_desa = DataDesa::create($validated_data_desa);

            $validated_count_data_desa = [
                "data_desa_id" => (int) $data_desa->id,
                "total_penduduk" => $validatedData['total_penduduk'],
                "total_wilayah" => $validatedData['total_wilayah'],
                "total_keluarga" => $validatedData['total_keluarga'],
                "total_penduduk_lk" => $validatedData['total_penduduk_lk'],
                "total_penduduk_pr" => $validatedData['total_penduduk_pr'],
                "total_keluarga_lk" => $validatedData['total_keluarga_lk'],
                "total_keluarga_pr" => $validatedData['total_keluarga_pr'],
            ];

            CountDataDesa::create($validated_count_data_desa);

            $data_desa_with_count = DataDesa::with('count_data_desa')->find($data_desa->id);

            return response()->json([
                'status' => 200,
                'message' => 'Berhasil menambah data desa',
                'data' => $data_desa_with_count
            ], 200);
        } catch (Exception $err) {
            Log::error('Gagal menambah data desa: ' . $err->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Gagal menambah data desa',
                'errors' => $err->getMessage()
            ], 500);
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
