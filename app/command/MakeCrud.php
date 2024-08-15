<?php

namespace app\command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

class MakeCrud extends Command
{
    protected static $defaultName = 'make:crud';
    protected static $defaultDescription = 'make crud';

    /**
     * @return void
     */
    protected function configure()
    {
        $this->addArgument('name', InputArgument::OPTIONAL, 'Model name. ');
        $this->addOption('table', 't', InputOption::VALUE_OPTIONAL, 'Select table name. ');
        $this->addOption('connection', 'c', InputOption::VALUE_OPTIONAL, 'Select database connection. ');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('name');
        $table = $input->getOption('table');
        $connection = $input->getOption('connection');
        $makeModelCmd = 'php webman make:model ' . $name;

        if ($table) {
            $makeModelCmd .= ' -t ' . $table;
        }

        if ($connection) {
            $makeModelCmd .= ' -c ' . $connection;
        }

        system($makeModelCmd);

        system('php webman make:validator ' . str_replace('model', 'validator', $name));

        system('php webman make:service ' . str_replace('model', 'service', $name));

        system('php webman make:controller ' . str_replace('model', 'controller', $name) . ' --crud=1');

        return self::SUCCESS;
    }
}
