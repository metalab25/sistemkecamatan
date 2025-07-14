<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as ModelsPermission;

class Permission extends ModelsPermission
{
    protected $table = 'permissions';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function getGroupNameAttribute()
    {
        $parts = explode(' ', $this->name);

        return $parts[0];
    }
}
