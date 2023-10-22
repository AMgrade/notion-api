<?php

declare(strict_types=1);

namespace AMgrade\NotionApi\Endpoints;

use function array_filter;
use function base64_encode;

use const null;

class Authorization extends Endpoint
{
    public function getAuthorizeUrl(
        string $clientId,
        string $redirectUri,
        ?string $state = null,
    ): string {
        $url = $this->httpClient->getFullUrl('oauth/authorize');
        $url .= '?owner=user';
        $url .= '&response_type=code';
        $url .= "&client_id={$clientId}";
        $url .= "&redirect_uri={$redirectUri}";

        if ($state) {
            $url .= "&state={$state}";
        }

        return $url;
    }

    public function createToken(
        string $code,
        string $clientId,
        string $clientSecret,
        ?string $redirectUri = null,
    ): array {
        $token = base64_encode("{$clientId}:{$clientSecret}");

        return $this->httpClient
            ->withHeaders(['Authorization' => "Bearer {$token}"])
            ->withJson(array_filter([
                'grant_type' => 'authorization_code',
                'code' => $code,
                'redirect_uri' => $redirectUri,
            ]))
            ->post('oauth/token')
            ->json();
    }
}
