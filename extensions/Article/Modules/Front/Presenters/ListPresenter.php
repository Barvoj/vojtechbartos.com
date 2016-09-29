<?php

namespace Article\Modules\Front\Presenters;

use Article\Components\ArticleList\ArticleList;
use Article\Components\ArticleList\ArticleListFactory;
use Article\Model\Entities\Article;
use Article\Model\Queries\ArticleQuery;
use Article\Model\Repositories\TArticleRepository;
use Auth\Components\Forms\SignInForm\TSignInModal;
use VojtechBartos\Presenters\Presenter;

class ListPresenter extends Presenter
{
    use TSignInModal;
    use TArticleRepository;

    /** @var Article[] */
    protected $articles = [];

    public function actionDefault()
    {
        $query = (new ArticleQuery())->published();
        $this->articles = $this->articleRepository->fetchAll($query);
    }

    /**
     * @param ArticleListFactory $factory
     * @return ArticleList
     */
    public function createComponentList(ArticleListFactory $factory) : ArticleList
    {
        $component = $factory->create($this->articles);

        $component->setShowLink($this->lazyLink(':Article:Front:Detail:default'));

        return $component;
    }
}