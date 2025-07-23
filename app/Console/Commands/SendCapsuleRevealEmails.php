<?php

namespace App\Console\Commands;
use App\Models\Capsule; 
use Illuminate\Console\Command;

class SendCapsuleRevealEmails extends Command
{

    protected $signature = 'app:send-capsule-reveal-emails';

    protected $description = 'Command description';
    
    public function handle()
{
    \Log::info('Command started at ' . now());

    $capsules = Capsule::with('user')
        ->where('is_revealed', false)
        ->where('reveal_date', '<=', now())
        ->get();

    if ($capsules->isEmpty()) {
        \Log::info('No capsules to reveal at ' . now());
        return;
    }

    foreach ($capsules as $capsule) {
        if ($capsule->user && filter_var($capsule->user->email, FILTER_VALIDATE_EMAIL)) {
            \Mail::to($capsule->user->email)->send(new \App\Mail\CapsuleRevealMail($capsule));
            $capsule->privacy = 'public';
            $capsule->is_revealed = true;
            $capsule->save();

            \Log::info("Sent email for capsule ID {$capsule->id} to {$capsule->user->email}");
        } else {
            \Log::warning("Skipped capsule ID {$capsule->id}: no valid user email");
        }
    }

    \Log::info('Command finished at ' . now());
}



}