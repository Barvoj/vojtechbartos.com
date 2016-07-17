<?php

namespace Article\Modules\Admin\Presenters;

use Article\Components\ArticleForm\Factories\ArticleAddFormFactory;
use Article\Components\ArticleForm\Forms\ArticleAddForm;
use Article\Modules\Admin\Presenters\Shared\Link;
use Article\Model\Entities\Article;
use VojtechBartos\Presenters\Presenter;

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