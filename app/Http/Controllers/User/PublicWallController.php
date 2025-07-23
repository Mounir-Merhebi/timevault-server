<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Capsule;
use App\Models\User;
use App\Services\User\CapsuleRevealService; 

class PublicWallController extends Controller
{
    public function getAllCapsules(CapsuleRevealService $service)
    {
        $service->revealDueCapsules();

        $capsules = Capsule::with('user:id,username')->where('privacy_setting', 'public')->where('is_revealed', 1)->get();

        return $this->responseJSON($capsules);
    }

    public function getAllCount($id = null, CapsuleRevealService $service)
    {

        $service->revealDueCapsules();

        $capsulesCount = Capsule::where('privacy_setting', 'public')->where('is_revealed', 1)->count();

        return $this->responseJSON($capsulesCount);
    }
}

