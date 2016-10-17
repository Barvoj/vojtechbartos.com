<?php

namespace Libs\MyList;

use Nette\Application\UI\Control;

class MyList extends Control
{
    /** @var IMyAction[] */
    protected $actions = [];

    public function addAction(IMyAction $action)
    {
        $this->actions[] = $action;
    }
}