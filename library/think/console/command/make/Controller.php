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

namespace think\console\command\make;

use think\console\command\Make;
use think\console\input\Option;
use think\facade\Config;

class Controller extends Make
{
    protected $type = "Controller";

    protected function configure()
    {
        parent::configure();
        $this->setName('make:controller')
            ->addOption('api', null, Option::VALUE_NONE, 'Generate an api controller class.')
            ->addOption('plain', null, Option::VALUE_NONE, 'Generate an empty controller class.')
            ->setDescription('Create a new resource controller class');
    }

    protected function getStub()
    {
        $stubPath = __DIR__ . DIRECTORY_SEPARATOR . 'stubs' . DIRECTORY_SEPARATOR;

        if ($this->input->getOption('api')) {
            return $stubPath . 'controller.api.stub';
        }

        if ($this->input->getOption('plain')) {
            return $stubPath . 'controller.plain.stub';
        }

        return $stubPath . 'controller.stub';
    }

    protected function getClassName($name)
    {
        return parent::getClassName($name) . (Config::get('controller_suffix') ? ucfirst(Config::get('url_controller_layer')) : '');
    }

    protected function getNamespace($appNamespace, $module)
    {
        return parent::getNamespace($appNamespace, $module) . '\controller';
    }

}
