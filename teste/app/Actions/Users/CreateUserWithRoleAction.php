<?php

namespace App\Actions\Users;

use App\Models\User;

class CreateUserWithRoleAction
{
    public static function execute(array $data): User
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        if (!empty($data['roles'])) {
            $user->syncRoles($data['roles']);
        }
        return $user;
    }
}
