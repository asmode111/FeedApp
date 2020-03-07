<?php

namespace App\Services\Contracts;

use App\Services\Builder\RequestBuilder;
  
interface FetchServiceInterface
{
    public function fetch(RequestBuilder $requestBuilder): bool;
    public function getBody(): string;
}