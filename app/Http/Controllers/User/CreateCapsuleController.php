<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\CapsuleService;
use App\Traits\ResponseTrait;
use Illuminate\Support\Str;

class CreateCapsuleController extends Controller {
    use ResponseTrait;

    public function viewShared($token){
    $capsule = Capsule::where('unlisted_link_token', $token)->where('privacy_setting', 'unlisted')->first();
    return $this->responseJSON($capsule);
    }


    public function addCapsule(Request $request) {
        $data = $request->all();
        $capsule = CapsuleService::createCapsule($data);

        return $this->responseJSON($capsule);
    }
}