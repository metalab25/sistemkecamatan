<?php

namespace App\Http\Controllers;

use App\Models\CountDataDesa;
use App\Models\DataDesa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $dataDesa = DataDesa::latest()->limit(7)->get();
        $desaCount = DataDesa::count();
        $pendudukCount = CountDataDesa::sum('total_penduduk');
        $keluargaCount = CountDataDesa::sum('total_keluarga');
        $desas = DataDesa::select('nama_desa', 'alamat', 'latitude', 'longitude', 'nama_kepala')->get();

        return view('dashboard.index', [
            'title'     => 'Dashboard',
            'dataDesa'  => $dataDesa,
            'desaCount' => $desaCount,
            'pendudukCount' => $pendudukCount,
            'keluargaCount' => $keluargaCount,
            'desas'     => $desas
        ]);
    }
}
