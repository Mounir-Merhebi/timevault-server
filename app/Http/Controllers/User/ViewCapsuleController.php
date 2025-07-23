<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Capsule;

class ViewCapsuleController extends Controller
{
    public function getCapsule($id = null){
        $capsule = Capsule::with('user:id,username')->find($id);
        return $this->responseJSON($capsule);
    }

    public function viewSharedCapsule($token)  {
        $capsule = Capsule::with('user:id,username')->where('unlisted_link_token', $token)->first();
        return $this->responseJSON($capsule);
    }

}

