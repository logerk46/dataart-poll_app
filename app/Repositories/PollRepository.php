<?php

namespace App\Repositories;

use App\User;
use App\Poll;
use App\Vote;
use App\PollOption;


class PollRepository
{
    protected $poll;

    public function __construct(Poll $poll)
    {
        $this->poll = $poll;
    }

    public function all()
    {
        return $this->poll->all();
    }

    public function find($id)
    {
        return $this->poll->find($id);
    }
}