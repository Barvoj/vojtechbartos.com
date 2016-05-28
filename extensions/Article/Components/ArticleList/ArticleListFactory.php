<?php

namespace Article\Components\ArticleList;


interface ArticleListFactory
{
    /**
     * @return ArticleList
     */
    public function create() : ArticleList;
}