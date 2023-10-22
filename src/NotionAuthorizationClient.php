<?php

declare(strict_types=1);

namespace AMgrade\NotionApi;

use AMgrade\NotionApi\Endpoints\Authorization;
use McMatters\Ticl\Client;

use function is_bool;

use const null;
use const true;

class NotionAuthorizationClient
{
    protected Authorization $endpoint;

    public function __construct(
        protected string $clientId,
        protected string $clientSecret,
        protected string $redirectUri,
    ) {
        $this->endpoint = new Authorization(
            new Client(['base_uri' => 'https://api.notion.com/v1/']),
        );
    }

    public function getAuthorizeUrl(?string $state = null): string
    {
        return $this->endpoint->getAuthorizeUrl(
            $this->clientId,
            $this->redirectUri,
            $state,
        );
    }

    public function createToken(
        string $code,
        bool|string $redirectUri = true,
    ): array {
        if (is_bool($redirectUri)) {
            $redirectUri = $redirectUri ? $this->redirectUri : null;
        }

        return $this->endpoint->createToken(
            $code,
            $this->clientId,
            $this->clientSecret,
            $redirectUri,
        );
    }
}
