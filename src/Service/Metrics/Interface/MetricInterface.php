<?php

namespace App\Service\Metrics\Interface;

interface MetricInterface
{
    public static function getApiEndpoint(): string;
    public static function getMetricValue(): array;
}
