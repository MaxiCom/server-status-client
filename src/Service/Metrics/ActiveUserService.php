<?php

namespace App\Service\Metrics;

class ActiveUserService
{
    public static function fetchCount(): int
    {
        $whoOutput = shell_exec('who');
        $explodedWhoOutput = explode('\n', trim($whoOutput));

        return count($explodedWhoOutput);
    }
}
