<?php

namespace Article\Presenters;

use Article\Components\ArticleAddForm\ArticleAddForm;
use Article\Components\ArticleAddForm\ArticleAddFormFactory;
use Article\Model\Entities\Article;
use Libs\Application\UI\Presenter;

class ArticlePresenter extends Presenter
{
    /** @var ArticleAddFormFactory */
    protected $articleAddFormFactory;

    /**
     * @param ArticleAddFormFactory $articleAddFormFactory
     */
    public function injectArticleAddFormFactory(ArticleAddFormFactory $articleAddFormFactory)
    {
        $this->articleAddFormFactory = $articleAddFormFactory;
    }

    /**
     * @return ArticleAddForm
     */
    public function createComponentArticleAdd() : ArticleAddForm
    {
        $component = $this->articleAddFormFactory->create();

        $component->onSuccess[] = function (Article $article) {
            $this->flashMessage("Article {$article->getTitle()} created.");
            $this->redirect('this');
        };

        return $component;
    }
}