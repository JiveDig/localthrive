{{-- Vote Button Partial --}}
@livewire('vote-button', [
    'nomination' => [
        'id' => $nomination_id,
        'ranking_id' => $nomination_ranking_id,
        'place_data' => [
            'id' => $nomination_place_data->id(),
            'title' => $nomination_place_data->get('title'),
            'url' => $nomination_place_data->url(),
            'content' => $nomination_place_data->get('content')
        ],
        'vote_total' => $nomination_vote_total
    ]
], key($nomination_id))