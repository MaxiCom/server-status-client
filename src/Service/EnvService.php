<?php

namespace App\Service;

use App\Service\API\ServerStatusClientApiService;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\Dotenv\Exception\FormatException;
use Symfony\Component\Dotenv\Exception\PathException;

class EnvService
{
    private const string ENV_FILE_PATH = __DIR__ . '/../../.env';

    public static function load(): void
    {
        $dotenv = new Dotenv();

        try {
            $dotenv->load(self::ENV_FILE_PATH);
        } catch (FormatException | PathException $exception) {
            echo $exception;
        }

        ServerStatusClientApiService::$apiUrl = $_ENV['API_URL'];
        ServerStatusClientApiService::$apiKey = $_ENV['API_KEY'];
    }
}
