<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;

class Feed extends Model implements Viewable
{
    use InteractsWithViews;
    use HasFactory;
    protected $appends = array('count_like');

    public function user()
    {
        return $this->belongsTo(User::class, 'publisher_id');
    }

    public function getCountLikeAttribute(){
        return Like::where([
            'feed_id' => $this->id,
        ])->count();
    }
}
