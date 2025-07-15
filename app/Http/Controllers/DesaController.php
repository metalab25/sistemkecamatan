<?php

namespace App\Http\Controllers;

use App\DataTables\DataDesaDataTable;
use App\Models\CountDataDesa;
use App\Models\DataDesa;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class DesaController extends Controller
{
    use AuthorizesRequests;

    public function index(DataDesaDataTable $dataTable)
    {
        $this->authorize('desa read');

        return $dataTable->render('dashboard.data.desa.index', [
            'title' => 'Data Desa',
        ]);
    }

    public function show(DataDesa $desa)
    {
        $detailDataDesa = CountDataDesa::where('data_desa_id', $desa->id)->firstOrFail();

        return view('dashboard.data.desa.details', [
            'title'             => 'Detail Desa ' . $desa->nama_desa,
            'desa'              => $desa,
            'detailDataDesa'    => $detailDataDesa
        ]);
    }
}
