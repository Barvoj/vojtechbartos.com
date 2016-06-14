<?php

namespace Article\Components\ArticleList;


use Article\Components\ArticleListItem\ArticleListItemFactory;
use Article\Model\Entities\Article;
use Nette\Application\UI\Control;
use Nette\Application\UI\Link;
use Nette\Application\UI\Multiplier;

class ArticleList extends Control
{
    /** @var Article[] */
    protected $articles;

    /** @var Link */
    protected $showLink;

    /** @var Link */
    protected $publishLink;

    /** @var Link */
    protected $editLink;

    /** @var ArticleListItemFactory */
    private $listItemFacade;

    /**
     * @param array $articles
     * @param ArticleListItemFactory $listItemFacade
     */
    public function __construct(array $articles, ArticleListItemFactory $listItemFacade)
    {
        parent::__construct();
        $this->articles = $articles;
        $this->listItemFacade = $listItemFacade;
    }

    /**
     * @param int $id
     */
    public function handlePublish(int $id)
    {
        dump($id);
    }

    public function render()
    {
        $this->getTemplate()->setFile(__DIR__ . '/ArticleList.latte');
        $this->getTemplate()->showLink = $this->showLink;
        $this->getTemplate()->publishLink = $this->publishLink;
        $this->getTemplate()->editLink = $this->editLink;
        $this->getTemplate()->articles = $this->articles;
        $this->getTemplate()->render();
    }

    public function createComponentItem()
    {
        return new Multiplier(function ($key) {
            $component = $this->listItemFacade->create($this->articles[$key]);

            if ($this->showLink) {
                $component->setShowLink($this->showLink);
            }

            if ($this->publishLink) {
                $component->setPublishLink($this->publishLink);
            }

            if ($this->editLink) {
                $component->setEditLink($this->editLink);
            }

            return $component;
        });
    }

    /**
     * @param Link $showLink
     * @return ArticleList
     */
    public function setShowLink(Link $showLink) : ArticleList
    {
        $this->showLink = $showLink;

        return $this;
    }

    /**
     * @param Link $publishLink
     * @return ArticleList
     */
    public function setPublishLink(Link $publishLink) : ArticleList
    {
        $this->publishLink = $publishLink;

        return $this;
    }

    /**
     * @param Link $editLink
     * @return ArticleList
     */
    public function setEditLink(Link $editLink) : ArticleList
    {
        $this->editLink = $editLink;

        return $this;
    }
}