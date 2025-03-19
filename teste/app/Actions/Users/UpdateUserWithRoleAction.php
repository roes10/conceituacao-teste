<?php

namespace App\Actions\Users;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class UpdateUserWithRoleAction
{
    /**
     * @throws \Exception
     */
    public static function execute($id, array $data)
    {
        $user = User::find($id);

        if (!$user) {
            Log::warning('Usuário não encontrado:', ['id' => $id]);
            throw new \Exception('User not found.');
        }

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);

        $roleIds = $data['roles'] ?? [];
        $roleNames = Role::whereIn('id', $roleIds)->pluck('name')->toArray();
        $user->syncRoles($roleNames);
        return $user;
    }
}
