<?php

namespace App\Repositories\Contracts;

use App\Models\Word;

interface WordRepositoryInterface
{
    public function all();

    public function truncateAndSaveBulk(array $words);

    public function saveBulk(array $words);
}