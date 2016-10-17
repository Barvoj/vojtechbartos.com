<?php

namespace Libs\MyList;

interface IMyAction
{
    public function isAllowed(IRow $row);

    public function getLink(IRow $row);
}