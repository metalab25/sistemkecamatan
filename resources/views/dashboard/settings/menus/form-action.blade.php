<div class="modal-content">
    <form id="formAction" action="{{ $menu->id ? route('menus.update', $menu->id) : route('menus.store') }}"
        method="post">
        @csrf
        @if ($menu->id)
            @method('PUT')
        @endif
        <div class="modal-header">
            <h1 class="modal-title fs-6" id="modalActionLabel">{{ $title }}</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group mb-2">
                <label for="menuName" class="form-label">Name</label>
                <input type="text" name="name" id="menuName" class="form-control" placeholder="Name menu..."
                    value="{{ old('name', $menu->name) }}">
            </div>
            <div class="form-group mb-2">
                <label for="urlName" class="form-label">URL</label>
                <input type="text" name="url" id="urlName" class="form-control" placeholder="Url..."
                    value="{{ old('url', $menu->url) }}">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label for="type" class="form-label">Menu Type</label>
                        <select name="type" id="type" class="form-select @error('type') is-invalid @enderror">
                            <option value="">-- Select Type --</option>
                            <option value="1" {{ old('type', $menu->type) == '1' ? 'selected' : '' }}>Main Menu
                            </option>
                            <option value="2" {{ old('type', $menu->type) == '2' ? 'selected' : '' }}>Sub Menu
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label for="parent" class="form-label">Main Menu</label>
                        <select name="parent" id="parent" class="form-select">
                            <option value="">-- Select Main Menu --</option>
                            @foreach ($mainMenu as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('parent', $menu->parent) == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group mb-0">
                <label for="iconMenu" class="form-label @error('icon') is-invalid @enderror">Menu Icon</label>
                <input type="text" name="icon" id="iconMenu" class="form-control"
                    value="{{ old('icon', $menu->icon) }}">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const iconItems = document.querySelectorAll('.icon-item');
            const iconPreview = document.getElementById('iconPreview');
            const selectedIcon = document.getElementById('selectedIcon');

            iconItems.forEach(item => {
                item.addEventListener('click', function() {
                    const icon = this.getAttribute('data-icon');
                    selectedIcon.value = icon;
                    iconPreview.innerHTML = `<i class="bi bi-${icon}"></i>`;

                    const dropdown = bootstrap.Dropdown.getInstance(iconPreview);
                    dropdown.hide();
                });
            });

            new bootstrap.Dropdown(iconPreview);
        });
    </script>
@endpush
