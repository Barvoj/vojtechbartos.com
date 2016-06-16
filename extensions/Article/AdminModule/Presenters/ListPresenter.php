<?php

namespace Article\AdminModule\Presenters;


use Article\AdminModule\Presenters\Shared\Link;
use Article\AdminModule\Presenters\Shared\TArticleFacade;
use Article\Components\ArticleList\ArticleList;
use Article\Components\ArticleList\ArticleListFactory;
use Article\Model\Entities\Article;
use Libs\Application\UI\Presenter;

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
    public function handleDelete(int $id)
    {
        // @todo check access
        $article = $this->articleFacade->get($id);
        $this->articleFacade->delete($article);

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
        $component->setPublishLink($component->lazyLink('publish!'));
        $component->setEditLink($this->lazyLink(Link::EDIT));
        $component->setDeleteLink($this->lazyLink('delete!'));

        return $component;
    }
}