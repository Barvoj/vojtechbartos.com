<?php

namespace Libs\UI;
use Nette\Application\UI\ITemplate;

trait Template
{

    /**
     * Creates component template
     * @param string
     * @return ITemplate
     */
    protected function createTemplate($class = null)
    {
        $template = parent::createTemplate($class);
        // change file extension to .latte
        $template->setFile(preg_replace('/\.[^.]+$/', '.latte', $this->getReflection()->fileName));
        return $template;
    }

    /**
     * Renders component template
     */
    public function render()
    {
        $this->template->render();
    }
}