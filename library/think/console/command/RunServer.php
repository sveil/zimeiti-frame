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

class RunServer extends Command
{
    public function configure()
    {
        $this->setName('run')
            ->addOption('host', 'H', Option::VALUE_OPTIONAL,
                'The host to server the application on', '127.0.0.1')
            ->addOption('port', 'p', Option::VALUE_OPTIONAL,
                'The port to server the application on', 8000)
            ->addOption('root', 'r', Option::VALUE_OPTIONAL,
                'The document root of the application', App::getRootPath() . 'public')
            ->setDescription('PHP Built-in Server for ThinkPHP');
    }

    public function execute(Input $input, Output $output)
    {
        $host = $input->getOption('host');
        $port = $input->getOption('port');
        $root = $input->getOption('root');

        $command = sprintf(
            'php -S %s:%d -t %s %s',
            $host,
            $port,
            escapeshellarg($root),
            escapeshellarg($root . DIRECTORY_SEPARATOR . 'router.php')
        );

        $output->writeln(sprintf('ThinkPHP Development server is started On <http://%s:%s/>', $host, $port));
        $output->writeln(sprintf('You can exit with <info>`CTRL-C`</info>'));
        $output->writeln(sprintf('Document root is: %s', $root));
        passthru($command);
    }

}
