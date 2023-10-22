<?php

declare(strict_types=1);

namespace AMgrade\NotionApi;

use AMgrade\NotionApi\Endpoints\Block;
use AMgrade\NotionApi\Endpoints\Comment;
use AMgrade\NotionApi\Endpoints\Database;
use AMgrade\NotionApi\Endpoints\Page;
use AMgrade\NotionApi\Endpoints\Search;
use AMgrade\NotionApi\Endpoints\User;
use McMatters\Ticl\Client;

class NotionClient
{
    protected Client $httpClient;

    protected array $endpoints = [];

    /**
     * @see https://developers.notion.com/reference
     */
    public function __construct(string $token, string $version = '2022-06-28')
    {
        $this->httpClient = new Client([
            'base_uri' => 'https://api.notion.com/v1/',
            'headers' => [
                'Authorization' => "Bearer {$token}",
                'Content-Type' => 'application/json',
                'Notion-Version' => $version,
            ],
            'empty_json_as_empty_string' => true,
        ]);
    }

    public function block(): Block
    {
        return $this->endpoint(Block::class);
    }

    public function comment(): Comment
    {
        return $this->endpoint(Comment::class);
    }

    public function database(): Database
    {
        return $this->endpoint(Database::class);
    }

    public function page(): Page
    {
        return $this->endpoint(Page::class);
    }

    public function search(): Search
    {
        return $this->endpoint(Search::class);
    }

    public function user(): User
    {
        return $this->endpoint(User::class);
    }

    protected function endpoint(string $class)
    {
        if (!isset($this->endpoints[$class])) {
            $this->endpoints[$class] = new $class($this->httpClient);
        }

        return $this->endpoints[$class];
    }
}
