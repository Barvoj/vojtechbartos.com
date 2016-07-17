<?php

namespace VojtechBartos\Presenters;

use Libs\Application\UI\Presenter as BasePresenter;
use VojtechBartos\Components\Menu\TMenu;
use Article\Model\Entities\Article;
use Nette\Application\ForbiddenRequestException;


class Presenter extends BasePresenter
{
    use TMenu;

    /**
     * @param Article $article
     * @throws ForbiddenRequestException
     */
    protected function checkAccessTo(Article $article)
    {
        if (!$this->isAllowedAccessTo($article)) {
            if ($this->getUser()->isLoggedIn()) {
                throw new ForbiddenRequestException();
            } else {
                $this->redirectToSignIn();
            }
        }
    }

    /**
     * @param Article $article
     * @return bool
     */
    protected function isAllowedAccessTo(Article $article) : bool
    {
        $user = $this->getUser();
        if (!$user->isLoggedIn()) {
            return false;
        }

        return $article->getUserId() === $user->getId();
    }
}