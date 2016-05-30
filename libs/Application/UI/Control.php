<?php

namespace Libs\Application\UI;


class Control extends \Nette\Application\UI\Control
{
    public function render()
    {
        $this->getTemplate()->setFile(__DIR__ . '/' . static::class . '.latte');
        $this->getTemplate()->render();
    }
}