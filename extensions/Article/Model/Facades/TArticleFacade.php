<?php

namespace Article\Model\Facades;

trait TArticleFacade
{
    /** @var ArticleFacade */
    protected $articleFacade;

    /**
     * @param ArticleFacade $articleFacade
     */
    public function injectArticleFacade(ArticleFacade $articleFacade)
    {
        $this->articleFacade = $articleFacade;
    }
}