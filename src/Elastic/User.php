<?php

namespace App\Elastic;

use App\Client\HttpClientInterface;
use Psr\Http\Message\ResponseInterface;

class User
{
    public const USER_TOTO = 'user/toto';
    public const USER_TOTO_SEARCH = 'user/toto/_search';
    public const HOST = 'http://elasticsearch:9200/';
    /**
     * @var HttpClientInterface
     */
    private $clientHttp;

    public function __construct(HttpClientInterface $clientHttp)
    {
        $this->clientHttp = $clientHttp;
    }

    public function getUser(?string $username): ResponseInterface
    {
        $query = [
            'query' => [
                'query_string' =>  [
                    'query' =>  $username
                ]
            ]
        ];

        return $this->clientHttp->post(self::HOST.self::USER_TOTO_SEARCH, $query);
    }

    public function getAllUser(): ResponseInterface
    {
        return $this->clientHttp->get(self::HOST.self::USER_TOTO_SEARCH, []);
    }

    public function saveUser($user): ResponseInterface
    {
        return $this->clientHttp->post(self::HOST.self::USER_TOTO, $user);
    }
}