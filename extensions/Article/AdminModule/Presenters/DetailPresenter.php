<?php

namespace Article\AdminModule\Presenters;


use Article\AdminModule\Presenters\Shared\TArticleFacade;
use Article\Components\ArticleDetail\ArticleDetail;
use Article\Components\ArticleDetail\ArticleDetailFactory;
use Article\Model\Entities\Article;
use Libs\Application\UI\Presenter;

/**
 * @acl
 */
class DetailPresenter extends Presenter
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
     * @param ArticleDetailFactory $articleFactory
     * @return ArticleDetail
     */
    public function createComponentDetail(ArticleDetailFactory $articleFactory) : ArticleDetail
    {
        $component = $articleFactory->create($this->article);

        return $component;
    }
}