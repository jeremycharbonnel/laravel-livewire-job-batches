<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('notifications.{channelUser}', function ($authUser, \App\Models\User $channelUser) {
    return $authUser->id === $channelUser->id;
});
