<?php

declare(strict_types=1);

namespace AMgrade\NotionApi\Endpoints;

class Database extends Endpoint
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
            ->post('databases')
            ->json();
    }

    /**
     * @see https://developers.notion.com/reference/post-database-query-filter
     * @see https://developers.notion.com/reference/post-database-query-sort
     */
    public function query(
        string $databaseId,
        array $body = [],
        array $query = [],
    ): array {
        return $this->httpClient
            ->withJson($body)
            ->withQuery($query)
            ->post("databases/{$databaseId}/query")
            ->json();
    }

    public function retrieve(string $databaseId): array
    {
        return $this->httpClient
            ->get("databases/{$databaseId}")
            ->json();
    }

    public function update(string $databaseId, array $data): array
    {
        return $this->httpClient
            ->withJson($data)
            ->patch("databases/{$databaseId}")
            ->json();
    }

    public function updateProperties(
        string $databaseId,
        array $properties,
    ): array {
        return $this->update($databaseId, ['properties' => $properties]);
    }
}
