<?php

namespace Article\Modules\User\Presenters;

use Article\Components\ArticleForm\Factories\ArticleAddFormFactory;
use Article\Components\ArticleForm\Forms\ArticleAddForm;
use Article\Model\Entities\Article;
use Article\Modules\User\Presenters\Shared\Link;
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
            $this->flashMessage($this->translate("admin.article.added", null, ['name' => $article->getTitle()]));
            $this->redirect(Link::LIST);
        };

        return $component;
    }
}