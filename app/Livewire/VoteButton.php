<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VoteButton extends Component
{
    public $nomination;
    public $voteTotal;
    public $hasUpvoted = false;
    public $hasDownvoted = false;
    public $rankingId;
    public $placeId;

    public function mount($nomination)
    {
        Log::info('Mounting VoteButton', ['nomination' => $nomination]);

        $this->nomination = $nomination;
        $this->rankingId = $nomination['ranking_id'];
        $this->placeId = $nomination['place_data']['id'];
        $this->voteTotal = $nomination['vote_total'] ?? 0;
        $this->refreshVoteStatus();
    }

    protected function refreshVoteStatus()
    {
        if (!Auth::check()) {
            $this->hasUpvoted = false;
            $this->hasDownvoted = false;
            return;
        }

        $vote = Vote::where([
            'user_id' => Auth::id(),
            'ranking_id' => $this->rankingId,
            'place_id' => $this->placeId
        ])->first();

        $this->hasUpvoted = $vote && $vote->value === 1;
        $this->hasDownvoted = $vote && $vote->value === -1;
    }

    public function upvote()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($this->hasUpvoted) {
            $this->removeVote();
        } else {
            $this->castVote(1);
        }

        $this->refreshVoteStatus();
    }

    public function downvote()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($this->hasDownvoted) {
            $this->removeVote();
        } else {
            $this->castVote(-1);
        }

        $this->refreshVoteStatus();
    }

    protected function removeVote()
    {
        Vote::where([
            'user_id' => Auth::id(),
            'ranking_id' => $this->rankingId,
            'place_id' => $this->placeId
        ])->delete();

        $this->voteTotal = Vote::where([
            'ranking_id' => $this->rankingId,
            'place_id' => $this->placeId
        ])->sum('value');
    }

    protected function castVote($value)
    {
        Vote::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'ranking_id' => $this->rankingId,
                'place_id' => $this->placeId
            ],
            ['value' => $value]
        );

        $this->voteTotal = Vote::where([
            'ranking_id' => $this->rankingId,
            'place_id' => $this->placeId
        ])->sum('value');
    }

    public function render()
    {
        return view('livewire.vote-button');
    }
}