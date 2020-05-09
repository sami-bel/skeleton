<?php

namespace App\Client;

use Psr\Http\Message\ResponseInterface;

interface HttpClientInterface
{
    public function post(string $uri, array $body): ResponseInterface;

    public function get(string $uri, array $params = []): ResponseInterface;
}