<?php

namespace Article\Modules\Admin\Presenters;

use Article\Components\ArticleForm\Factories\ArticleEditFormFactory;
use Article\Components\ArticleForm\Forms\ArticleEditForm;
use Article\Modules\Admin\Presenters\Shared\Link;
use Article\Modules\Admin\Presenters\Shared\TArticleFacade;
use Article\Model\Entities\Article;
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
            $this->flashMessage("Article {$article->getTitle()} updated.");
            $this->redirect(Link::LIST);
        };

        return $component;
    }
}