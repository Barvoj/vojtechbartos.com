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
     * @return ArticleAddForm
     */
    public function createComponentArticleAdd(ArticleAddFormFactory $articleAddFormFactory) : ArticleAddForm
    {
        $component = $articleAddFormFactory->create();

        $component->onSuccess[] = function (Article $article) {
            $this->flashMessage("Article {$article->getTitle()} created.");
            $this->redirect('list');
        };

        return $component;
    }

    /**
     * @param ArticleEditFormFactory $articleEditFormFactory
     * @return ArticleEditForm
     */
    public function createComponentArticleEdit(ArticleEditFormFactory $articleEditFormFactory) : ArticleEditForm
    {
        $component = $articleEditFormFactory->create($this->article);

        $component->onSuccess[] = function (Article $article) {
            $this->flashMessage("Article {$article->getTitle()} updated.");
            $this->redirect('list');
        };

        return $component;
    }

    /**
     * @param ArticleListFactory $articleListFactory
     * @return ArticleList
     */
    public function createComponentArticles(ArticleListFactory $articleListFactory) : ArticleList
    {
        $component = $articleListFactory->create();

        return $component;
    }
}