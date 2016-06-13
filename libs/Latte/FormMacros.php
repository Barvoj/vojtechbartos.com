<?php

namespace Libs\Latte;


use Latte\Compiler;
use Latte\Macros\MacroSet;

class FormMacros extends MacroSet
{
    /**
     * @param Compiler $compiler
     * @return FormMacros
     */
    public static function install(Compiler $compiler)
    {
        /** @var FormMacros $macroSet */
        $macroSet = new static($compiler);
        $macroSet->addMacro('field', 'echo $_form->getRenderer()->renderPair($_form[%node.word])');
    }
}