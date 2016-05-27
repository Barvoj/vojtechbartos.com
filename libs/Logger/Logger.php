<?php

namespace Libs\Logger;

use Exception;

/**
 * Interface Logger
 */
interface Logger
{
    /**
     * @param string|Exception $message
     * @return void
     */
    public function addDebug($message);

    /**
     * @param string|Exception $message
     * @return void
     */
    public function addInfo($message);

    /**
     * @param string|Exception $message
     * @return void
     */
    public function addNotice($message);

    /**
     * @param string|Exception $message
     * @return void
     */
    public function addWarning($message);

    /**
     * @param string|Exception $message
     * @return void
     */
    public function addError($message);

    /**
     * @param string|Exception $message
     * @return void
     */
    public function addCritical($message);

    /**
     * @param string|Exception $message
     * @return void
     */
    public function addAlert($message);

    /**
     * @param string|Exception $message
     * @return void
     */
    public function addEmergency($message);
}