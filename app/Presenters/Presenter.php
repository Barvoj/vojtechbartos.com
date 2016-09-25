<?php

namespace VojtechBartos\Presenters;

use Article\Model\Entities\Article;
use Libs\Application\UI\Presenter as BasePresenter;
use Nette\Application\ForbiddenRequestException;
use VojtechBartos\Components\Menu\TMenu;

class Presenter extends BasePresenter
{
    use TMenu;

    /**
     * Sign out action
     */
    public function handleOut()
    {
        $this->getUser()->logout();
        $this->flashMessage($this->translate('messages.sign.you_have_been_signed_out'));

        $this->redirect(':Home:default');
    }

    public function afterRender()
    {
        if ($this->isAjax() && !$this->isControlInvalid()) {
            $this->redrawControl('menu');
            $this->redrawControl('flashes');
            $this->redrawControl('content');
            $this->redrawControl('modal');
        }
    }

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