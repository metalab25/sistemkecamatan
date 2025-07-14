<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Helpers\imageHelper;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    use AuthorizesRequests;

    public function index(UserDataTable $dataTable)
    {
        $this->authorize('users read');

        $roles = Role::all();

        return $dataTable->render('dashboard.settings.users.index', [
            'title' => 'User Management',
            'roles' => $roles,
        ]);
    }

    public function create()
    {
        $this->authorize('users create');

        return view('dashboard.settings.users.form-action', [
            'title' => 'Add User',
            'user' => new User,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'username' => 'required|username|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|username|unique:users,phone',
            'password' => 'required|confirmed|min:8',
            'photo' => 'image|mimes:jpg,jpeg,png,bmp,webp|max:2048',
        ]);

        $validatedData['password'] = Hash::make($request->password);

        if ($request->hasFile('photo')) {
            $validatedData['photo'] = imageHelper::cropUserFoto($request->file('photo'), 'users');
        }

        $user = User::create($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Add User Successfully.',
            'user' => $user,
        ]);
    }

    public function show(User $user)
    {
        Auth::user()->unreadNotifications->where('id', request('id'))->first()?->markAsRead();

        return view('dashboard.settings.users.show', [
            'title' => 'Detail User ' . $user->name,
            'user' => $user,
        ]);
    }

    public function edit(User $user)
    {
        $this->authorize('users update');

        return view('dashboard.settings.users.form-action', [
            'title' => 'Update User',
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required',
            'password' => 'nullable|confirmed|min:8',
            'photo' => 'image|mimes:jpg,jpeg,png,bmp,webp|max:2048',
        ];

        if ($request->username !== $user->username) {
            $rules['username'] = 'required|unique:users,username,' . $user->id;
        }

        if ($request->email !== $user->email) {
            $rules['email'] = 'required|unique:users,email,' . $user->id;
        }

        if ($request->phone !== $user->phone) {
            $rules['phone'] = 'required|unique:users,phone,' . $user->id;
        }

        $validatedData = $request->validate($rules);

        if ($request->file('photo')) {
            if ($request->oldPhoto) {
                Storage::delete($request->oldPhoto);
            }
            $validatedData['photo'] = imageHelper::cropUserFoto($request->file('photo'), 'users');
        }

        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->password);
        } else {
            unset($validatedData['password']);
        }

        User::where('id', $user->id)->update($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Update Data User ' . $user->name . ' Successfully.',
        ]);
    }

    // public function updateStatus($id)
    // {
    //     $user = User::findOrFail($id);
    //     $user->status = $user->status ? 0 : 1;
    //     $user->save();

    //     return response()->json([
    //         'message' => 'User Status Updated Successfully',
    //         'status' => $user->status,
    //     ]);
    // }

    public function destroy(User $user)
    {
        $this->authorize('users delete');

        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Delete User Successfully.',
        ]);
    }
}
