<?php

namespace App\Models;

use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{
    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
