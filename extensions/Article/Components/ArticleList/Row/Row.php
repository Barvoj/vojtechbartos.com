<?php

namespace Article\Components\ArticleList\Row;

use Article\Model\Entities\Article;
use Libs\Application\UI\Control;
use Nette\Application\UI\Link;

class Row extends Control
{
    /** @var Article */
    protected $article;

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
        $template->isPublished = $this->article->isPublished();

        $template->showLink = $this->showLink ? $this->showLink->setParameter('id', $this->article->getId()) : null;
        $template->publishLink = $this->publishLink ? $this->publishLink->setParameter('id', $this->article->getId()) : null;
        $template->unPublishLink = $this->unPublishLink ? $this->unPublishLink->setParameter('id', $this->article->getId()) : null;
        $template->editLink = $this->editLink ? $this->editLink->setParameter('id', $this->article->getId()) : null;
        $template->deleteLink = $this->deleteLink ? $this->deleteLink->setParameter('id', $this->article->getId()) : null;
        $template->article = $this->article;

        parent::render();
    }

    /**
     * @param Link $showLink
     * @return Row
     */
    public function setShowLink(Link $showLink) : Row
    {
        $this->showLink = clone $showLink;

        return $this;
    }

    /**
     * @param Link $publishLink
     * @return Row
     */
    public function setPublishLink(Link $publishLink) : Row
    {
        $this->publishLink = clone $publishLink;

        return $this;
    }

    /**
     * @param Link $unPublishLink
     * @return Row
     */
    public function setUnPublishLink(Link $unPublishLink) : Row
    {
        $this->unPublishLink = clone $unPublishLink;

        return $this;
    }

    /**
     * @param Link $editLink
     * @return Row
     */
    public function setEditLink(Link $editLink) : Row
    {
        $this->editLink = clone $editLink;

        return $this;
    }

    /**
     * @param Link $deleteLink
     * @return Row
     */
    public function setDeleteLink(Link $deleteLink) : Row
    {
        $this->deleteLink = clone $deleteLink;

        return $this;
    }
}