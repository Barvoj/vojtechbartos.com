<?php

namespace Article\FrontModule\Presenters;

use Article\Components\ArticleDetail\ArticleDetail;
use Article\Components\ArticleDetail\ArticleDetailFactory;
use Article\Model\Entities\Article as EntityArticle;
use Article\Model\Facades\ArticleFacade;
use Libs\Application\UI\Presenter;

class DetailPresenter extends Presenter
{
    /** @var ArticleFacade */
    protected $articleFacade;

    /** @var EntityArticle */
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

    /**
     * @param ArticleFacade $articleFacade
     */
    public function injectArticleFacade(ArticleFacade $articleFacade)
    {
        $this->articleFacade = $articleFacade;
    }
}