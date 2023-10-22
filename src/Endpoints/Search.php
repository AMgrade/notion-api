<?php

declare(strict_types=1);

namespace AMgrade\NotionApi\Endpoints;

class Search extends Endpoint
{
    public function search(array $body): array
    {
        return $this->httpClient
            ->withJson($body)
            ->post('search')
            ->json();
    }
}
