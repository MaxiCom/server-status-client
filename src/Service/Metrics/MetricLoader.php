<?php

namespace App\Service\Metrics;

use Generator;

class MetricLoader
{
    public static function getMetrics(): Generator
    {
        yield ActiveUserMetric::class;
        yield CpuUsageMetric::class;
        yield DiskUsageMetric::class;
        yield MemoryUsageMetric::class;
    }
}
