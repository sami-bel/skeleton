<?php

namespace App\Controller;

use App\Elastic\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ElasticController
{
    public function search(Request $request, User $user): JsonResponse
    {
        $name = $request->get('name');

        if ($name) {
            $response = $user->getUser($name);
        }
        else {
            $response = $user->getAllUser();
        }

        return new JsonResponse(json_decode($response->getBody()->getContents(), true));
    }

    public function save(Request $request, User $elasticUser): JsonResponse
    {
        $user = json_decode($request->getContent(), true);
        $response = $elasticUser->saveUser($user);
        return new JsonResponse(json_decode($response->getBody()->getContents(), true));
    }
}