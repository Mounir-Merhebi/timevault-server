<?php

namespace App\Services\User;

use App\Models\User; 
use Illuminate\Support\Facades\Hash; 

class UserService
{
    static function update(array $data, int $id)
    {
        $user = User::find($id);

        if (!$user) {
            return null;
        }
        if (isset($data['username'])) {
            $user->username = $data['username'];
        }
        if (isset($data['email'])) {
            $user->email = $data['email'];
        }
        if (isset($data['password']) && !empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }
        $user->save();
        return $user; 
    }
}
