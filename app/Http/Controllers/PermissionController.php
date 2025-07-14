<?php

namespace App\Http\Controllers;

use App\DataTables\PermissionDataTable;
use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    use AuthorizesRequests;

    public function index(PermissionDataTable $dataTable)
    {
        $this->authorize('permission read');

        return $dataTable->render('dashboard.settings.permissions.index', [
            'title' => 'Permissions Management',
        ]);
    }

    public function create()
    {
        $this->authorize('permission create');

        return view('dashboard.settings.permissions.form-action', [
            'title' => 'Add Permission',
            'permission' => new Permission,
        ]);
    }

    public function store(PermissionRequest $request)
    {
        Permission::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Add Permission Successfully.',
        ]);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Permission $permission)
    {
        $this->authorize('permission update');

        return view('dashboard.settings.permissions.form-action', [
            'title' => 'Update Permission',
            'permission' => $permission,
        ]);
    }

    public function update(Request $request, Permission $permission)
    {
        $rules = [
            'guard_name' => 'required',
        ];

        if ($request->name !== $permission->name) {
            $rules['name'] = 'required|unique:permissions,name,' . $permission->id;
        }

        $validatedData = $request->validate($rules);

        Permission::where('id', $permission->id)->update($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Update Permission Successfully.',
        ]);
    }

    public function destroy(Permission $permission)
    {
        $this->authorize('permission delete');
        $permission->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Delete Permission Successfully.',
        ]);
    }
}
