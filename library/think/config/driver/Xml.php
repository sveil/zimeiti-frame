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

class Xml
{
    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function parse()
    {
        if (is_file($this->config)) {
            $content = simplexml_load_file($this->config);
        } else {
            $content = simplexml_load_string($this->config);
        }

        $result = (array) $content;
        foreach ($result as $key => $val) {
            if (is_object($val)) {
                $result[$key] = (array) $val;
            }
        }

        return $result;
    }
}
