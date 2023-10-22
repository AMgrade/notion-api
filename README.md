## PHP client for Notion API

### Installation
```shell
composer require amgrade/notion-api
```

### Usage

#### Authorization

```php
<?php

declare(strict_types=1);

use AMgrade\NotionApi\NotionAuthorizationClient;

require __DIR__.'/vendor/autoload.php';

$clientId = 'XXXXXX';
$clientSecret = 'XXXXXX';
$redirectUri = 'https://your-site.com';

$client = new NotionAuthorizationClient($clientId, $clientSecret, $redirectUri);

$url = $client->getAuthorizeUrl();

// Redirect user to the url

// After that exchange your "code" and get "access_token"
$response = $client->createToken('CODE');

$accessToken = $response['access_token'];
```

#### API usage

```php
<?php

declare(strict_types=1);

use AMgrade\NotionApi\NotionClient;

require __DIR__.'/vendor/autoload.php';

// Read more about how you can get token here:
// https://developers.notion.com/docs/authorization
$token = 'secret_XXXXXXX';
$notionVersion = '2022-06-28';

$client = new NotionClient($token, $notionVersion);

$me = $client->user()->me();

$pages = $client->search()->search([
    'filter' => [
        'value' => 'page',
        'property' => 'object',
    ],
]);

$databases = $client->search()->search([
    'filter' => [
        'value' => 'database',
        'property' => 'object',
    ],
]);
```
