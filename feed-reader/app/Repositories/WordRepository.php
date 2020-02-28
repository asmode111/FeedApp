<?php

namespace App\Repositories;

use App\Models\Word;
use App\Repositories\Contracts\WordRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class WordRepository implements WordRepositoryInterface
{
    public function all(): Collection
    {
        return Word::all();
    }

    /**
     * $words string[]
     */
    public function truncateAndSaveBulk(array $words): bool
    {
        $this->truncate();

        return $this->saveBulk($words);
    }

    public function truncate(): void
    {
        Word::truncate();
    }

    /**
     * $words string[]
     */
    public function saveBulk(array $words): bool
    {
        $data = collect($words)->map(function ($word) {
            return ['word' => $word];
        })->toArray();

        return Word::insert($data);
    }
}