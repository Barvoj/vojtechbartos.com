<?php

namespace Article\Components\ArticleListItem;


use Article\Model\Entities\Article;
use Libs\Application\UI\Control;
use Nette\Application\UI\Link;

class ArticleListItem extends Control
{
    /** @var Article */
    protected $article;

    /** @var Link */
    protected $showLink;

    /** @var Link */
    protected $publishLink;

    /** @var Link */
    protected $editLink;

    /** @var Link */
    protected $deleteLink;

    /**
     * @param Article $article
     */
    public function __construct(Article $article)
    {
        parent::__construct();
        $this->article = $article;
    }

    public function render()
    {
        $this->getTemplate()->setFile(__DIR__ . '/ArticleListItem.latte');
        $this->getTemplate()->showLink = $this->showLink ? $this->showLink->setParameter('id', $this->article->getId()) : null;
        $this->getTemplate()->publishLink = $this->publishLink ? $this->publishLink->setParameter('id', $this->article->getId()) : null;
        $this->getTemplate()->editLink = $this->editLink ? $this->editLink->setParameter('id', $this->article->getId()) : null;
        $this->getTemplate()->deleteLink = $this->deleteLink ? $this->deleteLink->setParameter('id', $this->article->getId()) : null;
        $this->getTemplate()->article = $this->article;
        $this->getTemplate()->render();
    }

    /**
     * @param Link $showLink
     * @return ArticleListItem
     */
    public function setShowLink(Link $showLink) : ArticleListItem
    {
        $this->showLink = $showLink;

        return $this;
    }

    /**
     * @param Link $publishLink
     * @return ArticleListItem
     */
    public function setPublishLink(Link $publishLink) : ArticleListItem
    {
        $this->publishLink = $publishLink;

        return $this;
    }

    /**
     * @param Link $editLink
     * @return ArticleListItem
     */
    public function setEditLink(Link $editLink) : ArticleListItem
    {
        $this->editLink = $editLink;

        return $this;
    }

    /**
     * @param Link $deleteLink
     * @return ArticleListItem
     */
    public function setDeleteLink(Link $deleteLink) : ArticleListItem
    {
        $this->deleteLink = $deleteLink;

        return $this;
    }
}