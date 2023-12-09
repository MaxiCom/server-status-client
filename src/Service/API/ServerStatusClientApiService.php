<?php

namespace App\Service\API;

use App\Service\Metrics\MetricLoader;
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
        foreach (MetricLoader::getMetrics() as $metric) {
            self::request(
                call_user_func([$metric, 'getApiEndpoint']),
                call_user_func([$metric, 'getMetricValue']),
            );
        }
    }
}
