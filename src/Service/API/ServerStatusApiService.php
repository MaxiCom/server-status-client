<?php

namespace App\Service\API;

use App\Service\Metrics\ActiveUserService;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class ServerStatusApiService
{
    /**
     * @throws TransportExceptionInterface
     */
    private static function request(string $endpoint, array $values): void
    {
        $httpClient = HttpClient::create();
        $httpClient->request(
            'POST',
            $_ENV['API_URL'] . $endpoint,
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
            'api_key' => $_ENV['API_KEY'],
        ]);
    }
}
