<?php

namespace App\Service;

use Symfony\Component\Dotenv\Dotenv;

class EnvService
{
    private const string ENV_FILE_PATH = __DIR__ . '/../../.env';

    public static function load(): void
    {
        $dotenv = new Dotenv();
        $dotenv->load(self::ENV_FILE_PATH);
    }
}
