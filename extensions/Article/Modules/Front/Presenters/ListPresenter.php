<?php

namespace Article\Modules\Front\Presenters;

use Article\Components\ArticleList\ArticleListFactory;
use Article\Model\Entities\Article;
use Article\Model\Facades\ArticleFacade;
use Libs\Application\UI\Presenter;

class ListPresenter extends Presenter
{
    /** @var ArticleFacade */
    protected $articleFacade;

    /** @var Article[] */
    protected $articles = [];

    public function actionDefault()
    {
        $this->articles = $this->articleFacade->findAll();
    }

    public function createComponentList(ArticleListFactory $factory)
    {
        $component = $factory->create($this->articles);

        $component->setShowLink($this->lazyLink(':Article:Front:Detail:default'));

        return $component;
    }

    /**
     * @param ArticleFacade $articleFacade
     */
    public function injectArticleFacade(ArticleFacade $articleFacade)
    {
        $this->articleFacade = $articleFacade;
    }
}