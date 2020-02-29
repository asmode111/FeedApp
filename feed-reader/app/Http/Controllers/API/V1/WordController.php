<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Services\WordService;
use App\Repositories\Contracts\WordRepositoryInterface;

class WordController extends Controller
{
    /**
     * @var WordService
     */
    private $wordService;
    
    /**
     * @var WordRepositoryInterface
     */
    private $wordRepository;

    public function __construct(
        WordService $wordService, 
        WordRepositoryInterface $wordRepository
    ) {
        $this->wordService = $wordService;
        $this->wordRepository = $wordRepository;
    }
    
     /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $words = $this->wordRepository->all();

        return response()->json([
            'words' => $words->toArray(),
            'sourceUrl' => $this->wordService::SOURCE_URL,
        ]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function extract()
    {
        $body = $this->wordService->fetch();
        if (!$body) {
            return response()->json([
                'success' => false,
            ]);
        }

        $words = $this->wordService->extract($body);
        if (!$words) {
            return response()->json([
                'success' => false,
            ]);
        }

        $isSaved = $this->wordRepository->truncateAndSaveBulk($words);
        if (!$isSaved) {
            return response()->json([
                'success' => false,
            ]);
        }

        $words = $this->wordRepository->all();

        return response()->json([
            'success' => true,
            'words' => $words->toArray(),
            'sourceUrl' => $this->wordService::SOURCE_URL,
        ]);
    }
}
