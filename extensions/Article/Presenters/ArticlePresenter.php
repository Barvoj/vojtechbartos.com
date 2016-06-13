<?php

namespace Article\Presenters;

use Article\Components\Article\Article;
use Article\Components\Article\ArticleFactory;
use Article\Components\ArticleAddForm\ArticleAddForm;
use Article\Components\ArticleAddForm\ArticleAddFormFactory;
use Article\Components\ArticleEditForm\ArticleEditForm;
use Article\Components\ArticleEditForm\ArticleEditFormFactory;
use Article\Components\ArticleList\ArticleList;
use Article\Components\ArticleList\ArticleListFactory;
use Article\Model\Entities\Article as EntityArticle;
use Article\Model\Facades\ArticleFacade;
use Libs\Application\UI\Presenter;

/**
 * @acl
 */
class ArticlePresenter extends Presenter
{
    /** @var ArticleFacade */
    protected $articleFacade;

    /** @var EntityArticle */
    protected $article;

    /** @var EntityArticle[] */
    protected $articles;

    /**
     * @param int $id
     */
    public function actionEdit(int $id)
    {
        $this->article = $this->articleFacade->get($id);
    }

    /**
     * @param int $id
     */
    public function actionShow(int $id)
    {
        $this->article = $this->articleFacade->get($id);
    }

    public function actionList()
    {
        $this->articles = $this->articleFacade->findAll();
    }

    /**
     * @param ArticleFactory $articleFactory
     * @return Article
     */
    public function createComponentArticle(ArticleFactory $articleFactory) : Article
    {
        $component = $articleFactory->create($this->article);

        return $component;
    }

    /**
     * @param ArticleAddFormFactory $articleAddFormFactory
     * @return ArticleAddForm
     */
    public function createComponentArticleAdd(ArticleAddFormFactory $articleAddFormFactory) : ArticleAddForm
    {
        $component = $articleAddFormFactory->create();

        $component->onSuccess[] = function (EntityArticle $article) {
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

        $component->onSuccess[] = function (EntityArticle $article) {
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
        $component = $articleListFactory->create($this->articles);

        $component->setShowLink($this->lazyLink('show'));
        $component->setPublishLink($component->lazyLink('publish!'));
        $component->setEditLink($this->lazyLink('edit'));

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