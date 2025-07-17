<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Capsule;

class ViewCapsuleController extends Controller
{
    public function getCapsule($id = null){
        $capsules = Capsule::find($id);
        $response = [];
        $response["status"] = "success";
        $response["payload"] = $capsules;

        return json_encode($response, 200);
    }
}

