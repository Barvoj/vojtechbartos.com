<?php

namespace Article\Components\ArticleForm\Factories;

use Article\Components\ArticleForm\Forms\ArticleAddForm;

interface ArticleAddFormFactory
{
    /**
     * @return ArticleAddForm
     */
    public function create() : ArticleAddForm;
}