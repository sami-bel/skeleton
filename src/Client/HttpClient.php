<?php

namespace App\Client;

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;

class HttpClient implements HttpClientInterface
{
    /**
     * @var ClientInterface
     */
    private $client;
    /**
     * @var RequestFactoryInterface
     */
    private $requestFactory;
    /**
     * @var StreamFactoryInterface
     */
    private $stream;

    public function __construct(ClientInterface $client, RequestFactoryInterface $requestFactory, StreamFactoryInterface $stream)
    {
        $this->client = $client;
        $this->requestFactory = $requestFactory;
        $this->stream = $stream;
    }

    public function post(string $uri, array $body = []): ResponseInterface
    {
        $request = $this->createRequest('POST', $uri, $body);

        try {
            return $this->client->sendRequest($request);
        } catch (ClientExceptionInterface $e) {
            throw new $e;
        }
    }

    public function get(string $uri, array $params = []): ResponseInterface
    {
        $uri = $this->createUriWithParams($uri, $params);
        $request = $this->createRequest('GET', $uri);

        try {
            return $this->client->sendRequest($request);
        } catch (ClientExceptionInterface $e) {
            throw new $e;
        }
    }

    public function createRequest(string $method, string $uri, array $body = []): RequestInterface
    {
        $request = $this->requestFactory->createRequest($method, $uri);

        if (!empty($body)) {
            $stream = $this->stream->createStream(json_encode($body));
            $stream->seek(0);
            $request = $request->withBody($stream);
        }

        return $request->withHeader('Content-Type', 'application/json');
    }

    public function createUriWithParams(string $url, array $queryParams = []): string
    {
        return !empty($queryParams) ? $url . '?' . http_build_query(array_filter($queryParams)) : $url;
    }
}