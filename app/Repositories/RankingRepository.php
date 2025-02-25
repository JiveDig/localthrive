<?php

namespace App\Repositories;

use App\Models\Ranking;
use Statamic\Facades\Entry;
use Statamic\Stache\Repositories\EntryRepository;
use Statamic\Stache\Query\EntryQueryBuilder;
use Illuminate\Support\Collection;

class RankingRepository extends EntryRepository
{
    public function __construct()
    {
        $this->collection = 'rankings';
    }

    protected function makeBaseQuery()
    {
        return Ranking::query();
    }

    public function make(): \Statamic\Entries\Entry
    {
        return Entry::make()->collection($this->collection);
    }

    public function find($id): ?\Statamic\Entries\Entry
    {
        $entry = $this->makeBaseQuery()->where('id', $id)->first();
        return $entry ? $this->makeEntry($entry) : null;
    }

    protected function makeEntry($item): \Statamic\Entries\Entry
    {
        $entry = $this->make()
            ->id($item->id)
            ->slug($item->slug);

        $data = json_decode($item->data, true);
        return $entry->data($data);
    }

    public function all(): Collection
    {
        return $this->makeBaseQuery()
            ->get()
            ->map(fn ($entry) => $this->makeEntry($entry));
    }

    public function query(): EntryQueryBuilder
    {
        return new EntryQueryBuilder($this);
    }
}