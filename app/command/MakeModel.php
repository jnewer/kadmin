<?php

namespace app\command;

use Doctrine\Inflector\InflectorFactory;
use support\Db;
use Webman\Console\Commands\MakeModelCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Webman\Console\Util;


class MakeModel extends MakeModelCommand
{
    protected static $defaultName = 'make:model';
    protected static $defaultDescription = 'make model';

    /**
     * @return void
     */
    protected function configure()
    {
        $this->addArgument('name', InputArgument::OPTIONAL, 'Model name');
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
        $name = Util::nameToClass($name);
        $connection = $input->getOption('connection');
        $table = $input->getOption('table');
        $output->writeln("Make model $name");
        if (!($pos = strrpos($name, '/'))) {
            $name = ucfirst($name);
            $modelStr = Util::guessPath(app_path(), 'model') ?: 'model';
            $file = app_path() . "/$modelStr/$name.php";
            $namespace = $modelStr === 'Model' ? 'App\Model' : 'app\model';
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
            if (strpos($name, $upper ? 'Model' : 'model') !== false) {
                $path = $nameStr;
            } else {
                $path = "$nameStr/" . ($upper ? 'Model' : 'model');
            }
            $name = ucfirst(substr($name, $pos + 1));
            $file = app_path() . "/$path/$name.php";
            $namespace = str_replace('/', '\\', ($upper ? 'App/' : 'app/') . $path);
        }
        $database = config('database');
        if (isset($database['default']) && strpos($database['default'], 'plugin.') === 0) {
            $database = false;
        }
        $this->createModel($name, $namespace, $file, $connection, $table);

        return self::SUCCESS;
    }


    /**
     * 获取文件路径字符串
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'stub' . DIRECTORY_SEPARATOR . 'model.stub';
    }

    /**
     * @param $class
     * @param $namespace
     * @param $file
     * @param string|null $connection
     * @return void
     */
    protected function createModel($class, $namespace, $file, $connection = null, $table = null)
    {
        $path = pathinfo($file, PATHINFO_DIRNAME);
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        $table = $table ?: Util::classToName($class);
        $tableVal = 'null';
        $pk = 'id';
        $properties = '';
        $connection = $connection ?: 'mysql';
        try {
            $prefix = config("database.connections.$connection.prefix") ?? '';
            $database = config("database.connections.$connection.database");
            $inflector = InflectorFactory::create()->build();
            $tablePlura = $inflector->pluralize($inflector->tableize($class));
            $con = Db::connection($connection);
            $tableVal = "'$table'";
            if ($con->select("show tables like '{$prefix}{$tablePlura}'")) {
                $table = "{$prefix}{$tablePlura}";
            } else if ($con->select("show tables like '{$prefix}{$table}'")) {
                $table = "{$prefix}{$table}";
            }
            $tableComment = $con->select('SELECT table_comment FROM information_schema.`TABLES` WHERE table_schema = ? AND table_name = ?', [$database, $table]);
            if (!empty($tableComment)) {
                $comments = $tableComment[0]->table_comment ?? $tableComment[0]->TABLE_COMMENT;
                $properties .= " * {$table} {$comments}" . PHP_EOL;
            }
            foreach ($con->select("select COLUMN_NAME,DATA_TYPE,COLUMN_KEY,COLUMN_COMMENT from INFORMATION_SCHEMA.COLUMNS where table_name = '$table' and table_schema = '$database' ORDER BY ordinal_position") as $item) {
                if ($item->COLUMN_KEY === 'PRI') {
                    $pk = $item->COLUMN_NAME;
                    $item->COLUMN_COMMENT .= "(主键)";
                }
                $type = $this->getType($item->DATA_TYPE);
                $properties .= " * @property $type \${$item->COLUMN_NAME} {$item->COLUMN_COMMENT}\n";
            }
        } catch (\Throwable $e) {
            echo $e->getMessage() . PHP_EOL;
        }
        $properties = rtrim($properties) ?: ' *';
        $stub = file_get_contents($this->getStub());
        $stub = str_replace([
            '%namespace%',
            '%properties%',
            '%modelClass%',
            '%connection%',
            '%tableVal%',
            '%pk%'
        ], [
            $namespace,
            $properties,
            $class,
            $connection,
            $tableVal,
            $pk
        ], $stub);

        file_put_contents($file, $stub);
    }
}
