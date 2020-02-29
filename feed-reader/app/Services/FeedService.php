<?php
namespace App\Services;
  
use App\Services\Contracts\FetchServiceInterface;
use App\Services\Builder\RequestBuilder;
use App\Services\Builder\WordFrequencyBuilder;
use Illuminate\Database\Eloquent\Collection;

class FeedService
{
    /**
     * @var FetchServiceInterface
     */
    private $fetchService;

    public const SOURCE_URL = 'https://www.theregister.co.uk/software/headlines.atom';
    private const WORD_LIMIT = 10;

    public function __construct(FetchServiceInterface $fetchService)
    {
        $this->fetchService = $fetchService;
    }

    public function fetch(): string
    {
        $requestBuilder = (new RequestBuilder)
            ->setUrl(self::SOURCE_URL);

        $this->fetchService->fetch($requestBuilder);

        return $this->fetchService->getBody();
    }

    public function convert(string $body): array
    {
        $xml = simplexml_load_string($body);
        $json = json_encode($xml);

        return json_decode($json, TRUE);
    }

    public function findFrequency(array $feeds, array $words): array
    {
        if (!$feeds['entry']) {
            return [];
        }
        
        $entries = $feeds['entry'];
        $matched = collect($entries)->map(static function ($entry) {
            $content = strtolower(strip_tags($entry['title'] . ' ' . $entry['summary']));
            $content = preg_replace('/[^A-Za-z0-9]/', ' ', $content);
            $row = explode(' ', $content);

            return $row;
        })
            ->collapse()
            ->filter()
            ->reject(function ($value, $key) use ($words) {
                return !in_array($value, $words);
            })
            ->countBy()
            ->toArray();

        arsort($matched);

        return array_slice($matched, 0, self::WORD_LIMIT);
    }

    public function toResponse(array $words): array
    {
        $data = [];
        foreach ($words as $word => $frequency) {
            $data[] = (new WordFrequencyBuilder)
                ->setWord($word)
                ->setFrequency($frequency)
                ->toArray();
        }

        return $data;
    }
}