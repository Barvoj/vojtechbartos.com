<?php

namespace Article\Modules\Admin\Presenters;

use Article\Modules\Admin\Presenters\Shared\Link;
use Article\Components\ArticleAddForm\ArticleAddForm;
use Article\Components\ArticleAddForm\ArticleAddFormFactory;
use Article\Model\Entities\Article;

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