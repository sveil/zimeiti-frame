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

namespace think\db\exception;

use think\exception\DbException;

class DataNotFoundException extends DbException
{
    protected $table;

    /**
     * DbException constructor.
     * @access public
     * @param  string $message
     * @param  string $table
     * @param  array $config
     */
    public function __construct($message, $table = '', array $config = [])
    {
        $this->message = $message;
        $this->table   = $table;

        $this->setData('Database Config', $config);
    }

    /**
     * 获取数据表名
     * @access public
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }
}
