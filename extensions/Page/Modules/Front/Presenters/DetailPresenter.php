<?php

namespace Page\Modules\Front\Presenters;

use Auth\Components\Forms\SignInForm\TSignInModal;
use Page\Model\Repositories\PageRepository;
use VojtechBartos\Presenters\Presenter;

class DetailPresenter extends Presenter
{
    use TSignInModal;

    /** @var PageRepository */
    protected $pageRepository;

    /**
     * @param PageRepository $pageRepository
     */
    public function __construct(PageRepository $pageRepository)
    {
        parent::__construct();
        $this->pageRepository = $pageRepository;
    }

    /**
     * @param int $id
     */
    public function actionDefault(int $id = 1)
    {
        $this->template->page = $this->pageRepository->get($id);
    }
}