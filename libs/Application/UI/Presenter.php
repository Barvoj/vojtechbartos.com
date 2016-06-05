<?php

namespace Libs\Application\UI;

use Kdyby\Autowired\AutowireComponentFactories;
use Kdyby\Translation\ITranslator;
use Nette\Application\ForbiddenRequestException;
use Nette\Application\UI\PresenterComponentReflection;
use Nette\Reflection\Method;

class Presenter extends \Nette\Application\UI\Presenter
{
    use AutowireComponentFactories;

    /** @var ITranslator */
    private $translator;

    /**
     * @param PresenterComponentReflection|Method $element
     * @throws ForbiddenRequestException
     */
    public function checkRequirements($element)
    {
        $acl = false;
        if ($element instanceof PresenterComponentReflection) {
            /** lookup */
            do {
                $acl = $acl ?: $element->getAnnotation('acl');
            } while (!$acl && $element = $element->getParentClass());
        } else if ($element instanceof Method) {
            $primary = $element->getAnnotation('acl');
        }

        if (!$acl) {
            return;
        }

        $isAllowed = $this->getUser()->isAllowed($this->getName() ,$this->getAction());
        if (!$isAllowed) {
            if ($this->getUser()->isLoggedIn()) {
                throw new ForbiddenRequestException();
            } else {
                $this->redirectToSignIn();
            }
        }
    }

    private function redirectToSignIn()
    {
        $this->redirect(':Auth:Sign:in', ['backlink' => $this->storeRequest()]);
    }

    /**
     * @param string $message
     * @param int $count
     * @param array $parameters
     * @param string $domain
     * @param string $locale
     * @return string
     */
    protected function translate(string $message, int $count = NULL, array $parameters = array(), string $domain = NULL, string $locale = NULL) : string
    {
        return $this->translator->translate($message, $count, $parameters, $domain, $locale);
    }

    /**
     * @return string|void
     */
    public function findLayoutTemplateFile()
    {
        if ($this->layout === FALSE) {
            return;
        }
        return __DIR__ . '/../../../app/presenters/templates/@layout.latte';
    }

    /**
     * @param ITranslator $translator
     */
    public function injectTranslator(ITranslator $translator)
    {
        $this->translator = $translator;
    }
}