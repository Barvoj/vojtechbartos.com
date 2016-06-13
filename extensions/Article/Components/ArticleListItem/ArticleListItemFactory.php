<?php

namespace Article\Components\ArticleListItem;


use Article\Model\Entities\Article;

interface ArticleListItemFactory
{
    /**
     * @param Article $article
     * @return ArticleListItem
     */
    public function create(Article $article) : ArticleListItem;
}