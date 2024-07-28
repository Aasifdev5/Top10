<?php
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.{userId}', function ($user, $userId) {
    // Return true if the user is authorized to listen to the channel
    return (int) $user->id === (int) $userId;
});


