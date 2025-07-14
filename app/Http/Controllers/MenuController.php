<?php

namespace App\Http\Controllers;

use App\DataTables\MenuDataTable;
use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    use AuthorizesRequests;

    public function index(MenuDataTable $dataTable)
    {
        $this->authorize('menus read');

        return $dataTable->render('dashboard.settings.menus.index', [
            'title' => 'Menu Management',
        ]);
    }

    public function create()
    {
        $this->authorize('menus create');

        $mainMenu = Menu::where('parent', null)->orderBy('name')->get();

        return view('dashboard.settings.menus.form-action', [
            'title' => 'Add Menu',
            'menu' => new Menu,
            'mainMenu' => $mainMenu,
        ]);
    }

    public function store(MenuRequest $request)
    {
        Menu::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Add Menus Successfully.',
        ]);
    }

    public function show(Menu $menu)
    {
        //
    }

    public function edit(Menu $menu)
    {
        $this->authorize('menus update');

        $mainMenu = Menu::where('parent', null)->orderBy('name')->get();

        return view('dashboard.settings.menus.form-action', [
            'title' => 'Update Menu',
            'menu' => $menu,
            'mainMenu' => $mainMenu,
        ]);
    }

    public function update(Request $request, Menu $menu)
    {
        $rules = [
            'icon' => 'required',
            'type' => 'required',
        ];

        if ($request->name !== $menu->name) {
            $rules['name'] = 'required|unique:menus,name,' . $menu->id;
        }
        if ($request->url !== $menu->url) {
            $rules['url'] = 'required|unique:menus,url,' . $menu->id;
        }

        $validatedData['parent'] = $request->parent;

        $validatedData = $request->validate($rules);

        Menu::where('id', $menu->id)->update($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Update Menus Successfully.',
        ]);
    }

    public function updateStatus($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->status = $menu->status ? 0 : 1;
        $menu->save();

        return response()->json([
            'message' => 'Menus Status Updated Successfully',
            'status' => $menu->status,
        ]);
    }

    public function updateUrutan($id, $direction)
    {
        $currentMenu = Menu::findOrFail($id);

        if ($direction === 'up') {
            $currentMenu->sort = max(0, $currentMenu->sort - 1);
        } elseif ($direction === 'down') {
            $currentMenu->sort = $currentMenu->sort + 1;
        }

        $currentMenu->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Menu order updated successfully',
            'new_sort' => $currentMenu->sort,
        ]);
    }

    public function destroy(Menu $menu)
    {
        $this->authorize('menus delete');
        $menu->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Delete Menus Successfully.',
        ]);
    }
}
