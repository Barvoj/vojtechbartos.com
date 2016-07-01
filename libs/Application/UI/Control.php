<?php

namespace Libs\Application\UI;


use Nette\Application\UI\Control as BaseControl;
use Nette\Application\UI\ITemplate;
use ReflectionClass;

class Control extends BaseControl
{
    const TEMPLATE_DIR = 'Template';
    const TEMPLATE_NAME = 'main';
    const TEMPLATE_CLASS = 'Main';

    /**
     * @return ITemplate
     */
    public function createTemplate() : ITemplate
    {
        $reflection = new ReflectionClass($this);

        $template = parent::createTemplate();
        $template->setFile($this->findTemplateFile($reflection));

        $templateClass = $reflection->getNamespaceName() . '\\' . self::TEMPLATE_DIR . '\\' . static::TEMPLATE_CLASS;

        return class_exists($templateClass) ? new $templateClass($template) : $template;
    }

    /**
     * @param ReflectionClass $reflection
     * @return string
     */
    protected function findTemplateFile(ReflectionClass $reflection)
    {
        $classFile = $reflection->getFileName();
        $directory = dirname($classFile);
        $templateFile = $directory . DIRECTORY_SEPARATOR . static::TEMPLATE_DIR . DIRECTORY_SEPARATOR . static::TEMPLATE_NAME . '.latte';

        if (file_exists($templateFile)) {
            return $templateFile;
        }

        $templateFile = preg_replace('/\.[^.]+$/', '.latte', $classFile);

        return $templateFile;
    }


    public function render()
    {
        $this->getTemplate()->render();
    }
}