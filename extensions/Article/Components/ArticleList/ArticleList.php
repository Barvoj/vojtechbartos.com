<?php

namespace Article\Components\ArticleList;


use Article\Model\Facades\ArticleFacade;
use Nette\Application\UI\Control;

class ArticleList extends Control
{
    /** @var ArticleFacade */
    protected $articleFacade;

    /**
     * ArticleList constructor.
     * @param ArticleFacade $articleFacade
     */
    public function __construct(ArticleFacade $articleFacade)
    {
        parent::__construct();
        $this->articleFacade = $articleFacade;
    }

    public function render()
    {
        $this->getTemplate()->setFile(__DIR__ . '/ArticleList.latte');
        $this->getTemplate()->articles = $this->articleFacade->findAll();
        $this->getTemplate()->render();
    }
}