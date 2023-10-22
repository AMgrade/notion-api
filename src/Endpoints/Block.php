<?php

declare(strict_types=1);

namespace AMgrade\NotionApi\Endpoints;

class Block extends Endpoint
{
    public function appendChildren(
        string $blockId,
        array $children,
        string $afterId,
    ): array {
        return $this->httpClient
            ->withJson(['children' => $children, 'after' => $afterId])
            ->patch("blocks/{$blockId}/children")
            ->json();
    }

    public function retrieve(string $blockId): array
    {
        return $this->httpClient
            ->get("blocks/{$blockId}")
            ->json();
    }

    public function retrieveChildren(string $blockId, array $query = []): array
    {
        return $this->httpClient
            ->withQuery($query)
            ->get("blocks/{$blockId}/children")
            ->json();
    }

    public function update(string $blockId, array $data): array
    {
        return $this->httpClient
            ->withJson($data)
            ->patch("blocks/{$blockId}")
            ->json();
    }

    public function delete(string $blockId): array
    {
        return $this->httpClient
            ->delete("blocks/{$blockId}")
            ->json();
    }
}
