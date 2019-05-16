<?php

namespace App;

use App\User;
use App\Poll;
use App\PollOption;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $guarded = [];

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
