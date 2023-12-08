<?php

namespace App\Service\Metrics;

use App\Service\Metrics\Interface\MetricInterface;
use Override;

class DiskUsageMetric implements MetricInterface
{
    #[Override] public static function getApiEndpoint(): string
    {
        return '/disk_usage';
    }

    #[Override] public static function getMetricValue(): array
    {
        $diskUsage = self::getDiskUsage();

        return [
            'disk_usage' => $diskUsage,
        ];
    }

    private static function getDiskUsage(): float
    {
        $totalSpace = disk_total_space('/');
        $freeSpace = disk_free_space('/');
        $usedSpace = $totalSpace - $freeSpace;

        $usageInPercent = ($usedSpace / $totalSpace) * 100;

        return round($usageInPercent, 2);
    }
}
