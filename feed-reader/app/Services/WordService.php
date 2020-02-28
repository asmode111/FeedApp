<?php
namespace App\Services;
  
use App\Services\Contracts\FetchServiceInterface;
use App\Services\Builder\RequestBuilder;

class WordService
{
    /**
     * FetchServiceInterface
     */
    private $fetchService;

    /**
     * string
     */
    public $error = '';
    
    private const WORD_REGEX_RULE = '/<td><a href="(.*)" class="(.*)" title="(.*)">(.*)<\/a><\/td>/';
    private const WORD_LIMIT = 49;

    /**
     * string
     */
    private const URL = 'https://en.wikipedia.org/wiki/Most_common_words_in_English';

    public function __construct(FetchServiceInterface $fetchService)
    {
        $this->fetchService = $fetchService;
    }

    public function fetch(): string
    {
        $requestBuilder = (new RequestBuilder)
            ->setUrl(self::URL);

        $this->fetchService->fetch($requestBuilder);

        return $this->fetchService->getBody();
    }

    /**
     * $body string[]
     */
    public function extract(string $body): array
    {
        preg_match_all(self::WORD_REGEX_RULE, $body, $matchedWords);
        if (!$matchedWords || !$matchedWords[4]) {
            return [];
        }

        return array_slice($matchedWords[4], 0, self::WORD_LIMIT);
    }
}