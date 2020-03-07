<?php
namespace App\Services;
  
use App\Services\Contracts\FetchServiceInterface;
use App\Services\Builder\RequestBuilder;

class WordService
{
    /**
     * @var FetchServiceInterface
     */
    private $fetchService;
    
    public const SOURCE_URL = 'https://en.wikipedia.org/wiki/Most_common_words_in_English';
    private const WORD_REGEX_RULE = '/<td><a href="(.*)" class="extiw" title="(.*)">(.*)<\/a><\/td>/';
    private const WORD_LIMIT = 50;

    public function __construct(FetchServiceInterface $fetchService)
    {
        $this->fetchService = $fetchService;
    }

    public function fetch(): string
    {
        $requestBuilder = (new RequestBuilder)
            ->setUrl(self::SOURCE_URL);

        $isFetched = $this->fetchService->fetch($requestBuilder);

        if ($isFetched) {
            return $this->fetchService->getBody();
        }

        return '';
    }

    public function extract(string $body): array
    {
        preg_match_all(self::WORD_REGEX_RULE, $body, $matchedWords);
        if (!$matchedWords || !$matchedWords[3]) {
            return [];
        }

        return array_slice($matchedWords[3], 0, self::WORD_LIMIT);
    }
}