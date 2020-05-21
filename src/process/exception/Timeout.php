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

namespace think\process\exception;

use think\Process;

class Timeout extends \RuntimeException
{

    const TYPE_GENERAL = 1;
    const TYPE_IDLE    = 2;

    private $process;
    private $timeoutType;

    public function __construct(Process $process, $timeoutType)
    {
        $this->process     = $process;
        $this->timeoutType = $timeoutType;

        parent::__construct(sprintf('The process "%s" exceeded the timeout of %s seconds.', $process->getCommandLine(), $this->getExceededTimeout()));
    }

    public function getProcess()
    {
        return $this->process;
    }

    public function isGeneralTimeout()
    {
        return $this->timeoutType === self::TYPE_GENERAL;
    }

    public function isIdleTimeout()
    {
        return $this->timeoutType === self::TYPE_IDLE;
    }

    public function getExceededTimeout()
    {
        switch ($this->timeoutType) {
            case self::TYPE_GENERAL:
                return $this->process->getTimeout();

            case self::TYPE_IDLE:
                return $this->process->getIdleTimeout();

            default:
                throw new \LogicException(sprintf('Unknown timeout type "%d".', $this->timeoutType));
        }
    }
}
