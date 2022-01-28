<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FeedController extends Controller
{
    public function new_feed(Request $request)
    {
        $request->validate([
            'image' => 'required | max: 100000000'
        ]);
        $feed = new Feed();
        $image = $request->file('image')->store('images');
        $feed->image_url = Storage::url($image);
        $feed->description = $request->description;
        $feed->publisher_id = Auth::user()->id;
        if($feed->save()){
            return back();
        }else{
            return false;
        }
    }

    public function submit_like(Feed $feed)
    {
        if (check_liked($feed, \auth()->user()->id)){
            $like = new Like();
            $like->feed_id = $feed->id;
            $like->user_id = \auth()->user()->id;
            $like->save();
            return back();
        }else{
            Like::where([
                'feed_id' => $feed->id,
                'user_id' => \auth()->user()->id
            ])->first()->delete();
            return back();
        }
    }
}
