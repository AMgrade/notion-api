<?php

declare(strict_types=1);

namespace AMgrade\NotionApi\Endpoints;

use McMatters\Ticl\Client;

abstract class Endpoint
{
    public function __construct(protected Client $httpClient)
    {
    }
}
