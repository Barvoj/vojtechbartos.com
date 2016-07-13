<?php

namespace Article\Components\ArticleList\Row;


use Article\Components\ArticleList\Row\Row;
use Article\Model\Entities\Article;

interface RowFactory
{
    /**
     * @param Article $article
     * @return Row
     */
    public function create(Article $article) : Row;
}