<?php

namespace Libs\Forms;

use Nette\Utils\ArrayHash;

class FormValues
{
    /** @var ArrayHash */
    protected $values;

    /**
     * Values constructor.
     * @param ArrayHash $values
     */
    public function __construct(ArrayHash $values)
    {
        $this->values = $values;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get(string $name)
    {
        return $this->values[$name];
    }

    /**
     * @param string $name
     * @return bool
     */
    public function __isset(string $name) : bool
    {
        return isset($this->values[$name]);
    }
}