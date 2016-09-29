<?php

namespace Article\Modules\User\Presenters;

use Article\Components\ArticleForm\Factories\ArticleEditFormFactory;
use Article\Components\ArticleForm\Forms\ArticleEditForm;
use Article\Model\Entities\Article;
use Article\Model\Facades\TArticleFacade;
use Article\Modules\User\Presenters\Shared\Link;
use VojtechBartos\Presenters\Presenter;

/**
 * @acl
 */
class EditPresenter extends Presenter
{
    use TArticleFacade;

    /** @var Article */
    protected $article;

    /**
     * @param int $id
     */
    public function actionDefault(int $id)
    {
        $article = $this->articleFacade->get($id);
        $this->checkAccessTo($article);

        $this->article = $article;
    }

    /**
     * @param ArticleEditFormFactory $articleEditFormFactory
     * @return ArticleEditForm
     */
    public function createComponentArticleEdit(ArticleEditFormFactory $articleEditFormFactory) : ArticleEditForm
    {
        $component = $articleEditFormFactory->create($this->article);

        $component->onSuccess[] = function (Article $article) {
            $this->flashMessage($this->translate("admin.article.updated", null, ['name' => $article->getTitle()]));
            $this->redirect(Link::LIST);
        };

        return $component;
    }
}