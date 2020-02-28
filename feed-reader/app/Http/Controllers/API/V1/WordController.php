<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Services\WordService;
use App\Repositories\Contracts\WordRepositoryInterface;

class WordController extends Controller
{
    /**
     * WordService
     */
    private $wordService;
    
    /**
     * WordRepositoryInterface
     */
    private $wordRepository;

    public function __construct(WordService $wordService, WordRepositoryInterface $wordRepository)
    {
        $this->wordService = $wordService;
        $this->wordRepository = $wordRepository;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function extract()
    {
        $body = $this->wordService->fetch();
        if (!$body) {
            return response()->json([
                'isSuccess' => false,
            ]);
        }

        $words = $this->wordService->extract($body);
        if (!$words) {
            return response()->json([
                'isSuccess' => false,
            ]);
        }

        $isSaved = $this->wordRepository->truncateAndSaveBulk($words);
        if (!$isSaved) {
            return response()->json([
                'isSuccess' => false,
            ]);
        }

        return response()->json([
            'isSuccess' => true,
            'words' => $words,
        ]);
    }
}
