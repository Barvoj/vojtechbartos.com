<?php

namespace Article\Components\ArticleDetail;


use Article\Model\Entities\Article as EntityArticle;

interface ArticleDetailFactory
{
    /**
     * @param EntityArticle $article
     * @return ArticleDetail
     */
    public function create(EntityArticle $article);
}