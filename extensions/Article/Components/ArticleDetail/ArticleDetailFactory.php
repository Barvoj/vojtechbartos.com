<?php

namespace Article\Components\ArticleDetail;

use Article\Model\Entities\Article;

interface ArticleDetailFactory
{
    /**
     * @param Article $article
     * @return ArticleDetail
     */
    public function create(Article $article);
}