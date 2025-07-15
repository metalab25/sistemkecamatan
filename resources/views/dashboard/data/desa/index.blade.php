@extends('dashboard.layouts.app')

@section('content')
    <div class="card mb-3">
        <div class="card-body p-2">
            <div class="table-responsive">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@endsection

@push('script')
    {{ $dataTable->scripts() }}
@endpush
