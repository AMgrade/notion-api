<?php

declare(strict_types=1);

namespace AMgrade\NotionApi\Endpoints;

use const true;

class Page extends Endpoint
{
    public function create(
        array $parent,
        array $properties,
        array $data = [],
    ): array {
        return $this->httpClient
            ->withJson([
                    'parent' => $parent,
                    'properties' => $properties
                ] + $data,
            )
            ->post('pages')
            ->json();
    }

    public function retrieve(string $pageId, array $query = []): array
    {
        return $this->httpClient
            ->withQuery($query)
            ->get("pages/{$pageId}")
            ->json();
    }

    public function retrieveProperty(
        string $pageId,
        string $propertyId,
        array $query = [],
    ): array {
        return $this->httpClient
            ->withQuery($query)
            ->get("pages/{$pageId}/properties/{$propertyId}")
            ->json();
    }

    public function updateProperties(string $pageId, array $data): array
    {
        return $this->httpClient
            ->withJson($data)
            ->patch("pages/{$pageId}")
            ->json();
    }

    public function archive(string $pageId): array
    {
        return $this->updateProperties(
            $pageId,
            ['archived' => true],
        );
    }
}
