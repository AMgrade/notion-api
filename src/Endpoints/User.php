<?php

declare(strict_types=1);

namespace AMgrade\NotionApi\Endpoints;

class User extends Endpoint
{
    public function list(array $query = []): array
    {
        return $this->httpClient
            ->withQuery($query)
            ->get('users')
            ->json();
    }

    public function retrieve(string $userId): array
    {
        return $this->httpClient
            ->get("users/{$userId}")
            ->json();
    }

    public function me(): array
    {
        return $this->httpClient
            ->get('users/me')
            ->json();
    }
}
