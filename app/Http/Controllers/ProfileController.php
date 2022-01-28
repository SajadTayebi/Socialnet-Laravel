<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use App\Models\Follow;
use App\Models\User;

class ProfileController extends Controller
{
    public function profile($user)
    {
        $user = User::find($user);
        $feeds = Feed::where('publisher_id', $user->id)->get();
        return view('profile', compact('feeds', 'user'));
    }

    public function click_follow($user)
    {
        if (check_follow($user, auth()->user()->id)){
            $follow = new Follow();

            $follow->following_id = auth()->user()->id;
            $follow->followers_id = $user;
            $follow->save();

            return back();
        }else{
            Follow::where([
                'following_id' => auth()->user()->id,
                'followers_id' => $user
            ])->first()->delete();
            return back();
        }
    }
}
