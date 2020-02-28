<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Services\FeedService;
use App\Repositories\Contracts\WordRepositoryInterface;

class FeedController extends Controller
{
    /**
     * @var FeedService
     */
    private $feedService;

    /**
     * @var WordRepositoryInterface
     */
    private $wordRepository;

    public function __construct(
        FeedService $feedService, 
        WordRepositoryInterface $wordRepository
    ) {
        $this->feedService = $feedService;
        $this->wordRepository = $wordRepository;
    }
    
     /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $body = $this->feedService->fetch();
        if (!$body) {
            return response()->json([
                'success' => false,
            ]);
        }

        $feeds = $this->feedService->convert($body);
        if (!$feeds) {
            return response()->json([
                'success' => false,
            ]);
        }

        $words = $this->wordRepository->getWordsAsArray();
        $topWords = $this->feedService->findFrequency($feeds, $words);
        if (!$topWords) {
            return response()->json([
                'success' => false,
            ]);
        }

        $response = $this->feedService->toResponse($topWords);

        return response()->json([
            'success' => true,
            'words' => $response,
        ]);
    }
}
