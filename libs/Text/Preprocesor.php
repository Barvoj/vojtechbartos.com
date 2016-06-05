<?php
/**
 * Created by PhpStorm.
 * User: Barvoj
 * Date: 05.06.2016
 * Time: 9:35
 */

namespace Libs\Text;


interface Preprocesor
{

    /**
     * @param string $text
     * @return string
     */
    public function process($text);
}