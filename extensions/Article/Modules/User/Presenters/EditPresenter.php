<?php

namespace Article\Modules\User\Presenters;

use Article\Components\ArticleForm\Factories\ArticleEditFormFactory;
use Article\Components\ArticleForm\Forms\ArticleEditForm;
use Article\Model\Entities\Article;
use Article\Model\Facades\TArticleFacade;
use Article\Modules\User\Presenters\Shared\Link;
use Article\Modules\User\Presenters\Shared\TArticle;
use VojtechBartos\Presenters\Presenter;

/**
 * @acl
 */
class EditPresenter extends Presenter
{
    use TArticleFacade;
    use TArticle;

    /**
     * @param int $id
     */
    public function actionDefault(int $id)
    {
        $article = $this->articleFacade->get($id);
        $this->checkAccessTo($article);

        $this->setArticle($article);
    }

    /**
     * @param ArticleEditFormFactory $articleEditFormFactory
     * @return ArticleEditForm
     */
    public function createComponentArticleEdit(ArticleEditFormFactory $articleEditFormFactory) : ArticleEditForm
    {
        $component = $articleEditFormFactory->create($this->getArticle());

        $component->onSuccess[] = function (Article $article) {
            $this->flashMessage($this->translate("messages.article.updated", null, ['name' => $article->getTitle()]));
            $this->redirect(Link::LIST);
        };

        return $component;
    }
}