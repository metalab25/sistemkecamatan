<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DataDesaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_desa' => 'required|string|max:255',
            'kode_desa' => 'required|string|max:255|unique:data_desa,telepon',
            'kode_pos' => 'required|string|max:10',
            'nama_kepala' => 'required|string|max:255',
            'nip_kepala' => 'required|string|max:30',
            'alamat' => 'required|string',
            'kecamatan' => 'required|string|max:255',
            'kode_kecamatan' => 'required|string|max:20',
            'kabupaten' => 'required|string|max:255',
            'kode_kabupaten' => 'required|string|max:20',
            'kode_provinsi' => 'required|string|max:20',
            'latitude' => 'nullable|string|max:50',
            'longitude' => 'nullable|string|max:50',
            'path' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:20|unique:data_desa,telepon',
            'website' => 'nullable|url|max:255',

            'total_penduduk' => 'required|integer|min:0',
            'total_wilayah' => 'required|integer|min:0',
            'total_keluarga' => 'required|integer|min:0',
            'total_penduduk_lk' => 'required|integer|min:0',
            'total_penduduk_pr' => 'required|integer|min:0',
            'total_keluarga_lk' => 'required|integer|min:0',
            'total_keluarga_pr' => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_desa.required' => 'Nama desa wajib diisi.',
            'kode_desa.required' => 'Kode desa wajib diisi.',
            'kode_pos.required' => 'Kode pos wajib diisi.',
            'nama_kepala.required' => 'Nama kepala desa wajib diisi.',
            'nip_kepala.required' => 'NIP kepala desa wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'kecamatan.required' => 'Kecamatan wajib diisi.',
            'kode_kecamatan.required' => 'Kode kecamatan wajib diisi.',
            'kabupaten.required' => 'Kabupaten wajib diisi.',
            'kode_kabupaten.required' => 'Kode kabupaten wajib diisi.',
            'kode_provinsi.required' => 'Kode provinsi wajib diisi.',

            'total_penduduk.required' => 'Total penduduk wajib diisi.',
            'total_penduduk.integer' => 'Total penduduk harus berupa angka.',
            'total_wilayah.required' => 'Total wilayah wajib diisi.',
            'total_keluarga.required' => 'Total keluarga wajib diisi.',
            'total_penduduk_lk.required' => 'Total penduduk laki-laki wajib diisi.',
            'total_penduduk_pr.required' => 'Total penduduk perempuan wajib diisi.',
            'total_keluarga_lk.required' => 'Total keluarga laki-laki wajib diisi.',
            'total_keluarga_pr.required' => 'Total keluarga perempuan wajib diisi.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 400,
            'message' => 'Validasi gagal',
            'errors' => $validator->errors()
        ], 400));
    }
}
