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

namespace think\route\dispatch;

use think\route\Dispatch;

class Callback extends Dispatch
{
    public function exec()
    {
        // 执行回调方法
        $vars = array_merge($this->request->param(), $this->param);

        return $this->app->invoke($this->dispatch, $vars);
    }

}
