<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Capsule;

class PublicWallController extends Controller
{
    public function getAllCapsules(){
        $capsules = Capsule::where('privacy_setting', 'public')->get();
        return $this->responseJSON($capsules);
    }

    public function getAllCount($id = null){
        $capsulesCount = Capsule::where('privacy_setting', 'public')->get()->count();
        return $this->responseJSON($capsulesCount);
    }

    

}
