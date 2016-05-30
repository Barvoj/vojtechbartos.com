<?php

require dirname(__DIR__) . '/vendor/backend/autoload.php';

Testbench\Bootstrap::setup(__DIR__ . '/_temp', function (\Nette\Configurator $configurator) {
    $configurator->createRobotLoader()->addDirectory([
        __DIR__ . '/../app',
        __DIR__ . '/../extensions',
        __DIR__ . '/../libs',
    ])->register();

    $configurator->addParameters([
        'appDir' => __DIR__ . '/../app',
    ]);

    $configurator->addConfig(__DIR__ . '/../app/config/config.neon');
//    $configurator->addConfig(__DIR__ . '/tests.neon');
});