@extends('dashboard.layouts.app')

@push('css')
    <style>
        .list__detail__desa {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            display: flex;
            flex-wrap: wrap;
            margin-top: calc(-1 * var(--bs-gutter-y));
            margin-right: calc(-0.5 * var(--bs-gutter-x));
            margin-left: calc(-0.5 * var(--bs-gutter-x));
        }

        .list__detail__desa>* {
            flex-shrink: 0;
            width: 100%;
            max-width: 100%;
            padding-right: calc(var(--bs-gutter-x) * 0.5);
            padding-left: calc(var(--bs-gutter-x) * 0.5);
            margin-top: var(--bs-gutter-y);
        }

        .list__detail__desa {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            display: flex;
            flex-wrap: wrap;
            margin-top: calc(-1 * var(--bs-gutter-y));
            margin-right: calc(-0.5 * var(--bs-gutter-x));
            margin-left: calc(-0.5 * var(--bs-gutter-x));
        }

        .list__detail__desa .small_card {
            width: 14.25%;
            flex: 0 0 auto;

        }

        .list__detail__desa .small_card .card__box {
            background: #fff;
            --bs-card-border-radius: 1.25rem;
            box-shadow: 0 1px 17px rgba(0, 0, 0, 0.175) !important;
            border-color: transparent;
            border-radius: 1rem;
            position: relative;
            display: block;
            margin-bottom: 1.25rem;
            --bs-link-color-rgb: none;
            --bs-link-hover-color-rgb: none;
            --bs-heading-color: none;
        }

        .list__detail__desa .small_card .card__box .box_title {
            text-align: center;
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            text-transform: uppercase;
            padding: 10px 15px;
            font-size: 0.75em;
            min-height: 55px;
            align-content: center;
            background: linear-gradient(87deg, #1a174d 0, #164596 100%);
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
            color: #fff;
        }

        .list__detail__desa .small_card .card__box .box_body {
            text-align: center;
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 2.5em;
            padding: 1.5rem 1rem;
        }

        @media(max-width:640px) {
            .list__detail__desa .small_card {
                width: 100%;
            }

            .list__detail__desa .small_card .card__box .box_title {
                font-size: 1em;
            }
        }
    </style>
@endpush

@section('content')
    <a href="{{ route('desa.index') }}" class="btn btn-danger btn-block mb-0 mb-sm-3">Kembali Ke Daftar Desa</a>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive table-shadow rounded-3 mb-0">
                <table class="table table-striped table-borderless justify-content-center mb-0">
                    <tr>
                        <th class="align-middle" width="13%">Desa</th>
                        <th class="text-center align-middle" width="2%">:</th>
                        <td class="align-middle">{{ $desa->nama_desa }}</td>
                    </tr>
                    <tr>
                        <th class="align-middle" width="13%">Kode Desa</th>
                        <th class="text-center align-middle" width="2%">:</th>
                        <td class="align-middle">
                            {{ $desa->kode_provinsi . '.' . $desa->kode_kabupaten . '.' . $desa->kode_kecamatan . '.' . $desa->kode_desa }}
                        </td>
                    </tr>
                    <tr>
                        <th class="align-middle" width="13%">Kode Desa</th>
                        <th class="text-center align-middle" width="2%">:</th>
                        <td class="align-middle">
                            {{ $desa->nama_kepala . ' - ' . $desa->nip_kepala }}
                        </td>
                    </tr>
                    <tr>
                        <th class="align-middle" width="13%">Alamat Kantor Desa</th>
                        <th class="text-center align-middle" width="2%">:</th>
                        <td class="align-middle">{{ $desa->alamat }}
                        </td>
                    </tr>
                    <tr>
                        <th class="align-middle" width="13%">Telepon Kantor Desa</th>
                        <th class="text-center align-middle" width="2%">:</th>
                        <td class="align-middle">{{ $desa->telepon }}</td>
                    </tr>
                    <tr>
                        <th class="align-middle" width="13%">Website Desa</th>
                        <th class="text-center align-middle" width="2%">:</th>
                        <td class="align-middle">{{ $desa->website }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="list__detail__desa">
        <div class="small_card">
            <div class="small_card_box rounded-xl">
                <div class="card__box">
                    <div class="box_title">
                        Total Wilayah Dusun
                    </div>
                    <div class="box_body align-middle">
                        {{ $detailDataDesa->total_wilayah }}
                    </div>
                </div>
            </div>
        </div>
        <div class="small_card">
            <div class="small_card_box rounded-xl">
                <div class="card__box">
                    <div class="box_title">
                        Total Keluarga Terdaftar
                    </div>
                    <div class="box_body align-middle">
                        {{ $detailDataDesa->total_keluarga }}
                    </div>
                </div>
            </div>
        </div>
        <div class="small_card">
            <div class="small_card_box rounded-xl">
                <div class="card__box">
                    <div class="box_title">
                        Kepala Keluarga Laki-Laki
                    </div>
                    <div class="box_body align-middle">
                        {{ $detailDataDesa->total_keluarga_lk }}
                    </div>
                </div>
            </div>
        </div>
        <div class="small_card">
            <div class="small_card_box rounded-xl">
                <div class="card__box">
                    <div class="box_title">
                        Kepala Keluarga Perempuan
                    </div>
                    <div class="box_body align-middle">
                        {{ $detailDataDesa->total_keluarga_pr }}
                    </div>
                </div>
            </div>
        </div>
        <div class="small_card">
            <div class="small_card_box rounded-xl">
                <div class="card__box">
                    <div class="box_title">
                        Total Penduduk Terdaftar
                    </div>
                    <div class="box_body align-middle">
                        {{ $detailDataDesa->total_penduduk }}
                    </div>
                </div>
            </div>
        </div>
        <div class="small_card">
            <div class="small_card_box rounded-xl">
                <div class="card__box">
                    <div class="box_title">
                        Total Penduduk Laki-laki
                    </div>
                    <div class="box_body align-middle">
                        {{ $detailDataDesa->total_penduduk_lk }}
                    </div>
                </div>
            </div>
        </div>
        <div class="small_card">
            <div class="small_card_box rounded-xl">
                <div class="card__box">
                    <div class="box_title">
                        Total Penduduk Perempuan
                    </div>
                    <div class="box_body align-middle">
                        {{ $detailDataDesa->total_penduduk_pr }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
