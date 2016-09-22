<?php

namespace Article\Modules\Admin\Presenters;

use Article\Components\ArticleList\ArticleList;
use Article\Components\ArticleList\ArticleListFactory;
use Article\Model\Entities\Article;
use Article\Modules\Admin\Presenters\Shared\Link;
use Article\Modules\Admin\Presenters\Shared\TArticleFacade;
use VojtechBartos\Presenters\Presenter;

/**
 * @acl
 */
class ListPresenter extends Presenter
{
    use TArticleFacade;

    /** @var Article[] */
    protected $articles;

    public function actionDefault()
    {
        $this->articles = $this->articleFacade->findAll();
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
        $article = $this->articleFacade->get($id);
        $this->checkAccessTo($article);
        $this->articleFacade->publish($article);

        if (!$this->isAjax()) {
            $this->redirect(Link::LIST);
        }
    }

    /**
     * @param int $id
     */
    public function handleDelete(int $id)
    {
        $article = $this->articleFacade->get($id);
        $this->checkAccessTo($article);
        $this->articleFacade->delete($article);

        if (!$this->isAjax()) {
            $this->redirect(Link::LIST);
        }
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
        $component->setEditLink($this->lazyLink(Link::EDIT));
        $component->setDeleteLink($this->lazyLink('delete!'));

        return $component;
    }
}