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

namespace think\config\driver;

class Json
{
    protected $config;

    public function __construct($config)
    {
        if (is_file($config)) {
            $config = file_get_contents($config);
        }

        $this->config = $config;
    }

    public function parse()
    {
        return json_decode($this->config, true);
    }
}
