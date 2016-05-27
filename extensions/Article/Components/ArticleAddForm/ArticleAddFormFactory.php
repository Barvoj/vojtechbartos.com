<?php

namespace Article\Components\ArticleAddForm;


interface ArticleAddFormFactory
{
    /**
     * @return ArticleAddForm
     */
    public function create() : ArticleAddForm;
}