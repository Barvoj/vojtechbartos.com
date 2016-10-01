<?php

namespace Article\Components\PublishForm;

use Article\Model\Entities\Article;

interface PublishFormFactory
{
    /**
     * @param Article $article
     * @return PublishForm
     */
    public function create(Article $article) : PublishForm;
}