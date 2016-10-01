<?php

namespace Article\Modules\User\Presenters\Shared;


use Article\Model\Entities\Article;

trait TArticle
{
    /** @var Article */
    private $article;

    /**
     * @return Article
     */
    public function getArticle(): Article
    {
        return $this->article;
    }

    /**
     * @param Article $article
     */
    public function setArticle(Article $article)
    {
        $this->article = $article;
    }
}