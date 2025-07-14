<div class="modal-content">
    <form id="formAction"
        action="{{ $permission->id ? route('permission.update', $permission->id) : route('permission.store') }}"
        method="post">
        @csrf
        @if ($permission->id)
            @method('PUT')
        @endif
        <div class="modal-header">
            <h1 class="modal-title fs-6" id="modalActionLabel">{{ $title }}</h1>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="roleName" class="form-label">Name</label>
                        <input type="text" name="name" id="roleName" class="form-control"
                            placeholder="Permission name" value="{{ $permission->name }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="guardName" class="form-label">Guard</label>
                        <input type="text" name="guard_name" id="guardName" class="form-control"
                            placeholder="Guard name" value="{{ $permission->guard_name }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
