<?php

namespace Article\Modules\User\Presenters;

use Article\Components\ArticleList\ArticleList;
use Article\Components\ArticleList\ArticleListFactory;
use Article\Model\Entities\Article;
use Article\Model\Facades\TArticleFacade;
use Article\Model\Queries\ArticleQuery;
use Article\Model\Repositories\TArticleRepository;
use Article\Modules\User\Presenters\Shared\Link;
use Article\Modules\User\Presenters\Shared\TArticle;
use Libs\Confirmation\Confirmation;
use Libs\Modal\Modal;
use VojtechBartos\Presenters\Presenter;

/**
 * @acl
 */
class ListPresenter extends Presenter
{
    use TArticleRepository;
    use TArticleFacade;
    use TArticle;

    /** @var Article[] */
    protected $articles;

    /**
     * @param int $id
     */
    public function actionDefault($id)
    {
        if ($id) {
            $article = $this->articleFacade->get($id);
            $this->checkAccessTo($article);

            $this->setArticle($article);
        }

        $query = (new ArticleQuery())
            ->byUserId($this->getUser()->getId())
            ->orderByPublished("DESC")
            ->orderById("DESC");

        $this->articles = $this->articleRepository->fetchAll($query);
    }

    public function renderDefault()
    {
        $this->template->linkAdd = $this->lazyLink(Link::ADD);
    }

    public function handlePublish(int $id)
    {
        $article = $this->articleRepository->get($id);
        $this->checkAccessTo($article);
        $this->articleFacade->publish($article);

        $this->flashMessage($this->translate("messages.article.published", null, ['name' => $article->getTitle()]));

        $this->redirect(Link::LIST);
    }

    public function handleUnPublish(int $id)
    {
        $article = $this->articleRepository->get($id);
        $this->checkAccessTo($article);
        $this->articleFacade->unPublish($article);

        $this->flashMessage($this->translate("messages.article.unpublished", null, ['name' => $article->getTitle()]));

        $this->redirect(Link::LIST);
    }

    /**
     * @param int $id
     */
    public function handleDelete(int $id)
    {
        $article = $this->articleRepository->get($id);
        $this->checkAccessTo($article);
        $this->articleFacade->delete($article);

        $this->flashMessage($this->translate("messages.article.deleted", null, ['name' => $article->getTitle()]));

        $this->redirect(Link::LIST);
    }

    /**
     * @param ArticleListFactory $articleListFactory
     * @return ArticleList
     */
    public function createComponentArticles(ArticleListFactory $articleListFactory) : ArticleList
    {
        $component = $articleListFactory->create($this->articles);

        $component->setShowLink($this->lazyLink(Link::DETAIL));
        $component->setPublishLink($this->lazyLink('this', ['do' => 'publishConfirmation-show']));
        $component->setUnPublishLink($this->lazyLink('unPublish!'));
        $component->setEditLink($this->lazyLink(Link::EDIT));
        $component->setDeleteLink($this->lazyLink('this', ['do' => 'deleteConfirmation-show']));

        return $component;
    }

    /**
     * @return Modal
     */
    public function createComponentPublishConfirmation() : Modal
    {
        return new Modal(function () {
            $component = (new Confirmation())
                ->setMessage("messages.article.are_you_sure_you_want_to_publish");

            $component->onConfirmed[] = function () {
                $this->handlePublish($this->getArticle()->getId());
            };

            $component->onCanceled[] = function () {
                $this->redirect(Link::LIST);
            };

            return $component;
        });
    }

    /**
     * @return Modal
     */
    public function createComponentDeleteConfirmation() : Modal
    {
        return new Modal(function () {
            $component = (new Confirmation())
                ->setMessage("messages.article.are_you_sure_you_want_to_delete");

            $component->onConfirmed[] = function () {
                $this->handleDelete($this->getArticle()->getId());
            };

            $component->onCanceled[] = function () {
                $this->redirect(Link::LIST);
            };

            return $component;
        });
    }
}