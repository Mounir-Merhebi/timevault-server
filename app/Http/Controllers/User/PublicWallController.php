<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Capsule;

class PublicWallController extends Controller
{
    public function getAllCapsules(){
        $capsules = Capsule::where('privacy_setting', 'public')->get();
        $response = [];
        $response["status"] = "success";
        $response["payload"] = $capsules;

        return json_encode($response, 200);
    }

    public function getAllCount($id = null){
        $capsulesCount = Capsule::where('privacy_setting', 'public')->get()->count();
        $response = [];
        $response["status"] = "success";
        $response["payload"] = $capsulesCount;

        return json_encode($response, 200);
    }

    

}
