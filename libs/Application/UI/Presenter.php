<?php

namespace Libs\Application\UI;

use Auth\AccessControl;
use Auth\Exceptions\NotSignInException;
use Kdyby\Autowired\AutowireComponentFactories;
use Kdyby\Translation\ITranslator;
use Nette\Application\ForbiddenRequestException;
use Nette\Reflection\ClassType;
use Nette\Reflection\Method;

class Presenter extends \Nette\Application\UI\Presenter
{
    use AutowireComponentFactories;

    /** @var ITranslator */
    private $translator;

    /** @var AccessControl */
    private $accessControl;

    /**
     * @param ClassType|Method $element
     * @throws ForbiddenRequestException
     */
    public function checkRequirements($element)
    {
        try {
            $this->accessControl->checkRequirements($this, $element);
        } catch (NotSignInException $ex) {
            $this->redirectToSignIn();
        }
    }

    protected function redirectToSignIn()
    {
        $this->redirect(':Auth:Front:Sign:in', ['backlink' => $this->storeRequest()]);
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
     * @return string|null
     */
    public function findLayoutTemplateFile()
    {
        if ($this->layout === FALSE) {
            return null;
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

    /**
     * @param AccessControl $accessControl
     */
    public function injectAccessControl(AccessControl $accessControl)
    {
        $this->accessControl = $accessControl;
    }
}