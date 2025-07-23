<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\User\UserService;
use App\Traits\ResponseTrait;

class ProfileController extends Controller
{
    public function getUser($id = null){
        $User = User::find($id);
        return $this->responseJSON($User);
    }

    public function updateUser(Request $request, $id = null)
    {
        $data = $request->all();
        $updatedUser = UserService::update($data, $id);
        return $this->responseJSON($updatedUser);
    }
}
