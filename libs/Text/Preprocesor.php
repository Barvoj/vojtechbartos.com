<?php

namespace Libs\Text;


interface Preprocesor
{

    /**
     * @param string $text
     * @return string
     */
    public function process($text);
}