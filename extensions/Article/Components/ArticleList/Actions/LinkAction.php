<?php

namespace Article\Components\ArticleList\Actions;

use Libs\MyList\IMyAction;
use Libs\MyList\IRow;
use Nette\Application\UI\Link;

class LinkAction implements IMyAction
{
    /** @var Link */
    protected $link;

    public function __construct(Link $link)
    {
        $this->link = clone $link;
    }

    public function isAllowed(IRow $row): bool
    {
        return true;
    }

    public function getLink(IRow $row): Link
    {
        return (clone $this->link)->setParameter('id', $row->getId());
    }
}