<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->poll_id,
            'option' => $this->title,
            'votes' => $this->votes,
            'vote_cont' => $this->votes()->count()
        ];
    }
}
