<?php

namespace Article\Presenters;

use Article\Components\ArticleAddForm\ArticleAddForm;
use Article\Components\ArticleAddForm\ArticleAddFormFactory;
use Article\Components\ArticleEditForm\ArticleEditForm;
use Article\Components\ArticleEditForm\ArticleEditFormFactory;
use Article\Components\ArticleList\ArticleList;
use Article\Components\ArticleList\ArticleListFactory;
use Article\Model\Entities\Article;
use Article\Model\Facades\ArticleFacade;
use Libs\Application\UI\Presenter;

class ArticlePresenter extends Presenter
{
    /** @var ArticleFacade */
    protected $articleFacade;

    /** @var ArticleAddFormFactory */
    protected $articleAddFormFactory;

    /** @var ArticleEditFormFactory */
    protected $articleEditFormFactory;

    /** @var ArticleListFactory */
    protected $articleListFactory;

    /** @var Article */
    protected $article;

    /**
     * @param string $id
     */
    public function actionEdit(string $id)
    {
        $this->article = $this->articleFacade->get((int) $id);
    }

    /**
     * @param ArticleFacade $articleFacade
     */
    public function injectArticleFacade(ArticleFacade $articleFacade)
    {
        $this->articleFacade = $articleFacade;
    }

    /**
     * @param ArticleAddFormFactory $articleAddFormFactory
     */
    public function injectArticleAddFormFactory(ArticleAddFormFactory $articleAddFormFactory)
    {
        $this->articleAddFormFactory = $articleAddFormFactory;
    }

    /**
     * @param ArticleEditFormFactory $articleEditFormFactory
     */
    public function injectArticleEditFormFactory(ArticleEditFormFactory $articleEditFormFactory)
    {
        $this->articleEditFormFactory = $articleEditFormFactory;
    }

    /**
     * @param ArticleListFactory $articleListFactory
     */
    public function injectArticleListFactory(ArticleListFactory $articleListFactory)
    {
        $this->articleListFactory = $articleListFactory;
    }

    /**
     * @return ArticleAddForm
     */
    public function createComponentArticleAdd() : ArticleAddForm
    {
        $component = $this->articleAddFormFactory->create();

        $component->onSuccess[] = function (Article $article) {
            $this->flashMessage("Article {$article->getTitle()} created.");
            $this->redirect('list');
        };

        return $component;
    }

    /**
     * @return ArticleEditForm
     */
    public function createComponentArticleEdit() : ArticleEditForm
    {
        $component = $this->articleEditFormFactory->create($this->article);

        $component->onSuccess[] = function (Article $article) {
            $this->flashMessage("Article {$article->getTitle()} updated.");
            $this->redirect('list');
        };

        return $component;
    }

    /**
     * @return ArticleList
     */
    public function createComponentArticles() : ArticleList
    {
        $component = $this->articleListFactory->create();

        return $component;
    }
}