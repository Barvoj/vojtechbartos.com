<?php

namespace Article\Components\Article;


use Article\Model\Entities\Article as EntityArticle;

interface ArticleFactory
{
    /**
     * @param EntityArticle $article
     * @return Article
     */
    public function create(EntityArticle $article);
}