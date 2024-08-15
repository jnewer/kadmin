<?php

namespace app\command;

use Webman\Console\Util;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeService extends Command
{
    protected static $defaultName = 'make:service';
    protected static $defaultDescription = 'make service';

    protected $upper = false;

    /**
     * @return void
     */
    protected function configure()
    {
        $this->addArgument('name', InputArgument::OPTIONAL, 'Service name');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('name');
        $output->writeln("Make service $name");
        $suffix = config('app.service_suffix', '');

        if ($suffix && !strpos($name, $suffix)) {
            $name .= $suffix;
        }

        $name = str_replace('\\', '/', $name);
        if (!($pos = strrpos($name, '/'))) {
            $name = ucfirst($name);
            $serviceStr = Util::guessPath(app_path(), 'service') ?: 'service';
            $file = app_path() . "/$serviceStr/$name.php";
            $namespace = $serviceStr === 'Service' ? 'App\Service' : 'app\service';
        } else {
            $nameStr = substr($name, 0, $pos);
            if ($realNameStr = Util::guessPath(app_path(), $nameStr)) {
                $nameStr = $realNameStr;
            } else if ($realSectionName = Util::guessPath(app_path(), strstr($nameStr, '/', true))) {
                $upper = strtolower($realSectionName[0]) !== $realSectionName[0];
            } else if ($realBaseController = Util::guessPath(app_path(), 'controller')) {
                $upper = strtolower($realBaseController[0]) !== $realBaseController[0];
            }
            $this->upper = $upper ?? strtolower($nameStr[0]) !== $nameStr[0];
            if ($this->upper && !$realNameStr) {
                $nameStr = preg_replace_callback('/\/([a-z])/', function ($matches) {
                    return '/' . strtoupper($matches[1]);
                }, ucfirst($nameStr));
            }

            if (strpos($name, $this->upper ? 'Service' : 'service') !== false) {
                $path = $nameStr;
            } else {
                $path = "$nameStr/" . ($this->upper ? 'Service' : 'service');
            }

            $name = ucfirst(substr($name, $pos + 1));
            $file = app_path() . "/$path/$name.php";
            $namespace = str_replace('/', '\\', ($this->upper ? 'App/' : 'app/') . $path);
        }
        $this->createService($name, $namespace, $file);

        return self::SUCCESS;
    }

    /**
     * 获取文件路径字符串
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'stub' . DIRECTORY_SEPARATOR . 'service.stub';
    }

    /**
     * @param $name
     * @param $namespace
     * @param $file
     * @return void
     */
    protected function createService($name, $namespace, $file)
    {
        $path = pathinfo($file, PATHINFO_DIRNAME);
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        $stub = file_get_contents($this->getStub());
        $modelNamespace = str_replace($this->upper ? 'Service' : 'service', $this->upper ? 'Model' : 'model', $namespace);
        $modelClass = str_replace('Service', '', $name);
        $validatorNamespace = str_replace($this->upper ? 'Service' : 'service', $this->upper ? 'Validator' : 'validator', $namespace);
        $validatorClass = str_replace('Service', 'Validator', $name);
        $stub = str_replace([
            '%namespace%',
            '%serviceClass%',
            '%modelNamespace%',
            '%modelClass%',
            '%validatorNamespace%',
            '%validatorClass%'
        ], [
            $namespace,
            $name,
            $modelNamespace,
            $modelClass,
            $validatorNamespace,
            $validatorClass
        ], $stub);

        file_put_contents($file, $stub);
    }
}
