<?php

namespace Tests;

use Testbench\TPresenter;
use Tester\TestCase;

require __DIR__ . '/boostrap.php';

class HomePresenter extends TestCase
{
    use TPresenter;

    public function testArticle()
    {
        $this->checkAction('Article:Article:list');
    }
}

(new HomePresenter())->run();