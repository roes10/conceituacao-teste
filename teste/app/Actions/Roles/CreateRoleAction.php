<?php

namespace App\Actions\Roles;

use Spatie\Permission\Models\Role;

class CreateRoleAction
{
    public static function execute(array $names)
    {
       return Role::create($names);
    }
}
