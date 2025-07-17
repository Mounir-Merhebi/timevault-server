<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Capsule;

class DashboardController extends Controller
{
    public function getUserCapsules($id = null){
        $capsules = Capsule::find($id);
        $response = [];
        $response["status"] = "success";
        $response["payload"] = $capsules;

        return json_encode($response, 200);
    }

    public function getTotalCount($id = null){
        $capsulesCount = Capsule::where('user_id', $id)->count();
        $response = [];
        $response["status"] = "success";
        $response["payload"] = $capsulesCount;

        return json_encode($response, 200);
    }

    public function getWaitingCount($id = null){
        $capsulesCount = Capsule::where('user_id', $id)->where('is_revealed', 0)->count();
        $response = [];
        $response["status"] = "success";
        $response["payload"] = $capsulesCount;

        return json_encode($response, 200);
    }

    public function getPublicCount($id = null){
        $capsulesCount = Capsule::where('user_id', $id)->where('privacy_setting', 'public')->count();
        $response = [];
        $response["status"] = "success";
        $response["payload"] = $capsulesCount;

        return json_encode($response, 200);
    }

}
