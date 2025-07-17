<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Capsule;

class DashboardController extends Controller
{
    public function getUserCapsules($id = null){
        $capsules = Capsule::find($id);
        return $this->responseJSON($capsules);
    }

    public function getTotalCount($id = null){
        $capsulesCount = Capsule::where('user_id', $id)->count();
        return $this->responseJSON($capsulesCount);
    }

    public function getWaitingCount($id = null){
        $capsulesCount = Capsule::where('user_id', $id)->where('is_revealed', 0)->count();
        return $this->responseJSON($capsulesCount);
    }

    public function getPublicCount($id = null){
        $capsulesCount = Capsule::where('user_id', $id)->where('privacy_setting', 'public')->count();
        return $this->responseJSON($capsulesCount);
    }

}
