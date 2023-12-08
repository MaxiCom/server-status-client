<?php

namespace App\Service\Metrics;

use App\Service\Metrics\Interface\MetricInterface;
use Override;

class MemoryUsage implements MetricInterface
{
    #[Override] public static function getApiEndpoint(): string
    {
        return '/memory_usage';
    }

    #[Override] public static function getMetricValue(): array
    {
        return self::getMemoryUsage();
    }

    private static function getMemoryUsage(): array
    {
        $memoryUsage = shell_exec('free -m');
        $lines = explode("\n", $memoryUsage);

        foreach ($lines as $line) {
            if (str_contains($line, 'Mem:')) {
                $parts = preg_split('/\s+/', $line);
                $total = $parts[1];
                $used = $parts[2];
                break; // Assuming you only want the first occurrence
            }
        }

        return [
            'memory_total' => $total ?? 0,
            'memory_used' => $used ?? 0,
        ];
    }
}
