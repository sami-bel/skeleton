<?php

namespace App\Controller;

use Arris\HttpClientBundle\Services\Hello;
use Psr\Http\Client\ClientInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class IndexController
{
    public function index(Hello $hello, ClientInterface $client): JsonResponse
    {
        return new JsonResponse(['index' => $hello->hello()]);
    }
}