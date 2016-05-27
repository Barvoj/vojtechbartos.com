<?php

namespace Libs\Logger;

use Exception;
use Tracy\Debugger;

/**
 * Wraps tracy debugger to single logger class
 */
class TracyLogger implements Logger
{

    /**
     * @param string|Exception $message
     * @return void
     */
    public function addDebug($message)
    {
        Debugger::log($message, 'debug');
    }

    /**
     * @param string|Exception $message
     * @return void
     */
    public function addInfo($message)
    {
        Debugger::log($message, 'info');
    }

    /**
     * @param string|Exception $message
     * @return void
     */
    public function addNotice($message)
    {
        Debugger::log($message, 'notice');
    }

    /**
     * @param string|Exception $message
     * @return void
     */
    public function addWarning($message)
    {
        Debugger::log($message, 'warning');
    }

    /**
     * @param string|Exception $message
     * @return void
     */
    public function addError($message)
    {
        Debugger::log($message, 'error');
    }

    /**
     * @param string|Exception $message
     * @return void
     */
    public function addCritical($message)
    {
        Debugger::log($message, 'critical');
    }

    /**
     * @param string|Exception $message
     * @return void
     */
    public function addAlert($message)
    {
        Debugger::log($message, 'alert');
    }

    /**
     * @param string|Exception $message
     * @return void
     */
    public function addEmergency($message)
    {
        Debugger::log($message, 'emergency');
    }
}