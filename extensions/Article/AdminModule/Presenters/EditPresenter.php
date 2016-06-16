<?php

namespace Article\AdminModule\Presenters;


use Article\AdminModule\Presenters\Shared\Link;
use Article\AdminModule\Presenters\Shared\TArticleFacade;
use Article\Components\ArticleEditForm\ArticleEditForm;
use Article\Components\ArticleEditForm\ArticleEditFormFactory;
use Article\Model\Entities\Article;
use Libs\Application\UI\Presenter;

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
        // @todo check access
        $this->article = $this->articleFacade->get($id);
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