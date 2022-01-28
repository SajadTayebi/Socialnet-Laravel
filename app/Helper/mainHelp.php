<?php

use App\Models\Like;
use App\Models\Follow;

function check_liked($feed, $user)
{
    return empty(Like::where([
        'feed_id' => $feed->id,
        'user_id' => $user
    ])->first()) ? true : false;
}

function check_follow($user, $follow)
{
    return empty(Follow::where([
        'following_id' => $follow,
        'followers_id' => $user
    ])->first()) ? true : false;
}
