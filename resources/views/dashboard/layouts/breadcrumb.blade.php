<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h5 class="font-outfit mb-0 pt-0 pt-sm-1">{{ $title }}</h5>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">
                            @if (request()->segment(1) == 'dashboard')
                                Home
                            @else
                                Dashboard
                            @endif
                        </a></li>
                    <li class="breadcrumb-item active text-capitalize" aria-current="page">{{ request()->segment(1) }}
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>
