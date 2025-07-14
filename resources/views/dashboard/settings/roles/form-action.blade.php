<div class="modal-content">
    <form id="formAction" action="{{ $role->id ? route('roles.update', $role->id) : route('roles.store') }}"
        method="post">
        @csrf
        @if ($role->id)
            @method('PUT')
        @endif
        <div class="modal-header">
            <h1 class="modal-title fs-6" id="modalActionLabel">{{ $title }}</h1>
        </div>
        <div class="modal-body" style="max-height: 60vh; overflow-y: auto;">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="roleName" class="form-label">Name</label>
                        <input type="text" name="name" id="roleName" class="form-control" placeholder="Role name"
                            value="{{ $role->name }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="guardName" class="form-label">Guard</label>
                        <input type="text" name="guard_name" id="guardName" class="form-control"
                            placeholder="Guard name" value="{{ $role->guard_name }}">
                    </div>
                </div>
            </div>

            @if ($role->id)
                <table class="table align-content-center mt-3 mb-0">
                    <thead>
                        <tr class="table-secondary">
                            <th class="text-center align-middle" width="13%" style="border-top-left-radius: 0.5rem">
                                Menu
                            </th>
                            <th class="text-center align-middle" style="border-top-right-radius: 0.5rem">
                                Permissions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $group => $groupPermissions)
                            <tr>
                                <td class="align-middle">{{ ucfirst($group) }}</td>
                                <td>
                                    <div class="row">
                                        @foreach ($groupPermissions as $permission)
                                            <div class="col-md-2">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" name="permissions[]"
                                                        value="{{ $permission->id }}"
                                                        id="permission{{ $permission->id }}"
                                                        @if (in_array($permission->id, $rolePermissions)) checked @endif>
                                                    <label class="form-check-label text-capitalize"
                                                        for="permission{{ $permission->id }}">
                                                        {{ str_replace($group . ' ', '', $permission->name) }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
