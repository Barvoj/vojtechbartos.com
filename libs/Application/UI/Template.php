<?php

namespace Libs\Application\UI;


use Nette\Application\UI\ITemplate;

class Template implements ITemplate
{
    /** @var ITemplate */
    protected $template;

    /**
     * Template constructor.
     * @param ITemplate $template
     */
    public function __construct(ITemplate $template)
    {
        $this->template = $template;
    }

    /**
     * Renders template to output.
     * @return void
     */
    function render()
    {
        $this->template->render();
    }

    /**
     * Sets the path to the template file.
     * @return void
     */
    function setFile($file)
    {
        $this->template->setFile($file);
    }

    /**
     * Returns the path to the template file.
     * @return string
     */
    function getFile()
    {
        return $this->template->getFile();
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set(string $name, $value)
    {
        $this->template->$name = $value;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get(string $name)
    {
        return $this->template->$name;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function __isset(string $name) : bool
    {
        return isset($this->template->$name);
    }
}