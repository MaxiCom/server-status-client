<?php

namespace App\Tests\Service\API;

use App\Service\API\ServerStatusClientApiService;
use App\Service\EnvService;
use PHPUnit\Framework\TestCase;

class ServerStatusClientApiServiceTest extends TestCase
{
    public function testProperties(): void
    {
        EnvService::load();

        $apiUrl = ServerStatusClientApiService::$apiUrl;
        $apiKey = ServerStatusClientApiService::$apiKey;

        $this->assertNotFalse(filter_var($apiUrl, FILTER_VALIDATE_URL));
        $this->assertNotEmpty($apiKey);
    }
}
