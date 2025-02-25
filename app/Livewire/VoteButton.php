<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;
use Statamic\Facades\Entry;

class VoteButton extends Component
{
    public $nomination;
    public $voteTotal;
    public $hasUpvoted;
    public $hasDownvoted;
    public $rankingId;
    public $placeId;

    public function mount($nomination)
    {
        $this->nomination = $nomination;
        $this->rankingId = $nomination->get('ranking_id');
        $this->placeId = $nomination->get('place_data')->id();
        $this->refreshVoteStatus();
    }

    protected function refreshVoteStatus()
    {
        $this->voteTotal = $this->nomination->get('vote_total') ?? 0;
        $userVote = $this->nomination->get('user_vote');
        $this->hasUpvoted = $userVote === 1;
        $this->hasDownvoted = $userVote === -1;
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
    }

    public function render()
    {
        return view('livewire.vote-button');
    }
}