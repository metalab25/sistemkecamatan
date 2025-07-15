<?php

namespace App\Http\Controllers;

use App\DataTables\DataDesaDataTable;
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
}
