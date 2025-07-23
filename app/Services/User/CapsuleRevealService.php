<?php

namespace App\Services\User;

use App\Models\Capsule;
use Carbon\Carbon;


class CapsuleRevealService
{
    public function revealDueCapsules()
    {
        date_default_timezone_set('Asia/Beirut');
        $now = Carbon::now();
        $capsules = Capsule::where('is_revealed', 0)->where('reveal_date', '<=', $now)->get();

        foreach ($capsules as $capsule) {
            $capsule->is_revealed = 1;
            $capsule->save();
            if ($capsule->user && filter_var($capsule->user->email, FILTER_VALIDATE_EMAIL)) {
                \Mail::to($capsule->user->email)->send(new \App\Mail\CapsuleRevealMail($capsule));
            }
        }
    }
}
