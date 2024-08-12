<?php

namespace app\command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Webman\Console\Util;


class MakeController extends Command
{
    protected static $defaultName = 'make:controller';
    protected static $defaultDescription = 'make controller';

    protected $upper = false;

    /**
     * @return void
     */
    protected function configure()
    {
        $this->addArgument('name', InputArgument::OPTIONAL, 'Controller name');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('name');
        $output->writeln("Make controller $name");
        $suffix = config('app.controller_suffix', '');

        if ($suffix && !strpos($name, $suffix)) {
            $name .= $suffix;
        }

        $name = str_replace('\\', '/', $name);
        if (!($pos = strrpos($name, '/'))) {
            $name = ucfirst($name);
            $controller_str = Util::guessPath(app_path(), 'controller') ?: 'controller';
            $file = app_path() . "/$controller_str/$name.php";
            $namespace = $controller_str === 'Controller' ? 'App\Controller' : 'app\controller';
        } else {
            $nameStr = substr($name, 0, $pos);
            if ($reaNameStr = Util::guessPath(app_path(), $nameStr)) {
                $nameStr = $reaNameStr;
            } else if ($real_section_name = Util::guessPath(app_path(), strstr($nameStr, '/', true))) {
                $upper = strtolower($real_section_name[0]) !== $real_section_name[0];
            } else if ($realBaseController = Util::guessPath(app_path(), 'controller')) {
                $upper = strtolower($realBaseController[0]) !== $realBaseController[0];
            }
            $this->upper = $upper ?? strtolower($nameStr[0]) !== $nameStr[0];
            if ($this->upper && !$reaNameStr) {
                $nameStr = preg_replace_callback('/\/([a-z])/', function ($matches) {
                    return '/' . strtoupper($matches[1]);
                }, ucfirst($nameStr));
            }
            if (strpos($name, $this->upper ? 'Controller' : 'controller') !== false) {
                $path = $nameStr;
            } else {
                $path = "$nameStr/" . ($this->upper ? 'Controller' : 'controller');
            }
            $name = ucfirst(substr($name, $pos + 1));
            $file = app_path() . "/$path/$name.php";
            $namespace = str_replace('/', '\\', ($this->upper ? 'App/' : 'app/') . $path);
        }
        $this->createController($name, $namespace, $file);

        return self::SUCCESS;
    }

    /**
     * 获取文件路径字符串
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'stub' . DIRECTORY_SEPARATOR . 'controller.stub';
    }

    /**
     * @param $name
     * @param $namespace
     * @param $file
     * @return void
     */
    protected function createController($name, $namespace, $file)
    {
        $path = pathinfo($file, PATHINFO_DIRNAME);
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $stub = file_get_contents($this->getStub());
        $serviceNamespace = str_replace($this->upper ? 'Controller' : 'controller', $this->upper ? 'Service' : 'service', $namespace);
        $serviceClass = str_replace('Controller', 'Service', $name);
        $stub = str_replace([
            '%namespace%',
            '%controllerClass%',
            '%serviceNamespace%',
            '%serviceClass%'
        ], [
            $namespace,
            $name,
            $serviceNamespace,
            $serviceClass
        ], $stub);
        file_put_contents($file, $stub);
    }
}
