<?php

use App\Models\Menu;

if (! function_exists('getMenus')) {
    function getMenus()
    {
        return Menu::with(['subMenus' => function ($query) {
            $query->where('status', 1)->orderBy('sort');
        }])
            ->whereNull('parent')
            ->where('status', 1)
            ->orderBy('sort')
            ->get();
    }
}
