<?php

namespace App\Service\Metrics;

use App\Service\Metrics\Interface\MetricInterface;
use Override;

class CpuUsageMetric implements MetricInterface
{
    #[Override] public static function getApiEndpoint(): string
    {
        return '/cpu_usage';
    }

    #[Override] public static function getMetricValue(): array
    {
        $cpuUsage = self::getCpuUsage();

        return [
            'usage' => $cpuUsage
        ];
    }

    private static function getCpuUsage(): float|int
    {
        $load = sys_getloadavg();
        $cores = trim(shell_exec('nproc --all'));

        $cpuLoadInPercent = ($load[1] / $cores) * 100;

        return round($cpuLoadInPercent, 2);
    }
}
