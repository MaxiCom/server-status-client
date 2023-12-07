<?php

namespace App\Service\API;

use App\Service\Metrics\ActiveUserMetric;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class ServerStatusClientApiService
{
    public static string $apiUrl;
    public static string $apiKey;

    private static function request(string $endpoint, array $values): void
    {
        $httpClient = HttpClient::create();

        $values['API_KEY'] = self::$apiKey;

        try {
            $httpClient->request(
                'POST',
                self::$apiUrl . $endpoint,
                [
                    'json' => $values,
                ]
            );
        } catch (TransportExceptionInterface $e) {
            echo $e;
        }
    }

    public static function apiUpdate(): void
    {
        self::request(
            ActiveUserMetric::getApiEndpoint(),
            ActiveUserMetric::getMetricValue()
        );
    }
}
