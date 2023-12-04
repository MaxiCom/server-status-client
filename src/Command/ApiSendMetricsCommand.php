<?php

namespace App\Command;

use App\Service\API\ServerStatusClientApiService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'api:send-metrics')]
class ApiSendMetricsCommand extends Command
{
    public function __toString(): string
    {
        return parent::getName();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        ServerStatusClientApiService::apiUpdate();

        return Command::SUCCESS;
    }
}
