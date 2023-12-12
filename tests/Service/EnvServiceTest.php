<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\EnvService;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class EnvServiceTest extends TestCase
{
    public function testConstEnvFilePathValid(): void
    {
        $reflectedClass = new ReflectionClass(EnvService::class);
        $envFilePath = $reflectedClass->getConstant('ENV_FILE_PATH');

        $this->assertFileExists($envFilePath);
        $this->assertFileIsReadable($envFilePath);
    }

    public function testLoad(): void
    {
        $this->expectNotToPerformAssertions();

        EnvService::load();
    }
}
