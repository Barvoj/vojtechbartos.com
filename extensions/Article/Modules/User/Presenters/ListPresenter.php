<?php

namespace Article\Modules\User\Presenters;

use Article\Components\ArticleList\ArticleList;
use Article\Components\ArticleList\ArticleListFactory;
use Article\Components\PublishForm\PublishFormFactory;
use Article\Model\Entities\Article;
use Article\Model\Facades\TArticleFacade;
use Article\Model\Queries\ArticleQuery;
use Article\Model\Repositories\TArticleRepository;
use Article\Modules\User\Presenters\Shared\Link;
use Article\Modules\User\Presenters\Shared\TArticle;
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
        $component->setPublishLink($this->lazyLink('this', ['do' => 'publishForm-show']));
        $component->setUnPublishLink($this->lazyLink('unPublish!'));
        $component->setEditLink($this->lazyLink(Link::EDIT));
        $component->setDeleteLink($this->lazyLink('delete!'));

        return $component;
    }

    /**
     * @param PublishFormFactory $publishFormFactory
     * @return Modal
     */
    public function createComponentPublishForm(PublishFormFactory $publishFormFactory) : Modal
    {
        return new Modal(function () use ($publishFormFactory) {
            $component = $publishFormFactory->create($this->getArticle());

            $component->onSuccess[] = function (Article $article) {
                $this->flashMessage($this->translate("admin.article.published", null, ['name' => $article->getTitle()]));
                $this->redirect('this', null);
            };

            $component->setLinkCancel($this->lazyLink('this', null));

            return $component;
        });
    }
}