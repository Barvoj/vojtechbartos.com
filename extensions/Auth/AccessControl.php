<?php

namespace Auth;

use Auth\Exceptions\NotSignInException;
use Libs\Application\UI\Presenter;
use LogicException;
use Nette\Application\ForbiddenRequestException;
use Nette\Reflection\ClassType;
use Nette\Reflection\Method;
use Nette\Security\User;

class AccessControl
{
    /** @var User */
    protected $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param Presenter $presenter
     * @param ClassType|Method $element
     * @throws ForbiddenRequestException
     */
    public function checkRequirements(Presenter $presenter, $element)
    {
        if (!$element instanceof ClassType && !$element instanceof Method)
        {
            throw new LogicException(ClassType::class . " or " . Method::class . " type expected.");
        }

        $acl = false;
        if ($element instanceof ClassType) {
            /** lookup */
            do {
                $acl = $acl ?: $element->getAnnotation('acl');
            } while (!$acl && $element = $element->getParentClass());
        } else {
            $acl = $element->getAnnotation('acl');
        }

        if (!$acl) {
            return;
        }

        $isAllowed = $this->getUser()->isAllowed($presenter->getName() ,$presenter->getAction());
        if (!$isAllowed) {
            if ($this->getUser()->isLoggedIn()) {
                throw new ForbiddenRequestException();
            } else {
                throw new NotSignInException();
            }
        }
    }

    /**
     * @return User
     */
    protected function getUser() : User
    {
        return $this->user;
    }
}