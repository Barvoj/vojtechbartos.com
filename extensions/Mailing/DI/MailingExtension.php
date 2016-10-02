<?php

namespace Mailing\DI;

use Libs\DI\CompilerExtension;

class MailingExtension extends CompilerExtension
{
    public function loadConfiguration()
    {
        $this->addConfig(__DIR__ . '/config.neon');
    }
}