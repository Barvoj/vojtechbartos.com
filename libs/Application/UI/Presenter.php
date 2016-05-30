<?php

namespace Libs\Application\UI;

use Kdyby\Autowired\AutowireComponentFactories;
use Kdyby\Translation\ITranslator;

class Presenter extends \Nette\Application\UI\Presenter
{
    use AutowireComponentFactories;

    /** @var ITranslator */
    private $translator;

    /**
     * @param ITranslator $translator
     */
    public function injectTranslator(ITranslator $translator)
    {
        $this->translator = $translator;
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
}