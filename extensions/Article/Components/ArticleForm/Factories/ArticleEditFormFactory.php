<?php

namespace Article\Components\ArticleForm\Factories;

use Article\Components\ArticleForm\Forms\ArticleEditForm;
use Article\Model\Entities\Article;

interface ArticleEditFormFactory
{
    /**
     * @param Article $article
     * @return ArticleEditForm
     */
    public function create(Article $article) : ArticleEditForm;
}