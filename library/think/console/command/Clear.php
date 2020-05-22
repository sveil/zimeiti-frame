<?php
// +----------------------------------------------------------------------
// | Framework for sveil/zimeiti-cms
// +----------------------------------------------------------------------
// | Copyright (c) 2019-2020 http://sveil.com All rights reserved.
// +----------------------------------------------------------------------
// | License ( http://www.gnu.org/licenses )
// +----------------------------------------------------------------------
// | gitee：https://gitee.com/sveil/zimeiti-frame
// | github：https://github.com/sveil/zimeiti-frame
// +----------------------------------------------------------------------

namespace think\console\command;

use think\console\Command;
use think\console\Input;
use think\console\input\Option;
use think\console\Output;
use think\facade\App;
use think\facade\Cache;

class Clear extends Command
{
    protected function configure()
    {
        // 指令配置
        $this
            ->setName('clear')
            ->addOption('path', 'd', Option::VALUE_OPTIONAL, 'path to clear', null)
            ->addOption('cache', 'c', Option::VALUE_NONE, 'clear cache file')
            ->addOption('route', 'u', Option::VALUE_NONE, 'clear route cache')
            ->addOption('log', 'l', Option::VALUE_NONE, 'clear log file')
            ->addOption('dir', 'r', Option::VALUE_NONE, 'clear empty dir')
            ->setDescription('Clear runtime file');
    }

    protected function execute(Input $input, Output $output)
    {
        if ($input->getOption('route')) {
            Cache::clear('route_cache');
        } else {
            if ($input->getOption('cache')) {
                $path = App::getRuntimePath() . 'cache';
            } elseif ($input->getOption('log')) {
                $path = App::getRuntimePath() . 'log';
            } else {
                $path = $input->getOption('path') ?: App::getRuntimePath();
            }

            $rmdir = $input->getOption('dir') ? true : false;
            $this->clear(rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR, $rmdir);
        }

        $output->writeln("<info>Clear Successed</info>");
    }

    protected function clear($path, $rmdir)
    {
        $files = is_dir($path) ? scandir($path) : [];

        foreach ($files as $file) {
            if ('.' != $file && '..' != $file && is_dir($path . $file)) {
                array_map('unlink', glob($path . $file . DIRECTORY_SEPARATOR . '*.*'));
                if ($rmdir) {
                    rmdir($path . $file);
                }
            } elseif ('.gitignore' != $file && is_file($path . $file)) {
                unlink($path . $file);
            }
        }
    }
}
