<?php

namespace App\Http\Controllers;


use App\Vote;
use App\Poll;
use JWTAuth;
use Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Resources\PollResource;
use Illuminate\Http\Request;

class PollController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function index()
    {
        $polls = Poll::latest()->paginate(5);
        return PollResource::collection($polls);
    }

    public function show(Poll $poll)
    {
        if ($this->user->id !== $poll->owner) {
            return response()->json([
                'sucess' => false,
                'message' => "You can't get access"
            ], 403);
        }

        return new PollResource($poll);
    }


    //todo createlogic in model
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'sucess' => false,
                'message' => 'Validation error',
            ], 422);
        }

        $poll = new Poll;
        $poll->title = $request->input('title');
        $poll->user_id = $this->user->id;
        $poll->description = $request->input('description');
        if ($poll->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Created',
                'data' => new PollResource($poll)
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => "Something wen't wrong"
        ], 404);
    }


    //todo createlogic in model
    public function saveOptions(Request $request, Poll $poll)
    {
        $options_params = $request->input('options');

        if (count($options_params) <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'No valid data'
            ], 404);
        }

        $options = [];

        foreach ($options_params as $option) {
            $options[] = [
                'title' => $option
            ];
        }

        if ($poll->options()->createMany($options)) {
            return response()->json([
                'success' => true,
                'message' => 'Created',
                'data' => new PollResource($poll)
            ], 201);
        }

    }

    public function vote(Request $request, Poll $poll)
    {
        $validator = Validator::make($request->all(), [
            'poll_option_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'sucess' => false,
                'message' => 'Validation error',
            ], 422);
        }

        $user_id = $this->user->id;
        $votes = $poll->votes;
        if ($votes->contains('user_id', $user_id)) {
            return response()->json([
                'sucess' => false,
                'message' => 'You have already voted',
            ], 422);
        }

        $vote = new Vote();
        $vote->poll_option_id = $request->input('poll_option_id');
        $vote->user_id = $user_id;
        $vote->save();
        return new PollResource($poll);
    }
}

