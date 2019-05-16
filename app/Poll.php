<?php

namespace App;

use App\User;
use App\PollOption;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $guarded = [];

    public function path()
    {
        return "/polls/{$this->id}";
    }

    public function options()
    {
        return $this->hasMany(PollOption::class, 'poll_id');
    }

    public function votes()
    {
        return $this->hasManyThrough(
            'App\Vote', 'App\PollOption',
            'poll_id', 'id', 'poll_id', 'poll_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
