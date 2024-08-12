<?php

namespace app\command;

use Webman\Console\Util;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class MakeValidator extends Command
{
    protected static $defaultName = 'make:validator';
    protected static $defaultDescription = 'make validator';

    /**
     * @return void
     */
    protected function configure()
    {
        $this->addArgument('name', InputArgument::OPTIONAL, 'Validator name');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('name');
        $output->writeln("Make validator $name");
        $suffix = config('app.validator_suffix', '');

        if ($suffix && !strpos($name, $suffix)) {
            $name .= $suffix;
        }

        $name = str_replace('\\', '/', $name);
        if (!($pos = strrpos($name, '/'))) {
            $name = ucfirst($name);
            $validatorStr = Util::guessPath(app_path(), 'validator') ?: 'validator';
            $file = app_path() . "/$validatorStr/$name.php";
            $namespace = $validatorStr === 'Validator' ? 'App\Validator' : 'app\validator';
        } else {
            $nameStr = substr($name, 0, $pos);
            if ($realNameStr = Util::guessPath(app_path(), $nameStr)) {
                $nameStr = $realNameStr;
            } else if ($realSectionName = Util::guessPath(app_path(), strstr($nameStr, '/', true))) {
                $upper = strtolower($realSectionName[0]) !== $realSectionName[0];
            } else if ($realBaseController = Util::guessPath(app_path(), 'controller')) {
                $upper = strtolower($realBaseController[0]) !== $realBaseController[0];
            }
            $upper = $upper ?? strtolower($nameStr[0]) !== $nameStr[0];
            if ($upper && !$realNameStr) {
                $nameStr = preg_replace_callback('/\/([a-z])/', function ($matches) {
                    return '/' . strtoupper($matches[1]);
                }, ucfirst($nameStr));
            }

            if (strpos($name, $upper ? 'Validator' : 'validator') !== false) {
                $path = $nameStr;
            } else {
                $path = "$nameStr/" . ($upper ? 'Validator' : 'validator');
            }

            $name = ucfirst(substr($name, $pos + 1));
            $file = app_path() . "/$path/$name.php";
            $namespace = str_replace('/', '\\', ($upper ? 'App/' : 'app/') . $path);
        }
        $this->createValidator($name, $namespace, $file);

        return self::SUCCESS;
    }

    /**
     * 获取文件路径字符串
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'stub' . DIRECTORY_SEPARATOR . 'validator.stub';
    }

    /**
     * @param $name
     * @param $namespace
     * @param $file
     * @return void
     */
    protected function createValidator($name, $namespace, $file)
    {
        $path = pathinfo($file, PATHINFO_DIRNAME);
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        $stub = file_get_contents($this->getStub());
        $stub = str_replace(['%namespace%', '%validatorClass%'], [$namespace, $name], $stub);

        file_put_contents($file, $stub);
    }
}
