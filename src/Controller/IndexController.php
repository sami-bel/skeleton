<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class IndexController
{
    public function index(): JsonResponse
    {
        return new JsonResponse(['index' => 'home page'] );
    }
}