<?php

namespace App\Http\Controllers;

use App\DataTables\RoleDataTable;
use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Spatie\Permission\PermissionRegistrar;

class RoleController extends Controller
{
    use AuthorizesRequests;

    public function index(RoleDataTable $dataTable)
    {
        $this->authorize('roles read');

        return $dataTable->render('dashboard.settings.roles.index', [
            'title' => 'Role Management',
        ]);
    }

    public function create()
    {
        $this->authorize('roles create');

        return view('dashboard.settings.roles.form-action', [
            'title' => 'Add Role',
            'role' => new Role,
        ]);
    }

    public function store(RoleRequest $request)
    {
        Role::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Add Role Successfully.',
        ]);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Role $role)
    {
        $this->authorize('roles update');

        $permissions = Permission::all()->groupBy('group_name');

        return view('dashboard.settings.roles.form-action', [
            'title' => 'Update Role',
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $role->permissions->pluck('id')->toArray(),
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $rules = [
            'guard_name' => 'required',
        ];

        if ($request->name !== $role->name) {
            $rules['name'] = 'required|unique:roles,name,' . $role->id;
        }

        $validatedData = $request->validate($rules);

        Role::where('id', $role->id)->update($validatedData);

        if ($request->has('permissions')) {
            $permissionIds = $request->permissions;
            $permissions = Permission::whereIn('id', $permissionIds)->pluck('name')->toArray();
            $role->syncPermissions($permissions);
        } else {
            $role->syncPermissions([]);
        }

        // Tambahkan baris berikut untuk flush cache permission
        // auth()->user()->refreshPermissions();
        // auth()->user()->forgetCachedPermissions();
        // app()[PermissionRegistrar::class]->forgetCachedPermissions();

        return response()->json([
            'status' => 'success',
            'message' => 'Update Role Successfully.',
        ]);
    }

    public function destroy(Role $role)
    {
        $this->authorize('roles delete');
        $role->delete();

        // Tambahkan baris berikut untuk flush cache permission
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        return response()->json([
            'status' => 'success',
            'message' => 'Delete Role Successfully.',
        ]);
    }
}
