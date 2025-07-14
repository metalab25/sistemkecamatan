<?php

namespace App\Http\Controllers;

use App\Helpers\imageHelper;
use App\Models\Config;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConfigController extends Controller
{
    public function index(Config $kecamatan)
    {
        $kecamatan  = Config::first();
        $provinsi   = Province::all();

        return view('dashboard.config.index', [
            'title' => 'Identitas Kecamatan',
            'kecamatan' => $kecamatan,
            'provinsi'  => $provinsi
        ]);
    }

    public function update(Request $request, Config $kecamatan)
    {
        $rules = [
            'nama_kecamatan'        => 'required|string',
            'kode_kecamatan'        => 'required|max:2',
            'alamat_kantor_camat'   => 'required|string',
            'kodepos'               => 'required|numeric',
            'telepon'               => 'required|min:10|max:13',
            'email'                 => 'nullable|email',
            'nama_camat'            => 'required|string',
            'nip_camat'             => 'required|string',
            'telepon_camat'         => 'nullable|numeric',
            'nama_kabupaten'        => 'required|string',
            'kode_kabupaten'        => 'required|max:2',
            'nama_bupati'           => 'required|string',
            'nip_bupati'            => 'required|string',
            'provinsi_id'           => 'required|max:2',
        ];

        $validatedData = $request->validate($rules);

        if ($request->file('logo')) {
            if ($request->oldLogo) {
                Storage::delete($request->oldLogo);
            }
            $validatedData['logo'] = imageHelper::cropLambang($request->file('logo'), 'lambang');
        }

        $validatedData['email']         = $request->mail;
        $validatedData['telepon_camat'] = $request->telepon_camat;
        $validatedData['lat']           = $request->lat;
        $validatedData['long']          = $request->long;
        $validatedData['wilayah']       = $request->wilayah;

        Config::where('id', $kecamatan->id)->update($validatedData);

        return redirect()->back()
            ->with('toast', [
                'type' => 'success',
                'message' => 'Identitas Kecamatan Berhasil Diperbaharui!',
            ]);
    }
}
