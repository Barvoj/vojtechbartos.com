<?php

namespace Article\Modules\Admin\Presenters\Shared;

use Article\Model\Facades\ArticleFacade;

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