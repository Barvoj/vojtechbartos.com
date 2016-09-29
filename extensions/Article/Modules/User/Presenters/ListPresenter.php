<?php

namespace Article\Modules\User\Presenters;

use Article\Components\ArticleList\ArticleList;
use Article\Components\ArticleList\ArticleListFactory;
use Article\Model\Entities\Article;
use Article\Model\Facades\TArticleFacade;
use Article\Model\Queries\ArticleQuery;
use Article\Model\Repositories\TArticleRepository;
use Article\Modules\User\Presenters\Shared\Link;
use VojtechBartos\Presenters\Presenter;

/**
 * @acl
 */
class ListPresenter extends Presenter
{
    use TArticleRepository;
    use TArticleFacade;

    /** @var Article[] */
    protected $articles;

    public function actionDefault()
    {
        $query = (new ArticleQuery())->byUserId($this->getUser()->getId());
        $this->articles = $this->articleRepository->fetchAll($query);
    }

    public function renderDefault()
    {
        $this->template->linkAdd = $this->lazyLink(Link::ADD);
    }

    /**
     * @param int $id
     */
    public function handlePublish(int $id)
    {
        $article = $this->articleRepository->get($id);
        $this->checkAccessTo($article);
        $this->articleFacade->publish($article);

        $this->flashMessage($this->translate("admin.article.published", null, ['name' => $article->getTitle()]));

        $this->redirect(Link::LIST);
    }

    public function handleUnPublish(int $id)
    {
        $article = $this->articleRepository->get($id);
        $this->checkAccessTo($article);
        $this->articleFacade->unPublish($article);

        $this->flashMessage($this->translate("admin.article.unpublished", null, ['name' => $article->getTitle()]));

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

        $this->flashMessage($this->translate("admin.article.deleted", null, ['name' => $article->getTitle()]));

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
        $component->setPublishLink($this->lazyLink('publish!'));
        $component->setUnPublishLink($this->lazyLink('unPublish!'));
        $component->setEditLink($this->lazyLink(Link::EDIT));
        $component->setDeleteLink($this->lazyLink('delete!'));

        return $component;
    }
}