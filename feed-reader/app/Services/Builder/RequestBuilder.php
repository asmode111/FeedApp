<?php
namespace App\Services\Builder;

class RequestBuilder
{
    /**
     * @var string
     */
    public $url = '';
    
    /**
     * @var string
     */
    public $method = 'GET';

    /**
     * @var float
     */
    public $timeout = 2.0;

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function setMethod(float $method): self
    {
        $this->method = $method;

        return $this;
    }

    public function setTimeout(float $timeout): self
    {
        $this->timeout = $timeout;

        return $this;
    }
}