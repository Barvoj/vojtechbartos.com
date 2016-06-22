<?php

namespace Article\Modules\Admin\Presenters;

use Article\Model\Entities\Article;
use Nette\Application\ForbiddenRequestException;

class Presenter extends \Libs\Application\UI\Presenter
{

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
    protected function isAllowedAccessTo(Article $article)
    {
        $user = $this->getUser();
        if (!$user->isLoggedIn()) {
            return false;
        }

        return $article->getUserId() === $user->getId();
    }
}