<?php

namespace Article\Components\ArticleList;

use Article\Components\ArticleList\Row\RowFactory;
use Article\Model\Entities\Article;
use Libs\Application\UI\Control;
use Nette\Application\UI\Link;
use Nette\Application\UI\Multiplier;

class ArticleList extends Control
{
    /** @var RowFactory */
    private $rowFacade;

    /** @var Article[] */
    protected $articles;

    /** @var Link */
    protected $showLink;

    /** @var Link */
    protected $publishLink;

    /** @var Link */
    protected $unPublishLink;

    /** @var Link */
    protected $editLink;

    /** @var Link */
    protected $deleteLink;

    /**
     * @param array $articles
     * @param RowFactory $rowFacade
     */
    public function __construct(array $articles, RowFactory $rowFacade)
    {
        parent::__construct();
        $this->articles = $articles;
        $this->rowFacade = $rowFacade;
    }

    public function render()
    {
        $template = $this->getTemplate();
        $template->articles = $this->articles;
        $template->render();
    }

    public function createComponentItem() : Multiplier
    {
        return new Multiplier(function ($key) {
            $component = $this->rowFacade->create($this->articles[$key]);

            if ($this->showLink) {
                $component->setShowLink($this->showLink);
            }

            if ($this->publishLink) {
                $component->setPublishLink($this->publishLink);
            }

            if ($this->unPublishLink) {
                $component->setUnPublishLink($this->unPublishLink);
            }

            if ($this->editLink) {
                $component->setEditLink($this->editLink);
            }

            if ($this->deleteLink) {
                $component->setDeleteLink($this->deleteLink);
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
     * @param Link $unPublishLink
     * @return ArticleList
     */
    public function setUnPublishLink(Link $unPublishLink) : ArticleList
    {
        $this->unPublishLink = $unPublishLink;

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

    /**
     * @param Link $deleteLink
     * @return ArticleList
     */
    public function setDeleteLink(Link $deleteLink) : ArticleList
    {
        $this->deleteLink = $deleteLink;

        return $this;
    }
}