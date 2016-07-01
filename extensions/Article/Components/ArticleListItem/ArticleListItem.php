<?php

namespace Article\Components\ArticleListItem;


use Article\Components\ArticleListItem\Template\Main;
use Article\Model\Entities\Article;
use Libs\Application\UI\Control;
use Nette\Application\UI\Link;

/**
 * @method Main getTemplate()
 */
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
        $template = $this->getTemplate();

        $template->showLink = $this->showLink ? $this->showLink->setParameter('id', $this->article->getId()) : null;
        $template->publishLink = $this->publishLink ? $this->publishLink->setParameter('id', $this->article->getId()) : null;
        $template->editLink = $this->editLink ? $this->editLink->setParameter('id', $this->article->getId()) : null;
        $template->deleteLink = $this->deleteLink ? $this->deleteLink->setParameter('id', $this->article->getId()) : null;
        $template->article = $this->article;

        parent::render();
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