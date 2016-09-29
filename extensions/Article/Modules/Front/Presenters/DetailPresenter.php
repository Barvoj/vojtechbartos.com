<?php

namespace Article\Modules\Front\Presenters;

use Article\Components\ArticleDetail\ArticleDetail;
use Article\Components\ArticleDetail\ArticleDetailFactory;
use Article\Model\Entities\Article;
use Article\Model\Facades\TArticleFacade;
use Auth\Components\Forms\SignInForm\TSignInModal;
use VojtechBartos\Presenters\Presenter;

class DetailPresenter extends Presenter
{
    use TSignInModal;
    use TArticleFacade;

    /** @var Article */
    protected $article;

    /**
     * @param int $id
     */
    public function actionDefault(int $id)
    {
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