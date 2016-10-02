<?php

namespace Auth;

use Auth\Exceptions\NotSignInException;
use Libs\Application\UI\Presenter;
use LogicException;
use Nette\Application\ForbiddenRequestException;
use Nette\Application\UI\ComponentReflection;
use Nette\Application\UI\MethodReflection;
use Nette\Reflection\ClassType;
use Nette\Reflection\Method;
use Reflector;

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
     * @param ComponentReflection|MethodReflection $element
     * @throws ForbiddenRequestException
     */
    public function checkRequirements(Presenter $presenter, $element)
    {
        if (!$element instanceof ComponentReflection && !$element instanceof MethodReflection)
        {
            throw new LogicException(ClassType::class . " or " . Method::class . " type expected.");
        }

        $acl = false;
        if ($element instanceof ComponentReflection) {
            /** lookup */
            do {
                $acl = $acl ?: $this->getAnnotation($element, 'acl');
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
     * @param Reflector $elem
     * @param string $name
     * @return mixed|null
     */
    private function getAnnotation(Reflector $elem, $name)
    {
        $res = ComponentReflection::parseAnnotation($elem, $name);
        return $res ? end($res) : NULL;
    }

    /**
     * @return User
     */
    protected function getUser() : User
    {
        return $this->user;
    }
}