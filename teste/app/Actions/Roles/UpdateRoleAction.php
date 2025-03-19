<?php

namespace App\Actions\Roles;

use Spatie\Permission\Models\Role;

class UpdateRoleAction
{
    public static function execute($id, array $names)
    {
        $role = Role::findById($id);
        $role->update($names);
    }
}
