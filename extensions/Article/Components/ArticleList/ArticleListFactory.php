<?php

namespace Article\Components\ArticleList;


use Article\Model\Entities\Article;

interface ArticleListFactory
{
    /**
     * @param Article[] $articles
     * @return ArticleList
     */
    public function create(array $articles) : ArticleList;
}