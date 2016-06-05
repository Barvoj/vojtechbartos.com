<?php

namespace Libs\Text;


use Texy\Texy;

class TexyPreprocesor implements Preprocesor
{

    /** @var Texy */
    protected $texy;

    /**
     * TexyPreprocesor constructor.
     */
    public function __construct()
    {
        $this->texy = new Texy();
    }

    /**
     * @param string $text
     * @return string
     */
    public function process($text)
    {
        return $this->texy->process($text);
    }
}