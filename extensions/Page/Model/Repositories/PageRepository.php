<?php

namespace Page\Model\Repositories;

use Kdyby\Doctrine\EntityRepository;
use Page\Model\Entities\Page;

class PageRepository
{
    /** @var EntityRepository */
    protected $pages;

    /**
     * @param EntityRepository $pages
     */
    public function __construct(EntityRepository $pages)
    {
        $this->pages = $pages;
    }

    /**
     * @param int $id
     * @return Page
     * @throws PageNotFoundException
     */
    public function get(int $id): Page
    {
        $page = $this->pages->find($id);

        if ($page === null) {
            throw new PageNotFoundException();
        }

        return $page;
    }
}