<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User;
Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// User::find(1)->
    // notify(new MessageNotification('Hello, World!'));
Broadcast::channel('messages.{userId}', function ($user, $id) {
    return (int) $user->id === (int) $id; // Authorize if the user ID matches
    
});