<?php

declare(strict_types=1);

namespace AMgrade\NotionApi\Endpoints;

class Comment extends Endpoint
{
    public function create(array $richText, array $data)
    {
        return $this->httpClient
            ->withJson(['rich_text' => $richText] + $data)
            ->post('comments')
            ->json();
    }

    public function list(string $blockId, array $query = []): array
    {
        return $this->httpClient
            ->withQuery(['block_id' => $blockId] + $query)
            ->get('comments')
            ->json();
    }
}
