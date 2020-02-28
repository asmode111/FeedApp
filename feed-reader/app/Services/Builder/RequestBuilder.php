<?php
namespace App\Services\Builder;

class RequestBuilder
{
    /**
     * string
     */
    public $url = '';
    
    /**
     * string
     */
    public $method = 'GET';

    /**
     * float
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