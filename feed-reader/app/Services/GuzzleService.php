<?php
namespace App\Services;
  
use App\Services\Contracts\FetchServiceInterface;
use GuzzleHttp\Client;
use App\Services\Builder\RequestBuilder;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Log;

class GuzzleService implements FetchServiceInterface
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $body = '';

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function fetch(RequestBuilder $requestBuilder): bool
    {
        $request = new Request($requestBuilder->method, $requestBuilder->url);
        $response = $this->client->send($request, ['timeout' => $requestBuilder->timeout]);

        $code = (int)$response->getStatusCode();
        $reason = (string)$response->getReasonPhrase();

        if ($code === 200 && $reason === 'OK') {
            $this->body = (string)$response->getBody();

            return true;
        }

        Log::error($reason);

        return false;
    }

    public function getBody(): string
    {
        return $this->body;
    }
}