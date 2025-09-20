@extends('dashboard.layouts.app')

@push('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 520px;
            width: 100%;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box text-bg-primary">
                <div class="inner">
                    <h3>{{ $desaCount }}</h3>
                    <p>Total Desa</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="small-box-icon bi bi-pie-chart-fill"
                    viewBox="0 0 16 16">
                    <path
                        d="M15.985 8.5H8.207l-5.5 5.5a8 8 0 0 0 13.277-5.5zM2 13.292A8 8 0 0 1 7.5.015v7.778zM8.5.015V7.5h7.485A8 8 0 0 0 8.5.015" />
                </svg>
                <a href="{{ route('desa.index') }}"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    Lihat Semua <i class="bi bi-link-45deg"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box text-bg-success">
                <div class="inner">
                    <h3>{{ $keluargaCount }}</h3>
                    <p>Total Keluarga</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg"fill="currentColor" class="small-box-icon bi bi-people-fill"
                    viewBox="0 0 16 16">
                    <path
                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                </svg>
                <a href="#"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    Lihat Semua <i class="bi bi-link-45deg"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box text-bg-warning">
                <div class="inner">
                    <h3>{{ $pendudukCount }}</h3>
                    <p>Total Penduduk</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="small-box-icon bi bi-person-fill"
                    viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                </svg>
                <a href="#"
                    class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                    Lihat Semua <i class="bi bi-link-45deg"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box text-bg-danger">
                <div class="inner">
                    <h3>65</h3>
                    <p class="font-outfit fw-semibold">Pelayanan Surat</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    class="small-box-icon bi bi-journal-bookmark-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6 1h6v7a.5.5 0 0 1-.757.429L9 7.083 6.757 8.43A.5.5 0 0 1 6 8z" />
                    <path
                        d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2" />
                    <path
                        d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z" />
                </svg>
                <a href="#"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    Lihat Semua <i class="bi bi-link-45deg"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="card mb-0">
        <div class="card-body">
            <div id="map" class="rounded-3"></div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        const desas = @json($desas);

        const map = L.map('map').setView([-8.67, 116.12], 12); // Pusatkan pada Lombok Barat

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        desas.forEach(desa => {
            if (desa.latitude && desa.longitude) {
                L.marker([desa.latitude, desa.longitude])
                    .addTo(map)
                    .bindPopup(`<p><strong>Desa ${desa.nama_desa}</strong></p>
                        <p><strong>Kepala Desa:</strong> ${desa.nama_kepala}<br>
                        <strong>Alamat:</strong> ${desa.alamat}</p>`);
            }
        });
    </script>
@endpush
