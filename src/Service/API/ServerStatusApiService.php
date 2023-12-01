<?php

namespace App\Service\API;

use App\Service\Metrics\ActiveUserService;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\Dotenv\Exception\FormatException;
use Symfony\Component\Dotenv\Exception\PathException;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class ServerStatusApiService
{
    private static string $envFilePath = __DIR__ . '/../../../.env';
    private static string $apiUrl;

    /**
     * @throws FormatException
     * @throws PathException
     *
     *
     * @return void
     */
    private static function fetchApiUrl(): void
    {
        $dotenv = new Dotenv();
        $dotenv->load(self::$envFilePath);

        self::$apiUrl = $_ENV['API_URL'];
    }

    /**
     * @throws TransportExceptionInterface
     */
    private static function request(string $endpoint, array $values): void
    {
        self::fetchApiUrl();

        $httpClient = HttpClient::create();
        $httpClient->request(
            'POST',
            self::$apiUrl . $endpoint,
            [
                'json' => $values,
            ]
        );
    }

    /**
     * @throws TransportExceptionInterface
     *
     * @return void
     */
    public static function apiUpdate(): void
    {
        $activeUserCount = ActiveUserService::fetchCount();

        self::request('/active_user_counts', [
            'count' => $activeUserCount,
        ]);
    }
}
