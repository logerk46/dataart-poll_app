<?php

namespace App;

use App\Poll;
use App\Vote;
use Illuminate\Database\Eloquent\Model;

class PollOption extends Model
{

    protected $guarded = [];
    public $timestamps = false;

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'poll_option_id');
    }
}
