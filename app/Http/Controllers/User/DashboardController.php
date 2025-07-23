<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Capsule;
use App\Services\User\CapsuleRevealService; 

class DashboardController extends Controller
{
    public function getUserCapsules($id = null, CapsuleRevealService $service){

        $service->revealDueCapsules();

        $capsules = Capsule::where('user_id', $id)->get();
        return $this->responseJSON($capsules);
    }

    public function getTotalCount($id = null, CapsuleRevealService $service){

        $service->revealDueCapsules();
        
        $capsulesCount = Capsule::where('user_id', $id)->count();
        return $this->responseJSON($capsulesCount);
    }

    public function getWaitingCount($id = null, CapsuleRevealService $service){

        $service->revealDueCapsules();
        
        $capsulesCount = Capsule::where('user_id', $id)->where('is_revealed', 0)->count();
        return $this->responseJSON($capsulesCount);
    }
    public function getOpenedCount($id = null, CapsuleRevealService $service){

        $service->revealDueCapsules();

        $capsulesCount = Capsule::where('user_id', $id)->where('is_revealed', 1)->count();
        return $this->responseJSON($capsulesCount);
    }

    public function getPublicCount($id = null, CapsuleRevealService $service){
        
        $service->revealDueCapsules();

        $capsulesCount = Capsule::where('user_id', $id)->where('privacy_setting', 'public')->count();
        return $this->responseJSON($capsulesCount);
    }

}
