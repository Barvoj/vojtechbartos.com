<?php

namespace Libs\Application\UI;


use Nette\Application\UI\Control as BaseControl;
use Nette\Application\UI\ITemplate;
use ReflectionClass;

class Control extends BaseControl
{
    /**
     * @return ITemplate
     */
    public function createTemplate() : ITemplate
    {
        $template = parent::createTemplate();
        $classFile = (new ReflectionClass($this))->getFileName();
        $templateFile = preg_replace('/\.[^.]+$/', '.latte', $classFile);
        $template->setFile($templateFile);

        return $template;
    }

    public function render()
    {
        $this->getTemplate()->render();
    }
}