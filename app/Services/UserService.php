<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function create($data): User
    {
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->save();
        return $user;
    }
}
