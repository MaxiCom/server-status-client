<?php

namespace App\Service\Metrics;

use App\Service\Metrics\Interface\MetricInterface;
use Override;

class ActiveUserMetric implements MetricInterface
{
    #[Override] public static function getApiEndpoint(): string
    {
        return '/active_user_counts';
    }

    #[Override] public static function getMetricValue(): array
    {
        $whoOutput = shell_exec('who');
        $explodedWhoOutput = explode('\n', trim($whoOutput));
        $activeUserCount = count($explodedWhoOutput);

        return [
            'count' => $activeUserCount,
        ];
    }
}
