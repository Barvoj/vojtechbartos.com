<?php

namespace Article\AdminModule\Presenters;

use Article\AdminModule\Presenters\Shared\Link;
use Article\Components\ArticleAddForm\ArticleAddForm;
use Article\Components\ArticleAddForm\ArticleAddFormFactory;
use Article\Model\Entities\Article;
use Libs\Application\UI\Presenter;

/**
 * @acl
 */
class AddPresenter extends Presenter
{
    /**
     * @param ArticleAddFormFactory $articleAddFormFactory
     * @return ArticleAddForm
     */
    public function createComponentArticleAdd(ArticleAddFormFactory $articleAddFormFactory) : ArticleAddForm
    {
        $component = $articleAddFormFactory->create();

        $component->onSuccess[] = function (Article $article) {
            $this->flashMessage("Article {$article->getTitle()} created.");
            $this->redirect(Link::LIST);
        };

        return $component;
    }
}