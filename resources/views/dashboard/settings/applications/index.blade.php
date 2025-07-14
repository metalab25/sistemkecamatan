@extends('dashboard.layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2-bootstrap-5-theme.css') }}">
@endpush

@section('content')
    <form action="{{ route('application.update', $application->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <input type="hidden" name="oldPhoto" value="{{ $application->logo }}">
                            @if ($application->logo)
                                <img src="{{ asset('storage/' . $application->logo) }}"
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
                            <label for="name" class="form-label col-md-3">Nama</label>
                            <div class="col-md-9">
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="Nama"
                                    value="{{ old('name', $application->name) }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="alias" class="form-label col-md-3">Alias</label>
                            <div class="col-md-9">
                                <input type="text" name="alias" id="alias"
                                    class="form-control @error('alias') is-invalid @enderror" placeholder="Alias"
                                    value="{{ old('alias', $application->alias) }}">
                                @error('alias')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="address" class="form-label col-md-3">Alamat</label>
                            <div class="col-md-9">
                                <input type="text" name="address" id="address"
                                    class="form-control @error('address') is-invalid @enderror" placeholder="Alamat"
                                    value="{{ old('address', $application->address) }}">
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="province_id" class="form-label col-md-3">Provinsi</label>
                            <div class="col-md-9">
                                <select class="form-control form-select select2 @error('province_id') is-invalid @enderror"
                                    id="province_id" name="province_id">
                                    <option value="">-- Pilih Provinsi --</option>
                                    @foreach ($province as $item)
                                        <option value="{{ $item->kode }}"
                                            {{ old('province_id', $application->province_id) == $item->kode ? 'selected' : '' }}>
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('province_id')
                                    <div class="invalid-feedback">
                                        {{ 'Provinsi harus diisi' }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="phone" class="form-label col-md-3">Telepon</label>
                            <div class="col-md-3">
                                <input type="number" name="phone" id="phone"
                                    class="form-control @error('phone') is-invalid @enderror" placeholder="Telepon"
                                    value="{{ old('phone', $application->phone) }}">
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="email" class="form-label col-md-3">Email</label>
                            <div class="col-md-9">
                                <input type="email" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                                    value="{{ old('email', $application->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="fonnte_key" class="form-label col-md-3">Fonnte Key</label>
                            <div class="col-md-9">
                                <input type="text" name="fonnte_key" id="fonnte_key"
                                    class="form-control @error('fonnte_key') is-invalid @enderror"
                                    placeholder="Fonnte key" value="{{ old('fonnte_key', $application->fonnte_key) }}">
                                @error('fonnte_key')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="order_no" class="form-label col-md-3">Nomor Awal Pesanan</label>
                            <div class="col-md-9">
                                <input type="number" name="order_no" id="order_no"
                                    class="form-control @error('order_no') is-invalid @enderror"
                                    placeholder="Nomor awal pesanan"
                                    value="{{ old('order_no', $application->order_no) }}">
                                @error('order_no')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="ticket_no" class="form-label col-md-3">Nomor Awal Tiket</label>
                            <div class="col-md-9">
                                <input type="number" name="ticket_no" id="ticket_no"
                                    class="form-control @error('ticket_no') is-invalid @enderror"
                                    placeholder="Nomor awal tiket"
                                    value="{{ old('ticket_no', $application->ticket_no) }}">
                                @error('ticket_no')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="facebook_link" class="form-label col-md-3">Facebook Link</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-facebook"></i></span>
                                    <input type="url" name="facebook_link" id="facebook_link" class="form-control"
                                        placeholder="Facebook link"
                                        value="{{ old('facebook_link', $application->facebook_link) }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="x_link" class="form-label col-md-3">Twitter-X Link</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-twitter-x"></i></span>
                                    <input type="url" name="x_link" id="x_link" class="form-control"
                                        placeholder="X link" value="{{ old('x_link', $application->x_link) }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="instagram_link" class="form-label col-md-3">Instagram Link</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-instagram"></i></span>
                                    <input type="url" name="instagram_link" id="instagram_link" class="form-control"
                                        placeholder="Facebook link"
                                        value="{{ old('instagram_link', $application->instagram_link) }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="youtube_link" class="form-label col-md-3">Youtube Link</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-youtube"></i></span>
                                    <input type="url" name="youtube_link" id="youtube_link" class="form-control"
                                        placeholder="Youtube link"
                                        value="{{ old('youtube_link', $application->youtube_link) }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="github_link" class="form-label col-md-3">Github Link</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-github"></i></span>
                                    <input type="url" name="github_link" id="github_link" class="form-control"
                                        placeholder="Github link"
                                        value="{{ old('github_link', $application->github_link) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-end mb-0">Save</button>
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
            $('#province_id').select2({
                placeholder: '-- Pilih Provinsi --',
                theme: 'bootstrap-5',
                allowClear: false
            });
        });
    </script>
@endpush
