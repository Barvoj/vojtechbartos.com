<?php

namespace Libs\Application\UI;

class Presenter extends \Nette\Application\UI\Presenter
{

    /**
     * @param string $message
     * @return string
     */
    protected function translate(string $message) : string
    {
        return $message;
    }
}