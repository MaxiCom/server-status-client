<?php

namespace App\Service\API;

use App\Service\Metrics\ActiveUserService;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class ServerStatusApiService
{
    public static string $apiUrl;
    public static string $apiKey;

    /**
     * @throws TransportExceptionInterface
     */
    private static function request(string $endpoint, array $values): void
    {
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
            'api_key' => self::$apiKey,
        ]);
    }
}
