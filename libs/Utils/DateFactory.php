<?php

namespace Libs\Utils;

use DateTime;
use Nette\Utils\DateTime as NetteDateTime;

/**
 * Class Date
 */
class DateFactory
{
    /** @var null|DateTime */
    private $currentDateTime = null;

    /**
     * @return DateTime
     */
    public function getCurrentDateTime() : DateTime
    {
        if (!$this->currentDateTime instanceof DateTime) {
            $this->currentDateTime = NetteDateTime::from('NOW');
        }

        return $this->currentDateTime;
    }
}