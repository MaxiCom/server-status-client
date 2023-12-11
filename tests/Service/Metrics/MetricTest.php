<?php

namespace App\Tests\Service\Metrics;

use App\Service\Metrics\Interface\MetricInterface;
use App\Service\Metrics\MetricLoader;
use PHPUnit\Framework\TestCase;

class MetricTest extends TestCase
{
    public function testMetrics(): void
    {
        foreach (MetricLoader::getMetrics() as $metric) {
            $this->assertInstanceOf(MetricInterface::class, new $metric());

            $this->assertIsString(call_user_func([$metric, 'getApiEndpoint']));

            $this->assertIsArray(call_user_func([$metric, 'getMetricValue']));
            $this->assertNotEmpty(call_user_func([$metric, 'getMetricValue']));
        }
    }
}
