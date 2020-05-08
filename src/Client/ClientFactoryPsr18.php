<?php

namespace App\Client;

use Psr\Http\Client\ClientInterface;
use Symfony\Component\HttpClient\Psr18Client;

class ClientFactoryPsr18
{
    /**
     * @var ClientInterface
     */
    private $client;

    public function create(): ClientInterface
    {
        return new Psr18Client();
    }

}