<?php
/**
 * Created by PhpStorm.
 * User: Barvoj
 * Date: 28.05.2016
 * Time: 8:37
 */

namespace Article\Components\ArticleEditForm;


use Article\Model\Entities\Article;

interface ArticleEditFormFactory
{
    /**
     * @param Article $article
     * @return ArticleEditForm
     */
    public function create(Article $article) : ArticleEditForm;
}