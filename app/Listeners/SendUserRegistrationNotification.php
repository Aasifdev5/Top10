<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Str;
class SendUserRegistrationNotification implements ShouldQueue
{
    public function handle(UserRegistered $event)
    {
        $user = $event->user;

        // Create and save notification for the user
        $notification = new Notification([
            'uuid' => Str::uuid()->toString(),
            'user_id' => $user->id,
            'text' => 'Welcome to our application! We are excited to have you on board.',
            'user_type' => 2, // Assuming user type is instructor
        ]);
        $notification->save();

        // Dispatch notification to the admin
        $admin = User::where('role', 1)->first(); // Assuming there's only one admin
        if ($admin) {
            $adminNotification = new Notification([
                'uuid' => Str::uuid()->toString(),
                'sender_id' => $user->id,
                'user_id' => $admin->id,
                'text' => 'A new user has registered on the platform.',
                'user_type' => 1, // Admin user type
            ]);
            $adminNotification->save();
        }
    }
}
