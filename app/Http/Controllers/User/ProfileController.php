<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function getUser($id = null){
        $User = User::find($id);
        return $this->responseJSON($User);
    }
}
