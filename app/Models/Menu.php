<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function MainMenus()
    {
        return $this->belongsTo(Menu::class, 'parent');
    }

    public function subMenus()
    {
        return $this->hasMany(Menu::class, 'parent');
    }

    protected static function booted()
    {
        static::creating(function ($menu) {
            if (empty($menu->sort)) {
                $maxSort = self::where('parent', $menu->parent)->max('sort');
                $menu->sort = $maxSort ? $maxSort + 1 : 1;
            }
        });
    }
}
