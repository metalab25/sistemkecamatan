@extends('dashboard.layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2-bootstrap-5-theme.css') }}">
@endpush

@section('content')
    <form action="{{ route('kecamatan.update', $kecamatan->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <input type="hidden" name="oldPhoto" value="{{ $kecamatan->logo }}">
                            @if ($kecamatan->logo)
                                <img src="{{ asset('storage/' . $kecamatan->logo) }}"
                                    class="logo-preview img-fluid rounded-3 d-block mx-auto mb-3">
                            @else
                                <img src="{{ asset('/assets/img/logo.png') }}"
                                    class="logo-preview img-fluid rounded-3 d-block mx-auto mb-3">
                            @endif
                        </div>
                        <div class="mb-0">
                            <div class="input-group">
                                <input class="form-control @error('logo') is-invalid @enderror" type="file"
                                    name="logo" id="logo" onchange="previewLogo()">
                            </div>
                            @error('logo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="form-group row mb-3">
                            <label for="nama_kecamatan" class="form-label col-md-4">Nama Kecamatan</label>
                            <div class="col-md-8">
                                <input type="text" name="nama_kecamatan" id="nama_kecamatan"
                                    class="form-control @error('nama_kecamatan') is-invalid @enderror"
                                    placeholder="Nama kecamatan"
                                    value="{{ old('nama_kecamatan', $kecamatan->nama_kecamatan) }}">
                                @error('nama_kecamatan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="kode_kecamatan" class="form-label col-md-4">Kode Kecamatan</label>
                            <div class="col-md-8">
                                <input type="text" name="kode_kecamatan" id="kode_kecamatan"
                                    class="form-control @error('kode_kecamatan') is-invalid @enderror"
                                    placeholder="Kode kecamatan"
                                    value="{{ old('kode_kecamatan', $kecamatan->kode_kecamatan) }}">
                                @error('kode_kecamatan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="alamat_kantor_camat" class="form-label col-md-4">Alamat Kantor</label>
                            <div class="col-md-8">
                                <input type="text" name="alamat_kantor_camat" id="alamat_kantor_camat"
                                    class="form-control @error('alamat_kantor_camat') is-invalid @enderror"
                                    placeholder="Alamat kantor kecamatan"
                                    value="{{ old('alamat_kantor_camat', $kecamatan->alamat_kantor_camat) }}">
                                @error('alamat_kantor_camat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="kodepos" class="form-label col-md-4">Kode Pos</label>
                            <div class="col-md-8">
                                <input type="number" name="kodepos" id="kodepos"
                                    class="form-control @error('kodepos') is-invalid @enderror" placeholder="83111"
                                    value="{{ old('kodepos', $kecamatan->kodepos) }}">
                                @error('kodepos')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="telepon" class="form-label col-md-4">Telepon Kantor</label>
                            <div class="col-md-8">
                                <input type="number" name="telepon" id="telepon"
                                    class="form-control @error('telepon') is-invalid @enderror" placeholder="0370123456"
                                    value="{{ old('telepon', $kecamatan->telepon) }}">
                                @error('telepon')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="email" class="form-label col-md-4">Email Kecamatan</label>
                            <div class="col-md-8">
                                <input type="email" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="email@kecamatan.go.id" value="{{ old('email', $kecamatan->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="lat" class="form-label col-md-4">Latitude Kantor</label>
                            <div class="col-md-8">
                                <input type="text" name="lat" id="lat" class="form-control "
                                    placeholder="-8.73423728973429" value="{{ old('lat', $kecamatan->lat) }}">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="long" class="form-label col-md-4">Longitude Kantor</label>
                            <div class="col-md-8">
                                <input type="text" name="long" id="long" class="form-control "
                                    placeholder="116.76348276347" value="{{ old('long', $kecamatan->long) }}">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="wilayah" class="form-label col-md-4">Wilayah Kecamatan</label>
                            <div class="col-md-8">
                                <input type="text" name="wilayah" id="wilayah" class="form-control"
                                    placeholder="116.76348276347" value="{{ old('wilayah', $kecamatan->wilayah) }}">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="nama_camat" class="form-label col-md-4">Nama Camat</label>
                            <div class="col-md-8">
                                <input type="text" name="nama_camat" id="nama_camat"
                                    class="form-control @error('nama_camat') is-invalid @enderror"
                                    placeholder="Hasanuddin, S.H"
                                    value="{{ old('nama_camat', $kecamatan->nama_camat) }}">
                                @error('nama_camat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="nip_camat" class="form-label col-md-4">NIP Camat</label>
                            <div class="col-md-8">
                                <input type="text" name="nip_camat" id="nip_camat"
                                    class="form-control @error('nip_camat') is-invalid @enderror" placeholder="0370123456"
                                    value="{{ old('nip_camat', $kecamatan->nip_camat) }}">
                                @error('nip_camat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="telepon_camat" class="form-label col-md-4">Telepon Camat</label>
                            <div class="col-md-8">
                                <input type="number" name="telepon_camat" id="telepon_camat" class="form-control"
                                    placeholder="081234567890"
                                    value="{{ old('telepon_camat', $kecamatan->telepon_camat) }}">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="nama_kabupaten" class="form-label col-md-4">Nama Kabupaten</label>
                            <div class="col-md-8">
                                <input type="text" name="nama_kabupaten" id="nama_kabupaten"
                                    class="form-control @error('nama_kabupaten') is-invalid @enderror"
                                    placeholder="Lombok Tengah"
                                    value="{{ old('nama_kabupaten', $kecamatan->nama_kabupaten) }}">
                                @error('nama_kabupaten')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="kode_kabupaten" class="form-label col-md-4">Kode Kabupaten</label>
                            <div class="col-md-8">
                                <input type="text" name="kode_kabupaten" id="kode_kabupaten"
                                    class="form-control @error('kode_kabupaten') is-invalid @enderror" placeholder="05"
                                    value="{{ old('kode_kabupaten', $kecamatan->kode_kabupaten) }}">
                                @error('kode_kabupaten')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="nama_bupati" class="form-label col-md-4">Nama Bupati</label>
                            <div class="col-md-8">
                                <input type="text" name="nama_bupati" id="nama_bupati"
                                    class="form-control @error('nama_bupati') is-invalid @enderror"
                                    placeholder="Warsito, S.P.d"
                                    value="{{ old('nama_bupati', $kecamatan->nama_bupati) }}">
                                @error('nama_bupati')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="nip_bupati" class="form-label col-md-4">NIP Bupati</label>
                            <div class="col-md-8">
                                <input type="text" name="nip_bupati" id="nip_bupati"
                                    class="form-control @error('nip_bupati') is-invalid @enderror"
                                    placeholder="111 1111 111 1111"
                                    value="{{ old('nip_bupati', $kecamatan->nip_bupati) }}">
                                @error('nip_bupati')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="provinsi_id" class="form-label col-md-4">Provinsi</label>
                            <div class="col-md-8">
                                <select
                                    class="form-control form-select select2 @error('provinsi_id') is-invalid @enderror"
                                    id="provinsi_id" name="provinsi_id">
                                    <option value="">-- Pilih Provinsi --</option>
                                    @foreach ($provinsi as $item)
                                        <option value="{{ $item->kode }}"
                                            {{ old('provinsi_id', $kecamatan->provinsi_id) == $item->kode ? 'selected' : '' }}>
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('provinsi_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-end mb-0">Simpan</button>
            </div>
        </div>
    </form>
@endsection

@push('script')
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toastEl = document.getElementById('liveToast');
            const toastBody = document.querySelector('.toast-body');
            const toast = new bootstrap.Toast(toastEl);

            @if (session('toast'))
                const toastData = @json(session('toast'));
                toastBody.textContent = toastData.message;

                if (toastData.type === 'success') {
                    toastEl.querySelector('.toast-header').classList.add('text-success');
                    toastEl.querySelector('.toast-body').classList.add('text-success');
                } else if (toastData.type === 'error') {
                    toastEl.querySelector('.toast-header').classList.add('text-danger');
                    toastEl.querySelector('.toast-body').classList.add('text-danger');
                }

                toast.show();
            @endif

            function showToast(message, type = 'success') {
                const toastBody = toastEl.querySelector('.toast-body')
                toastEl.classList.remove('bg-success', 'bg-danger')
                toastEl.classList.add(`bg-${type}`)
                toastBody.textContent = message
                toast.show()
            }
        });

        function previewLogo() {
            const logo = document.querySelector('#logo');
            const imgPreview = document.querySelector('.logo-preview');

            const oFReader = new FileReader();
            oFReader.readAsDataURL(logo.files[0]);

            oFReader.onLoad = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
            const blob = URL.createObjectURL(logo.files[0]);
            imgPreview.src = blob;
        }

        $(document).ready(function() {
            $('#provinsi_id').select2({
                placeholder: '-- Pilih Provinsi --',
                theme: 'bootstrap-5',
                allowClear: false
            });
        });
    </script>
@endpush
